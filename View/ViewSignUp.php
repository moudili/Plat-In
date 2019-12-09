<html>
    <head>
        <link rel="stylesheet" href="Css\ErrorChamp.css">
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
                <p >Nom d'utilisateur : <input type='text' name='User' value=''></p>
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

                    echo("<form action='Index.php' method='get'>");
                    if(empty($_GET['User']) 
                    || strlen($_GET['User']) < 5
                    || strlen($_GET['User']) > 40
                    || !empty($CheckUser)
                    )
                    {
                        echo"<p>Nom d'utilisateur : <input type='text' name='User' value='".htmlspecialchars($_GET['User'], ENT_QUOTES)."' class=Error></p>";
                    }
                    else
                    {
                        echo"<p>Nom d'utilisateur : <input type='text' name='User' value='".htmlspecialchars($_GET['User'], ENT_QUOTES)."' class=Aright></p>";
                    }
                    
                    if(empty($_GET['FirstName'])
                    || strlen($_GET['FirstName']) < 2
                    || strlen($_GET['FirstName']) > 40
                    || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['FirstName'])
                    )
                    {
                        echo"<p>Prénom : <input type='text' name='FirstName' value='".htmlspecialchars($_GET['FirstName'], ENT_QUOTES)."'class=Error></p>";
                    }
                    else
                    {
                        echo"<p>Prénom : <input type='text' name='FirstName' value='".htmlspecialchars($_GET['FirstName'], ENT_QUOTES)."'class=Aright></p>";
                    }

                    if(empty($_GET['LastName'])
                    || strlen($_GET['LastName']) < 2
                    || strlen($_GET['LastName']) > 40
                    || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['LastName'])
                    )
                    {
                        echo"<p>Nom : <input type='text' name='LastName' value='".htmlspecialchars($_GET['LastName'], ENT_QUOTES)."'class=Error></p>";
                    }
                    else
                    {
                        echo"<p>Nom : <input type='text' name='LastName' value='".htmlspecialchars($_GET['LastName'], ENT_QUOTES)."'class=Aright></p>";
                    }

                    if(empty($_GET['Adress'])
                    || strlen($_GET['Adress']) < 2
                    || strlen($_GET['Adress']) > 40
                    || !preg_match("#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Adress'])
                    )
                    {
                        echo"<p>Adresse : <input type='text' name='Adress' value='".htmlspecialchars($_GET['Adress'], ENT_QUOTES)."'class=Error></p>";
                    }
                    else
                    {
                        echo"<p>Adresse : <input type='text' name='Adress' value='".htmlspecialchars($_GET['Adress'], ENT_QUOTES)."'class=Aright></p>";
                    }

                    if(empty($_GET['Mail'])
                    || !preg_match("#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'._-]{2,30}+@[a-z0-9._-]{2,10}\.[a-z]{2,4}$#", $_GET['Mail'])
                    || !empty($CheckUser)
                    )
                    {
                        echo"<p>Adresse e-mail : <input type='email' name='Mail' value='".htmlspecialchars($_GET['Mail'], ENT_QUOTES)."'class=Error></p>";
                    }
                    else
                    {
                        echo"<p>Adresse e-mail : <input type='email' name='Mail' value='".htmlspecialchars($_GET['Mail'], ENT_QUOTES)."'class=Aright></p>";
                    }

                    if(empty($_GET['Phone'])
                    || !preg_match('#^(0|\+33)[1-9]{1}\d{8}$#' , $_GET['Phone'])
                    )
                    {
                        echo"<p>Numéro de téléphone : <input type='text' name='Phone' value='".htmlspecialchars($_GET['Phone'], ENT_QUOTES)."'class=Error></p>";
                    }
                    else
                    {
                        echo"<p>Numéro de téléphone : <input type='text' name='Phone' value='".htmlspecialchars($_GET['Phone'], ENT_QUOTES)."'class=Aright></p>";
                    }
                    if(empty($_GET['Pwd']) 
                    || strlen($_GET['Pwd']) < 5
                    || strlen($_GET['Pwd']) > 40    
                    )
                    {
                        echo"<p>Mot de passe : <input type='password' name='Pwd' value='".htmlspecialchars($_GET['Pwd'], ENT_QUOTES)."'class=Error></p>";
                    }
                    else
                    {
                        echo"<p>Mot de passe : <input type='password' name='Pwd' value='".htmlspecialchars($_GET['Pwd'], ENT_QUOTES)."'class=Aright></p>";
                    }
                    if(empty($_GET['Cpwd'])
                    || $_GET['Pwd'] != $_GET['Cpwd']
                    )
                    {
                        echo"<p>Confirmation de mot de passe : <input type='password' name='Cpwd' value='".htmlspecialchars($_GET['Cpwd'], ENT_QUOTES)."'class=Error></p>";
                    }
                    else
                    {
                        echo"<p>Confirmation de mot de passe : <input type='password' name='Cpwd' value='".htmlspecialchars($_GET['Cpwd'], ENT_QUOTES)."'class=Aright></p>";
                    }

                    echo "<FONT color='red'>".$_SESSION['Error']."</FONT>
                    <input type='hidden' name='page' value='Inscription'>
                    <br><br><input type='submit' value='Inscription' name='SignUp'>
                    </form>
                    </div>";
                }
            }       
        ?>
    </div>
    </body>
</html>