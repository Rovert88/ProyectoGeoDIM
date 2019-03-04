<?php

require '../vendor/autoload.php';

class DBConnection {
    
    //Conexion principal
    //Esta es la conexion principal, esta selecciona la Bd
    public function ConectarBD(){
        $host = '127.0.0.1';
        $port = '27017';
        $uss = rawurldecode('GeoDIM');
        $pass = rawurldecode('');
        $db = 'GeoDIMTests';
        
        $urlConexion = sprintf('mongodb://%s:%s/%s', $host, $port, $db);
        $cliente = new MongoDB\Client($urlConexion);
        return $cliente->selectDatabase($db);
    }
    
    //Preparacion de coleccion Archivos Sondas de Inspeccion
    //Despues cuando cargo un archivo mando a traer esa conexion y aca selcciono o le doy el nombre que tendra la coleccion, preparo
    //una cadena predeterminada
    public function PreparaCollArchivosSI($cadenaArchSI){
        $coleccion = 'RegistrosSI_'.$cadenaArchSI; //Esa variable tiene el valor del id del sitio que elegi cuando cargo un archivo
        return $coleccion;
    }
    
    //Preparacion de coleccion Archivos Bombas de Calor Geotermico
    public function PreparaCollArchivosBCG($cadenaArchBCG){
        $coleccion = 'RegistrosBCG_'.$cadenaArchBCG;
        return $coleccion;
    }        
    
    //Preparacion de coleccion Archivos Bateria de CR800
    public function PreparaCollArchivosBatCR800($cadenaArchBatCR800){
        $coleccion = 'RegistrosBatCR800_'.$cadenaArchBatCR800;
        return $coleccion;
    }
    
    //PRUEBA CARGAR CSV REGISTROS BCG-----------------------
    public function TestBCGFiles(){
        $client = new MongoDB\Client('mongodb://127.0.0.1:27017');
        $collection = $client->cursoMongo->PruebaCSV;
        
        return $collection;
    }
    
    //Sitios Geograficos Connection
    public function SGConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIM->SitiosGeograficos;
    
        return $collection;
    }
    
    //Upload CSV SI Connection
    public function UpCSVSIConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->RegistrosSI_5c53244700d5101cb4008757;
    
        return $collection;
    }
    
    //Upload CSV BCG Connection
    public function UpCSVBCGConn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->RegistrosBCG_5c53244700d5101cb4008757;
    
        return $collection;
    }
    
    public function UpCSVBCR800Conn() {
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
        $collection = $client->GeoDIMTests->RegistrosBatCR800_5c53244700d5101cb4008757;
    
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
