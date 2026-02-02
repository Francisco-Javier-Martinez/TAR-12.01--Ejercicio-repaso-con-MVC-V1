<?php
    //crear un administrador para la aplicacion haseado
    require_once __DIR__ . "/config/config.php";
    require_once __DIR__ . "/modelo/mUsuarios.php";
    $nombre="admin";
    $apeNombre="Administrador Principal";
    $password=password_hash("admin123", PASSWORD_DEFAULT);
    $correo="admin@gmail.com";
    $perfil="c";
    $mUsuarios=new Musuarios();
    $resultado=$mUsuarios->crearAdmin($nombre,$apeNombre,$password,$correo,$perfil);
    echo $resultado;
?>