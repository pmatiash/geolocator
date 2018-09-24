<?php

namespace MatiashApp\Service;

use MatiashApp\Model\Visitor;

class VisitorSaver
{
    /**
     * @var IpFormatConverter
     */
    private $formatConverter;

    /**
     * @param IpFormatConverter $formatConverter
     */
    public function __construct(IpFormatConverter $formatConverter)
    {
        $this->formatConverter = $formatConverter;
    }

    /**
     * @param Visitor $visitor
     * @param array $data
     * @throws \Exception
     * @throws \MatiashApp\Exception\DataFormatException
     */
    public function save(Visitor $visitor, array $data)
    {
        $convertedIpAddress = $this->formatConverter->encode($data['ip']);

        $visitor->setIpAddress($convertedIpAddress);
        $visitor->setCountry($data['country']);
        $visitor->setCity($data['city']);
        $visitor->save();
    }
} 