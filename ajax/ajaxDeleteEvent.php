<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$no = json_encode(array('delete' => -1));
$id = Request::req("Idevento");
$usuario = Request::req("usuario");

if($sesion->isLogged()){
    $bd = new DataBase();
    $gestor = new ManageEvent($bd);
    $gestorUsuario = new ManageUser($bd);
    $user = $sesion->getUser();
    if($user == $usuario){
    $r = $gestor->delete($id);
    
    $bd->close();
    $respuesta = '{"delete":' . $r .'}';
    echo $respuesta;
    }
    //var_dump($bd->getError());
}else{
    echo $no;
}