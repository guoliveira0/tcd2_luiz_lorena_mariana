<?php

class UsuarioServices
{
    public static function salvar($nome, $email, $senha, $perfil)
    {
        require_once 'r.class.php';
        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );
        $usuarios = R::findOne('usuario', 'email LIKE ?', [$email]);

        if ($usuarios->email == $email) {
            echo ("<script>alert(\"Email já cadastrado\");</script>");
            echo ("<meta http-equiv=\"refresh\" content=\"0;url=../../usuarios/admin/cadastrarusuarios.php\"> ");
            exit;
        } else {
            $usuario = R::dispense('usuario');
            $usuario->email = $email;
            $usuario->nome = $nome;
            $usuario->perfil = $perfil;
            $usuario->senha = md5($senha . '__');
            R::store($usuario);
            R::close();
        }
    }
    public static function salvarVenda($codigo, $data, $subtotal, $pin, $aprazo)
    {
        require_once 'r.class.php';
        if (!R::testConnection()) {
            R::setup(
                'mysql:host=127.0.0.1;dbname=sistemarestaurante',
                'root',
                ''
            );
        }
        $vendas = R::findOne('venda', 'codigo LIKE ?', [$codigo]);

        if ($vendas->codigo == $codigo) {
            echo ("<script>alert(\"Código já cadastrado\");</script>");
            echo ("<meta http-equiv=\"refresh\" content=\"0;url=../../usuarios/caixa/cadastrovenda.php\"> ");
            exit;
        } else {
            date_default_timezone_set('America/Fortaleza');
            $venda = R::dispense('venda');
            $venda->codigo = $codigo;
            $venda->data = $data;
            $venda->subtotal = $subtotal;
            $venda->pin = $pin;
            if ($aprazo == false) {
                $venda->dataPagamento = date('Y-m-d');
            } else {
                $venda->dataPagamento = null;
            }


            R::store($venda);
            R::close();
        }
    }

    public static function salvarCliente($nome, $email, $senha, $perfil, $pin, $carteira, $cliente)
    {
        require_once 'r.class.php';
        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );
        $usuarios = R::findOne('usuario', 'email LIKE ?', [$email]);
        $usuarios2 = R::findOne('usuario', 'pin LIKE ?', [$pin]);
        if ($usuarios->email == $email || $usuarios2->pin == $pin) {
            echo ("<script>alert(\"Email ou PIN já cadastrados\");</script>");
            echo ("<meta http-equiv=\"refresh\" content=\"0;url=../../usuarios/admin/cadastrocliente.php\"> ");
            exit;
        } else {
            $usuario = R::dispense('usuario');
            $usuario->email = $email;
            $usuario->nome = $nome;
            $usuario->perfil = $perfil;
            $usuario->senha = md5($senha . '__');
            $usuario->pin = $pin;
            $usuario->carteira = $carteira;
            $usuario->habilitado = $cliente;
            R::store($usuario);
            R::close();
        }
    }
    public static function salvarClienteGerente($nome, $email, $senha, $perfil, $pin, $carteira, $cliente)
    {
        require_once 'r.class.php';
        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );
        $usuarios = R::findOne('usuario', 'email LIKE ?', [$email]);

        if ($usuarios->email == $email && $usuarios->pin == $pin) {
            echo ("<script>alert(\"Email ou PIN já cadastrados!\");</script>");
            echo ("<meta http-equiv=\"refresh\" content=\"0;url=../../usuarios/gerente/cadastrocliente.php\"> ");
            exit;
        } else {
            $usuario = R::dispense('usuario');
            $usuario->email = $email;
            $usuario->nome = $nome;
            $usuario->perfil = $perfil;
            $usuario->senha = md5($senha . '__');
            $usuario->pin = $pin;
            $usuario->carteira = $carteira;
            $usuario->habilitado = $cliente;
            R::store($usuario);
            R::close();
        }
    }
    public static function excluir($id)
    {
        require_once 'r.class.php';
        if (!R::testConnection()) {
            R::setup(
                'mysql:host=127.0.0.1;dbname=sistemarestaurante',
                'root',
                ''
            );
        }
        R::trash('usuario', $id);
        R::close();
    }
    public static function salvarnoticia($conteudo)
    {
        require_once 'r.class.php';
        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );
        date_default_timezone_set('America/Fortaleza');

        $noticia = R::dispense('noticia');
        $noticia->conteudo = $conteudo;
        $noticia->data = date('d/m/Y H:i');

        R::store($noticia);
        R::close();
    }
    public static function procurar()
    {
        require_once 'r.class.php';
        R::setup('mysql:host=127.0.0.1;dbname=sistemarestaurante', 'root', '');

        $usuarios = R::findAll('usuario');
        R::close();
        return $usuarios;
    }
    public static function procurarVenda($pin)
    {
        require_once 'r.class.php';
        R::setup('mysql:host=127.0.0.1;dbname=sistemarestaurante', 'root', '');
        $usuarios = R::findAll('venda', 'pin LIKE ?', [$pin]);
        R::close();
        return $usuarios;
    }


    public static function procurarPorId($id)
    {

        require_once 'r.class.php';

        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );

        $usuario = R::load('usuario', $id);
        R::close();
        return $usuario;
    }
    public static function procurarPorEmail($email)
    {

        require_once 'r.class.php';

        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );


        $usuario = R::findOne('usuario', 'email LIKE ?', [$email]);
        R::close();
        if ($usuario->perfil == 'cliente') {
            return $usuario;
        }
    }
    public static function procurarPorPin($pin)
    {

        require_once 'r.class.php';
        if (!R::testConnection()) {
            R::setup(
                'mysql:host=127.0.0.1;dbname=sistemarestaurante',
                'root',
                ''
            );
        }


        $usuario = R::findOne('usuario', 'pin LIKE ?', [$pin]);


        if ($usuario->perfil == 'cliente') {
            return $usuario;
        }
        R::close();
    }
    public static function verificarCarteira($pin)
    {

        require_once 'r.class.php';
        if (!R::testConnection()) {
            R::setup(
                'mysql:host=127.0.0.1;dbname=sistemarestaurante',
                'root',
                ''
            );
        }

        $usuario = R::findOne('usuario', 'pin LIKE ?', [$pin]);


        if ($usuario->carteira == TRUE && $usuario->habilitado == TRUE) {
            return $usuario;
        }
        R::close();
    }
    public static function quitarDebito($codigo)
    {

        require_once 'r.class.php';
        if (!R::testConnection()) {
            R::setup(
                'mysql:host=127.0.0.1;dbname=sistemarestaurante',
                'root',
                ''
            );
        }

        date_default_timezone_set('America/Fortaleza');
        $venda = R::findOne('venda', 'codigo LIKE ?', [$codigo]);
        $venda->data_pagamento = date('Y-m-d');
        R::store($venda);
        R::close();
    }
    public static function procurarCarteira($pin)
    {

        require_once 'r.class.php';
        if (!R::testConnection()) {
            R::setup(
                'mysql:host=127.0.0.1;dbname=sistemarestaurante',
                'root',
                ''
            );
        }


        $carteiras = R::findAll('venda', 'data_pagamento IS NULL');
        foreach ($carteiras as $x) {
            if ($x->pin == $pin) {
                $y[] = $x;
            } else {
                echo ("<script>alert(\"Pin não encontrado!\");</script>");
                echo ("<meta http-equiv=\"refresh\" content=\"0;url=../../usuarios/caixa/escolhercliente.php\"> ");
            }
            return $y;
        }



        R::close();
    }
    public static function procurarCarteiraGerente($pin)
    {

        require_once 'r.class.php';
        if (!R::testConnection()) {
            R::setup(
                'mysql:host=127.0.0.1;dbname=sistemarestaurante',
                'root',
                ''
            );
        }


        $carteiras = R::findAll('venda', 'data_pagamento IS NULL');
        foreach ($carteiras as $x) {
            if ($x->pin == $pin) {
                $y[] = $x;
            } else {
                echo ("<script>alert(\"Pin não encontrado!\");</script>");
                echo ("<meta http-equiv=\"refresh\" content=\"0;url=../../usuarios/gerente/escolhercliente.php\"> ");
            }
            return $y;
        }



        R::close();
    }

    public static function procurarClientes()
    {
        require_once 'r.class.php';
        R::setup('mysql:host=127.0.0.1;dbname=sistemarestaurante', 'root', '');

        $usuarios = R::findAll('usuario', 'perfil = \'cliente\'');
        R::close();
        return $usuarios;
    }
    public static function procurarProdutos()
    {
        require_once 'r.class.php';
        R::setup('mysql:host=127.0.0.1;dbname=sistemarestaurante', 'root', '');

        $produtos = R::findAll('produto');
        R::close();
        return $produtos;
    }
    public static function salvarEdicaoCliente($id, $nome, $email, $senha, $pin, $carteira, $habilitado)
    {
        require_once 'r.class.php';

        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );

        $usuario = R::dispense('usuario');

        $usuario->id = $id;
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = md5($senha . '__');
        $usuario->pin = $pin;
        $usuario->carteira = $carteira;
        $usuario->habilitado = $habilitado;
        R::store($usuario);

        R::close();
    }

    public static function salvarEdicao($id, $nome, $email, $senha, $perfil)
    {
        require_once 'r.class.php';

        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );

        $usuario = R::dispense('usuario');

        $usuario->id = $id;
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = md5($senha . '__');
        $usuario->perfil = $perfil;

        R::store($usuario);

        R::close();
    }
    public static function salvarProduto($nome, $preco, $codigo)
    {
        require_once 'r.class.php';

        R::setup(
            'mysql:host=127.0.0.1;dbname=sistemarestaurante',
            'root',
            ''
        );
        $produto = R::findOne('produto', 'codigo LIKE ?', [$codigo]);

        if ($produto->codigo == $codigo) {
            echo ("<script>alert(\"Código já cadastrado!!\");</script>");
            echo ("<meta http-equiv=\"refresh\" content=\"0;url=../../usuarios/gerente/cadastrarproduto.php\"> ");
            exit;
        } else {
            $produto = R::dispense('produto');
            $produto->nome = $nome;
            $produto->preco = $preco;
            $produto->codigo = $codigo;

            R::store($produto);
            R::close();
        }
    }






    public static function calcularSubtotal($codigo, $quantidade)
    {
        require_once 'r.class.php';
        if (!R::testConnection()) {
            R::setup(
                'mysql:host=127.0.0.1;dbname=sistemarestaurante',
                'root',
                ''
            );
        }
        $produto = R::findOne('produto', 'codigo = ?', [$codigo]);
        $subtotal = $produto->preco * $quantidade;
        R::close();
        return $subtotal;
    }
}
