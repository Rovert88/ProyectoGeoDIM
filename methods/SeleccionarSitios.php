<?php

require_once '../classes/ConexionDB.php';
    require_once '../classes/CRUD.php';
    require_once '../classes/GeneralOp.php';
    
    $op = new CRUD();
    $collection = new DBConnection();
    
    $consulta = array("_id" => '_id');
    $item = $collection->findOne(array('_id' => new MongoId('4e49fd8269fd873c0a000000')));
    $result = $op->findAll($consulta);
