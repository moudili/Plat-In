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
    else if ($_GET['page'] == 'Profil')
        require('Controller/ControllerProfil.php');
    else if ($_GET['page'] == 'Social')
        require('Controller/ControllerSocial.php');
    else if ($_GET['page'] == 'Aliments')
        require('Controller/ControllerManageFood.php');
    else if ($_GET['page'] == 'Origines')
        require('Controller/ControllerOrigins.php');
    else if ($_GET['page'] == 'Gestion des droits')
        require('Controller/ControllerRights.php');
    else if ($_GET['page'] == 'Régimes')
        require('Controller/ControllerDiet.php');
    else if ($_GET['page'] == 'Catégories Alimentaires')
        require('Controller/ControllerFoodCategories.php');
    else if ($_GET['page'] == 'Notes recettes')
        require('Controller/ControllerNotesRecettes.php');
    else if ($_GET['page'] == 'Recettes')
        require('Controller/ControllerRecettes.php'); 
    else if ($_GET['page'] == 'Relation')
        require('Controller/ControllerRelation.php'); 
?>       