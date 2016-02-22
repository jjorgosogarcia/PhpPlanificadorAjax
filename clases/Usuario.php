<?php

class Usuario {
    
  private $usuario, $password, $nombre, $apellidos, $departamento, $rol;
  
  function __construct($usuario=null, $password=null, $nombre=null, 
          $apellidos=null, $departamento=null, $rol=0) {
      $this->usuario = $usuario;
      $this->password = $password;
      $this->nombre = $nombre;
      $this->apellidos = $apellidos;
      $this->departamento = $departamento;
      $this->rol = $rol;
  }

  function getUsuario() {
      return $this->usuario;
  }

  function getPassword() {
      return $this->password;
  }

  function getNombre() {
      return $this->nombre;
  }

  function getApellidos() {
      return $this->apellidos;
  }

  function getDepartamento() {
      return $this->departamento;
  }

  function getRol() {
      return $this->rol;
  }

  function setUsuario($usuario) {
      $this->usuario = $usuario;
  }

  function setPassword($password) {
      $this->password = $password;
  }

  function setNombre($nombre) {
      $this->nombre = $nombre;
  }

  function setApellidos($apellidos) {
      $this->apellidos = $apellidos;
  }

  function setDepartamento($departamento) {
      $this->departamento = $departamento;
  }

  function setRol($rol) {
      $this->rol = $rol;
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
