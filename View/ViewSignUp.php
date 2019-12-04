<html>
    <head>
        <title>Inscription</title>
    </head>
    
    <body>
        <?php 
            require("View/ViewBanner.php");
        ?>
        <div class="text-center mt-5">
        <?php
            if (empty($_GET['SignUp']))
            {
                echo("<form action='Index.php' method='get'>
                <p>Nom d'utilisateur : <input type='text' name='User' value=''></p>
                <p>Prénom : <input type='text' name='FirstName' value=''></p>
                <p>Nom : <input type='text' name='LastName' value=''></p>
                <p>Adresse : <input type='text' name='Adress' value=''></p>
                <p>Adresse e-mail : <input type='email' name='Mail' value=''></p>
                <p>Numéro de téléphone : <input type='text' name='Phone' value=''></p>
                <p>Mot de passe : <input type='password' name='Pwd' value=''></p>
                <p>Confirmation de mot de passe : <input type='password' name='Cpwd' value=''></p>
                <input type='hidden' name='page' value='Inscription'>
                <input type='submit' value='Inscription' name='SignUp'>
                </form>
                </div>");
            } else if (!empty($_GET['SignUp']))
            {
                if ($_SESSION["Create"]==true) 
                {
                    echo("Tu as reussi a t'inscrire, ton nom d'utilisateur est : ".$_GET['User']."<br>
                    <a href='Index.php'><input type='button' value='Retour accueil'></a>");
                } else if ($_SESSION["Create"]==false)
                {

                    echo("<form action='Index.php' method='get'>
                    <p>Nom d'utilisateur : <input type='text' name='User' value='".htmlspecialchars($_GET['User'], ENT_QUOTES)."'></p>
                    <p>Prénom : <input type='text' name='FirstName' value='".htmlspecialchars($_GET['FirstName'], ENT_QUOTES)."'></p>
                    <p>Nom : <input type='text' name='LastName' value='".htmlspecialchars($_GET['LastName'], ENT_QUOTES)."'></p>
                    <p>Adresse : <input type='text' name='Adress' value='".htmlspecialchars($_GET['Adress'], ENT_QUOTES)."'></p>
                    <p>Adresse e-mail : <input type='email' name='Mail' value='".htmlspecialchars($_GET['Mail'], ENT_QUOTES)."'></p>
                    <p>Numéro de téléphone : <input type='text' name='Phone' value='".htmlspecialchars($_GET['Phone'], ENT_QUOTES)."'></p>
                    <p>Mot de passe : <input type='password' name='Pwd' value='".htmlspecialchars($_GET['Pwd'], ENT_QUOTES)."'></p>
                    <p>Confirmation de mot de passe : <input type='password' name='Cpwd' value='".htmlspecialchars($_GET['Cpwd'], ENT_QUOTES)."'></p>
                    <FONT color='red'>"
                    .$_SESSION['Error'].
                    "</FONT>
                    <input type='hidden' name='page' value='Inscription'>
                    <br><br><input type='submit' value='Inscription' name='SignUp'>
                    </form>
                    </div>");
                }
            }       
        ?>
    </div>
    </body>
</html>