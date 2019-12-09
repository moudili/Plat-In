<html>
    <head>
        <title>Aliments</title>
    </head>
    <body>

<?php 
            require("View/ViewBanner.php");  
?>
<div class="text-center mt-5">
<?php
            if(empty($_GET['Request']))
            {

                ?>
                    <form action='Index.php' method='get'>
                    <input type='search' placeholder = 'Rechercher un aliment...' name='Ali'/>
                    <input type='hidden' name='page' value='Aliments'>
                    <input type='hidden' name='Request' value='Search'>
                    <input type='submit' value=" "></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Aliments'>
                    <input type='submit' name='Request' value='Ajouter un aliment'></form><br>       
        
                <?php
                for($i = 0 ; $i < count($Foods[0]) ; $i++ )
                {
                    echo $Foods[1][$i]
                    ."<form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Aliments'>
                    <input type='hidden' name='food' value='".$Foods[1][$i]."'>
                    <input type='hidden' name='id' value='".$Foods[0][$i]."'>
                    <input type='submit' name='Request' value='Supprimer'></form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Aliments'>
                    <input type='hidden' name='food' value='".htmlspecialchars($Foods[1][$i], ENT_QUOTES)."'>
                    <input type='hidden' name='id' value='".htmlspecialchars($Foods[0][$i], ENT_QUOTES)."'>
                    <input type='submit' name='Request' value='Modifier'></form>";
                }
            }
            else if (!empty($_GET['Request']))
            {
                if($_GET['Request'] == "Ajouter un aliment")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Aliment : <input type='Food' name='Ali'/></p>
                    <input type='hidden' name='page' value='Aliments'>
                    <input type='submit' name='Request' value='Ajouter'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Aliments'>
                    <br><input type='submit' value='Retour'></form>
                    ";
                }
                else if($_GET['Request'] == "Ajouter")
                {
                    if(empty($_GET['Ali']))
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Aliment : <input type='Food' name='Ali'/></p>
                        <input type='hidden' name='page' value='Aliments'>
                        <FONT color='red'>Veuillez saisir un aliment</FONT><br>
                        <br><input type='submit' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <br><input type='submit' value='Retour'></form>
                        ";    
                    }
                    else if(strlen($_GET['Ali']) < 3)
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Aliments'>
                        <FONT color='red'>Cette aliment doit faire plus de 2 caractères</FONT><br>
                        <br><input type='submit' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <br><input type='submit' value='Retour'></form>
                        "; 
                    }
                    else if(strlen($_GET['Ali']) > 39)
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Aliments'>
                        <FONT color='red'>Cet aliment doit faire moins de 40 caractères</FONT><br>
                        <br><input type='submit' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <br><input type='submit' value='Retour'></form>
                        "; 
                    }
                    else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Ali']))
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Aliments'>
                        <FONT color='red'>Cet aliment est incorrecte</FONT><br>
                        <br><input type='submit' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <br><input type='submit' value='Retour'></form>
                        "; 
                    }
                    else
                    {
                        if($CheckFormAdd == 0)
                        {
                            echo "L'aliment ".mb_strtolower($_GET['Ali'],"UTF-8")." à bien été ajouté à la base de données";
                            echo("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Aliments'>
                            <br><input type='submit' value='Retour'></form>");
                        }
                        else
                        {
                            echo "<p><form action='Index.php' method='get'>
                            <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                            <input type='hidden' name='page' value='Aliments'>
                            <FONT color='red'>Cet aliment est déja présente dans la base de données</FONT><br>
                            <br><input type='submit' name='Request' value='Ajouter'></form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Aliments'>
                            <br><input type='submit' value='Retour'></form>
                            ";                                
                        }
                    }

                }
                else if($_GET['Request'] == "Supprimer")
                {
                    if(empty($_GET['Answer']))
                    {
                        echo "Etes-vous sûr de vouloir supprimer l'aliment ".$_GET['food']." de la base de données?<br>
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <input type='hidden' name='Request' value='Supprimer'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='food' value='".$_GET['food']."'>
                        <br><input type='submit' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <br><input type='submit' value='Non'></form>

                        ";
                    }
                    else
                    {
                        echo "Vous avez bien supprimé l'aliment ".$_GET['food']." de la base de données.";
                        echo("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Aliments'>
                            <br><input type='submit' value='Retour'></form>");
                    }
                }
                else if($_GET['Request'] == "Modifier")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['food'], ENT_QUOTES)."'/></p>
                    <input type='hidden' name='page' value='Aliments'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='food' value='".$_GET['food']."'>
                    <input type='submit' name='Request' value='Modifier cet aliment'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Aliments'>
                    <br><input type='submit' value='Retour'></form>
                    ";
                }
                else if($_GET['Request'] == "Modifier cet aliment")
                {
                    if(empty($_GET['Ali']))
                    {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                    <input type='hidden' name='page' value='Aliments'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='food' value='".$_GET['food']."'>
                    <FONT color='red'>Veuillez saisir un aliment<br></FONT>
                    <input type='submit' name='Request' value='Modifier cet aliment'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Aliments'>
                    <br><input type='submit' value='Retour'></form>
                    ";
                    }
                    else if(strlen($_GET['Ali']) < 3)
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Aliments'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='food' value='".$_GET['food']."'>
                        <FONT color='red'>Cet aliment doit faire plus de 2 caractères<br></FONT>
                        <input type='submit' name='Request' value='Modifier cet aliment'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <br><input type='submit' value='Retour'></form>
                        ";
                    }
                    else if(strlen($_GET['Ali']) > 39)
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Aliments'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='food' value='".$_GET['food']."'>
                        <FONT color='red'>Cet aliment doit faire moins de 40 caractères<br></FONT>
                        <input type='submit' name='Request' value='Modifier cet aliment'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <br><input type='submit' value='Retour'></form>
                        ";
                    }
                    else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Ali']))
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                        <input type='hidden' name='page' value='Aliments'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='food' value='".$_GET['food']."'>
                        <FONT color='red'>Cet aliment est incorrecte<br></FONT>
                        <input type='submit' name='Request' value='Modifier cet aliment'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <br><input type='submit' value='Retour'></form>
                        ";
                    }
                    else
                    {
                        if($CheckFormUpdate == 0)
                        {
                            echo "L'aliment ".$_GET['food']." à bien été modifié en ".mb_strtolower($_GET['Ali'],"UTF-8");
                        }
                        else
                        {
                            echo "<p><form action='Index.php' method='get'>
                            <p>Aliment : <input type='Food' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/></p>
                            <input type='hidden' name='page' value='Aliments'>
                            <input type='hidden' name='id' value='".$_GET['id']."'>
                            <input type='hidden' name='food' value='".$_GET['food']."'>
                            <FONT color='red'>Cet aliment est déja présente dans la base de données</FONT><br>
                            <br><input type='submit' name='Request' value='Modifier cet aliment'></form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Aliments'>
                            <br><input type='submit' value='Retour'></form>
                            ";                            
                        }


                    }
                }
                else if($_GET['Request'] == "Search")
                {
                    if($Foods != false)
                    {

                        echo("
                        <form action='Index.php' method='get'>
                        <input type='search' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/>
                        <input type='hidden' name='page' value='Aliments'>
                        <input type='hidden' name='Request' value='Search'>
                        <input type='submit' value=' '></form>
    
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <input type='submit' name='Request' value='Ajouter un aliment'></form><br>                        
                        ");
                        for($i = 0 ; $i < count($Foods[0]) ; $i++ )
                        {
                            echo $Foods[1][$i]
                            ."<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Aliments'>
                            <input type='hidden' name='food' value='".$Foods[1][$i]."'>
                            <input type='hidden' name='id' value='".$Foods[0][$i]."'>
                            <input type='submit' name='Request' value='Supprimer'></form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Aliments'>
                            <input type='hidden' name='food' value='".$Foods[1][$i]."'>
                            <input type='hidden' name='id' value='".$Foods[0][$i]."'>
                            <input type='submit' name='Request' value='Modifier'></form>";
                        }                        
                    }
                    else
                    {
                        echo("
                        <form action='Index.php' method='get'>
                        <input type='search' name='Ali' value='".htmlspecialchars($_GET['Ali'], ENT_QUOTES)."'/>
                        <input type='hidden' name='page' value='Aliments'>
                        <input type='hidden' name='Request' value='Search'>
                        <input type='submit' value=' '></form>
    
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Aliments'>
                        <input type='submit' name='Request' value='Ajouter un aliment'></form><br>                        
                        <br>Aucun résultat pour la recherche ".$_GET['Ali'].".");                        
                    }
                }
            }
?>
</div>
    </body>
</html>