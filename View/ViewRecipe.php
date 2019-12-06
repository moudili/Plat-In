<html>
    <head>
        <title>Recette</title>
    </head>
    
    <body>
        <?php
            
            require("View/ViewBanner.php"); 


            if ($_SESSION['Co']==false)
            {
                echo("<div class='text-center mt-5'>
                Veuillez vous <a href='Index.php?page=Inscription'> inscrire</a> ou 
                vous <a href='Index.php?page=Connexion'> connecter</a> pour ajouter des recettes");   
            } 
            else if ($_SESSION['Co']!=false)
            {
                if (empty($_GET['Request']))
                {
                echo("<div class='text-center mt-5'>
                <form action='Index.php' method='get'>
                <input type='submit' name='Request' value='Ajouter une recette'>
                <input type='hidden' name='page' value='Recette'>
                </form>");
                } 
                else if ($_GET['Request']=='Ajouter une recette')
                {
                    echo("<p>Créer une recette</p>
                    <p>image : <input id='get_compte' type='text' name='img' value=''></p>
                    <p> Nom de la recette : <input id='get_compte' type='text' name='name' value=''></p>
                    <p> Aliments : <input id='get_compte' type='text' name='food' value=''></p>
                    <p> Temps de préparation : <input id='get_compte' type='text' name='time' value=''></p>
                    <p> Origine de la recette : <input id='get_compte' type='text' name='origin' value=''></p>
                    <p> Recette : <br><TEXTAREA name='text' rows=4 cols=40></TEXTAREA></p>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' name='Request'value='Valider'></form>");

                    echo("<p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' value='Retour'></form>");
                } 
                else if ($_GET['Request']=='Valider')
                {
                    echo("<div class='text-center mt-5'>
                    Votre recette est maintenant en ligne !");
                }
            }
        
        ?>
    </body>
</html>