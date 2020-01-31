<?php

require("View/ViewBanner.php");
?>
<html>
    <head>
        <title>Origines</title>
        <link rel="stylesheet" href="Css/Bootstrap/PersonalCss.css">
        <link rel="stylesheet" href="Css/Bootstrap/background.css">
    </head> 
    <body class='backgroundhat center'>
        <div class='arriereprofil'>
            <div class='profil'>
        <?php
            if(empty($_GET['Request']))
            {

                ?>
                    <form action='Index.php' method='get'>
                    <input type='search' class='text_1'placeholder = 'Rechercher une origine...' name='Org'/>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='Request' value='Search'>
                    <button type='submit'class='bouton_1'> <i class="fa fa-search"></i></button></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='submit' class='bouton_1' name='Request' value='Ajouter une origine'></form><br>
                    <table border align=center>       
        
                <?php
                for($i = 0 ; $i < count($Origins[0]) ; $i++ )
                {
                    echo "<tr><td>".$Origins[1][$i]
                    ."</td><td><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='origin' value='".htmlspecialchars($Origins[1][$i], ENT_QUOTES)."'>
                    <input type='hidden' name='id' value='".htmlspecialchars($Origins[0][$i], ENT_QUOTES)."'>
                    <input type='submit' class='bouton_1' name='Request' value='Modifier'></form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='origin' value='".$Origins[1][$i]."'>
                    <input type='hidden' name='id' value='".$Origins[0][$i]."'>
                    <input type='submit' class='bouton_1' name='Request' value='Supprimer'></form></td></tr>
";
                }
                echo "</table>";
            }
            else if (!empty($_GET['Request']))
            {
                if($_GET['Request'] == "Ajouter une origine")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Origine: <input type='Origine' name='Org'/></p>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='submit' class='bouton_1' name='Request' value='Ajouter'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <br><input type='submit' class='bouton_1' value='Retour'></form>
                    ";
                }
                else if($_GET['Request'] == "Ajouter")
                {
                    if(empty($_GET['Org']))
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Origine: <input type='Origine' name='Org'/></p>
                        <input type='hidden' name='page' value='Origines'>
                        <FONT color='red'>Veuillez saisir une origine</FONT><br>
                        <br><input type='submit' class='bouton_1' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Retour'></form>
                        ";    
                    }
                    else if(strlen($_GET['Org']) < 3)
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Origines'>
                        <FONT color='red'>Cette origine doit faire plus de 2 caractères</FONT><br>
                        <br><input type='submit' class='bouton_1' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Retour'></form>
                        "; 
                    }
                    else if(strlen($_GET['Org']) > 39)
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Origines'>
                        <FONT color='red'>Cette origine doit faire moins de 40 caractères</FONT><br>
                        <br><input type='submit' class='bouton_1' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Retour'></form>
                        "; 
                    }
                    else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Org']))
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Origines'>
                        <FONT color='red'>Cette origine est incorrecte</FONT><br>
                        <br><input type='submit' class='bouton_1' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Retour'></form>
                        "; 
                    }
                    else
                    {
                        if($CheckFormAdd == 0)
                        {
                            echo "L'origine ".mb_strtolower($_GET['Org'],"UTF-8")." à bien été ajouté à la base de données
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <br><input type='submit' class='bouton_1' value='Retour'></form>";
                        }
                        else
                        {
                            echo "<p><form action='Index.php' method='get'>
                            <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                            <input type='hidden' name='page' value='Origines'>
                            <FONT color='red'>Cette origine est déja présente dans la base de données</FONT><br>
                            <br><input type='submit' class='bouton_1' name='Request' value='Ajouter'></form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <br><input type='submit' class='bouton_1' value='Retour'></form>
                            ";                                
                        }
                    }

                }
                else if($_GET['Request'] == "Supprimer")
                {
                    if(empty($_GET['Answer']))
                    {
                        echo "Etes-vous sûr de vouloir supprimer l'origine ".$_GET['origin']." de la base de données?<br>
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='hidden' name='Request' value='Supprimer'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='origin' value='".$_GET['origin']."'>
                        <br><input type='submit' class='bouton_1' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Non'></form>

                        ";
                    }
                    else
                    {
                        echo "Vous avez bien supprimé l'origine ".$_GET['origin']." de la base de données.
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Retour'></form>";
                    }
                }
                else if($_GET['Request'] == "Modifier")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['origin'], ENT_QUOTES)."'/></p>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='origin' value='".$_GET['origin']."'>
                    <input type='submit' class='bouton_1' name='Request' value='Modifier cette origine'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <br><input type='submit' class='bouton_1' value='Retour'></form>
                    ";
                }
                else if($_GET['Request'] == "Modifier cette origine")
                {
                    if(empty($_GET['Org']))
                    {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='origin' value='".$_GET['origin']."'>
                    <FONT color='red'>Veuillez saisir une origine</FONT><br>
                    <input type='submit' class='bouton_1' name='Request' value='Modifier cette origine'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <br><input type='submit' class='bouton_1' value='Retour'></form>
                    ";
                    }
                    else if(strlen($_GET['Org']) < 3)
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='origin' value='".$_GET['origin']."'>
                        <FONT color='red'>Cette origine doit faire plus de 2 caractères</FONT><br>
                        <input type='submit' class='bouton_1' name='Request' value='Modifier cette origine'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Retour'></form>
                        ";
                    }
                    else if(strlen($_GET['Org']) > 39)
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='origin' value='".$_GET['origin']."'>
                        <FONT color='red'>Cette origine doit faire moins de 40 caractères</FONT><br>
                        <input type='submit' class='bouton_1' name='Request' value='Modifier cette origine'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Retour'></form>
                        ";
                    }
                    else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Org']))
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='origin' value='".$_GET['origin']."'>
                        <FONT color='red'>Cette origine est incorrecte</FONT><br>
                        <input type='submit' class='bouton_1' name='Request' value='Modifier cette origine'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' class='bouton_1' value='Retour'></form>
                        ";
                    }
                    else
                    {
                        if($CheckFormUpdate == 0)
                        {
                            echo "L'origine ".$_GET['origin']." à bien été modifiée en ".mb_strtolower($_GET['Org'],"UTF-8");
                        }
                        else
                        {
                            echo "<p><form action='Index.php' method='get'>
                            <p>Origine: <input type='Origine' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/></p>
                            <input type='hidden' name='page' value='Origines'>
                            <input type='hidden' name='id' value='".$_GET['id']."'>
                            <input type='hidden' name='origin' value='".$_GET['origin']."'>
                            <FONT color='red'>Cette origine est déja présente dans la base de données</FONT><br>
                            <br><input type='submit' class='bouton_1' name='Request' value='Modifier cette origine'></form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <br><input type='submit' class='bouton_1' value='Retour'></form>
                            ";                            
                        }


                    }
                }
                else if($_GET['Request'] == "Search")
                {
                    if($Origins != false)
                    {

                        echo("
                        <form action='Index.php' method='get'>
                        <input type='search' class='text_1'name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='hidden' name='Request' value='Search'>
                        <button type='submit'class='bouton_1'> <i class='fa fa-search'></i></button></form>
    
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='submit' class='bouton_1' name='Request' value='Ajouter une origine'></form><br>
                        <table border align=center>;                        
                        ");
                        for($i = 0 ; $i < count($Origins[0]) ; $i++ )
                        {
                            echo "<tr><td>".$Origins[1][$i]
                            ."</td><td><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <input type='hidden' name='origin' value='".$Origins[1][$i]."'>
                            <input type='hidden' name='id' value='".$Origins[0][$i]."'>
                            <input type='submit' class='bouton_1' name='Request' value='Modifier'></form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <input type='hidden' name='origin' value='".$Origins[1][$i]."'>
                            <input type='hidden' name='id' value='".$Origins[0][$i]."'>
                            <input type='submit' class='bouton_1' name='Request' value='Supprimer'></form></td></tr>
";
                        }
                        echo "</table>";                        
                    }
                    else
                    {
                        echo("
                        <form action='Index.php' method='get'>
                        <input type='search' class='text_1'name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='hidden' name='Request' value='Search'>
                        <button type='submit'class='bouton_1'> <i class='fa fa-search'></i></button></form>
    
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='submit' class='bouton_1' name='Request' value='Ajouter une origine'></form><br>                        
                        <br>aucun résultat pour la recherche ".$_GET['Org'].".");                        
                    }
                }
            }

        ?>
    </body>
</html>
