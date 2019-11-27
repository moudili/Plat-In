<html>
    <head>
        <title>Origines</title>
    </head>
    
    <body>
        <?php

            require("View/ViewBanner.php");  
            if(empty($_GET['Request']))
            {

                ?>
                    <form action='Index.php' method='get'>
                    <input type='search' placeholder = 'Rechercher une origine...' name='Org'/>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='Request' value='Search'>
                    <input type='submit' value=" "></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='submit' name='Request' value='Ajouter une origine'></form><br>       
        
                <?php
                for($i = 0 ; $i < count($Origins[0]) ; $i++ )
                {
                    echo $Origins[1][$i]
                    ."<form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='origin' value='".$Origins[1][$i]."'>
                    <input type='hidden' name='id' value='".$Origins[0][$i]."'>
                    <input type='submit' name='Request' value='Supprimer'></form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='origin' value='".$Origins[1][$i]."'>
                    <input type='hidden' name='id' value='".$Origins[0][$i]."'>
                    <input type='submit' name='Request' value='Modifier'></form>";
                }
            }
            else if (!empty($_GET['Request']))
            {
                if($_GET['Request'] == "Ajouter une origine")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Origine: <input type='Origine' name='Org'/></p>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='submit' name='Request' value='Ajouter'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <br><input type='submit' value='Retour'></form>
                    ";
                }
                else if($_GET['Request'] == "Ajouter")
                {
                    if(empty($_GET['Org']))
                    {
                        echo "<p><form action='Index.php' method='get'>
                        <p>Origine: <input type='Origine' name='Org'/></p>
                        <input type='hidden' name='page' value='Origines'>
                        Veuillez saisir une origine<br>
                        <br><input type='submit' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' value='Retour'></form>
                        ";    
                    }
                    else
                    {
                        if($CheckFormAdd == 0)
                        {
                            echo "L'origine ".$_GET['Org']." à bien été ajouté à la base de données";
                        }
                        else
                        {
                            echo "<p><form action='Index.php' method='get'>
                            <p>Origine: <input type='Origine' name='Org' value='".$_GET['Org']."'/></p>
                            <input type='hidden' name='page' value='Origines'>
                            Cette origine est déja présente dans la base de données<br>
                            <br><input type='submit' name='Request' value='Ajouter'></form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <br><input type='submit' value='Retour'></form>
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
                        <br><input type='submit' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <br><input type='submit' value='Non'></form>

                        ";
                    }
                    else
                    {
                        echo "Vous avez bien supprimé l'origine ".$_GET['origin']." de la base de données.";
                    }
                }
                else if($_GET['Request'] == "Modifier")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Origine: <input type='Origine' name='Org' value='".$_GET['origin']."'/></p>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='origin' value='".$_GET['origin']."'>
                    <input type='submit' name='Request' value='Modifier cette origine'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <br><input type='submit' value='Retour'></form>
                    ";
                }
                else if($_GET['Request'] == "Modifier cette origine")
                {
                    if(empty($_GET['Org']))
                    {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Origine: <input type='Origine' name='Org' value='".$_GET['origin']."'/></p>
                    <input type='hidden' name='page' value='Origines'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='origin' value='".$_GET['origin']."'>
                    Veuillez saisir une origine<br>
                    <input type='submit' name='Request' value='Modifier cette origine'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Origines'>
                    <br><input type='submit' value='Retour'></form>
                    ";
                    }
                    else
                    {
                        if($CheckFormUpdate == 0)
                        {
                            echo "L'origine ".$_GET['origin']." à bien été modifier en ".$_GET['Org'];
                        }
                        else
                        {
                            echo "<p><form action='Index.php' method='get'>
                            <p>Origine: <input type='Origine' name='Org' value='".$_GET['origin']."'/></p>
                            <input type='hidden' name='page' value='Origines'>
                            <input type='hidden' name='id' value='".$_GET['id']."'>
                            <input type='hidden' name='origin' value='".$_GET['origin']."'>
                            Cette origine est déja présente dans la base de données<br>
                            <br><input type='submit' name='Request' value='Modifier cette origine'></form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <br><input type='submit' value='Retour'></form>
                            ";                            
                        }


                    }
                }
                else if($_GET['Request'] == "Search")
                {
                    if($Origins != false)
                    {
                        ?>
       
                
                        <?php

                        echo("
                        <form action='Index.php' method='get'>
                        <input type='search' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='hidden' name='Request' value='Search'>
                        <input type='submit' value=' '></form>
    
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='submit' name='Request' value='Ajouter une origine'></form><br>                        
                        ");
                        for($i = 0 ; $i < count($Origins[0]) ; $i++ )
                        {
                            echo $Origins[1][$i]
                            ."<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <input type='hidden' name='origin' value='".$Origins[1][$i]."'>
                            <input type='hidden' name='id' value='".$Origins[0][$i]."'>
                            <input type='submit' name='Request' value='Supprimer'></form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Origines'>
                            <input type='hidden' name='origin' value='".$Origins[1][$i]."'>
                            <input type='hidden' name='id' value='".$Origins[0][$i]."'>
                            <input type='submit' name='Request' value='Modifier'></form>";
                        }                        
                    }
                    else
                    {
                        echo("
                        <form action='Index.php' method='get'>
                        <input type='search' name='Org' value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'/>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='hidden' name='Request' value='Search'>
                        <input type='submit' value=' '></form>
    
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Origines'>
                        <input type='submit' name='Request' value='Ajouter une origine'></form><br>                        
                        <br>aucun résultat pour la recherche ".$_GET['Org'].".");                        
                    }
                }
            }

        ?>
    </body>
</html>
