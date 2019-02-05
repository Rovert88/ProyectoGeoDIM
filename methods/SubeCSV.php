<?php

require '../classes/SubirCSV.php';
//require 'SubirCSV.php';

if(isset($_POST['cargar'])){
    
    $opc = isset($_POST['radios']);
    $fichero = isset($_POST['archivo']);
    $cargaCSV = new SubirCSV();                
    
//    switch ($opc){
//        case $opc == 'f_si':
//            $cargaCSV->cargarCSVSI($fichero);
//            break;
//        
//        case $opc == 'f_bcg':
//            $cargaCSV->cargarCSVBCG($fichero);
//            break;
//            
//        case $opc == 'f_bcr800':
//            break;
//        }
    if($opc == 'f_si'){
        $cargaCSV->cargarCSVSI($fichero);
    }
    
    
    if($opc == 'f_bcg'){
        $cargaCSV->cargarCSVBCG($fichero);
    }
    
    if($opc == 'f_bcr800'){
        
    }
    
    }else{
        echo "Archivo no cargado";
}
