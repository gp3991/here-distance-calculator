<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Gp3991\HereDistanceCalculator\App;
use Gp3991\HereDistanceCalculator\Exception\BadRequestHttpException;
use Gp3991\HereDistanceCalculator\Exception\HereRequestException;
use Gp3991\HereDistanceCalculator\Exception\HereRouteNotFoundException;
use Gp3991\HereDistanceCalculator\Exception\HttpException;
use Gp3991\HereDistanceCalculator\Exception\NotFoundHttpException;
use Gp3991\HereDistanceCalculator\Exception\ValidatorNotFoundException;
use Gp3991\HereDistanceCalculator\Here\Address as HereAddress;
use Gp3991\HereDistanceCalculator\Here\Here;
use Gp3991\HereDistanceCalculator\Here\Location;
use Gp3991\HereDistanceCalculator\Http\JsonRequestInterface;
use Gp3991\HereDistanceCalculator\Http\JsonResponse;
use Gp3991\HereDistanceCalculator\Http\RequestInterface;
use Gp3991\HereDistanceCalculator\Http\ResponseInterface;
use Gp3991\HereDistanceCalculator\Model\Address;
use Gp3991\HereDistanceCalculator\Model\MapLocation;
use Gp3991\HereDistanceCalculator\Model\RouteDistance;
use Gp3991\HereDistanceCalculator\Repository\AddressRepository;
use Gp3991\HereDistanceCalculator\Validator\Validator;
use OpenApi\Annotations as OA;

class HereController extends AbstractController
{
    public const MISSING_PARAMETER_MESSAGE = 'Missing %s parameter.';

    private Here $here;
    private AddressRepository $addressRepository;
    private Validator $validator;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->here = new Here();
        $this->addressRepository = new AddressRepository($this->getDbConnection());
        $this->validator = new Validator();
    }

    /**
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    private function getAddressFromQuery(RequestInterface $request): Address
    {
        $id = (int) ($request->getQuery()['address_id'] ?? null);

        if (!$id) {
            throw new BadRequestHttpException('You must provide an address_id parameter');
        }

        $address = $this->addressRepository->find($id);

        if (!$address) {
            throw new NotFoundHttpException(sprintf('Address id=%d not found', $id));
        }

        return $address;
    }

    /**
     * @OA\Get(
     *     path="/here/geocode",
     *     summary="Find an address based on a given query.",
     *     tags={"Here"},
     *     operationId="geocodeAddressAction",
     *     @OA\Parameter(
     *         description="Search query",
     *         in="query",
     *         name="q",
     *         required=true,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="MapLocation model on success",
     *          @OA\JsonContent(ref="#/components/schemas/MapLocation"),
     *      )
     * )
     *
     * @throws HttpException
     * @throws AssertionFailedException
     */
    public function geocodeAddressAction(JsonRequestInterface $request): ResponseInterface
    {
        $query = $request->getQuery();

        Assertion::keyExists(
            $query,
            'q',
            sprintf(
                self::MISSING_PARAMETER_MESSAGE,
                'q'
            )
        );

        Assertion::minLength(
            $query['q'],
            3,
            'Minimum length for `q` parameter is 3.'
        );

        try {
            $result = $this->here->geocodeAddress($query['q']);
        } catch (HereRequestException $e) {
            throw new BadRequestHttpException('Here API request error', data: ['here_message' => $e->getMessage()]);
        }

        $result = array_map(
            fn (HereAddress $address) => (new MapLocation(
                $address->label,
                $address->location->latitude,
                $address->location->longitude
            )),
            $result
        );

        return new JsonResponse($result);
    }

    /**
     * @OA\Get(
     *      path="/here/calculate-route",
     *      summary="Find the distance between Address and coordinates.",
     *      tags={"Here"},
     *      operationId="calculateRouteAction",
     *      @OA\Parameter(
     *          description="ID of Address",
     *          in="query",
     *          name="address_id",
     *          required=true,
     *          @OA\Schema(
     *            type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          description="Destination latitude",
     *          in="query",
     *          name="dest_latitude",
     *          required=true,
     *          @OA\Schema(
     *            type="number"
     *          )
     *      ),
     *      @OA\Parameter(
     *          description="Destination longitude",
     *          in="query",
     *          name="dest_longitude",
     *          required=true,
     *          @OA\Schema(
     *            type="number"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="RouteDistance model on success",
     *          @OA\JsonContent(ref="#/components/schemas/RouteDistance"),
     *      )
     * )
     *
     * @throws HttpException
     * @throws AssertionFailedException
     * @throws ValidatorNotFoundException
     */
    public function calculateRouteAction(JsonRequestInterface $request): ResponseInterface
    {
        $address = $this->getAddressFromQuery($request);
        $query = $request->getQuery();

        Assertion::keyExists(
            $query,
            'dest_latitude',
            sprintf(
                self::MISSING_PARAMETER_MESSAGE,
                'dest_latitude'
            )
        );

        Assertion::keyExists(
            $query,
            'dest_longitude',
            sprintf(
                self::MISSING_PARAMETER_MESSAGE,
                'dest_longitude'
            )
        );

        $destination = new Location(
            (float) $query['dest_latitude'],
            (float) $query['dest_longitude']
        );

        $this->validator->validate($destination);

        try {
            $length = $this->here->measureDistance(
                $address->getLocation(),
                $destination
            );
        } catch (HereRouteNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        } catch (HereRequestException $e) {
            throw new BadRequestHttpException('Here API request error', data: ['here_message' => $e->getMessage()]);
        }

        return new JsonResponse(
            (new RouteDistance($length))->toArray()
        );
    }
}
