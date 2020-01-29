<?php     
    require("View/ViewBanner.php"); 
?>
<html>
    <head>
        <title>Plat'In</title>
    </head>
    <style>
         body{
            text-align: center;
            }
    </style> 
    <body>

        <table border=1>
        <h1>Liste des utilisateurs</h1>
        <tr>
            <td>ID</td><td>Utilisateur</td>
        </tr>
        <tr>
        <?php
            foreach($ListeUtilisateur as $Utilisateur)
            {

                echo("<tr><td>".$Utilisateur[0]."</td><td>".$Utilisateur[1]."</td></tr>");
            }

        ?>
        </tr>
        </table>

        <?php
        if ($_GET['Relation']=='Ajouter') {
            echo("
            <form action='Index.php' method='get'>
                <input type='number' name='utilisateur1' >
                <input type='number' name='utilisateur2' >
                <input type='radio' name='status' value='accepted' checked> accepted<br>
                <input type='radio' name='status' value='requested'> requested<br>
                <input type='radio' name='status' value='block'> block<br>
                <input type='hidden' name='page' value='Relation'>
                <input type='submit' name='Relation' value='Inserer'>
                </form>
            ");
        }
        else
        {
        ?>


        <table border=1>
            <tr>
            <td>Utilisateur n°1</td><td>Utilisateur n°2</td><td>Status</td><td> Nouveau Utilisateur n°1</td><td>Nouveau Utilisateur n°2</td><td>Nouveau Status</td>
            <td>
            <form>
                <input type='hidden' name='page' value='Relation'>
                <input type='submit' name='Relation' value='Ajouter'></form>
            </tr>

            <?php
            foreach ($Relation as $Amitier) {
                echo($Amitier[3]);
                echo("<tr>");
                echo("<td>".$Amitier[0]."</td><td>".$Amitier[1]."</td><td>".$Amitier[2]."</td>");
                echo("
                <form action='Index.php' method='get'>
                <td>
                <input type='number' name='utilisateur1' value='".$Amitier[0]."'>
                </td>
                <td>
                <input type='number' name='utilisateur2' value='".$Amitier[1]."'>
                </td>
                <td>
                <input type='radio' name='status' value='accepted' checked> accepted<br>
                <input type='radio' name='status' value='requested'> requested<br>
                <input type='radio' name='status' value='block'> block<br>
                </td>
                <td>
                <input type='hidden' name='page' value='Relation'>
                <input type='hidden' name='ID' value='".$Amitier[3]."'>
                <input type='submit' name='Relation' value='Mettre a jour'>
                </form></td>");
                echo("<form action='Index.php' method='get'>
                <td>
                <input type='hidden' name='page' value='Relation'>
                <input type='hidden' name='ID' value='".$Amitier[3]."'>
                <input type='submit' name='Relation' value='Supprimer'>
                </form></td>");
                echo("</tr>");

                
            }
            ?>
            </table>
        <?php
        }
        ?>
    </body>
</html>