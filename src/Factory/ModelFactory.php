<?php

namespace MatiashApp\Factory;

use MatiashApp\Exception\ModelNotExistsException;
use MatiashApp\MatiashApp;
use MatiashApp\Model\BaseModel;

class ModelFactory implements ModelFactoryInterface
{
    /**
     * @var MatiashApp
     */
    private $app;

    public function __construct(MatiashApp $app)
    {
        $this->app = $app;
    }

    /**
     * @param $className
     * @return BaseModel
     * @throws ModelNotExistsException
     */
    public function create($className)
    {
        if (!class_exists($className)) {
            throw new ModelNotExistsException;
        }

        return new $className($this->app);
    }
}