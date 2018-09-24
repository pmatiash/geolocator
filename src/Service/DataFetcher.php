<?php

namespace MatiashApp\Service;

use MatiashApp\Exception\DataNotFoundException;
use MatiashApp\Factory\ModelFactoryInterface;
use MatiashApp\Model\Visitor;
use MatiashApp\Service\Api\Client;

class DataFetcher
{
    /**
     * @var Client
     */
    private $apiClient;

    /**
     * @var ModelFactoryInterface
     */
    private $modelFactory;

    /**
     * @var IpFormatConverter
     */
    private $formatConverter;

    /**
     * @var VisitorSaver
     */
    private $visitorSaver;

    public function __construct(
        Client $apiClient,
        ModelFactoryInterface $modelFactory,
        IpFormatConverter $formatConverter,
        VisitorSaver $visitorSaver
    ) {
        $this->apiClient = $apiClient;
        $this->modelFactory = $modelFactory;
        $this->formatConverter = $formatConverter;
        $this->visitorSaver = $visitorSaver;
    }

    public function getVisitorByIp($clientIp)
    {
        $activeRecordInstance = $this->modelFactory->create(Visitor::class);
        $convertedIpAddress = $this->formatConverter->encode($clientIp);
        $visitor = $activeRecordInstance->findOneBy('ipAddress', $convertedIpAddress);

        if (!$visitor instanceof Visitor) {
            $jsonData = $this->apiClient->getData($clientIp);
            $data = json_decode($jsonData, 1);
            if ($data) {
                $visitor = $this->modelFactory->create(Visitor::class);
                $this->visitorSaver->save($visitor, $data);
            } else {
                throw new DataNotFoundException;
            }
        }

        return $visitor;
    }
} 