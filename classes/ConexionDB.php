<?php

require '../vendor/autoload.php';

class DBConnection {
    
    //Sitios Geograficos Connection
    public function SGConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIM->SitiosGeograficos;
    
        return $collection;
    }
    
    //Upload CSV SI Connection
    public function UpCSVSIConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->RegistrosSI;
    
        return $collection;
    }
    
    //Upload CSV BCG Connection
    public function UpCSVBCGConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIM->RegistrosBCG;
    
        return $collection;
    }
    
    //Graficas Sondas Inspeccion Connection
    public function GSIConn(){
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");        
        $collection = $client->GeoDIMTests->ArchivosCSV;
        
        return $collection;
    }
    
    //Graficas Bombas Calor Connection
    public function GBCGConn(){
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");        
        $collection = $client->GeoDIM->ChartCollBCG;
        
        return $collection;
    }
    
    //Tests cargas de archivos
    public function UpCSVSIConnTest() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->RegistrosSITest;
    
        return $collection;
    }
}
