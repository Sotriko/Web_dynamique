<?php
    session_start();
    
    if (isset($_SESSION['id'])): //si il y a un identifiant de connexion
        if ($_SESSION['id']==1):
            $connect=2;
        else:
            $connect=1;
        endif;
    else: //si pas d'identifiant de connexion
        $connect=0;
    endif;
    if (isset($_GET['seDeco'])): //cf lien de Déconnexion
        session_destroy();?>
    <script>
        window.location = 'index.php'; //redirection sur l'accueil après la déconnexion
    </script>";
    <?php endif;
    include_once('connexion.php');
?>
<html>
    <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <link rel="stylesheet"  media="screen" type="text/css" title="design" href="global.css"/>
    <title>Ludotheque de Vull</title>
    <link rel="shortcut icon" href="./images/icone_site.png" type="image/x-icon" /> 
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script> <!-- insertion de la librairie jQuery -->
    </head>
    <body>
    <nav> <!-- menu -->
        <ul>
            <li><a href="./index.php"> Accueil </a></li>
            <li>
                <a>Jeux</a>
                <ul>
                    <li><a href="./jeux.php"> Tous les jeux </a></li>
                    <li><a href="./a_venir.php"> Jeux a venir </a></li>
                </ul>
            </li>
        <?php if($connect==1):?> <!-- menu d'un utilisateur normal -->
            <li><a href="./panier.php"> Panier </a></li>
            <li><a href="./mon_profil.php"> Mon Profil </a></li>
            <li><a href="./index.php?seDeco=ok">Déconnexion</a></li>
        <?php elseif($connect==2): ?> <!-- menu d'un utilisateur admin -->
            <li><a href="./voir_commande.php"> Commandes </a></li>
            <li><a href="./index.php?seDeco=ok">Déconnexion</a></li>
        <?php else: ?> <!-- menu d'un visiteur -->
            <li><a href="./seconnecter.php"> Connexion </a></li>
        <?php endif;?>
        </ul>
    </nav>
    <?php if ($connect != 0): ?>
        <marquee>Bienvenue <?php echo $_SESSION['pseudo']; ?>, vous pouvez maintenant passer commande.</marquee>
    <?php endif; ?>
        <section>