<?php

namespace MatiashApp\Controller;

use MatiashApp\Exception\BadRequestException;
use MatiashApp\MatiashApp;
use MatiashApp\Service\DataFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GeoLocationController
{
    /**
     * @var DataFetcher
     */
    private $dataFetcher;

    /**
     * @param DataFetcher $dataFetcher
     */
    public function __construct(DataFetcher $dataFetcher)
    {
        $this->dataFetcher = $dataFetcher;
    }

    /**
     * @param Request $request
     * @param MatiashApp $app
     * @return Response
     * @throws
     */
    public function postAction(Request $request, MatiashApp $app)
    {
        try {
            $clientIp = $request->get('clientIp');

            if (!$clientIp) {
                throw new BadRequestException(
                    'Client IP was not received!'
                );
            }

            $visitor = $this->dataFetcher->getVisitorByIp($clientIp);

            return $app->render(
                'partials/visitor-info.html.twig',
                [
                    'visitor' => $visitor
                ]
            );

        } catch (\Exception $e) {
            return $app->render(
                'errors/error.html.twig',
                [
                    'errorMessage' => $e->getMessage()
                ]
            );
        }
    }
}

