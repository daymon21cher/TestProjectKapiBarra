<?php

namespace Phonebook\Base;

use \Exception;
use \PDO;
use Phonebook\Region_type as ChildRegion_type;
use Phonebook\Region_typeQuery as ChildRegion_typeQuery;
use Phonebook\Map\Region_typeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'region_type' table.
 *
 *
 *
 * @method     ChildRegion_typeQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     ChildRegion_typeQuery orderByvalue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildRegion_typeQuery groupByid() Group by the id column
 * @method     ChildRegion_typeQuery groupByvalue() Group by the value column
 *
 * @method     ChildRegion_typeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegion_typeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegion_typeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegion_typeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRegion_typeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRegion_typeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRegion_typeQuery leftJoinRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Region relation
 * @method     ChildRegion_typeQuery rightJoinRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Region relation
 * @method     ChildRegion_typeQuery innerJoinRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the Region relation
 *
 * @method     ChildRegion_typeQuery joinWithRegion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Region relation
 *
 * @method     ChildRegion_typeQuery leftJoinWithRegion() Adds a LEFT JOIN clause and with to the query using the Region relation
 * @method     ChildRegion_typeQuery rightJoinWithRegion() Adds a RIGHT JOIN clause and with to the query using the Region relation
 * @method     ChildRegion_typeQuery innerJoinWithRegion() Adds a INNER JOIN clause and with to the query using the Region relation
 *
 * @method     \Phonebook\RegionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegion_type|null findOne(?ConnectionInterface $con = null) Return the first ChildRegion_type matching the query
 * @method     ChildRegion_type findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRegion_type matching the query, or a new ChildRegion_type object populated from the query conditions when no match is found
 *
 * @method     ChildRegion_type|null findOneByid(int $id) Return the first ChildRegion_type filtered by the id column
 * @method     ChildRegion_type|null findOneByvalue(string $value) Return the first ChildRegion_type filtered by the value column *

 * @method     ChildRegion_type requirePk($key, ?ConnectionInterface $con = null) Return the ChildRegion_type by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegion_type requireOne(?ConnectionInterface $con = null) Return the first ChildRegion_type matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegion_type requireOneByid(int $id) Return the first ChildRegion_type filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRegion_type requireOneByvalue(string $value) Return the first ChildRegion_type filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRegion_type[]|Collection find(?ConnectionInterface $con = null) Return ChildRegion_type objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRegion_type> find(?ConnectionInterface $con = null) Return ChildRegion_type objects based on current ModelCriteria
 * @method     ChildRegion_type[]|Collection findByid(int $id) Return ChildRegion_type objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildRegion_type> findByid(int $id) Return ChildRegion_type objects filtered by the id column
 * @method     ChildRegion_type[]|Collection findByvalue(string $value) Return ChildRegion_type objects filtered by the value column
 * @psalm-method Collection&\Traversable<ChildRegion_type> findByvalue(string $value) Return ChildRegion_type objects filtered by the value column
 * @method     ChildRegion_type[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRegion_type> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class Region_typeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Phonebook\Base\Region_typeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Phonebook\\Region_type', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegion_typeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegion_typeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRegion_typeQuery) {
            return $criteria;
        }
        $query = new ChildRegion_typeQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRegion_type|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(Region_typeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = Region_typeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRegion_type A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, value FROM region_type WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRegion_type $obj */
            $obj = new ChildRegion_type();
            $obj->hydrate($row);
            Region_typeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildRegion_type|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(Region_typeTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(Region_typeTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterByid(1234); // WHERE id = 1234
     * $query->filterByid(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterByid(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByid($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(Region_typeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(Region_typeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(Region_typeTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByvalue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByvalue('%fooValue%', Criteria::LIKE); // WHERE value LIKE '%fooValue%'
     * $query->filterByvalue(['foo', 'bar']); // WHERE value IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $value The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByvalue($value = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(Region_typeTableMap::COL_VALUE, $value, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Phonebook\Region object
     *
     * @param \Phonebook\Region|ObjectCollection $region the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegion($region, ?string $comparison = null)
    {
        if ($region instanceof \Phonebook\Region) {
            $this
                ->addUsingAlias(Region_typeTableMap::COL_ID, $region->getregion_type_id(), $comparison);

            return $this;
        } elseif ($region instanceof ObjectCollection) {
            $this
                ->useRegionQuery()
                ->filterByPrimaryKeys($region->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByRegion() only accepts arguments of type \Phonebook\Region or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Region relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRegion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Region');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Region');
        }

        return $this;
    }

    /**
     * Use the Region relation Region object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Phonebook\RegionQuery A secondary query class using the current class as primary query
     */
    public function useRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Region', '\Phonebook\RegionQuery');
    }

    /**
     * Use the Region relation Region object
     *
     * @param callable(\Phonebook\RegionQuery):\Phonebook\RegionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRegionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useRegionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Region table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Phonebook\RegionQuery The inner query object of the EXISTS statement
     */
    public function useRegionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Region', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Region table for a NOT EXISTS query.
     *
     * @see useRegionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Phonebook\RegionQuery The inner query object of the NOT EXISTS statement
     */
    public function useRegionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Region', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildRegion_type $region_type Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($region_type = null)
    {
        if ($region_type) {
            $this->addUsingAlias(Region_typeTableMap::COL_ID, $region_type->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the region_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(Region_typeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            Region_typeTableMap::clearInstancePool();
            Region_typeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(Region_typeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(Region_typeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            Region_typeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            Region_typeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}