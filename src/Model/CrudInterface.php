<?php

namespace MatiashApp\Model;

interface CrudInterface
{
    public function find($tableName, $field, $value);

    public function insert($tableName, array $data);

    public function update($tableName, $tableAlias, array $data);

    public function delete($tableName, $tableAlias, $id);
}