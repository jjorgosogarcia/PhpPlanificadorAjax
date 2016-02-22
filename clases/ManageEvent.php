<?php

class ManageEvent {
    private $bd = null;
    private $tabla = "evento";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function getList($pagina=1, $orden="", $nrpp=10){
        $ordenPredeterminado = "$orden, idevento, profesor";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "idevento, profesor";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $evento = new Evento();
             $evento->set($fila);
             $r[]=$evento;
         }
         return $r;
    }
    
    function getListJson($pagina = 1, $orden = "", $nrpp = Constants::NRPP, $condicion = "1=1", $parametros = array()) {
        $list = $this->getList($pagina, $orden, $nrpp, $condicion, $parametros);
        $r = "[ ";
        foreach ($list as $objeto) {
            $r .= $objeto->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }
    
    function get($ID){
        $parametros = array();
        $parametros['ID'] = $ID;
        $this->bd->select($this->tabla, "*", "idevento=:ID", $parametros);
        $fila=$this->bd->getRow();
        $evento = new Evento();
        $evento->set($fila);
        return $evento;
    }
    
    function delete($Code){
        $parametros = array();
        $parametros['idevento'] = $Code;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(Evento $evento){
        return $this->delete($evento);
    }
    
    function set(Evento $evento, $pkCode){
        $parametros = $evento->getArray();
        $parametrosWhere = array();
        $parametrosWhere["idevento"] = $pkCode;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
   
    public function insert(Evento $evento){
        $parametros = $evento->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getValuesSelect(){
        $this->bd->query($this->tabla, "idevento", array(), "idevento");
        $array = array();
        while($fila=$this->bd->getRow()){
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
        
    function count($condicion="1 = 1", $parametros = array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
}
