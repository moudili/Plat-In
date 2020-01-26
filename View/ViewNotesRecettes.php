<?php
require("View/ViewBanner.php");
?>
<html>
    <head>
        <title>Notes Recettes</title>
    </head>
    
    <body>
        <?php


        if (empty($_GET['Request']))
        {
            echo("<div class='text-center mt-5'>
            <form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Notes recettes'>
            </form>
            <table border=4 align='center'>
            <p>Notes des recettes</br></br>");
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
                <input type='submit' name='Request' value='Supprimer'></td>
                </tr></p></form>");
            }
        }
        else if ($_GET['Request']=="Supprimer")
        {
            echo("<div class='text-center mt-5'>
            Êtes-vous sur de vouloir supprimer la note ".$_GET['note']." de la recette ".$_GET['nom']."? </br></br>
            <form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Notes recettes'>
            <input type='hidden' name='RequestSupp' value='ok'>
            <input type='hidden' name='id' value='".$_GET['id']."'>
            <input type='hidden' name='note' value='".$_GET['note']."'>
            <input type='hidden' name='nom' value='".$_GET['nom']."'>
            <input type='submit' name='Request' value='Oui'>
            </form>
            <form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Notes recettes'>
            <input type='submit' value='Non'>
            </form>");
        }
        else if ($_GET['Request']=="Oui" AND $_GET['RequestSupp']=='ok')
        {
            echo("<div class='text-center mt-5'>
            Vous avez bien supprimé la note ".$_GET['note']." de la recette ".$_GET['nom'].".
            </br></br>
            <form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Notes recettes'>
            <input type='submit' value='Retour'>
            </form>");
        }     

        ?>
    </body>
</html>