<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
<div class="header">
    <hr>
    <div class="ul">
        <ul class="ul_head">
                <li class="li-left"><a href="index.php?registerCase">Registrar Un caso</a></li>
                <li class="li-left"><a href="index.php">Mostrar los casos existentes</a></li>
                <li class="li-right"><a href="index.php?logout">Cerrar sesión!</a></li>
        </ul>
    </div>
    <div class="square">
        <h3>Hey, <strong class="resalt-medium-light"><?php echo $_SESSION['user_name']; ?></strong> bienvenido!</h3>
        <p>Has iniciado sesión de forma exítosa!. Intenta cerrar la pestaña del navegador y abrir esta pagina de nuevo</p>
        <p>TE MANTENDRÁS LOGEADO! ;)</p>
    </div>
</div>
