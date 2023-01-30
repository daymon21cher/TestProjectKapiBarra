<?php
require_once('Api.php');
require_once('vendor/autoload.php');
require_once('generated-conf/config.php');

class AddressApi extends Api{


    public $apiName = 'address';

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/address
     * @return string
     */
    public function indexAction()
    {
        $addresses = \Phonebook\AddressQuery::create()
            ->find();
        if($addresses){
            return $this->response($addresses->toJSON(), 200);
        }
        return $this->response('Data not found', 404);
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function viewAction()
    {
        //id должен быть первым параметром после /users/x
        $id = array_shift($this->requestUri);

        if($id){
            $addressesQuery = new \Phonebook\AddressQuery();
            $address = $addressesQuery->findPk($id);
            if($address){
                return $this->response($address->toJSON(), 200);
            }
        }
        return $this->response('Data not found', 404);
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/users + параметры запроса name, email
     * @return string
     */
    public function createAction()
    {
        $lastname = $this->requestParams['lastname'] ?? '';
        $firstname = $this->requestParams['firstname'] ?? '';
        $phone = $this->requestParams['phone'] ?? '';
        $addresid = $this->requestParams['addresid'] ?? '';
        if($lastname && $firstname && $addresid && $phone){
            $address = new \Phonebook\Address();
            $address->setfirst_name($firstname);
            $address->setlast_name($lastname);
            $address->setphone($phone);
            $address->setaddress_id($addresid);
            if($address = $address->save()){
                return $this->response('Data saved.', 200);
            }
        }
        return $this->response("Saving error", 500);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/users/1 + параметры запроса name, email
     * @return string
     */
    public function updateAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;


        $addressesQuery = new \Phonebook\AddressQuery();
        $address = $addressesQuery->findPk($userId);

        if(!$userId || !$address){
            return $this->response("User with id=$userId not found", 404);
        }

        $lastname = $this->requestParams['lastname'] ?? '';
        $firstname = $this->requestParams['firstname'] ?? '';
        $phone = $this->requestParams['phone'] ?? '';
        $addresid = $this->requestParams['addresid'] ?? '';

        if($lastname && $firstname && $addresid && $phone){
            $addressesQuery = new \Phonebook\AddressQuery();
            $address = $addressesQuery->findPk($userId);
            $address->setfirst_name($firstname);
            $address->setlast_name($lastname);
            $address->setphone($phone);
            $address->setaddress_id($addresid);
            if($address = $address->save()){
                return $this->response('Data updated.', 200);
            }
        }
        return $this->response($lastname, 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function deleteAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;

        $address = \Phonebook\AddressQuery::create()->findByid($userId);

        if(!$userId || !$address){
            return $this->response("User with id=$userId not found", 404);
        }
        if($address->delete()){
            return $this->response('Data deleted.', 200);
        }
    }

}