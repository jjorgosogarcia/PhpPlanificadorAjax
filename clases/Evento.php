<?php

class Evento {
    
    private $idevento, $profesor, $descripcion;

    function __construct($idevento=null, $profesor=null, $descripcion=null) {
        $this->idevento = $idevento;
        $this->profesor = $profesor;
        $this->descripcion = $descripcion;
    }

    function getIdevento() {
        return $this->idevento;
    }

    function getProfesor() {
        return $this->profesor;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdevento($idevento) {
        $this->idevento = $idevento;
    }

    function setProfesor($profesor) {
        $this->profesor = $profesor;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

//3º getJson
    function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":"' . $valor . '",';
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }

    function set($valores, $inicio=0){
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i+$inicio];
            $i++;
        }
    }
    
    public function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$valor ";
        }
        return $r;
    }
    
    public function getArray($valores=true){
        $array = array();
        foreach($this as $key => $valor) {
            if($valores===true){
                $array[$key] = $valor;
            }else{
                $array[$key]=null;
            }
        }
        return $array;
    }
    
    function read(){
        foreach($this as $key => $valor) {
            $this->$key = Request::req($key);
        }
    }
    
}
