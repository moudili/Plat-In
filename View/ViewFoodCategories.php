<html>
    <head>
        <title>Categories alimentaires</title>
    </head>
    
    <body>
        <?php

            require("View/ViewBanner.php");  
            if(empty($_GET['Request']))
            {

                ?>
                    <form action='Index.php' method='get'>
                    <input type='search' placeholder = 'Rechercher une categorie...' name='Cat'/>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='hidden' name='Request' value='Search'>
                    <input type='submit' value=" "></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='submit' name='Request' value='Ajouter une catégorie alimentaire'></form><br>       
        
                <?php
                for($i = 0 ; $i < count($Categories[0]) ; $i++ )
                {
                    echo $Categories[1][$i]
                    ."<form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='hidden' name='categorie' value='".$Categories[1][$i]."'>
                    <input type='hidden' name='id' value='".$Categories[0][$i]."'>
                    <input type='submit' name='Request' value='Supprimer'></form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='hidden' name='categorie' value='".$Categories[1][$i]."'>
                    <input type='hidden' name='id' value='".$Categories[0][$i]."'>
                    <input type='submit' name='Request' value='Modifier'></form>";
                }
            }
            else if (!empty($_GET['Request']))
            {
                if($_GET['Request'] == "Ajouter une catégorie alimentaire")
                {
                    echo ("<p><form action='Index.php' method='get'>
                            <p>Categorie : <input type='Categorie' name='Cat'/></p>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            Veuillez saisir une catégorie alimentaire<br>
                            <SELECT name='Food' size='1'>");

                        for ($i=0; $i < count($Foods); $i++)
                        {
                                echo("<OPTION>".$Foods[1][$i]."</OPTION>");
                        }
                        echo("</SELECT><br><input type='submit' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <br><input type='submit' value='Retour'></form>
                        ");    
                }
                else if($_GET['Request'] == "Ajouter")
                {
                    if(empty($_GET['Cat']))
                    {
                        echo ("<p><form action='Index.php' method='get'>
                            <p>Categorie : <input type='Categorie' name='Cat'/></p>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            Veuillez saisir une catégorie alimentaire<br>
                            <SELECT name='Food' size='1'>");

                        for ($i=0; $i < count($Foods); $i++)
                        {
                                echo("<OPTION>".$Foods[1][$i]."</OPTION>");
                        }
                        echo("</SELECT><br><input type='submit' name='Request' value='Ajouter'></form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <br><input type='submit' value='Retour'></form>
                        ");    
                    }
                    else
                    {
                        if($CheckFormAdd == 0)
                        {
                            echo "La categorie alimentaire ".$_GET['Cat']." à bien été ajouté à la base de données";
                            echo("<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='submit' value='Retour'></form>");
                        }
                        else
                        {
                            echo "<p><form action='Index.php' method='get'>
                            <p>Categorie : <input type='Categorie' name='Cat' value='".$_GET['Cat']."'/></p>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            Cette catégorie est déja présente dans la base de données<br>
                            <br><input type='submit' name='Request' value='Ajouter'></form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <br><input type='submit' value='Retour'></form>
                            ";                                
                        }
                    }

                }
                else if($_GET['Request'] == "Supprimer")
                {
                    if(empty($_GET['Answer']))
                    {
                        echo "Etes-vous sûr de vouloir supprimer la catégorie alimentaire ".$_GET['categorie']." de la base de données?<br>
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <input type='hidden' name='Request' value='Supprimer'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='categorie' value='".$_GET['categorie']."'>
                        <br><input type='submit' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <br><input type='submit' value='Non'></form>

                        ";
                    }
                    else
                    {
                        echo "Vous avez bien supprimé la catégorie alimentaire ".$_GET['categorie']." de la base de données.";
                        echo("<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='submit' value='Retour'></form>");
                    }
                }
                else if($_GET['Request'] == "Modifier")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Categorie : <input type='Categorie' name='Cat' value='".$_GET['categorie']."'/></p>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='categorie' value='".$_GET['categorie']."'>
                    <input type='submit' name='Request' value='Modifier cette categorie'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <br><input type='submit' value='Retour'></form>
                    ";
                }
                else if($_GET['Request'] == "Modifier cette categorie")
                {
                    if(empty($_GET['Cat']))
                    {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Categorie : <input type='Categorie' name='Cat' value='".$_GET['origin']."'/></p>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='categorie' value='".$_GET['origin']."'>
                    Veuillez saisir une categorie<br>
                    <input type='submit' name='Request' value='Modifier cette categorie'></form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <br><input type='submit' value='Retour'></form>
                    ";
                    }
                    else
                    {
                        if($CheckFormUpdate == 0)
                        {
                            echo "La categorie ".$_GET['categorie']." à bien été modifier en ".$_GET['Cat'];
                            echo("<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='submit' value='Retour'></form>");
                        }
                        else
                        {
                            echo "<p><form action='Index.php' method='get'>
                            <p>Categorie : <input type='Categorie' name='Cat' value='".$_GET['categorie']."'/></p>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='id' value='".$_GET['id']."'>
                            <input type='hidden' name='categorie' value='".$_GET['categorie']."'>
                            Cette categorie est déja présente dans la base de données<br>
                            <br><input type='submit' name='Request' value='Modifier cette categorie'></form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <br><input type='submit' value='Retour'></form>
                            ";                            
                        }


                    }
                }
                else if($_GET['Request'] == "Search")
                {

                    if($Categories != false)
                    {
                        ?>
                            <form action='Index.php' method='get'>
                            <input type='search' placeholder = 'Rechercher une catégorie...' name='Cat'/>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='Request' value='Search'>
                            <input type='submit' value=" "></form>
        
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='submit' name='Request' value='Ajouter une catégorie alimentaire'></form><br>       
                
                        <?php
                        for($i = 0 ; $i < count($Categories[0]) ; $i++ )
                        {
                            echo ($Categories[1][$i]
                            ."<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$Categories[1][$i]."'>
                            <input type='hidden' name='id' value='".$Categories[0][$i]."'>
                            <input type='submit' name='Request' value='Supprimer'></form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$Categories[1][$i]."'>
                            <input type='hidden' name='id' value='".$Categories[0][$i]."'>
                            <input type='submit' name='Request' value='Modifier'></form>");
                        }                        
                    }
                    else
                    {
                        ?>
                            <form action='Index.php' method='get'>
                            <input type='search' placeholder = 'Rechercher une categorie...' name='Cat'/>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='Request' value='Search'>
                            <input type='submit' value=" "></form>
        
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='submit' name='Request' value='Ajouter une catégorie alimentaire'></form><br>       
                
                        <?php
                        echo "<br>aucun résultat pour la recherche ".$_GET['Cat'].".";
                        echo("<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='submit' value='Retour'></form>");                      
                    }
                }
            }

        ?>
    </body>
</html>