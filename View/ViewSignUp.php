<html>
    <head>
        <title>Inscription</title>
    </head>
    
    <body>
        <?php
        if (empty($_GET['SignUp']))
        {
            echo("<form action='SignUp.php' method='get'>
            <p>Nom d'utilisateur : <input type='text' name='User' value=''></p>
            <p>Prénom : <input type='text' name='FirstName' value=''></p>
            <p>Nom : <input type='text' name='LastName' value=''></p>
            <p>Adresse : <input type='text' name='Adress' value=''></p>
            <p>Adresse e-mail : <input type='email' name='Mail' value=''></p>
            <p>Numéro de téléphone : <input type='text' name='Phone' value=''></p>
            <p>Mot de passe : <input type='password' name='Pwd' value=''></p>
            <p>Confirmation de mot de passe : <input type='password' name='Cpwd' value=''></p>
            <input type='submit' value='Inscription' name='SignUp'>
            </form>
            </div>");
        } else if (!empty($_GET['SignUp']))
        {
            if ($_SESSION["Create"]==true) {
                echo("Tu as reussi a t'inscrire, ton nom d'utilisateur est : ".$_GET['User']." Et ton mot de passe est : ".$_GET['Pwd']."<br>
                <a href='Index.php'><input type='button' value='Retour accueil'></a>");
            } else if ($_SESSION["Create"]==false)
            {
                echo("<br><form action='SignUp.php' method='get'>
                <p>Nom d'utilisateur : <input type='text' name='User' value='".$_GET['User']."'></p>
                <p>Prénom : <input type='text' name='FirstName' value='".$_GET['FirstName']."'></p>
                <p>Nom : <input type='text' name='LastName' value='".$_GET['LastName']."'></p>
                <p>Adresse : <input type='text' name='Adress' value='".$_GET['Adress']."'></p>
                <p>Adresse e-mail : <input type='email' name='Mail' value='".$_GET['Mail']."'></p>
                <p>Numéro de téléphone : <input type='text' name='Phone' value='".$_GET['Phone']."'></p>
                <p>Mot de passe : <input type='password' name='Pwd' value='".$_GET['Pwd']."'></p>
                <p>Confirmation de mot de passe : <input type='password' name='Cpwd' value='".$_GET['Cpwd']."'></p>"
                .$_SESSION['Error'].
                "<input type='submit' value='Inscription' name='SignUp'>
                </form>
                </div>");
            }
        }
        
        ?>
        
    </body>
</html>