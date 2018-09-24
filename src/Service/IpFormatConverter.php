<?php

namespace MatiashApp\Service;

use MatiashApp\Exception\DataFormatException;

class IpFormatConverter
{
    /**
     * @param $ipAddress
     * @return int
     * @throws DataFormatException
     */
    public function encode($ipAddress)
    {
        $convertedIpAddress = ip2long($ipAddress);

        if (false === $convertedIpAddress) {
            throw new DataFormatException;
        }

        return $convertedIpAddress;
    }

    /**
     * @param $convertedIpAddress
     * @return string
     */
    public function decode($convertedIpAddress)
    {
        return long2ip($convertedIpAddress);
    }
} 