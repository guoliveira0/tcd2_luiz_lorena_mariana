<?php
require_once '../../classes/util.class.php';
Util::isAdmin();

if(isset($_POST['id'])){
    require_once '../../classes/usuarioservices.class.php';

    UsuarioServices::salvarEdicao(
        $_POST['id'],
        $_POST['nome'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['perfis']
    );
}

header('Location:escolherusuario.php');