<?php

class Util
{
    public static function protect()
    {
        session_start();

        if (isset($_SESSION['email'])) {
        } else {
            header("Location:index.php?acess");
            die();
        }
    }
    public static function logout()
    {
        if (!isset($_SESSION)) session_start();
        session_destroy();
        header("Location:../index.php");
        die();
    }
    public static function isLog()
    {
        //session_start();
        if (!isset($_SESSION)) session_start();
        return isset($_SESSION['email']);
    }
    public static function valid()
    {
        session_start();
        return isset($_SESSION['email']);
    }
    public static function isGerente()
    {
        session_start();
        if ($_SESSION['perfil'] == 'gerente') {
      
        } else {
            header("Location:403.php");
        }
    }
    public static function isCaixa()
    {
        session_start();
        if ($_SESSION['perfil'] == 'caixa') {
      
        } else {
            header("Location:403.php");
        }
    }
    public static function isCliente()
    {
        session_start();
        if ($_SESSION['perfil'] == 'cliente') {
      
        } else {
            header("Location:403.php");
        }
    }
    public static function isAdmin()
    {
        session_start();
        if ($_SESSION['perfil'] == 'admin') {
    
        } else {
            header("Location:403.php");
        }
    }
    public static function autenticarUsuario($email, $senha)
    {
        require_once 'r.class.php';

        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );


        $usuarios = R::findOne('usuario', ' email = ? AND senha = ?', [$email, md5($senha . '__')]);
        if (isset($usuarios)) {
            session_start();
            $_SESSION['usuario'] = $usuarios['nome'];
            $_SESSION['email'] = $usuarios['email'];
            $_SESSION['perfil'] = $usuarios['perfil'];
       

            if ($usuarios['perfil'] == 'gerente') {
                header('Location:../usuarios/gerente/index.php');
            } 
            else if($usuarios['perfil'] == 'caixa'){
                header('Location:../usuarios/caixa/index.php');
            }
            else if($usuarios['perfil'] == 'admin'){
                header('Location:../usuarios/admin/index.php');
            }
        
            else {
                header('Location:../usuarios/cliente/index.php');
            }
        } else {

            header('Location:../index.php?naoautenticado');
        }
        R::close();
        //return count($usuarios) > 0;
    }
   
}
