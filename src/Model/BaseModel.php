<?php

namespace MatiashApp\Model;

abstract class BaseModel extends ActiveRecordModel implements ModelInterface
{
    const PREFIX_SET = 'set';

    /**
     * @return string
     */
    public  function getTableAlias()
    {
        return substr($this->getTableName(), 0, 2);
    }

    /**
     * @throws \Exception
     */
    public function save()
    {
        try {
            if (null == $this->getId()) {
                $this->insert(
                    $this->getTableName(),
                    $this->toArray()
                );
            } else {
                $this->update(
                    $this->getTableName(),
                    $this->getTableAlias(),
                    $this->toArray()
                );
            }

        } catch (\Exception $e) {
            throw $e;
        }

        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    public function findOneBy($field, $value)
    {
        $data = parent::findOne($this->getTableName(), $field, $value);

        if (!$data) {
            return null;
        }

        return $this->persistModel($data);
    }

    private function persistModel($data)
    {
        foreach ($data as $field => $value) {
            $methodName = $this->getMethodName($field, self::PREFIX_SET);

            if (method_exists($this, $methodName)) {
                call_user_func([$this, $methodName], $value);
            }
        }

        return $this;
    }

    private function getMethodName($fieldName, $prefix)
    {
        $parts = explode('_', $fieldName);
        $preparedFieldName = '';

        foreach ($parts as $part) {
            $preparedFieldName .= ucfirst($part);
        }
        $methodName = $prefix.$preparedFieldName;

        return $methodName;
    }
} 