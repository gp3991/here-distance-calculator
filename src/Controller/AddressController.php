<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Gp3991\HereDistanceCalculator\Exception\BadRequestHttpException;
use Gp3991\HereDistanceCalculator\Exception\HttpException;
use Gp3991\HereDistanceCalculator\Exception\NotFoundHttpException;
use Gp3991\HereDistanceCalculator\Http\JsonResponse;
use Gp3991\HereDistanceCalculator\Http\RequestInterface;
use Gp3991\HereDistanceCalculator\Http\ResponseInterface;
use Gp3991\HereDistanceCalculator\Repository\AddressRepository;

class AddressController extends AbstractController
{
    private AddressRepository $addressRepository;

    public function __construct()
    {
        parent::__construct();

        $this->addressRepository = new AddressRepository($this->dbConnection);
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
    public function getItemAction(RequestInterface $request): ResponseInterface
    {
        $id = (int) ($request->getQuery()['id'] ?? null);

        if (!$id) {
            throw new BadRequestHttpException('You must provide an id parameter');
        }
        
        $address = $this->addressRepository->find($id);
        
        if (!$address) {
            throw new NotFoundHttpException(
                sprintf('Item id=%d not found', $id)
            );
        }
        
        return new JsonResponse($address->toArray());
    }
}
