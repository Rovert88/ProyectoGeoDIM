<?php

class ModeloBombasCalorG {
    
    //Atributos
    protected $nombreBCG;
    protected $dispositivoBCG;
    protected $noSerieDispBCG;
    protected $vSODispBCG;
    protected $fechaIniTrabBCG;
    protected $horaIniTrabBCG;
    protected $alimentDispBCG;
    protected $ubicacionSitioBCG;
    protected $noVariablesBCG;

    //Constructor
    public function __construct($nombreBCG, $dispositivoBCG, $noSerieDispBCG, $vSODispBCG, $fechaIniTrabBCG, $horaIniTrabBCG, $alimentDispBCG, $ubicacionSitioBCG, $noVariablesBCG){
        $this->nombreBCG = $nombreBCG;
        $this->dispositivoBCG = $dispositivoBCG;
        $this->noSerieDispBCG = $noSerieDispBCG;
        $this->vSODispBCG = $vSODispBCG;
        $this->fechaIniTrabBCG = $fechaIniTrabBCG;
        $this->horaIniTrabBCG = $horaIniTrabBCG;
        $this->alimentDispBCG = $alimentDispBCG;
        $this->ubicacionSitioBCG = $ubicacionSitioBCG;
        $this->noVariablesBCG = $noVariablesBCG;
    }

    //Setters y Getters
    public function setNombreBCG($nombreBCG){
        $this->nombreBCG = $nombreBCG;
    }
    
    public function getNombreBCG(){
        return $this->nombreBCG;
    }
    
    public function setDispositivoBCG($dispositivoBCG){
        $this->dispositivoBCG = $dispositivoBCG;
    }
    
    public function getDispositivoBCG(){
        return $this->dispositivoBCG;
    }
    
    public function setNoSerieDispBCG($noSerieDispBCG){
        $this->noSerieDispBCG = $noSerieDispBCG;
    }
    
    public function getNoSerieDispBCG(){
        return $this->noSerieDispBCG;
    }
    
    public function setVSODispBCG($vSODispBCG){
        $this->vSODispBCG = $vSODispBCG;
    }
    
    public function getVSODispBCG(){
        return $this->vSODispBCG;
    }
    
    public function setFechaIniTrabBCG($fechaIniTrabBCG){
        $this->fechaIniTrabBCG = $fechaIniTrabBCG;
    }
    
    public function getFechaIniTrabBCG(){
        return $this->fechaIniTrabBCG;
    }
    
    public function setHoraIniTrabBCG($horaIniTrabBCG){
        $this->horaIniTrabBCG = $horaIniTrabBCG;
    }
    
    public function getHoraIniTrabBCG(){
        return $this->horaIniTrabBCG;
    }
    
    public function setAlimentDispBCG($alimentDispBCG){
        $this->alimentDispBCG = $alimentDispBCG;
    }
    
    public function getAlimentDispBCG(){
        return $this->alimentDispBCG;
    }
    
    public function setUbicacionSitioBCG($ubicacionSitioBCG){
        $this->ubicacionSitioBCG = $ubicacionSitioBCG;
    }
    
    public function getUbicacionSitioBCG(){
        return $this->ubicacionSitioBCG;
    }
    
    public function setNoVariablesBCG($noVariablesBCG){
        $this->noVariablesBCG = $noVariablesBCG;
    }
    
    public function getNoVariablesBCG(){
        return $this->noVariablesBCG;
    }
}
