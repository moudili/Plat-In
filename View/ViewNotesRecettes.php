<?php
require("View/ViewBanner.php");
?>
<html>
    <head>
        <title>Notes Recettes</title>
    </head>
    <link rel="stylesheet" href="Css/Bootstrap/PersonalCss.css">
    <link rel="stylesheet" href="Css/Bootstrap/background.css">
    <body class='backgroundhat center'>
        <div class='arriereprofil'>
            <div class='profil'>
        <?php

        if (empty($_GET['Request']))
        {
            echo("
            <form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Notes recettes'>
            </form>
            <table border=4 align='center'>
            Notes des recettes<br><br>");
            for ($i=0;$i<count($Note[0]);$i++)
            {
                echo("<form action='Index.php' method='get'>
                <td>Note des utilisateurs : ".$Note[0][$i]."/5</br> 
                Recette : ".$Note[2][$i]."
                <td>
                <input type='hidden' name='page' value='Notes recettes'><br>
                <input type='hidden' name='note' value='".$Note[0][$i]."'>
                <input type='hidden' name='nom' value='".$Note[2][$i]."'>
                <input type='hidden' name='id' value='".$Note[3][$i]."'>
                <input type='submit' class='bouton_1' name='Request' value='Supprimer'></td>
                </tr></form>");
            }
        }
        else if ($_GET['Request']=="Supprimer")
        {
            echo("
            Êtes-vous sur de vouloir supprimer la note ".$_GET['note']." de la recette ".$_GET['nom']."? </br></br>
            <form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Notes recettes'>
            <input type='hidden' name='RequestSupp' value='ok'>
            <input type='hidden' name='id' value='".$_GET['id']."'>
            <input type='hidden' name='note' value='".$_GET['note']."'>
            <input type='hidden' name='nom' value='".$_GET['nom']."'>
            <input type='submit' class='bouton_1' name='Request' value='Oui'>
            </form>
            <form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Notes recettes'>
            <input type='submit' class='bouton_1' value='Non'>
            </form>");
        }
        else if ($_GET['Request']=="Oui" AND $_GET['RequestSupp']=='ok')
        {
            echo("
            Vous avez bien supprimé la note ".$_GET['note']." de la recette ".$_GET['nom'].".
            </br></br>
            <form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Notes recettes'>
            <input type='submit' class='bouton_1' value='Retour'>
            </form>");
        }     

        ?>
    </body>
</html>