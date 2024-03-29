<?php

require("View/ViewBanner.php");
?>
<html>
    <head>
        <link rel="stylesheet" href="Css/ErrorChamp.css">
        <link rel="stylesheet" href="Css/Bootstrap/PersonalCss.css">
        <link rel="stylesheet" href="Css/Bootstrap/background.css">
        <title>Profile</title>
    </head> 
    <body class='backgroundhat'>
        <div class='arriereprofil'>
        <?php
        if (empty($_GET['modif']))
        {
            echo("<br><div><div class='flexbox profil'>
                <div class='flexbox sousprofil center'><p>Nom d'utilisateur : ".PrintProfil(SelectProfile())[0]."</p></div>
                <div class='flexbox sousprofil center'><p>Prénom : ".PrintProfil(SelectProfile())[2]."</p></div>
                <div class='flexbox sousprofil center'><p>Nom : ".PrintProfil(SelectProfile())[3]."</p></div>
                <div class='flexbox sousprofil center'><p>Adresse : ".PrintProfil(SelectProfile())[4]."</p></div>
                <div class='flexbox sousprofil center'><p>Adresse e-mail : ".PrintProfil(SelectProfile())[5]."</p></div>
                <div class='flexbox sousprofil center'><p>Numéro de téléphone : ".PrintProfil(SelectProfile())[6]."</p></div>
                <div class='flexbox sousprofil center'><p>Mot de passe : ".PrintProfil(SelectProfile())[1]."</p></div></div>");
            echo("<div class='profil'><form action='Index.php' method='get'>
            <input type='submit' class='bouton_1'name='modif' value='Modifier mon profil'>
            <input type='hidden' name='page' value='Profil'>
            </form>
            <form action='Controller/ControllerPreferences.php' method='get'>
            <input type='submit' class='bouton_1'value='Modifier mes préférences'>
            </form>
            <form action='Index.php' method='get'>
            <input type='hidden' name='modif' value='Supprimer mon profil'>
            <input type='submit' class='bouton_1'value='Supprimer mon compte'>
            <input type='hidden' name='page' value='Profil'>
            </form></div></div>");
        } 
        else if ($_GET['modif']=='Modifier mon profil')
        {
            echo("<div class='profil center'><br><form action='Index.php' id='FormCom' name='FormName' method='get'>
                <p>Nom d'utilisateur : <input id='User' type='text' class='text_1'name='ndu' value='".htmlspecialchars(PrintProfil(SelectProfile())[0], ENT_QUOTES)."' class=Aright></p>
                <p>Prénom : <input id='FirstName' type='text' name='first_name' class='text_1'value='".htmlspecialchars(PrintProfil(SelectProfile())[2], ENT_QUOTES)."' class=Aright></p>
                <p>Nom : <input id='LastName' type='text' name='last_name' class='text_1'value='".htmlspecialchars(PrintProfil(SelectProfile())[3], ENT_QUOTES)."' class=Aright></p>
                <p>Adresse : <input id='Adress' type='text' name='adresse' class='text_1'value='".htmlspecialchars(PrintProfil(SelectProfile())[4], ENT_QUOTES)."' class=Aright></p>
                <p>Adresse e-mail : <input id='Mail' type='email' class='text_1'name='mail' class='text_1'value='".htmlspecialchars(PrintProfil(SelectProfile())[5], ENT_QUOTES)."' class=Aright></p>
                <p>Numéro de téléphone : <input id='Phone' type='text' name='phone' class='text_1'value='".htmlspecialchars(PrintProfil(SelectProfile())[6], ENT_QUOTES)."' class=Aright></p>
                <p>Mot de passe : <input id='Pwd' type='password' class='text_1'name='mdp' class='text_1'value='".htmlspecialchars(PrintProfil(SelectProfile())[1], ENT_QUOTES)."' class=Aright></p>
                <p>Confirmation de mot de passe : <input id='Cpwd' type='password' class='text_1'name='cmdp' class='text_1'value=''></p>
                <input type='hidden' name='modif' value='Corriger'>
                <p><input type='submit' class='bouton_1'value='Modifier'></p>
                <input type='hidden' name='page' value='Profil'>
                </form>");  
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' class='bouton_1'class='bouton_1'value='Retour'>
                </form>");
        }
        else if ($_GET['modif']=='Supprimer mon profil')
        {
            echo("Etes-vous vraiment sûr de vouloir supprimer votre compte ?");
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' class='bouton_1'name='supprimer'value='Oui'>
                </form>");
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' class='bouton_1'value='Non'>
                </form>");
        } 
        else if ($_SESSION['modifier']==true)
        {
            echo($_SESSION['erreur']."<br><form action='Index.php' method='get'>
            <input type='submit' class='bouton_1'value='Retour'>
            <input type='hidden' name='page' value='Profil'>
            </form>");
        } 
        else if ($_SESSION['modifier']==false)
        {
            echo"<br><form action='Index.php' id='FormCom' name='FormName' method='get'>";
            
            if(empty($_GET['ndu']) 
            || strlen($_GET['ndu']) < 5
            || strlen($_GET['ndu']) > 40
            || $Valeur != 0
            )
            {
                echo"<p>Nom d'utilisateur : <input type='text' class='text_1'id='User' name='ndu' value='".htmlspecialchars($_GET['ndu'], ENT_QUOTES)."' class=Error></p>";
            }
            else
            {
                echo"<p>Nom d'utilisateur : <input type='text' class='text_1'id='User' name='ndu' value='".htmlspecialchars($_GET['ndu'], ENT_QUOTES)."' class=Aright></p>";
            }
            
            if(empty($_GET['first_name'])
            || strlen($_GET['first_name']) < 2
            || strlen($_GET['first_name']) > 40
            || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['first_name'])
            )
            {
                echo"<p>Prénom : <input type='text' class='text_1'name='first_name' id='FirstName' value='".htmlspecialchars($_GET['first_name'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Prénom : <input type='text' class='text_1'name='first_name' id='FirstName' value='".htmlspecialchars($_GET['first_name'], ENT_QUOTES)."'class=Aright></p>";
            }

            if(empty($_GET['last_name'])
            || strlen($_GET['last_name']) < 2
            || strlen($_GET['last_name']) > 40
            || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['last_name'])
            )
            {
                echo"<p>Nom : <input type='text' class='text_1'name='last_name' id='LastName' value='".htmlspecialchars($_GET['last_name'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Nom : <input type='text' class='text_1'name='last_name' id='LastName' value='".htmlspecialchars($_GET['last_name'], ENT_QUOTES)."'class=Aright></p>";
            }

            if(empty($_GET['adresse'])
            || strlen($_GET['adresse']) < 2
            || strlen($_GET['adresse']) > 40
            || !preg_match("#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['adresse'])
            )
            {
                echo"<p>Adresse : <input type='text' class='text_1'name='adresse' id='Adress' value='".htmlspecialchars($_GET['adresse'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Adresse : <input type='text' class='text_1'name='adresse' id='Adress' value='".htmlspecialchars($_GET['adresse'], ENT_QUOTES)."'class=Aright></p>";
            }

            if(empty($_GET['mail'])
            || !preg_match("#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'._-]{2,30}+@[a-z0-9._-]{2,10}\.[a-z]{2,4}$#", $_GET['mail'])
            || $Valeur != 0
            )
            {
                echo"<p>Adresse e-mail : <input type='email' class='text_1'name='mail' id='Mail' value='".htmlspecialchars($_GET['mail'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Adresse e-mail : <input type='email' class='text_1'name='mail' id='Mail' value='".htmlspecialchars($_GET['mail'], ENT_QUOTES)."'class=Aright></p>";
            }

            if(empty($_GET['phone'])
            || !preg_match('#^(0|\+33)[1-9]{1}\d{8}$#' , $_GET['phone'])
            )
            {
                echo"<p>Numéro de téléphone : <input type='text' class='text_1'name='phone' id='Phone' value='".htmlspecialchars($_GET['phone'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Numéro de téléphone : <input type='text' class='text_1'name='phone' id='Phone' value='".htmlspecialchars($_GET['phone'], ENT_QUOTES)."'class=Aright></p>";
            }
            if(empty($_GET['mdp']) 
            || strlen($_GET['mdp']) < 5
            || strlen($_GET['mdp']) > 40    
            )
            {
                echo"<p>Mot de passe : <input type='password' class='text_1'id='Pwd' name='mdp' value='".htmlspecialchars($_GET['mdp'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Mot de passe : <input type='password' class='text_1'id='Pwd' name='mdp' value='".htmlspecialchars($_GET['mdp'], ENT_QUOTES)."'class=Aright></p>";
            }
            if(empty($_GET['cmdp'])
            || $_GET['mdp'] != $_GET['cmdp']
            )
            {
                echo"<p>Confirmation de mot de passe : <input type='password' id='Cpwd' class='text_1'name='cmdp' value='".htmlspecialchars($_GET['cmdp'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Confirmation de mot de passe : <input type='password' id='Cpwd' class='text_1'name='cmdp' value='".htmlspecialchars($_GET['cmdp'], ENT_QUOTES)."'class=Aright></p>";
            }


            echo"<input type='hidden' value='Corriger' name='modif'>
            <p><FONT color='red'>
            ".($_SESSION['erreur']."
            </FONT></p>
            <input type='submit' class='bouton_1'value='Modifier'>
            <input type='hidden' name='page' value='Profil'>
            </form>
            ");
            echo("<form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Profil'>
            <input type='submit' class='bouton_1'value='Retour'>
            </form>");
        }
        ?>
        </div>
    </body>
</html>