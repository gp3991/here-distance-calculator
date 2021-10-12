<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Gp3991\HereDistanceCalculator\App;
use Gp3991\HereDistanceCalculator\Exception\BadRequestHttpException;
use Gp3991\HereDistanceCalculator\Exception\HttpException;
use Gp3991\HereDistanceCalculator\Exception\NotFoundHttpException;
use Gp3991\HereDistanceCalculator\Exception\ValidatorNotFoundException;
use Gp3991\HereDistanceCalculator\Http\JsonRequestInterface;
use Gp3991\HereDistanceCalculator\Http\JsonResponse;
use Gp3991\HereDistanceCalculator\Http\RequestInterface;
use Gp3991\HereDistanceCalculator\Http\ResponseInterface;
use Gp3991\HereDistanceCalculator\Model\Address;
use Gp3991\HereDistanceCalculator\ObjectManager\AddressObjectManager;
use Gp3991\HereDistanceCalculator\Repository\AddressRepository;
use Gp3991\HereDistanceCalculator\Validator\Validator;

class AddressController extends AbstractController
{
    private AddressRepository $addressRepository;
    private AddressObjectManager $addressObjectManager;
    private Validator $validator;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->addressRepository = new AddressRepository($this->getDbConnection());
        $this->addressObjectManager = new AddressObjectManager(
            $this->getDbConnection(),
            $this->addressRepository
        );
        $this->validator = new Validator();
    }

    /**
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    private function getAddressFromQuery(RequestInterface $request): Address
    {
        $id = (int) ($request->getQuery()['id'] ?? null);

        if (!$id) {
            throw new BadRequestHttpException('You must provide an id parameter');
        }

        $address = $this->addressRepository->find($id);

        if (!$address) {
            throw new NotFoundHttpException(sprintf('Item id=%d not found', $id));
        }

        return $address;
    }

    public function getCollectionAction(): ResponseInterface
    {
        return new JsonResponse(
            array_map(
                fn ($obj) => $obj->toArray(),
                $this->addressRepository->findAll()
            )
        );
    }

    /**
     * @throws HttpException
     */
    public function getItemAction(JsonRequestInterface $request): ResponseInterface
    {
        $address = $this->getAddressFromQuery($request);

        return new JsonResponse($address->toArray());
    }

    /**
     * @throws HttpException
     */
    public function removeItemAction(JsonRequestInterface $request): ResponseInterface
    {
        $address = $this->getAddressFromQuery($request);
        $this->addressObjectManager->delete($address);

        return new JsonResponse(['status' => true]);
    }

    /**
     * @throws ValidatorNotFoundException
     */
    public function createItemAction(JsonRequestInterface $request): ResponseInterface
    {
        $newAddress = Address::createFromArray($request->getJsonBody());
        $this->validator->validate($newAddress);

        return new JsonResponse(
            $this->addressObjectManager->save($newAddress),
            201
        );
    }

    /**
     * @throws ValidatorNotFoundException
     * @throws HttpException
     */
    public function updateItemAction(JsonRequestInterface $request): ResponseInterface
    {
        $address = $this->getAddressFromQuery($request)
            ->updateFromArray($request->getJsonBody());

        $this->validator->validate($address);

        return new JsonResponse(
            $this->addressObjectManager->update($address)
        );
    }
}
