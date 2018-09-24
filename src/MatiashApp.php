<?php

namespace MatiashApp;

use Doctrine\DBAL\Connection;
use Silex\Application;
use Silex\Application\TwigTrait;

class MatiashApp extends Application
{
    use TwigTrait;

    /**
     * @var Connection
     */
    private $db;

    private $config;

    /**
     * @param Connection $db
     * @return $this
     */
    public function setConnection(Connection $db)
    {
        $this->db = $db;

        return $this;
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->db;
    }

    public function setConfig(array $config)
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }
} 