<?php

namespace Phonebook\Base;

use \Exception;
use \PDO;
use Phonebook\Street as ChildStreet;
use Phonebook\StreetQuery as ChildStreetQuery;
use Phonebook\Map\StreetTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'street' table.
 *
 *
 *
 * @method     ChildStreetQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     ChildStreetQuery orderByname($order = Criteria::ASC) Order by the name column
 * @method     ChildStreetQuery orderBystreet_type_id($order = Criteria::ASC) Order by the street_type_id column
 * @method     ChildStreetQuery orderBycity_id($order = Criteria::ASC) Order by the city_id column
 *
 * @method     ChildStreetQuery groupByid() Group by the id column
 * @method     ChildStreetQuery groupByname() Group by the name column
 * @method     ChildStreetQuery groupBystreet_type_id() Group by the street_type_id column
 * @method     ChildStreetQuery groupBycity_id() Group by the city_id column
 *
 * @method     ChildStreetQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStreetQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStreetQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStreetQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStreetQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStreetQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStreetQuery leftJoinCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the City relation
 * @method     ChildStreetQuery rightJoinCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the City relation
 * @method     ChildStreetQuery innerJoinCity($relationAlias = null) Adds a INNER JOIN clause to the query using the City relation
 *
 * @method     ChildStreetQuery joinWithCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the City relation
 *
 * @method     ChildStreetQuery leftJoinWithCity() Adds a LEFT JOIN clause and with to the query using the City relation
 * @method     ChildStreetQuery rightJoinWithCity() Adds a RIGHT JOIN clause and with to the query using the City relation
 * @method     ChildStreetQuery innerJoinWithCity() Adds a INNER JOIN clause and with to the query using the City relation
 *
 * @method     ChildStreetQuery leftJoinStreet_type($relationAlias = null) Adds a LEFT JOIN clause to the query using the Street_type relation
 * @method     ChildStreetQuery rightJoinStreet_type($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Street_type relation
 * @method     ChildStreetQuery innerJoinStreet_type($relationAlias = null) Adds a INNER JOIN clause to the query using the Street_type relation
 *
 * @method     ChildStreetQuery joinWithStreet_type($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Street_type relation
 *
 * @method     ChildStreetQuery leftJoinWithStreet_type() Adds a LEFT JOIN clause and with to the query using the Street_type relation
 * @method     ChildStreetQuery rightJoinWithStreet_type() Adds a RIGHT JOIN clause and with to the query using the Street_type relation
 * @method     ChildStreetQuery innerJoinWithStreet_type() Adds a INNER JOIN clause and with to the query using the Street_type relation
 *
 * @method     ChildStreetQuery leftJoinAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the Address relation
 * @method     ChildStreetQuery rightJoinAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Address relation
 * @method     ChildStreetQuery innerJoinAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the Address relation
 *
 * @method     ChildStreetQuery joinWithAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Address relation
 *
 * @method     ChildStreetQuery leftJoinWithAddress() Adds a LEFT JOIN clause and with to the query using the Address relation
 * @method     ChildStreetQuery rightJoinWithAddress() Adds a RIGHT JOIN clause and with to the query using the Address relation
 * @method     ChildStreetQuery innerJoinWithAddress() Adds a INNER JOIN clause and with to the query using the Address relation
 *
 * @method     \Phonebook\CityQuery|\Phonebook\Street_typeQuery|\Phonebook\AddressQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStreet|null findOne(?ConnectionInterface $con = null) Return the first ChildStreet matching the query
 * @method     ChildStreet findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStreet matching the query, or a new ChildStreet object populated from the query conditions when no match is found
 *
 * @method     ChildStreet|null findOneByid(int $id) Return the first ChildStreet filtered by the id column
 * @method     ChildStreet|null findOneByname(string $name) Return the first ChildStreet filtered by the name column
 * @method     ChildStreet|null findOneBystreet_type_id(int $street_type_id) Return the first ChildStreet filtered by the street_type_id column
 * @method     ChildStreet|null findOneBycity_id(int $city_id) Return the first ChildStreet filtered by the city_id column *

 * @method     ChildStreet requirePk($key, ?ConnectionInterface $con = null) Return the ChildStreet by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStreet requireOne(?ConnectionInterface $con = null) Return the first ChildStreet matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStreet requireOneByid(int $id) Return the first ChildStreet filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStreet requireOneByname(string $name) Return the first ChildStreet filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStreet requireOneBystreet_type_id(int $street_type_id) Return the first ChildStreet filtered by the street_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStreet requireOneBycity_id(int $city_id) Return the first ChildStreet filtered by the city_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStreet[]|Collection find(?ConnectionInterface $con = null) Return ChildStreet objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStreet> find(?ConnectionInterface $con = null) Return ChildStreet objects based on current ModelCriteria
 * @method     ChildStreet[]|Collection findByid(int $id) Return ChildStreet objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildStreet> findByid(int $id) Return ChildStreet objects filtered by the id column
 * @method     ChildStreet[]|Collection findByname(string $name) Return ChildStreet objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildStreet> findByname(string $name) Return ChildStreet objects filtered by the name column
 * @method     ChildStreet[]|Collection findBystreet_type_id(int $street_type_id) Return ChildStreet objects filtered by the street_type_id column
 * @psalm-method Collection&\Traversable<ChildStreet> findBystreet_type_id(int $street_type_id) Return ChildStreet objects filtered by the street_type_id column
 * @method     ChildStreet[]|Collection findBycity_id(int $city_id) Return ChildStreet objects filtered by the city_id column
 * @psalm-method Collection&\Traversable<ChildStreet> findBycity_id(int $city_id) Return ChildStreet objects filtered by the city_id column
 * @method     ChildStreet[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStreet> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StreetQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Phonebook\Base\StreetQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Phonebook\\Street', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStreetQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStreetQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStreetQuery) {
            return $criteria;
        }
        $query = new ChildStreetQuery();
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
     * @return ChildStreet|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StreetTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StreetTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStreet A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, street_type_id, city_id FROM street WHERE id = :p0';
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
            /** @var ChildStreet $obj */
            $obj = new ChildStreet();
            $obj->hydrate($row);
            StreetTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStreet|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StreetTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StreetTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(StreetTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StreetTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StreetTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(StreetTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the street_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterBystreet_type_id(1234); // WHERE street_type_id = 1234
     * $query->filterBystreet_type_id(array(12, 34)); // WHERE street_type_id IN (12, 34)
     * $query->filterBystreet_type_id(array('min' => 12)); // WHERE street_type_id > 12
     * </code>
     *
     * @see       filterByStreet_type()
     *
     * @param mixed $street_type_id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBystreet_type_id($street_type_id = null, ?string $comparison = null)
    {
        if (is_array($street_type_id)) {
            $useMinMax = false;
            if (isset($street_type_id['min'])) {
                $this->addUsingAlias(StreetTableMap::COL_STREET_TYPE_ID, $street_type_id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($street_type_id['max'])) {
                $this->addUsingAlias(StreetTableMap::COL_STREET_TYPE_ID, $street_type_id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StreetTableMap::COL_STREET_TYPE_ID, $street_type_id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the city_id column
     *
     * Example usage:
     * <code>
     * $query->filterBycity_id(1234); // WHERE city_id = 1234
     * $query->filterBycity_id(array(12, 34)); // WHERE city_id IN (12, 34)
     * $query->filterBycity_id(array('min' => 12)); // WHERE city_id > 12
     * </code>
     *
     * @see       filterByCity()
     *
     * @param mixed $city_id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBycity_id($city_id = null, ?string $comparison = null)
    {
        if (is_array($city_id)) {
            $useMinMax = false;
            if (isset($city_id['min'])) {
                $this->addUsingAlias(StreetTableMap::COL_CITY_ID, $city_id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($city_id['max'])) {
                $this->addUsingAlias(StreetTableMap::COL_CITY_ID, $city_id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StreetTableMap::COL_CITY_ID, $city_id, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Phonebook\City object
     *
     * @param \Phonebook\City|ObjectCollection $city The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity($city, ?string $comparison = null)
    {
        if ($city instanceof \Phonebook\City) {
            return $this
                ->addUsingAlias(StreetTableMap::COL_CITY_ID, $city->getid(), $comparison);
        } elseif ($city instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StreetTableMap::COL_CITY_ID, $city->toKeyValue('PrimaryKey', 'id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCity() only accepts arguments of type \Phonebook\City or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the City relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCity(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('City');

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
            $this->addJoinObject($join, 'City');
        }

        return $this;
    }

    /**
     * Use the City relation City object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Phonebook\CityQuery A secondary query class using the current class as primary query
     */
    public function useCityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'City', '\Phonebook\CityQuery');
    }

    /**
     * Use the City relation City object
     *
     * @param callable(\Phonebook\CityQuery):\Phonebook\CityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to City table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Phonebook\CityQuery The inner query object of the EXISTS statement
     */
    public function useCityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('City', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to City table for a NOT EXISTS query.
     *
     * @see useCityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Phonebook\CityQuery The inner query object of the NOT EXISTS statement
     */
    public function useCityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('City', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Phonebook\Street_type object
     *
     * @param \Phonebook\Street_type|ObjectCollection $street_type The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStreet_type($street_type, ?string $comparison = null)
    {
        if ($street_type instanceof \Phonebook\Street_type) {
            return $this
                ->addUsingAlias(StreetTableMap::COL_STREET_TYPE_ID, $street_type->getid(), $comparison);
        } elseif ($street_type instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StreetTableMap::COL_STREET_TYPE_ID, $street_type->toKeyValue('PrimaryKey', 'id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByStreet_type() only accepts arguments of type \Phonebook\Street_type or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Street_type relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStreet_type(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Street_type');

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
            $this->addJoinObject($join, 'Street_type');
        }

        return $this;
    }

    /**
     * Use the Street_type relation Street_type object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Phonebook\Street_typeQuery A secondary query class using the current class as primary query
     */
    public function useStreet_typeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStreet_type($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Street_type', '\Phonebook\Street_typeQuery');
    }

    /**
     * Use the Street_type relation Street_type object
     *
     * @param callable(\Phonebook\Street_typeQuery):\Phonebook\Street_typeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStreet_typeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useStreet_typeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Street_type table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Phonebook\Street_typeQuery The inner query object of the EXISTS statement
     */
    public function useStreet_typeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Street_type', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Street_type table for a NOT EXISTS query.
     *
     * @see useStreet_typeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Phonebook\Street_typeQuery The inner query object of the NOT EXISTS statement
     */
    public function useStreet_typeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Street_type', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Phonebook\Address object
     *
     * @param \Phonebook\Address|ObjectCollection $address the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress($address, ?string $comparison = null)
    {
        if ($address instanceof \Phonebook\Address) {
            $this
                ->addUsingAlias(StreetTableMap::COL_ID, $address->getstreet_id(), $comparison);

            return $this;
        } elseif ($address instanceof ObjectCollection) {
            $this
                ->useAddressQuery()
                ->filterByPrimaryKeys($address->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAddress() only accepts arguments of type \Phonebook\Address or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Address relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Address');

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
            $this->addJoinObject($join, 'Address');
        }

        return $this;
    }

    /**
     * Use the Address relation Address object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Phonebook\AddressQuery A secondary query class using the current class as primary query
     */
    public function useAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Address', '\Phonebook\AddressQuery');
    }

    /**
     * Use the Address relation Address object
     *
     * @param callable(\Phonebook\AddressQuery):\Phonebook\AddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Address table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Phonebook\AddressQuery The inner query object of the EXISTS statement
     */
    public function useAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Address', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Address table for a NOT EXISTS query.
     *
     * @see useAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Phonebook\AddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Address', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildStreet $street Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($street = null)
    {
        if ($street) {
            $this->addUsingAlias(StreetTableMap::COL_ID, $street->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the street table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StreetTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StreetTableMap::clearInstancePool();
            StreetTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StreetTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StreetTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StreetTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StreetTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
