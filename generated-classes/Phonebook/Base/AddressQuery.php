<?php

namespace Phonebook\Base;

use \Exception;
use \PDO;
use Phonebook\Address as ChildAddress;
use Phonebook\AddressQuery as ChildAddressQuery;
use Phonebook\Map\AddressTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'address' table.
 *
 *
 *
 * @method     ChildAddressQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     ChildAddressQuery orderByaddress_str($order = Criteria::ASC) Order by the address_str column
 * @method     ChildAddressQuery orderBybuilding_number($order = Criteria::ASC) Order by the building_number column
 * @method     ChildAddressQuery orderBynumber($order = Criteria::ASC) Order by the number column
 * @method     ChildAddressQuery orderBystreet_id($order = Criteria::ASC) Order by the street_id column
 * @method     ChildAddressQuery orderBybuilding_type_id($order = Criteria::ASC) Order by the building_type_id column
 *
 * @method     ChildAddressQuery groupByid() Group by the id column
 * @method     ChildAddressQuery groupByaddress_str() Group by the address_str column
 * @method     ChildAddressQuery groupBybuilding_number() Group by the building_number column
 * @method     ChildAddressQuery groupBynumber() Group by the number column
 * @method     ChildAddressQuery groupBystreet_id() Group by the street_id column
 * @method     ChildAddressQuery groupBybuilding_type_id() Group by the building_type_id column
 *
 * @method     ChildAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAddressQuery leftJoinStreet($relationAlias = null) Adds a LEFT JOIN clause to the query using the Street relation
 * @method     ChildAddressQuery rightJoinStreet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Street relation
 * @method     ChildAddressQuery innerJoinStreet($relationAlias = null) Adds a INNER JOIN clause to the query using the Street relation
 *
 * @method     ChildAddressQuery joinWithStreet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Street relation
 *
 * @method     ChildAddressQuery leftJoinWithStreet() Adds a LEFT JOIN clause and with to the query using the Street relation
 * @method     ChildAddressQuery rightJoinWithStreet() Adds a RIGHT JOIN clause and with to the query using the Street relation
 * @method     ChildAddressQuery innerJoinWithStreet() Adds a INNER JOIN clause and with to the query using the Street relation
 *
 * @method     ChildAddressQuery leftJoinBuilding_type($relationAlias = null) Adds a LEFT JOIN clause to the query using the Building_type relation
 * @method     ChildAddressQuery rightJoinBuilding_type($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Building_type relation
 * @method     ChildAddressQuery innerJoinBuilding_type($relationAlias = null) Adds a INNER JOIN clause to the query using the Building_type relation
 *
 * @method     ChildAddressQuery joinWithBuilding_type($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Building_type relation
 *
 * @method     ChildAddressQuery leftJoinWithBuilding_type() Adds a LEFT JOIN clause and with to the query using the Building_type relation
 * @method     ChildAddressQuery rightJoinWithBuilding_type() Adds a RIGHT JOIN clause and with to the query using the Building_type relation
 * @method     ChildAddressQuery innerJoinWithBuilding_type() Adds a INNER JOIN clause and with to the query using the Building_type relation
 *
 * @method     ChildAddressQuery leftJoinPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the Person relation
 * @method     ChildAddressQuery rightJoinPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Person relation
 * @method     ChildAddressQuery innerJoinPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the Person relation
 *
 * @method     ChildAddressQuery joinWithPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Person relation
 *
 * @method     ChildAddressQuery leftJoinWithPerson() Adds a LEFT JOIN clause and with to the query using the Person relation
 * @method     ChildAddressQuery rightJoinWithPerson() Adds a RIGHT JOIN clause and with to the query using the Person relation
 * @method     ChildAddressQuery innerJoinWithPerson() Adds a INNER JOIN clause and with to the query using the Person relation
 *
 * @method     \Phonebook\StreetQuery|\Phonebook\Building_typeQuery|\Phonebook\PersonQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAddress|null findOne(?ConnectionInterface $con = null) Return the first ChildAddress matching the query
 * @method     ChildAddress findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAddress matching the query, or a new ChildAddress object populated from the query conditions when no match is found
 *
 * @method     ChildAddress|null findOneByid(int $id) Return the first ChildAddress filtered by the id column
 * @method     ChildAddress|null findOneByaddress_str(string $address_str) Return the first ChildAddress filtered by the address_str column
 * @method     ChildAddress|null findOneBybuilding_number(string $building_number) Return the first ChildAddress filtered by the building_number column
 * @method     ChildAddress|null findOneBynumber(string $number) Return the first ChildAddress filtered by the number column
 * @method     ChildAddress|null findOneBystreet_id(int $street_id) Return the first ChildAddress filtered by the street_id column
 * @method     ChildAddress|null findOneBybuilding_type_id(int $building_type_id) Return the first ChildAddress filtered by the building_type_id column *

 * @method     ChildAddress requirePk($key, ?ConnectionInterface $con = null) Return the ChildAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOne(?ConnectionInterface $con = null) Return the first ChildAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAddress requireOneByid(int $id) Return the first ChildAddress filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByaddress_str(string $address_str) Return the first ChildAddress filtered by the address_str column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneBybuilding_number(string $building_number) Return the first ChildAddress filtered by the building_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneBynumber(string $number) Return the first ChildAddress filtered by the number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneBystreet_id(int $street_id) Return the first ChildAddress filtered by the street_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneBybuilding_type_id(int $building_type_id) Return the first ChildAddress filtered by the building_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAddress[]|Collection find(?ConnectionInterface $con = null) Return ChildAddress objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAddress> find(?ConnectionInterface $con = null) Return ChildAddress objects based on current ModelCriteria
 * @method     ChildAddress[]|Collection findByid(int $id) Return ChildAddress objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildAddress> findByid(int $id) Return ChildAddress objects filtered by the id column
 * @method     ChildAddress[]|Collection findByaddress_str(string $address_str) Return ChildAddress objects filtered by the address_str column
 * @psalm-method Collection&\Traversable<ChildAddress> findByaddress_str(string $address_str) Return ChildAddress objects filtered by the address_str column
 * @method     ChildAddress[]|Collection findBybuilding_number(string $building_number) Return ChildAddress objects filtered by the building_number column
 * @psalm-method Collection&\Traversable<ChildAddress> findBybuilding_number(string $building_number) Return ChildAddress objects filtered by the building_number column
 * @method     ChildAddress[]|Collection findBynumber(string $number) Return ChildAddress objects filtered by the number column
 * @psalm-method Collection&\Traversable<ChildAddress> findBynumber(string $number) Return ChildAddress objects filtered by the number column
 * @method     ChildAddress[]|Collection findBystreet_id(int $street_id) Return ChildAddress objects filtered by the street_id column
 * @psalm-method Collection&\Traversable<ChildAddress> findBystreet_id(int $street_id) Return ChildAddress objects filtered by the street_id column
 * @method     ChildAddress[]|Collection findBybuilding_type_id(int $building_type_id) Return ChildAddress objects filtered by the building_type_id column
 * @psalm-method Collection&\Traversable<ChildAddress> findBybuilding_type_id(int $building_type_id) Return ChildAddress objects filtered by the building_type_id column
 * @method     ChildAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAddress> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AddressQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Phonebook\Base\AddressQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Phonebook\\Address', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAddressQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAddressQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAddressQuery) {
            return $criteria;
        }
        $query = new ChildAddressQuery();
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
     * @return ChildAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AddressTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, address_str, building_number, number, street_id, building_type_id FROM address WHERE id = :p0';
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
            /** @var ChildAddress $obj */
            $obj = new ChildAddress();
            $obj->hydrate($row);
            AddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAddress|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AddressTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AddressTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(AddressTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AddressTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AddressTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address_str column
     *
     * Example usage:
     * <code>
     * $query->filterByaddress_str('fooValue');   // WHERE address_str = 'fooValue'
     * $query->filterByaddress_str('%fooValue%', Criteria::LIKE); // WHERE address_str LIKE '%fooValue%'
     * $query->filterByaddress_str(['foo', 'bar']); // WHERE address_str IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $address_str The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByaddress_str($address_str = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address_str)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AddressTableMap::COL_ADDRESS_STR, $address_str, $comparison);

        return $this;
    }

    /**
     * Filter the query on the building_number column
     *
     * Example usage:
     * <code>
     * $query->filterBybuilding_number('fooValue');   // WHERE building_number = 'fooValue'
     * $query->filterBybuilding_number('%fooValue%', Criteria::LIKE); // WHERE building_number LIKE '%fooValue%'
     * $query->filterBybuilding_number(['foo', 'bar']); // WHERE building_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $building_number The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBybuilding_number($building_number = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($building_number)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AddressTableMap::COL_BUILDING_NUMBER, $building_number, $comparison);

        return $this;
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterBynumber('fooValue');   // WHERE number = 'fooValue'
     * $query->filterBynumber('%fooValue%', Criteria::LIKE); // WHERE number LIKE '%fooValue%'
     * $query->filterBynumber(['foo', 'bar']); // WHERE number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $number The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBynumber($number = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($number)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AddressTableMap::COL_NUMBER, $number, $comparison);

        return $this;
    }

    /**
     * Filter the query on the street_id column
     *
     * Example usage:
     * <code>
     * $query->filterBystreet_id(1234); // WHERE street_id = 1234
     * $query->filterBystreet_id(array(12, 34)); // WHERE street_id IN (12, 34)
     * $query->filterBystreet_id(array('min' => 12)); // WHERE street_id > 12
     * </code>
     *
     * @see       filterByStreet()
     *
     * @param mixed $street_id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBystreet_id($street_id = null, ?string $comparison = null)
    {
        if (is_array($street_id)) {
            $useMinMax = false;
            if (isset($street_id['min'])) {
                $this->addUsingAlias(AddressTableMap::COL_STREET_ID, $street_id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($street_id['max'])) {
                $this->addUsingAlias(AddressTableMap::COL_STREET_ID, $street_id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AddressTableMap::COL_STREET_ID, $street_id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the building_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterBybuilding_type_id(1234); // WHERE building_type_id = 1234
     * $query->filterBybuilding_type_id(array(12, 34)); // WHERE building_type_id IN (12, 34)
     * $query->filterBybuilding_type_id(array('min' => 12)); // WHERE building_type_id > 12
     * </code>
     *
     * @see       filterByBuilding_type()
     *
     * @param mixed $building_type_id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBybuilding_type_id($building_type_id = null, ?string $comparison = null)
    {
        if (is_array($building_type_id)) {
            $useMinMax = false;
            if (isset($building_type_id['min'])) {
                $this->addUsingAlias(AddressTableMap::COL_BUILDING_TYPE_ID, $building_type_id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($building_type_id['max'])) {
                $this->addUsingAlias(AddressTableMap::COL_BUILDING_TYPE_ID, $building_type_id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AddressTableMap::COL_BUILDING_TYPE_ID, $building_type_id, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Phonebook\Street object
     *
     * @param \Phonebook\Street|ObjectCollection $street The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStreet($street, ?string $comparison = null)
    {
        if ($street instanceof \Phonebook\Street) {
            return $this
                ->addUsingAlias(AddressTableMap::COL_STREET_ID, $street->getid(), $comparison);
        } elseif ($street instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AddressTableMap::COL_STREET_ID, $street->toKeyValue('PrimaryKey', 'id'), $comparison);

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
     * Filter the query by a related \Phonebook\Building_type object
     *
     * @param \Phonebook\Building_type|ObjectCollection $building_type The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBuilding_type($building_type, ?string $comparison = null)
    {
        if ($building_type instanceof \Phonebook\Building_type) {
            return $this
                ->addUsingAlias(AddressTableMap::COL_BUILDING_TYPE_ID, $building_type->getid(), $comparison);
        } elseif ($building_type instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AddressTableMap::COL_BUILDING_TYPE_ID, $building_type->toKeyValue('PrimaryKey', 'id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBuilding_type() only accepts arguments of type \Phonebook\Building_type or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Building_type relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBuilding_type(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Building_type');

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
            $this->addJoinObject($join, 'Building_type');
        }

        return $this;
    }

    /**
     * Use the Building_type relation Building_type object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Phonebook\Building_typeQuery A secondary query class using the current class as primary query
     */
    public function useBuilding_typeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBuilding_type($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Building_type', '\Phonebook\Building_typeQuery');
    }

    /**
     * Use the Building_type relation Building_type object
     *
     * @param callable(\Phonebook\Building_typeQuery):\Phonebook\Building_typeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBuilding_typeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBuilding_typeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Building_type table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Phonebook\Building_typeQuery The inner query object of the EXISTS statement
     */
    public function useBuilding_typeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Building_type', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Building_type table for a NOT EXISTS query.
     *
     * @see useBuilding_typeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Phonebook\Building_typeQuery The inner query object of the NOT EXISTS statement
     */
    public function useBuilding_typeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Building_type', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Phonebook\Person object
     *
     * @param \Phonebook\Person|ObjectCollection $person the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPerson($person, ?string $comparison = null)
    {
        if ($person instanceof \Phonebook\Person) {
            $this
                ->addUsingAlias(AddressTableMap::COL_ID, $person->getaddress_id(), $comparison);

            return $this;
        } elseif ($person instanceof ObjectCollection) {
            $this
                ->usePersonQuery()
                ->filterByPrimaryKeys($person->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPerson() only accepts arguments of type \Phonebook\Person or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Person relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPerson(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Person');

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
            $this->addJoinObject($join, 'Person');
        }

        return $this;
    }

    /**
     * Use the Person relation Person object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Phonebook\PersonQuery A secondary query class using the current class as primary query
     */
    public function usePersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Person', '\Phonebook\PersonQuery');
    }

    /**
     * Use the Person relation Person object
     *
     * @param callable(\Phonebook\PersonQuery):\Phonebook\PersonQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPersonQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePersonQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Person table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Phonebook\PersonQuery The inner query object of the EXISTS statement
     */
    public function usePersonExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Person', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Person table for a NOT EXISTS query.
     *
     * @see usePersonExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Phonebook\PersonQuery The inner query object of the NOT EXISTS statement
     */
    public function usePersonNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Person', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildAddress $address Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($address = null)
    {
        if ($address) {
            $this->addUsingAlias(AddressTableMap::COL_ID, $address->getid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AddressTableMap::clearInstancePool();
            AddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AddressTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
