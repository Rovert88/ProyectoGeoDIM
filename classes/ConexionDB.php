<?php

require '../vendor/autoload.php';

class DBConnection {
    
    //Sitios Geograficos Connection
    public function SGConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->SitiosGeograficos;
    
        return $collection;
    }
    
    //Upload CSV Connection
    public function UpCSVConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->ArchivosCSV;
    
        return $collection;
    }
}
