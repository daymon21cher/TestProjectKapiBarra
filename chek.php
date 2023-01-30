<?php
require_once('vendor/autoload.php');
require_once('generated-conf/config.php');

//$person = new \Phonebook\Person();


//$q = new \Phonebook\PersonQuery();
//$person_one = $q->findByid(1);
//echo json_decode($person_one);

$personsQuery = new \Phonebook\PersonQuery();
//$persons = $personsQuery->find();
//echo $persons;
$person = $personsQuery->findPk(1);
echo $person->toJSON();

?>