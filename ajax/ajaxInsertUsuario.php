<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$no = json_encode(array('insert' => -1));

$usuario = Request::req("Usuario");
$password = Request::req("Password");
$nombre = Request::req("Nombre");
$apellidos = Request::req("Apellidos");
$departamento = Request::req("Departamento");


if($sesion->isLogged()){
    $bd = new DataBase();
    $gestor = new ManageUser($bd);
    $usuario = new Usuario($usuario, $password, $nombre, $apellidos, $departamento, 0);
    //$usuario->read();
    echo $usuario;
    var_dump($usuario);
    $r = $gestor->insert($usuario);
    $bd->close();
    $respuesta  =json_encode(array('insert' => $r));
    //$respuesta = '{"insert":' . $r .'}';
    echo $respuesta;
    //var_dump($bd->getError());
}else{
    echo $no;
}