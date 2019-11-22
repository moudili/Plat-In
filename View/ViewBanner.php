<html>
    <head>
    </head>
    <body>
        <!--affiche le haut de la banner -->
        <div>
            <img src="Pictures/Logo.png">
            <form action='Recipe.php' method='get'>
            <input type="text" value="Rechercher une recette"/>
            <input type='submit' value=" "></form>
        <!--partie statut -->

            <?php

                if($_SESSION['Co']==false)
                {
                    ?>
                        <form action='SignUp.php' method='get'>
                        <input type='submit' value="Inscription"></form>
                        <form action='SignIn.php' method='get'>
                        <input type='submit' value="Connexion"></form>
                    <?php
                }
                else        
                {
                    echo($_SESSION['User']);
                    ?>
                        <br><br><a href=Index.php?Request=LogOut>Déconnexion</a><br><br>
                    <?php
                }

            ?>
            
        </div>
        <!--affiche le menu -->
        <?php
            if($_SESSION['Co']==false)
            {
                ?>
                    <div>
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
                <?php
            }
            else
            {
                if($_SESSION['status_u'] == 'admin')
                {
                    ?>
                        <div>
                            admin
                            <form action='Index.php' method='get'>
                            <input type='submit' value="Accueil"></form>
                            <form action='ManageFood.php' method='get'>
                            <input type='submit' value="Aliments"></form>                            
                            <form action='Origins.php' method='get'>
                            <input type='submit' value="Origines"></form>
                            <form action='Rights.php' method='get'>
                            <input type='submit' value="Gestion des droits"></form>
                            <form action='Diet.php' method='get'>
                            <input type='submit' value="Régimes"></form>
                            <form action='Food_categorie.php' method='get'>
                            <input type='submit' value="Catégories Alimentaires"></form>            
                        </div>
                    <?php
                }
                else
                {
                    var_dump($_SESSION);
                    echo("test");
                    echo($_SESSION['status_u']);
                    ?>
                        <div>
                            pas admin
                            
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
                    <?php
                }
            }

        ?>


    </body>
</html>  