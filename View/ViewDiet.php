<html>
    <head>
        <title>Régimes</title>
    </head>
    
    <body>
        <?php
            
            require("View/ViewBanner.php");
            
            if(!empty($_GET['Request']))
            {
                if($_GET['Request'] == "Ajouter un régime")
                {
                    echo "<p><form action='Index.php' method='get'>
                    <p>Régime alimentaire: <input name='Diet'/></p>
                    <input type='hidden' name='page' value='Régimes'>
                    <p>Choisissez une ou des catégories alimentaires avec lesquelles votre régime n'est pas compatible:<br><br>
                    <select name='Kind0'>
                    <option value=''>--Choisissez une catégorie alimentaire--</option>
                    ";
                    
                    for($i = 0 ; $i < count($Kind[0]) ; $i++)
                    {
                        echo("<option value=".$Kind[0][$i].">".$Kind[1][$i]."</option>");
                    }
                    
                    echo("</select>
                    <input type='submit' name='Request' value='+'></p>
                    <input type='hidden' name='Menu' value=".$_GET['Menu'].">
                    <input type='submit' name='Request' value='Ajouter'>
                    </form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='submit' value='Retour'></form>");
                }
                else if($_GET['Request'] == "+"
                || $_GET['Request'] == "-" )
                {
                    echo ("<p><form action='Index.php' method='get'>
                    <p>Régime alimentaire: <input name='Diet' value='".htmlspecialchars($_GET['Diet'], ENT_QUOTES)."'></p>
                    <input type='hidden' name='page' value='Régimes'>
                    <p>Choisissez une ou des catégories alimentaires avec lesquelles votre régime n'est pas compatible:<br><br>");
                    
                    
                    for($j = 0 ; $j < $Menu ; $j++ )
                    {
                        echo(" <select name='Kind".$j."'>
                        <option value=''>--Choisissez une catégorie alimentaire--</option>");
                
                        for($i = 0 ; $i < count($Kind[0]) ; $i++)
                        {
                            if($Kind[0][$i] == $_GET['Kind'.$j])
                            {
                                echo("<option selected='selected' value=".$Kind[0][$i].">".$Kind[1][$i]."</option>");
                            }
                            else
                            {
                                echo("<option value=".$Kind[0][$i].">".$Kind[1][$i]."</option>");
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
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='submit' value='Retour'></form>");
                }
                else if($_GET['Request'] == "Ajouter")
                {
                    if(strlen($_GET['Diet']) < 3
                    || strlen($_GET['Diet']) > 40
                    || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Diet'])
                    || $CheckMenu == "double"
                    || $CheckMenu == "void"
                    || $CheckForm != 0
                    )
                    {
                        echo ("<p><form action='Index.php' method='get'>
                        <p>Régime alimentaire: <input name='Diet' value='".htmlspecialchars($_GET['Diet'], ENT_QUOTES)."'></p>
                        <input type='hidden' name='page' value='Régimes'>
                        <p>Choisissez une ou des catégories alimentaires avec lesquelles votre régime n'est pas compatible:<br><br>");
                        
                        for($j = 0 ; $j < $Menu ; $j++ )
                        {
                            echo(" <select name='Kind".$j."'>
                            <option value=''>--Choisissez une catégorie alimentaire--</option>");
                    
                            for($i = 0 ; $i < count($Kind[0]) ; $i++)
                            {
                                if($Kind[0][$i] == $_GET['Kind'.$j])
                                {
                                    echo("<option selected='selected' value=".$Kind[0][$i].">".$Kind[1][$i]."</option>");
                                }
                                else
                                {
                                    echo("<option value=".$Kind[0][$i].">".$Kind[1][$i]."</option>");
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

                        if(strlen($_GET['Diet']) < 3)
                        {
                            echo("<FONT color='red'>Ce régime doit faire plus de 3 caractères<br><br></FONT>");
                        }
                        else if(strlen($_GET['Diet']) > 39)
                        {
                            echo("<FONT color='red'>Ce régime doit faire moins de 40 caractères</FONT><br><br>");
                        }
                        else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Diet']))
                        {
                            echo("<FONT color='red'>Ce régime est incorrecte</FONT><br><br>");
                        }
                        else if($CheckMenu == "double")
                        {
                            echo("<FONT color='red'>Une catégorie alimentaire a été selectionné deux fois ou plus</FONT><br><br>");
                        }
                        else if($CheckMenu == "void")
                        {
                            echo("<FONT color='red'>Veuillez séléctionner une valeur dans chacun des formulaires</FONT><br><br>");
                        }
                        else if($CheckForm != 0)
                        {
                            echo("<FONT color='red'>Ce régime alimentaire existe déjà</FONT><br><br>");
                        }
                        echo("<input type='submit' name='Request' value='Ajouter'>
                        </form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='submit' value='Retour'></form>");
                    }
                    else
                    {
                        echo"<p>Le régime ".$_GET['Diet']." à bien été ajouté à la base de donnée</p>";
                    }
                }   
            }
            else
            {
                echo("
                    <form action='Index.php' method='get'>
                    <input type='search' placeholder = 'Rechercher un regime...' name='Org'/>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='hidden' name='Request' value='Search'>
                    <input type='submit' value=' '></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='hidden' name='Menu' value=1>
                    <input type='submit' name='Request' value='Ajouter un régime'></form><br>       
                ");
            }
        
        ?>
    </body>
</html>