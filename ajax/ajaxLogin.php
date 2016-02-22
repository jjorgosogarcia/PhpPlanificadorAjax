<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$bd = new DataBase();
$gestor = new ManageUser($bd);
$login = Request::req("login");
$clave = Request::req("clave");
$usuarios = $gestor->get($login);
$sesion = new Session();
$privilegio = $usuarios->getRol();
//var_dump($usuarios->getUsuario());
$ok = json_encode(array('login' => true, 'privilegio' => $privilegio));
$no = json_encode(array('login' => false));
if($usuarios->getUsuario()=== $login && $usuarios->getPassword() === $clave){
    echo $ok;
    $usuario = new Usuario($login, $clave);
    $sesion->setUser($usuario);
    $sesion->set("_usuario", $login);
}else{
    echo $no;
    $sesion->destroy();
};
  
 