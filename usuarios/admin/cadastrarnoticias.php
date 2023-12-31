<?php
require_once '../../classes/util.class.php';
Util::isAdmin()

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/rsrllxn7v5tmfve49z7wzocog92nwadca6n4s6ytb80bvitc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Cadastro Notícias</title>
    <link rel="stylesheet" href="../../styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap');
    </style>
</head>

<body>
    <?php include '../../padrao/cabecalho.inc.php';?>

    <main>
        <div class="destaque-titulo">
            <h1>Cadastrar nova notícia</h1>
        </div>

    <form id="cadastrarnoticia" action="cadastrarnoticias.php" method="post">
        <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
        </script>
        <textarea name="conteudo" id="conteudo" rows="10" cols="50"></textarea>
        <input type="submit" value="Cadastrar">
    </form>
    
      <?php
      require_once '../../classes/usuarioservices.class.php';

      if(isset($_POST['conteudo'])){
        UsuarioServices::salvarnoticia($_POST['conteudo']); 
      }
      ?>

    </main>
    <?php include '../../padrao/rodape.inc.php';?>

</body>

</html>
