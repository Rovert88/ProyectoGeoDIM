<?php

class ModeloSitiosGeograficos {
    
    //Atributos
    protected $nombreSG;
    protected $ubicacionSG;
    protected $localizacionSG;
    protected $registradoPor;
    protected $tipoClimaSG;
    
    //Constructor
    public function __construct($nombreSG, $ubicacionSG, $localizacionSG, $registradoPor, $tipoClimaSG) {
        $this->nombreSG = $nombreSG;
        $this->ubicacionSG =$ubicacionSG;
        $this->localizacionSG = $localizacionSG;
        $this->registradoPor = $registradoPor;
        $this->tipoClimaSG = $tipoClimaSG;
    }
    
    //Setters y Getters
    public function setNombreSG($nombreSG){
        $this->nombreSG = $nombreSG;
    }
    
    public function getNombreSG(){
        return $this->nombreSG;
    }
    
    public function setUbicacionSG($ubicacionSG){
        $this->ubicacionSG = $ubicacionSG;
    }
    
    public function getUbicacionSG(){
        return $this->ubicacionSG;
    }
    
    public function setLocalizacionSG($localizacionSG){
        $this->localizacionSG = $localizacionSG;
    }
    
    public function getLocalizacionSG(){
        return $this->localizacionSG;
    }
    
    public function setRegistradoPor($registradoPor){
        $this->registradoPor = $registradoPor;
    }
    
    public function getRegistradoPor(){
        return $this->registradoPor;
    }
    
    public function setTipoClimaSG($tipoClimaSG){
        $this->tipoClimaSG = $tipoClimaSG;
    }
    
    public function getTipoClimaSG(){
        return $this->tipoClimaSG;
    }
}
