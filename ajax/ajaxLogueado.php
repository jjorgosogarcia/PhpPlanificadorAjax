<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$logueado = $sesion->isLogged();

$bd = new DataBase();
$gestor = new ManageUser($bd);

$usuario = $gestor->get($sesion->getUser());
$privilegio = $usuario->getRol();

$ok = json_encode(array('login' => true,'usuario' => $sesion->getUser(),'privilegio' => $privilegio));
$no = json_encode(array('login' => false));

if($logueado){
    echo $ok;
}else{
    echo $no;
}