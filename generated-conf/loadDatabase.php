<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\Phonebook\\Map\\AddressTableMap',
    1 => '\\Phonebook\\Map\\Building_typeTableMap',
    2 => '\\Phonebook\\Map\\CityTableMap',
    3 => '\\Phonebook\\Map\\City_typeTableMap',
    4 => '\\Phonebook\\Map\\PersonTableMap',
    5 => '\\Phonebook\\Map\\RegionTableMap',
    6 => '\\Phonebook\\Map\\Region_typeTableMap',
    7 => '\\Phonebook\\Map\\StreetTableMap',
    8 => '\\Phonebook\\Map\\Street_typeTableMap',
  ),
));
