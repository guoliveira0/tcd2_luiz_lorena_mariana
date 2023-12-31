<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Produtos</title>
    <link rel="stylesheet" href="../../styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap');
    </style>
</head>

<body>
    <?php include '../../padrao/cabecalho.inc.php' ?>
    <main>
        <div class="destaque-titulo">
            <h1>Lista de produtos</h1>
        </div>

        <table class= "content-table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Código</th>

            </tr>
            <?php
            require_once '../../classes/usuarioservices.class.php';
            $produtos = UsuarioServices::procurarProdutos();
            foreach ($produtos as $x) {
            ?>
                <tr>
                    <td><?= $x->id ?></td>
                    <td><?= $x->nome ?></td>
                    <td>R$<?= number_format((float)$x->preco, 2, '.', '')?></td>
                    <td><?= $x->codigo ?></td>

                </tr>

            <?php
            }
            ?>

        </table>

    </main>

    <?php include '../../padrao/rodape.inc.php' ?>
</body>

</html>