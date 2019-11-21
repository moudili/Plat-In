<html>
    <head>
    </head>
    <body>
        <?php
            
            if(empty($_GET['page']))
                require('Controller/ControllerHome.php');
            else if ($_GET['page'] == "Inscription")
                require('Controller/ControllerSignUp.php');
            else if ($_GET['page'] == 'Connexion')
                require('Controller/ControllerSignIn.php');
            else if ($_GET['page'] == 'Recette')
                require('Controller/ControllerRecipe.php');
            else if ($_GET['page'] == 'Evènement')
                require('Controller/ControllerEvent.php');
            else if ($_GET['page'] == 'Profile')
                require('Controller/ControllerProfile.php');
            else if ($_GET['page'] == 'Sociale')
                require('Controller/ControllerSocial.php');
            else if ($_GET['page'] == 'Aliments')
                require('Controller/ControllerFood.php');
            else if ($_GET['page'] == 'Origines')
                require('Controller/ControllerOrigins.php');
            else if ($_GET['page'] == 'Gestion des droits')
                require('Controller/ControllerRights.php');
            else if ($_GET['page'] == 'Régimes')
                require('Controller/ControllerDiet.php');
            else if ($_GET['page'] == 'Catégories Alimentaires')
                require('Controller/ControllerFoodCategories.php');
        
        ?>
    </body>
</html>        