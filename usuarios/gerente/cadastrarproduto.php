<?php
require_once '../../classes/util.class.php';
Util::isGerente();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Produto</title>
  <link rel="stylesheet" href="../../styles.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap');
  </style>

</head>

<body>
  <?php include '../../padrao/cabecalho.inc.php'; ?>

  <div class="destaque-titulo">
    <h1>Cadastrar novo produto</h1>
  </div>

  <main>
    <form action="cadastrarproduto.php" method="post" class="user-form" id="form-cadastro-produto">
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
      </div>

      <div class="form-group">
        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" step="0.01" required>
      </div>

      <div class="form-group">
        <label for="codigo">Código:</label>
        <input type="number" name="codigo" id="codigo" min="1000" max="9999" required>
      </div>

      <div class="form-group">
        <input type="submit" value="Cadastrar">
      </div>
    </form>


    <?php
    if (isset($_POST['codigo'])) {
      require_once '../../classes/usuarioservices.class.php';
      UsuarioServices::salvarProduto($_POST['nome'], floatval($_POST['preco']), $_POST['codigo']);
      header('Location:cadastrarproduto.php');
    }
    ?>
  </main>
  <?php include '../../padrao/rodape.inc.php'; ?>
</body>

</html>