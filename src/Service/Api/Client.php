<?php

namespace MatiashApp\Service\Api;

use MatiashApp\Exception\DataNotFoundException;

class Client
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }
    public function getData($clientIp)
    {
        $token = $this->config['apiToken'];
        $url = sprintf('http://ipinfo.io/%s?token=%s', $clientIp, $token);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $data = curl_exec($ch);
            curl_close($ch);

        } catch (\Exception $e) {
            throw new DataNotFoundException;
        }

        return $data;
    }
} 