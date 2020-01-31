<html>
    <head>
    <link rel="stylesheet" href="Css/Bootstrap/PersonalCss.css">
    <link rel="stylesheet" href="Css/Bootstrap/background.css">
    <link rel="stylesheet" href="Css/Bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body >
        <!--affiche le haut de la banner -->
        <div class="banner1 row justify-content-between px-5" >
            <div>
                <form action='Index.php' method='get'>
                <button>
                <img src="Pictures/Logo.png" alt="logo Plat'In" class='adjimg' type='submit' class='bouton_1' value='Accueil'>
                </button>
                </form>
            </div>
            
            <?php
                if($_SESSION['Co']==false)
                {
            ?>
            <div class='brr'>
            <form action='Index.php' method='get'>
            <input type='search' class='text_1'placeholder = 'Recherche...' name='Org' 
            <?php
            if(!empty($_GET['Org'])) 
            echo"value='".$_GET['Org']."'"; 
            ?>/>
            <input type='hidden' name='page' value='Recette'>
            <input type='hidden' name='Request' value='Search' >
            <button type='submit'class='bouton_1'> <i class="fa fa-search"></i></button></form>
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
                        <input type='search' class='text_1'placeholder = 'Recherche...' name='Org' 
                        <?php
                        if(!empty($_GET['Org'])) 
                        echo"value='".$_GET['Org']."'"; 
                        ?>/>                        
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='Request' value='Search'>
                        <button type='submit'class='bouton_1'> <i class="fa fa-search"></i></button></form></form>
                        </div>
                        <?php   
                    }
                }    
            ?>
           
           <div class='ghetto'>
        <!--partie statut -->

            <?php

                if($_SESSION['Co']==false)
                {
            ?>      <div>
                    <form action='Index.php' method='get'>
                    <input type='submit' class="bouton_1" name="page" value="Inscription"></form>
                    </div>
                    <div>
                    <form action='Index.php' method='get'>
                    <input type='submit' class="bouton_1" name="page" value="Connexion"></form>
                    </div>
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
                        <input type='submit' class="bouton_1" value="Accueil"></form>
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" class='bouton_1' value="Recette"></form>
                        <form action='Index.php'  method='get'>
                        <input type='submit' name="page" class="bouton_1" value="Evènement"></form>
                        <form action='Index.php'  method='get'>
                        <input type='submit' name="page" class="bouton_1" value="Profil"></form>
                        <form action='Index.php' method='get'>
                        <input type='submit' name="page" class="bouton_1" value='Social'></form>            
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
                            <input type='submit' class='bouton_1'value="Accueil"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Aliments"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Catégories Alimentaires"></form>     
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Régimes"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Origines"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Gestion des droits"></form>                         
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Notes recettes"></form>   
                            <!--<form action='Index.php' method='get'>
                            <input type='submit' name="page" value="Relation"></form>-->
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Recettes"></form>
                            

                            
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div class="banner2 row justify-content-around">
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'value="Accueil"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Recette"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Evènement"></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' class='bouton_1'name="page" value="Profil"></form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='Usr' value=''>
                            <input type='submit' class='bouton_1'name="page" value="Social">
                            <input type='hidden' name='Request' value='Search'>
                            <input type='hidden' name='Usr' value="">
                            </form>
                        </div>
                    <?php
                }
            }

        ?>


    </body>
</html>  