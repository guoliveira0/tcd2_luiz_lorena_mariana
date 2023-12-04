<header>

    <?php
    require_once dirname(__DIR__) . '/classes/util.class.php';
    if (Util::isLog()) {
        echo "<p>{$_SESSION['usuario']}</p> | <a href=\"/tcd2_luiz_lorena_mariana/padrao/logout.php\">Logout</a>";

        //logout

    } else {
        //form para autenticar
    ?>
        <!-- Login -->
        <div id="login">
            <form action="./padrao/autenticar.php" method="post">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
                <label for="senha">Senha: </label>
                <input type="password" name="senha" id="senha">
                <input type="submit" value="Enviar">
                <?php
                if (isset($_GET['naoautenticado'])) {
                    echo '<br><span id="naoautenticado" style="color:red">Senha ou email incorretos, tente novamente.</span>';
                }
                ?>
            </form>
        </div>
    <?php
    }
    ?>

    <!-- Links do header -->
    <div id="linksheader">
        <nav>
            <ul>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Notícias</a></li>
            </ul>
        </nav>
    </div>
</header>