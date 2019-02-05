<?php

class CRUD {

    private $collection;

    function __construct($collection) {
        $this->collection = $collection;
    }

    function findAll($Datos = array()) {
        if (!empty($Datos)) {
            $document = $this->collection->find($Datos);
            return $document;
        } else {
            $document = $this->collection->find();
            return $document;
        }
    }

    function findOne($Datos) {
        $document = $this->collection->findOne($Datos);
        return $document;
    }

    function insertOne($Datos) {
        $this->collection->insertOne($Datos);
    }

}
