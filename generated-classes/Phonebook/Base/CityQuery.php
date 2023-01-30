<?php

namespace Phonebook\Base;

use \Exception;
use \PDO;
use Phonebook\City as ChildCity;
use Phonebook\CityQuery as ChildCityQuery;
use Phonebook\Map\CityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'city' table.
 *
 *
 *
 * @method     ChildCityQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     ChildCityQuery orderByname($order = Criteria::ASC) Order by the name column
 * @method     ChildCityQuery orderByregion_id($order = Criteria::ASC) Order by the region_id column
 * @method     ChildCityQuery orderBycity_type_id($order = Criteria::ASC) Order by the city_type_id column
 *
 * @method     ChildCityQuery groupByid() Group by the id column
 * @method     ChildCityQuery groupByname() Group by the name column
 * @method     ChildCityQuery groupByregion_id() Group by the region_id column
 * @method     ChildCityQuery groupBycity_type_id() Group by the city_type_id column
 *
 * @method     ChildCityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCityQuery leftJoinRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Region relation
 * @method     ChildCityQuery rightJoinRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Region relation
 * @method     ChildCityQuery innerJoinRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the Region relation
 *
 * @method     ChildCityQuery joinWithRegion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Region relation
 *
 * @method     ChildCityQuery leftJoinWithRegion() Adds a LEFT JOIN clause and with to the query using the Region relation
 * @method     ChildCityQuery rightJoinWithRegion() Adds a RIGHT JOIN clause and with to the query using the Region relation
 * @method     ChildCityQuery innerJoinWithRegion() Adds a INNER JOIN clause and with to the query using the Region relation
 *
 * @method     ChildCityQuery leftJoinCity_type($relationAlias = null) Adds a LEFT JOIN clause to the query using the City_type relation
 * @method     ChildCityQuery rightJoinCity_type($relationAlias = null) Adds a RIGHT JOIN clause to the query using the City_type relation
 * @method     ChildCityQuery innerJoinCity_type($relationAlias = null) Adds a INNER JOIN clause to the query using the City_type relation
 *
 * @method     ChildCityQuery joinWithCity_type($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the City_type relation
 *
 * @method     ChildCityQuery leftJoinWithCity_type() Adds a LEFT JOIN clause and with to the query using the City_type relation
 * @method     ChildCityQuery rightJoinWithCity_type() Adds a RIGHT JOIN clause and with to the query using the City_type relation
 * @method     ChildCityQuery innerJoinWithCity_type() Adds a INNER JOIN clause and with to the query using the City_type relation
 *
 * @method     ChildCityQuery leftJoinStreet($relationAlias = null) Adds a LEFT JOIN clause to the query using the Street relation
 * @method     ChildCityQuery rightJoinStreet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Street relation
 * @method     ChildCityQuery innerJoinStreet($relationAlias = null) Adds a INNER JOIN clause to the query using the Street relation
 *
 * @method     ChildCityQuery joinWithStreet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Street relation
 *
 * @method     ChildCityQuery leftJoinWithStreet() Adds a LEFT JOIN clause and with to the query using the Street relation
 * @method     ChildCityQuery rightJoinWithStreet() Adds a RIGHT JOIN clause and with to the query using the Street relation
 * @method     ChildCityQuery innerJoinWithStreet() Adds a INNER JOIN clause and with to the query using the Street relation
 *
 * @method     \Phonebook\RegionQuery|\Phonebook\City_typeQuery|\Phonebook\StreetQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCity|null findOne(?ConnectionInterface $con = null) Return the first ChildCity matching the query
 * @method     ChildCity findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCity matching the query, or a new ChildCity object populated from the query conditions when no match is found
 *
 * @method     ChildCity|null findOneByid(int $id) Return the first ChildCity filtered by the id column
 * @method     ChildCity|null findOneByname(string $name) Return the first ChildCity filtered by the name column
 * @method     ChildCity|null findOneByregion_id(int $region_id) Return the first ChildCity filtered by the region_id column
 * @method     ChildCity|null findOneBycity_type_id(int $city_type_id) Return the first ChildCity filtered by the city_type_id column *

 * @method     ChildCity requirePk($key, ?ConnectionInterface $con = null) Return the ChildCity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOne(?ConnectionInterface $con = null) Return the first ChildCity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCity requireOneByid(int $id) Return the first ChildCity filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOneByname(string $name) Return the first ChildCity filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOneByregion_id(int $region_id) Return the first ChildCity filtered by the region_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOneBycity_type_id(int $city_type_id) Return the first ChildCity filtered by the city_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCity[]|Collection find(?ConnectionInterface $con = null) Return ChildCity objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCity> find(?ConnectionInterface $con = null) Return ChildCity objects based on current ModelCriteria
 * @method     ChildCity[]|Collection findByid(int $id) Return ChildCity objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCity> findByid(int $id) Return ChildCity objects filtered by the id column
 * @method     ChildCity[]|Collection findByname(string $name) Return ChildCity objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildCity> findByname(string $name) Return ChildCity objects filtered by the name column
 * @method     ChildCity[]|Collection findByregion_id(int $region_id) Return ChildCity objects filtered by the region_id column
 * @psalm-method Collection&\Traversable<ChildCity> findByregion_id(int $region_id) Return ChildCity objects filtered by the region_id column
 * @method     ChildCity[]|Collection findBycity_type_id(int $city_type_id) Return ChildCity objects filtered by the city_type_id column
 * @psalm-method Collection&\Traversable<ChildCity> findBycity_type_id(int $city_type_id) Return ChildCity objects filtered by the city_type_id column
 * @method     ChildCity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCity> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Phonebook\Base\CityQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Phonebook\\City', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCityQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCityQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCityQuery) {
            return $criteria;
        }
        $query = new ChildCityQuery();
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
     * @return ChildCity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CityTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, region_id, city_type_id FROM city WHERE id = :p0';
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
            /** @var ChildCity $obj */
            $obj = new ChildCity();
            $obj->hydrate($row);
            CityTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCity|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CityTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CityTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CityTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CityTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CityTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByname('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByname('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByname(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByname($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CityTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the region_id column
     *
     * Example usage:
     * <code>
     * $query->filterByregion_id(1234); // WHERE region_id = 1234
     * $query->filterByregion_id(array(12, 34)); // WHERE region_id IN (12, 34)
     * $query->filterByregion_id(array('min' => 12)); // WHERE region_id > 12
     * </code>
     *
     * @see       filterByRegion()
     *
     * @param mixed $region_id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByregion_id($region_id = null, ?string $comparison = null)
    {
        if (is_array($region_id)) {
            $useMinMax = false;
            if (isset($region_id['min'])) {
                $this->addUsingAlias(CityTableMap::COL_REGION_ID, $region_id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($region_id['max'])) {
                $this->addUsingAlias(CityTableMap::COL_REGION_ID, $region_id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CityTableMap::COL_REGION_ID, $region_id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the city_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterBycity_type_id(1234); // WHERE city_type_id = 1234
     * $query->filterBycity_type_id(array(12, 34)); // WHERE city_type_id IN (12, 34)
     * $query->filterBycity_type_id(array('min' => 12)); // WHERE city_type_id > 12
     * </code>
     *
     * @see       filterByCity_type()
     *
     * @param mixed $city_type_id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBycity_type_id($city_type_id = null, ?string $comparison = null)
    {
        if (is_array($city_type_id)) {
            $useMinMax = false;
            if (isset($city_type_id['min'])) {
                $this->addUsingAlias(CityTableMap::COL_CITY_TYPE_ID, $city_type_id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($city_type_id['max'])) {
                $this->addUsingAlias(CityTableMap::COL_CITY_TYPE_ID, $city_type_id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CityTableMap::COL_CITY_TYPE_ID, $city_type_id, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Phonebook\Region object
     *
     * @param \Phonebook\Region|ObjectCollection $region The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegion($region, ?string $comparison = null)
    {
        if ($region instanceof \Phonebook\Region) {
            return $this
                ->addUsingAlias(CityTableMap::COL_REGION_ID, $region->getid(), $comparison);
        } elseif ($region instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CityTableMap::COL_REGION_ID, $region->toKeyValue('PrimaryKey', 'id'), $comparison);

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
     * Filter the query by a related \Phonebook\City_type object
     *
     * @param \Phonebook\City_type|ObjectCollection $city_type The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_type($city_type, ?string $comparison = null)
    {
        if ($city_type instanceof \Phonebook\City_type) {
            return $this
                ->addUsingAlias(CityTableMap::COL_CITY_TYPE_ID, $city_type->getid(), $comparison);
        } elseif ($city_type instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CityTableMap::COL_CITY_TYPE_ID, $city_type->toKeyValue('PrimaryKey', 'id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCity_type() only accepts arguments of type \Phonebook\City_type or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the City_type relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCity_type(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('City_type');

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
            $this->addJoinObject($join, 'City_type');
        }

        return $this;
    }

    /**
     * Use the City_type relation City_type object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Phonebook\City_typeQuery A secondary query class using the current class as primary query
     */
    public function useCity_typeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCity_type($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'City_type', '\Phonebook\City_typeQuery');
    }

    /**
     * Use the City_type relation City_type object
     *
     * @param callable(\Phonebook\City_typeQuery):\Phonebook\City_typeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCity_typeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCity_typeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to City_type table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Phonebook\City_typeQuery The inner query object of the EXISTS statement
     */
    public function useCity_typeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('City_type', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to City_type table for a NOT EXISTS query.
     *
     * @see useCity_typeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Phonebook\City_typeQuery The inner query object of the NOT EXISTS statement
     */
    public function useCity_typeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('City_type', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Phonebook\Street object
     *
     * @param \Phonebook\Street|ObjectCollection $street the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStreet($street, ?string $comparison = null)
    {
        if ($street instanceof \Phonebook\Street) {
            $this
                ->addUsingAlias(CityTableMap::COL_ID, $street->getcity_id(), $comparison);

            return $this;
        } elseif ($street instanceof ObjectCollection) {
            $this
                ->useStreetQuery()
                ->filterByPrimaryKeys($street->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStreet() only accepts arguments of type \Phonebook\Street or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Street relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStreet(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Street');

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
            $this->addJoinObject($join, 'Street');
        }

        return $this;
    }

    /**
     * Use the Street relation Street object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Phonebook\StreetQuery A secondary query class using the current class as primary query
     */
    public function useStreetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStreet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Street', '\Phonebook\StreetQuery');
    }

    /**
     * Use the Street relation Street object
     *
     * @param callable(\Phonebook\StreetQuery):\Phonebook\StreetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStreetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useStreetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Street table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Phonebook\StreetQuery The inner query object of the EXISTS statement
     */
    public function useStreetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Street', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Street table for a NOT EXISTS query.
     *
     * @see useStreetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Phonebook\StreetQuery The inner query object of the NOT EXISTS statement
     */
    public function useStreetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Street', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildCity $city Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($city = null)
    {
        if ($city) {
            $this->addUsingAlias(CityTableMap::COL_ID, $city->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the city table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CityTableMap::clearInstancePool();
            CityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
