<?php
require_once('Api.php');
require_once('vendor/autoload.php');
require_once('generated-conf/config.php');

class PersonApi extends Api{


    public $apiName = 'person';

    public function indexAction()
    {
        $personsQuery = new \Phonebook\PersonQuery();
        $persons = $personsQuery->find();
        $persons = \Phonebook\PersonQuery::create()
            ->join('Address')
            ->join('Address.Building_type')
            ->join('Address.Street')
            ->join('Street.Street_type')
            ->join('Street.City')
            ->join('City.Region')
            ->join('City.City_type')
            ->join('Region.Region_type')
            ->select(array('id', 'last_name', 'first_name', 'phone', 'address_id',
                'Address.number',
                'Address.building_number',
                'Building_type.value',
                'Street.name',
                'Street_type.value',
                'City.name',
                'City_type.value',
                'Region.name',
                'Region_type.value'
                ))
            ->find();
        if($persons){
            return $this->response($persons->toJSON(), 200);
        }
        return $this->response('Data not found', 404);
    }


    public function viewAction()
    {
        //id должен быть первым параметром после /users/x
        $id = array_shift($this->requestUri);

        if($id){
            $personsQuery = new \Phonebook\PersonQuery();
            $person = $personsQuery->findPk($id);
            if($person){
                return $this->response($person->toJSON(), 200);
            }
        }
        return $this->response('Data not found', 404);
    }

    public function createAction()
    {
        $lastname = $this->requestParams['lastname'] ?? '';
        $firstname = $this->requestParams['firstname'] ?? '';
        $phone = $this->requestParams['phone'] ?? '';
        $addresid = $this->requestParams['addresid'] ?? '';
        if($lastname && $firstname && $addresid && $phone){
            $person = new \Phonebook\Person();
            $person->setfirst_name($firstname);
            $person->setlast_name($lastname);
            $person->setphone($phone);
            $person->setaddress_id($addresid);
            if($person = $person->save()){
                return $this->response('Data saved.', 200);
            }
        }
        return $this->response("Saving error", 500);
    }


    public function updateAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;


        $personsQuery = new \Phonebook\PersonQuery();
        $person = $personsQuery->findPk($userId);

        if(!$userId || !$person){
            return $this->response("User with id=$userId not found", 404);
        }

        $lastname = $this->requestParams['lastname'] ?? '';
        $firstname = $this->requestParams['firstname'] ?? '';
        $phone = $this->requestParams['phone'] ?? '';
        $addresid = $this->requestParams['addresid'] ?? '';

        if($lastname && $firstname && $addresid && $phone){
            $personsQuery = new \Phonebook\PersonQuery();
            $person = $personsQuery->findPk($userId);
            $person->setfirst_name($firstname);
            $person->setlast_name($lastname);
            $person->setphone($phone);
            $person->setaddress_id($addresid);
            if($person = $person->save()){
                return $this->response('Data updated.', 200);
            }
        }
        return $this->response($this->requestParams, 200);
    }

    public function deleteAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;

        $person = \Phonebook\PersonQuery::create()->findByid($userId);

        if(!$userId || !$person){
            return $this->response("User with id=$userId not found", 404);
        }
        if($person->delete()){
            return $this->response('Data deleted.', 200);
        }
    }

}