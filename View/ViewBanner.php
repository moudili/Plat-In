<html>
    <body>
        <!--affiche le haut de la banner -->
        <div>
            <img src="Pictures/Logo.png">
            
            <?php
                if($_SESSION['Co']==false)
                {
            ?>

            <form action='Index.php' method='get'>
            <input type='search' placeholder = 'Recherche...' name='Search'/>
            <input type='hidden' name='page' value='Recette'>
            <input type='hidden' name='Request' value='Search'>
            <input type='submit' value=" "></form>
            
            <?php    
                }
                else
                {
                    if($_SESSION['status_u'] != 'admin')
                    {
                        ?>

                        <form action='Index.php' method='get'>
                        <input type='search' placeholder = 'Recherche...'/>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='Request' value='search'>
                        <input type='submit' value=" "></form>
                        
                        <?php   
                    }
                }    
            ?>

        <!--partie statut -->

            <?php

                if($_SESSION['Co']==false)
                {
            ?>
                    <form action='Index.php' method='get'>
                    <input type='submit' name="page" value="Inscription"></form>
                    <form action='Index.php' method='get'>
                    <input type='submit' name="page" value="Connexion"></form>
            <?php
                }
                else        
                {
                    echo"<br>".($_SESSION['User']);
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
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" value="Recette"></form>
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" value="Evènement"></form>
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" value="Profile"></form>
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" value="Sociale"></form>            
                    </div>
                <?php
            }
            else
            {
                if($_SESSION['status_u'] == 'admin')
                {
                    ?>
                        <div>
                            <form action='Index.php' method='get'>
                            <input type='submit' value="Accueil"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Aliments"></form>                            
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Origines"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Gestion des droits"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Régimes"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Catégories Alimentaires"></form>            
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div>
                            <form action='Index.php' method='get'>
                            <input type='submit' value="Accueil"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Recette"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Evènement"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Profile"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Sociale"></form>
                        </div>
                    <?php
                }
            }

        ?>


    </body>
</html>  