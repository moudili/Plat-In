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
                    <input type='submit' name='Request' value='Ajouter une catégorie alimentaire'>
                    <input type='hidden' name='Menu' value=1></form><br>       
                    <table border>
                <?php
                for($i = 0 ; $i < count($FoodPrint[0]) ; $i++ )
                {
                    /*echo ($Categories[1][$i]);
                    //echo ($Foods[1][$i]);
                    //echo($Liste[1][$i]);
                    for ($j = 0 ; $j < count($Liste[3][$i]); $j++)
                    {
                        echo("<br>".$Liste[3][$i][$j]);
                    }*/
                    $compt = 0;
                        for($j = $i ; $FoodPrint[0][$i] == $FoodPrint[0][$j] ; $j++)
                        {
                            $compt++;
                            if($j == count($FoodPrint[0]) - 1)
                            {
                                break;
                            }
                        }

                        if($i > 0)
                        {

                            if($FoodPrint[0][$i] == $FoodPrint[0][$i-1])
                            {
                                //echo"<tr>";
                                $compt = 0;
                                
                            }
                            else
                            {
                                echo"<tr ><td rowspan='".$compt."'>".$FoodPrint[1][$i]."<form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Catégories Alimentaires'>
                                <input type='hidden' name='categorie' value='".$FoodPrint[1][$i]."'>
                                <input type='hidden' name='id' value='".$FoodPrint[0][$i]."'>
                                <input type='hidden' name='liste' value='".$i."'>
                                <input type='submit' name='Request' value='Supprimer'></form>
                                <form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Catégories Alimentaires'>
                                <input type='hidden' name='categorie' value='".$FoodPrint[1][$i]."'>
                                <input type='hidden' name='id' value='".$FoodPrint[0][$i]."'>
                                <input type='hidden' name='liste' value='".$i."'>
                                <input type='submit' name='Request' value='Modifier'></form></td>";
                            }
                        }
                        else
                        {
                            echo"<tr><td rowspan='".$compt."'>".$FoodPrint[1][$i]."<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$FoodPrint[1][$i]."'>
                            <input type='hidden' name='id' value='".$FoodPrint[0][$i]."'>
                            <input type='hidden' name='liste' value='".$i."'>
                            <input type='submit' name='Request' value='Supprimer'></form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$FoodPrint[1][$i]."'>
                            <input type='hidden' name='id' value='".$FoodPrint[0][$i]."'>
                            <input type='hidden' name='liste' value='".$i."'>
                            <input type='submit' name='Request' value='Modifier'></form>
                            <form action='Index.php' method='get'>
                            <input type='submit' name='Request' value='Ajouter un aliment'>
                            <input type='hidden' name='categorie' value='".$FoodPrint[1][$i]."'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            </form></td>";                        
                        }
                        
                        if ($compt != 1)
                        {
                            echo("<td>".$FoodPrint[3][$i]."<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$FoodPrint[1][$i]."'>
                            <input type='hidden' name='id' value='".$FoodPrint[0][$i]."'>
                            <input type='hidden' name='liste' value='".$i."'>
                            <input type='hidden' name='aliment' value='".$FoodPrint[3][$i]."'>
                            <input type='submit' name='Request' value='Supprimer cet aliment'></form>
                            </td></tr>");
                        }
                        else 
                        {
                            echo("<td>".$FoodPrint[3][$i]."</td></tr>");
                        }
                }
                echo("</table>");
            }
            else if (!empty($_GET['Request']))
            {
                if($_GET['Request'] == "Ajouter une catégorie alimentaire")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Catégorie alimentaire: <input name='Cat'/></p>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <p>Choisissez un ou des aliments que vous voulez ajouter à votre catégorie :<br><br>
                    <select name='Kind0'>
                    <option value=''>--Choisissez un aliment--</option>
                    ";
                    
                    for($i = 0 ; $i < count($Foods[0]) ; $i++)
                    {
                        echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>");
                    }
                    
                    echo("</select>
                    <input type='submit' name='Request' value='+'></p>
                    <input type='hidden' name='Menu' value=".$_GET['Menu'].">
                    <input type='submit' name='Request' value='Ajouter'>
                    </form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='submit' value='Retour'></form>");
                    
                } else if ($_GET['Request'] == "+"
                || $_GET['Request'] == "-")
                {
                    echo ("<p><form action='Index.php' method='get'>
                    <p>Catégorie alimentaire: <input name='Cat' value='".htmlspecialchars($_GET['Cat'], ENT_QUOTES)."'></p>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <p>Choisissez un ou des aliments avec lesquelles votre categorie alimentaire est compatible : <br><br>");
                    
                    
                    for($j = 0 ; $j < $Menu ; $j++ )
                    {
                        echo(" <select name='Kind".$j."'>
                        <option value=''>--Choisissez un aliment--</option>");
                
                        for($i = 0 ; $i < count($Foods[0]) ; $i++)
                        {
                            if($Foods[0][$i] == $_GET['Kind'.$j])
                            {
                                echo("<option selected='selected' value=".$Foods[0][$i].">".$Foods[1][$i]."</option>");
                            }
                            else
                            {
                                echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>");
                            }  
                        }                
                        echo("</select> ");

                        if( ($j+2)%5 == 1)
                        {
                            echo("<br><br>");
                        }
                    }
                    
                    if( $Menu > 1 )
                    {
                        echo("<input type='submit' name='Request' value='-'> ");
                    }
                    
                    echo("<input type='submit' name='Request' value='+'></p>
                    <input type='hidden' name='Menu' value=".$Menu.">
                    <input type='submit' name='Request' value='Ajouter'>
                    </form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='submit' value='Retour'></form>");
                }
                else if($_GET['Request'] == "Ajouter")
                {
                    if(strlen($_GET['Cat']) < 3
                    || strlen($_GET['Cat']) > 40
                    || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Cat'])
                    || $CheckMenu == "double"
                    || $CheckMenu == "void"
                    || $CheckFormAdd != 0
                    )
                    {
                        echo ("<p><form action='Index.php' method='get'>
                        <p>Régime alimentaire : <input name='Cat' value='".htmlspecialchars($_GET['Cat'], ENT_QUOTES)."'></p>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <p>Choisissez un ou des aliments avec lesquelles votre categorie alimentaire est compatible : <br><br>");
                        
                        
                        for($j = 0 ; $j < $Menu ; $j++ )
                        {
                            echo(" <select name='Kind".$j."'>
                            <option value=''>--Choisissez un aliment--</option>");
                    
                            for($i = 0 ; $i < count($Foods[0]) ; $i++)
                            {
                                if($Foods[0][$i] == $_GET['Kind'.$j])
                                {
                                    echo("<option selected='selected' value=".$Foods[0][$i].">".$Foods[1][$i]."</option>");
                                }
                                else
                                {
                                    echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>");
                                }  
                            }                
                            echo("</select> ");
    
                            if( ($j+2)%5 == 1)
                            {
                                echo("<br><br>");
                            }
                        }
                        
                        if( $Menu > 1 )
                        {
                            echo("<input type='submit' name='Request' value='-'> ");
                        }
                        
                        echo("<input type='submit' name='Request' value='+'></p>
                        <input type='hidden' name='Menu' value=".$Menu.">");

                        if(strlen($_GET['Cat']) < 3)
                        {
                            echo("<FONT color='red'>Cette catégorie doit faire plus de 3 caractères<br><br></FONT>");
                        }
                        else if(strlen($_GET['Cat']) > 39)
                        {
                            echo("<FONT color='red'>Cette catégorie doit faire moins de 40 caractères</FONT><br><br>");
                        }
                        else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Cat']))
                        {
                            echo("<FONT color='red'>Cette catégorie est incorrecte</FONT><br><br>");
                        }
                        else if($CheckMenu == "double")
                        {
                            echo("<FONT color='red'>Un aliment a été selectionné deux fois ou plus</FONT><br><br>");
                        }
                        else if($CheckMenu == "void")
                        {
                            echo("<FONT color='red'>Veuillez séléctionner une valeur dans chacun des formulaires</FONT><br><br>");
                        }
                        else if($CheckFormAdd != 0)
                        {
                            echo("<FONT color='red'>Cette catégorie alimentaire existe déjà</FONT><br><br>");
                        }
                        echo("<input type='submit' name='Request' value='Ajouter'>
                        </form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <input type='submit' value='Retour'></form>");
                    }
                    else
                    {
                        echo"<p>La catégorie alimentaire ".$_GET['Cat']." à bien été ajouté à la base de donnée</p>";
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
                } else if($_GET['Request'] == "Supprimer cet aliment")
                {
                    if(empty($_GET['AnswerFood']))
                    {
                        echo "Etes-vous sûr de vouloir supprimer l'aliment ".$_GET['aliment']." de la categorie alimentaire ".$_GET['categorie']." ?<br>
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <input type='hidden' name='Request' value='Supprimer cet aliment'>
                     
                        <input type='hidden' name='aliment' value='".$_GET['aliment']."'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='categorie' value='".$_GET['categorie']."'>
                        <br><input type='submit' name='AnswerFood' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <input type='hidden' name='aliment' value='".$_GET['aliment']."'>
                        <br><input type='submit' value='Non'></form>
                        ";
                    }
                    else
                    {
                        echo "Vous avez bien supprimé l'aliment ".$_GET['aliment']." de la categorie alimentaire ".$_GET['categorie'].".";
                        echo("<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='submit' value='Retour'></form>");
                    }
                }
                else if($_GET['Request'] == "Modifier")
                {
                    echo("<br><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='categorie' value='".$_GET['categorie']."'><p>
                    <p>Categorie : <input type='Categorie' name='Cat' value='".$_GET['categorie']."'/></p>
                    <input type='hidden' name='liste' value='".$_GET['liste']."'>
                    <input type='submit' name='Request' value='Modifier cette categorie'></form>");
                    

                    /*for ($j = 0 ; $j < count($Foods[3]); $j++)
                    {
                        echo("<form action='Index.php' method='get'><br>".$Foods[3][$_GET['liste']][$j].
                        "<br><input type='submit' name='Request' value='Supprimer cet aliment'><br>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <input type='hidden' name='categorie' value='".$_GET['categorie']."'>
                        <input type='hidden' name='id' value='".$Foods[0][$_GET['liste']]."'>
                        <input type='hidden' name='liste' value='".$_GET['liste']."'>
                        </form>");
                    }*/
                    
                    
                    echo("<form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Catégories Alimentaires'>
                    <br><input type='submit' value='Retour'></form>
                    ");
                    
                }
                else if($_GET['Request'] == "Modifier cette categorie")
                {
                    if(empty($_GET['Cat']))
                    {
                        echo("<br><form action='Index.php' method='get'>
                        <p>Veuillez saisir un nom de catégorie</p>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='categorie' value='".$_GET['categorie']."'><p>
                        <p>Categorie : <input type='Categorie' name='Cat' value='".$_GET['categorie']."'/></p>
                        <input type='hidden' name='liste' value='".$_GET['liste']."'>
                        <input type='submit' name='Request' value='Modifier cette categorie'></form>");
                        
    
                        for ($j = 0 ; $j < count($Liste[3][$_GET['liste']]); $j++)
                        {
                            echo("<form action='Index.php' method='get'><br>".$Liste[3][$_GET['liste']][$j].
                            "<br><input type='submit' name='Request' value='Supprimer cet aliment'><br>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$_GET['categorie']."'>
                            <input type='hidden' name='id' value='".$Liste[0][$_GET['liste']]."'>
                            <input type='hidden' name='liste' value='".$_GET['liste']."'>
                            </form>");
                        }
                        
                        
                        echo("<form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <br><input type='submit' value='Retour'></form>
                        ");
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
                            echo("<br><form action='Index.php' method='get'>
                        <p>Cette categorie est déja présente dans la base de données</p>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='hidden' name='categorie' value='".$_GET['categorie']."'><p>
                        <p>Categorie : <input type='Categorie' name='Cat' value='".$_GET['categorie']."'/></p>
                        <input type='hidden' name='liste' value='".$_GET['liste']."'>
                        <input type='submit' name='Request' value='Modifier cette categorie'></form>");
                        
    
                        /*for ($j = 0 ; $j < count($Liste[3][$_GET['liste']]); $j++)
                        {
                            echo("<form action='Index.php' method='get'><br>".$Liste[3][$_GET['liste']][$j].
                            "<br><input type='submit' name='Request' value='Supprimer cet aliment'><br>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$_GET['categorie']."'>
                            <input type='hidden' name='id' value='".$Liste[0][$_GET['liste']]."'>
                            <input type='hidden' name='liste' value='".$_GET['liste']."'>
                            </form>");
                        }*/
                        
                        
                        echo("<form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Catégories Alimentaires'>
                        <br><input type='submit' value='Retour'></form>
                        ");                      
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
                            echo ($Categories[1][$i]);
                            //echo ($Foods[1][$i]);
                            //echo($Liste[1][$i]);
                            for ($j = 0 ; $j < count($Liste[3][$i]); $j++)
                            {
                                echo("<br>".$Liste[3][$i][$j]);
                            }

                            echo ("<form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$Liste[1][$i]."'>
                            <input type='hidden' name='id' value='".$Liste[0][$i]."'>
                            <input type='hidden' name='liste' value='".$i."'>
                            <input type='submit' name='Request' value='Supprimer'></form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Catégories Alimentaires'>
                            <input type='hidden' name='categorie' value='".$Liste[1][$i]."'>
                            <input type='hidden' name='id' value='".$Liste[0][$i]."'>
                            <input type='hidden' name='liste' value='".$i."'>
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