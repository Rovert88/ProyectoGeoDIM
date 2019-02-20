<?php

class ModeloSondasInspeccion {
    
    //Atributos
    protected $nombreSI;
    protected $dispositivoSI;
    protected $noSerieDispSI;
    protected $vSODispSI;
    protected $fechaIniTrabSI;
    protected $horaIniTrabSI;
    protected $alimentDispSI;
    protected $profundidadSI;
    protected $noSensoresSI;

    //Constructor
    public function __construct($nombreSI, $dispositivoSI, $noSerieDispSI, $vSODispSI, $fechaIniTrabSI, $horaIniTrabSI, $alimentDispSI, $profundidadSI, $noSensoresSI) {
        $this->nombreSI = $nombreSI;
        $this->dispositivoSI = $dispositivoSI;
        $this->noSerieDispSI = $noSerieDispSI;
        $this->vSODispSI = $vSODispSI;
        $this->fechaIniTrabSI = $fechaIniTrabSI;
        $this->horaIniTrabSI = $horaIniTrabSI;
        $this->alimentDispSI = $alimentDispSI;
        $this->profundidadSI = $profundidadSI;
        $this->noSensoresSI = $noSensoresSI;
    }
    
    //Setters y Getters
    public function setNombreSI($nombreSI){
        $this->nombreSI = $nombreSI;
    }
    
    public function getNombreSI(){
        return $this->nombreSI;
    }
    
    public function setDispositivoSI($dispositivoSI){
        $this->dispositivoSI = $dispositivoSI;
    }
    
    public function getDispositivoSI(){
        return $this->dispositivoSI;
    }
    
    public function setNoSerieDispSI($noSerieDispSI){
        $this->noSerieDispSI = $noSerieDispSI;
    }
    
    public function getNoSerieDispSI(){
        return $this->noSerieDispSI;
    }
    
    public function setVSODispSI($vSODispSI){
        $this->vSODispSI = $vSODispSI;
    }
    
    public function getVSODispSI(){
        return $this->vSODispSI;
    }
    
    public function setFechaIniTrabSI($fechaIniTrabSI){
        $this->fechaIniTrabSI = $fechaIniTrabSI;
    }
    
    public function getFechaIniTrabSI(){
        return $this->fechaIniTrabSI;
    }
    
    public function setHoraIniTrabSI($horaIniTrabSI){
        $this->horaIniTrabSI = $horaIniTrabSI;
    }
    
    public function getHoraIniTrabSI(){
        return $this->horaIniTrabSI;
    }
    
    public function setAlimentDispSI($alimentDispSI){
        $this->alimentDispSI = $alimentDispSI;
    }
    
    public function getAlimentDispSI(){
        return $this->alimentDispSI;
    }
    
    public function setProfundidadSI($profundidadSI){
        $this->profundidadSI = $profundidadSI;
    }
    
    public function getProfundidadSI(){
        return $this->profundidadSI;
    }
    
    public function setNoSensoresSI($noSensoresSI){
        $this->noSensoresSI = $noSensoresSI;
    }
    
    public function getNoSensoresSI(){
        return $this->noSensoresSI;
    }
}
