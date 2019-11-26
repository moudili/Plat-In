<html>
    <head>
        <title>Profile</title>
    </head>
    
    <body>
        <?php

        require("View/ViewBanner.php"); 
        
        if (empty($_GET['modif']))
        {
            echo("<br>
                <p>Nom d'utilisateur : ".PrintProfil(SelectProfile())[0]."</p>
                <p>Prénom : ".PrintProfil(SelectProfile())[2]."</p>
                <p>Nom : ".PrintProfil(SelectProfile())[3]."</p>
                <p>Adresse :".PrintProfil(SelectProfile())[4]."</p>
                <p>Adresse e-mail :".PrintProfil(SelectProfile())[5]."</p>
                <p>Numéro de téléphone :".PrintProfil(SelectProfile())[6]."</p>
                <p>Mot de passe : ".PrintProfil(SelectProfile())[1]."</p>");
            echo("<form action='Index.php' method='get'>
            <input type='submit' name='modif' value='Modifier mon profil'>
            <input type='hidden' name='page' value='Profil'>
            </form>");
            echo("<form action='Index.php' method='get'>
            <input type='submit' name='modif' value='Supprimer mon profil'>
            <input type='hidden' name='page' value='Profil'>
            </form>");
        } 
        else if ($_GET['modif']=='Modifier mon profil')
        {
            echo("<br><form action='Index.php' method='get'>
                <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value='".PrintProfil(SelectProfile())[0]."'></p>
                <p>Prénom : <input id='get_prenom' type='text' name='first_name' value='".PrintProfil(SelectProfile())[2]."'></p>
                <p>Nom : <input id='get_nom' type='text' name='last_name' value='".PrintProfil(SelectProfile())[3]."'></p>
                <p>Adresse : <input id='get_adresse' type='text' name='adresse' value='".PrintProfil(SelectProfile())[4]."'></p>
                <p>Adresse e-mail : <input id='get_mail' type='email' name='mail' value='".PrintProfil(SelectProfile())[5]."'></p>
                <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value='".PrintProfil(SelectProfile())[6]."'></p>
                <p>Mot de passe : <input id='get_mdp' type='text' name='mdp' value='".PrintProfil(SelectProfile())[1]."'></p>
                <p>Confirmation de mot de passe : <input id='get_cmdp' type='text' name='cmdp' value=''></p>
                <input type='submit' name='modif' value='Corriger'>
                <input type='hidden' name='page' value='Profil'>
                </form>");
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' value='Retour'>
                </form>");
        }
        else if ($_GET['modif']=='Supprimer mon profil')
        {
            echo("Veux-tu vraiment supprimer ton profil ???");
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' name='supprimer'value='Oui'>
                </form>");
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' value='Non'>
                </form>");
        } 
        else if ($_SESSION['modifier']==true)
        {
            echo($_SESSION['erreur']."<br><form action='Index.php' method='get'>
            <input type='submit' value='Retour'>
            <input type='hidden' name='page' value='Profil'>
            </form>");
        } 
        else if ($_SESSION['modifier']==false)
        {
            echo($_SESSION['erreur']."<br><form action='Index.php' method='get'>
            <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value='".$_GET['ndu']."'></p>
            <p>Prénom : <input id='get_prenom' type='text' name='first_name' value='".$_GET['first_name']."'></p>
            <p>Nom : <input id='get_nom' type='text' name='last_name' value='".$_GET['last_name']."'></p>
            <p>Adresse : <input id='get_adresse' type='text' name='adresse' value='".$_GET['adresse']."'></p>
            <p>Adresse e-mail : <input id='get_mail' type='email' name='mail' value='".$_GET['mail']."'></p>
            <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value='".$_GET['phone']."'></p>
            <p>Mot de passe : <input id='get_mdp' type='text' name='mdp' value='".$_GET['mdp']."'></p>
            <p>Confirmation de mot de passe : <input id='get_cmdp' type='text' name='cmdp' value='".$_GET['cmdp']."'></p>
            <input type='submit' value='Corriger' name='modif'>
            <input type='hidden' name='page' value='Profil'>
            </form>
            </div>");
            echo("<form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Profil'>
            <input type='submit' value='Retour'>
            </form>");
        }
        ?>
    </body>
</html>