<html>
    <head>
    <meta charset="utf-8"/>
	<title>Plat'In</title>
    <link rel="stylesheet" href="../css/divbg.css"/>
    <link rel="stylesheet" href="../css/BannerVisitor.css"/>
    <link rel="icon"  type="image/png" href="../Pictures/Logo.png">
    </head>
    <body>
        <!--affiche le haut de la banner -->
        <div class="box center row">
            <img src="../Pictures/Logo.png">
            <form action='Recipe.php' method='get'>
            <input type="text" value="Rechercher une recette"/>
            <input type='submit' value=" "></form>
            <form action='SignUp.php' method='get'>
            <input type='submit' value="Inscription"></form>
            <form action='SignIn.php' method='get'>
            <input type='submit' value="Connexion"></form>
        </div>
        <!--affiche le menu -->
        <div class="box center row">
            <form action='Index.php' method='get'>
            <input type='submit' value="Accueil"></form>
            <form action='Recipe.php' method='get'>
            <input type='submit' value="Recette"></form>
            <form action='Event.php' method='get'>
            <input type='submit' value="Evènement"></form>
            <form action='Profile.php' method='get'>
            <input type='submit' value="Profile"></form>
            <form action='Social.php' method='get'>
            <input type='submit' value="Sociale"></form>            
        </div>
    </body>
</html>  