<?php

namespace MatiashApp\Model;

interface ModelInterface
{
    public function save();

    public function getId();

    public function getTableName();

    public function getTableAlias();

    public function toArray();
}