<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$no = json_encode(array('insertEvento' => -1));

$idEvento = Request::req("Idevento");
$profesor = $sesion->get("_usuario");
$descripcion = Request::req("Descripcion");

echo $profesor;

if($sesion->isLogged()){
    $bd = new DataBase();
    $gestor = new ManageEvent($bd);
    $evento = new Evento($idEvento, $profesor, $descripcion);
   
    //echo $evento;
   // var_dump($evento);
    $r = $gestor->insert($evento);
    $bd->close();
    $respuesta = json_encode(array('insertEvento' => $r));
    //$respuesta = '{"insert":' . $r .'}';
    //echo $respuesta;
   // var_dump($bd->getError());
}else{
    //echo $no;
}