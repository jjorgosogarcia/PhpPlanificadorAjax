<?php


class ManageUser {
    private $bd = null;
    private $tabla = "usuario";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function getList($pagina=1, $orden="", $nrpp=Constant::NRPP){
        $ordenPredeterminado = "$orden, nombre, departamento";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "nombre, departamento";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $user = new Usuario();
             $user->set($fila);
             $r[]=$user;
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
        $this->bd->select($this->tabla, "*", "usuario=:ID", $parametros);
        $fila=$this->bd->getRow();
        $user = new Usuario();
        $user->set($fila);
        return $user;
    }
    
    function delete($Code){
        $parametros = array();
        $parametros['usuario'] = $Code;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(Usuario $user){
        return $this->delete($user);
    }
    
    function set(Usuario $user, $pkCode){
        $parametros = $user->getArray();
        $parametrosWhere = array();
        $parametrosWhere["usuario"] = $pkCode;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
   
    public function insert(Usuario $user){
        $parametros = $user->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getValuesSelect(){
        $this->bd->query($this->tabla, "usuario", array(), "usuario");
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
