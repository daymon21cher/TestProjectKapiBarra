<?php

namespace Phonebook\Map;

use Phonebook\Address;
use Phonebook\AddressQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Phonebook.Map.AddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'address';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Phonebook\\Address';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Phonebook.Address';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'address.id';

    /**
     * the column name for the address_str field
     */
    public const COL_ADDRESS_STR = 'address.address_str';

    /**
     * the column name for the building_number field
     */
    public const COL_BUILDING_NUMBER = 'address.building_number';

    /**
     * the column name for the number field
     */
    public const COL_NUMBER = 'address.number';

    /**
     * the column name for the street_id field
     */
    public const COL_STREET_ID = 'address.street_id';

    /**
     * the column name for the building_type_id field
     */
    public const COL_BUILDING_TYPE_ID = 'address.building_type_id';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['id', 'address_str', 'building_number', 'number', 'street_id', 'building_type_id', ],
        self::TYPE_CAMELNAME     => ['id', 'address_str', 'building_number', 'number', 'street_id', 'building_type_id', ],
        self::TYPE_COLNAME       => [AddressTableMap::COL_ID, AddressTableMap::COL_ADDRESS_STR, AddressTableMap::COL_BUILDING_NUMBER, AddressTableMap::COL_NUMBER, AddressTableMap::COL_STREET_ID, AddressTableMap::COL_BUILDING_TYPE_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'address_str', 'building_number', 'number', 'street_id', 'building_type_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['id' => 0, 'address_str' => 1, 'building_number' => 2, 'number' => 3, 'street_id' => 4, 'building_type_id' => 5, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'address_str' => 1, 'building_number' => 2, 'number' => 3, 'street_id' => 4, 'building_type_id' => 5, ],
        self::TYPE_COLNAME       => [AddressTableMap::COL_ID => 0, AddressTableMap::COL_ADDRESS_STR => 1, AddressTableMap::COL_BUILDING_NUMBER => 2, AddressTableMap::COL_NUMBER => 3, AddressTableMap::COL_STREET_ID => 4, AddressTableMap::COL_BUILDING_TYPE_ID => 5, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'address_str' => 1, 'building_number' => 2, 'number' => 3, 'street_id' => 4, 'building_type_id' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'id' => 'ID',
        'Address.id' => 'ID',
        'address.id' => 'ID',
        'AddressTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'address_str' => 'ADDRESS_STR',
        'Address.address_str' => 'ADDRESS_STR',
        'address.address_str' => 'ADDRESS_STR',
        'AddressTableMap::COL_ADDRESS_STR' => 'ADDRESS_STR',
        'COL_ADDRESS_STR' => 'ADDRESS_STR',
        'building_number' => 'BUILDING_NUMBER',
        'Address.building_number' => 'BUILDING_NUMBER',
        'address.building_number' => 'BUILDING_NUMBER',
        'AddressTableMap::COL_BUILDING_NUMBER' => 'BUILDING_NUMBER',
        'COL_BUILDING_NUMBER' => 'BUILDING_NUMBER',
        'number' => 'NUMBER',
        'Address.number' => 'NUMBER',
        'address.number' => 'NUMBER',
        'AddressTableMap::COL_NUMBER' => 'NUMBER',
        'COL_NUMBER' => 'NUMBER',
        'street_id' => 'STREET_ID',
        'Address.street_id' => 'STREET_ID',
        'address.street_id' => 'STREET_ID',
        'AddressTableMap::COL_STREET_ID' => 'STREET_ID',
        'COL_STREET_ID' => 'STREET_ID',
        'building_type_id' => 'BUILDING_TYPE_ID',
        'Address.building_type_id' => 'BUILDING_TYPE_ID',
        'address.building_type_id' => 'BUILDING_TYPE_ID',
        'AddressTableMap::COL_BUILDING_TYPE_ID' => 'BUILDING_TYPE_ID',
        'COL_BUILDING_TYPE_ID' => 'BUILDING_TYPE_ID',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('address');
        $this->setPhpName('Address');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Phonebook\\Address');
        $this->setPackage('Phonebook');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'id', 'INTEGER', true, null, null);
        $this->addColumn('address_str', 'address_str', 'VARCHAR', false, 255, null);
        $this->addColumn('building_number', 'building_number', 'VARCHAR', false, 255, null);
        $this->addColumn('number', 'number', 'VARCHAR', false, 255, null);
        $this->addForeignKey('street_id', 'street_id', 'INTEGER', 'street', 'id', false, null, null);
        $this->addForeignKey('building_type_id', 'building_type_id', 'INTEGER', 'building_type', 'id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Street', '\\Phonebook\\Street', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':street_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Building_type', '\\Phonebook\\Building_type', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':building_type_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Person', '\\Phonebook\\Person', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':address_id',
    1 => ':id',
  ),
), null, null, 'People', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? AddressTableMap::CLASS_DEFAULT : AddressTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Address object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AddressTableMap::OM_CLASS;
            /** @var Address $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AddressTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = AddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Address $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AddressTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(AddressTableMap::COL_ID);
            $criteria->addSelectColumn(AddressTableMap::COL_ADDRESS_STR);
            $criteria->addSelectColumn(AddressTableMap::COL_BUILDING_NUMBER);
            $criteria->addSelectColumn(AddressTableMap::COL_NUMBER);
            $criteria->addSelectColumn(AddressTableMap::COL_STREET_ID);
            $criteria->addSelectColumn(AddressTableMap::COL_BUILDING_TYPE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.address_str');
            $criteria->addSelectColumn($alias . '.building_number');
            $criteria->addSelectColumn($alias . '.number');
            $criteria->addSelectColumn($alias . '.street_id');
            $criteria->addSelectColumn($alias . '.building_type_id');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(AddressTableMap::COL_ID);
            $criteria->removeSelectColumn(AddressTableMap::COL_ADDRESS_STR);
            $criteria->removeSelectColumn(AddressTableMap::COL_BUILDING_NUMBER);
            $criteria->removeSelectColumn(AddressTableMap::COL_NUMBER);
            $criteria->removeSelectColumn(AddressTableMap::COL_STREET_ID);
            $criteria->removeSelectColumn(AddressTableMap::COL_BUILDING_TYPE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.address_str');
            $criteria->removeSelectColumn($alias . '.building_number');
            $criteria->removeSelectColumn($alias . '.number');
            $criteria->removeSelectColumn($alias . '.street_id');
            $criteria->removeSelectColumn($alias . '.building_type_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(AddressTableMap::DATABASE_NAME)->getTable(AddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Address or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Address object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Phonebook\Address) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AddressTableMap::DATABASE_NAME);
            $criteria->add(AddressTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Address or Criteria object.
     *
     * @param mixed $criteria Criteria or Address object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Address object
        }

        if ($criteria->containsKey(AddressTableMap::COL_ID) && $criteria->keyContainsValue(AddressTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AddressTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
