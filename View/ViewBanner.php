<html>
    <head>
    <link rel="stylesheet" href="Css/Bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="Css/Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Css/Bootstrap/MyCss.css">
    
    </head>
    <body>
        <!--affiche le haut de la banner -->
        <div class="banner1 row justify-content-between px-5" >
            <div>
                <form action='Index.php' method='get'>
                <button>
                <img src="Pictures/Logo.png" alt="logo Plat'In" class='adjimg' type='submit' value='Accueil'>
                </button>
                </form>
            </div>
            
            <?php
                if($_SESSION['Co']==false)
                {
            ?>
            <div class='brr'>
            <form action='Index.php' method='get'>
            <input type='search' placeholder = 'Recherche...' name='Search'/>
            <input type='hidden' name='page' value='Recette'>
            <input type='hidden' name='Request' value='Search'>
            <input type='submit' value=" "></form>
            </div>
            <?php    
                }
                else
                {
                    if($_SESSION['status_u'] != 'admin')
                    {
                        ?>
                        <div class='brr'>
                        <form action='Index.php' method='get'>
                        <input type='search' placeholder = 'Recherche...'/>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='Request' value='search'>
                        <input type='submit' value=" "></form>
                        </div>
                        <?php   
                    }
                }    
            ?>
           
           <div>
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
        </div>
        <!--affiche le menu -->

        <?php
            if($_SESSION['Co']==false)
            {
                ?>
                    <div class="banner2 row justify-content-around">
                        <form action='Index.php' method='get'>
                        <input type='submit' value="Accueil"></form>
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" value="Recette"></form>
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" value="Evènement"></form>
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" value="Profil"></form>
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
                        <div class="banner2 row justify-content-around">
                            <form action='Index.php' method='get'>
                            <input type='submit' value="Accueil"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Aliments"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Catégories Alimentaires"></form>     
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Notes recettes"></form>   
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Recettes"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Régimes"></form>                         
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Origines"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Gestion des droits"></form>

                            
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div class="banner2 row justify-content-around">
                            <form action='Index.php' method='get'>
                            <input type='submit' value="Accueil"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Recette"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Evènement"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Profil"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Sociale"></form>
                        </div>
                    <?php
                }
            }

        ?>


    </body>
</html>  