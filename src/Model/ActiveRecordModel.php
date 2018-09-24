<?php

namespace MatiashApp\Model;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use MatiashApp\MatiashApp;

abstract class ActiveRecordModel implements CrudInterface
{
    /**
     * @var Connection
     */
    private $dbConnection;

    public function __construct(MatiashApp $app)
    {
        $this->dbConnection = $app->getConnection();
    }

    /**
     * @return QueryBuilder
     */
    protected function createQueryBuilder()
    {
        return $this->dbConnection->createQueryBuilder();
    }

    /**
     * @param string $tableName
     * @param array $data
     *
     * @return $this
     */
    public function insert($tableName, array $data)
    {
        $this->createQueryBuilder()
            ->insert($tableName)
            ->values($data)
            ->execute();

        return $this;
    }

    /**
     * @param string $tableName
     * @param string $tableAlias
     * @param array $data
     *
     * @return $this
     */
    public function update($tableName, $tableAlias, array $data)
    {
        $queryBuilder = $this->createQueryBuilder()
            ->update($tableName, $tableAlias);

        $id = $data['id'];
        unset($data['id']);

        foreach ($data as $filed => $value) {
            $queryBuilder->set($filed, $value);
        }

        $queryBuilder->where(
            sprintf(
                '%s.id=%d',
                $tableAlias,
                $id
            )
        );
        $queryBuilder->execute();

        return $this;
    }

    /**
     * @param string $tableName
     * @param string $tableAlias
     * @param int $id
     */
    public function delete($tableName, $tableAlias, $id)
    {
        $this->createQueryBuilder()
            ->delete($tableName, $tableAlias)
            ->where(
                sprintf(
                    '%s.id=%d',
                    $tableAlias,
                    $id
                )
            )
            ->execute();
    }

    /**
     * @param string $tableName
     * @param string $field
     * @param string $value
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    public function findOne($tableName, $field, $value)
    {
        return $this->createQueryBuilder()
            ->select('*')
            ->from($tableName)
            ->where(sprintf('%s="%s"', $field, $value))
            ->setMaxResults(1)
            ->execute();
    }

    public function find($tableName, $field, $value)
    {
        return $this->createQueryBuilder()
            ->select('*')
            ->from($tableName)
            ->where(sprintf('%s="%s"', $field, $value))
            ->execute();
    }
}