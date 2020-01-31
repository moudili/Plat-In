<?php
    require("View/ViewBanner.php");
?>
<html>
    <head>
        <title>Régimes</title>
    </head>
    <style>
         body{
            text-align: center;
            }
        
    </style> 
    <body>

        <div class="mt-5 text-center justify-content-center flexbox">
            <div>
        <?php
            
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
                    <input type='submit' class='bouton_1' name='Request' value='+'></p>
                    <input type='hidden' name='Menu' value=".$_GET['Menu'].">
                    <input type='submit' class='bouton_1' name='Request' value='Ajouter'>
                    </form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='submit' class='bouton_1' value='Retour'></form>");
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
                        echo("<input type='submit' class='bouton_1' name='Request' value='-'> ");
                    }
                    
                    echo("<input type='submit' class='bouton_1' name='Request' value='+'></p>
                    <input type='hidden' name='Menu' value=".$Menu.">
                    <input type='submit' class='bouton_1' name='Request' value='Ajouter'>
                    </form>
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='submit' class='bouton_1' value='Retour'></form>");
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
                            echo("<input type='submit' class='bouton_1' name='Request' value='-'> ");
                        }
                        
                        echo("<input type='submit' class='bouton_1' name='Request' value='+'></p>
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
                        echo("<input type='submit' class='bouton_1' name='Request' value='Ajouter'>
                        </form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='submit' class='bouton_1' value='Retour'></form>");
                    }
                    else
                    {
                        echo"<p>Le régime ".$_GET['Diet']." à bien été ajouté à la base de donnée</p>";
                        echo("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='submit' class='bouton_1' value='Retour'></form>");
                    }
                }
                else if($_GET['Request'] == "Search")
                {
                    echo("
                    <form action='Index.php' method='get'>
                    <input type='search' class='text_1'placeholder = 'Rechercher un regime...' name='Search' value='".htmlspecialchars($_GET['Search'], ENT_QUOTES)."'/>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='hidden' name='Request' value='Search'>
                    <button type='submit'class='bouton_1'> <i class='fa fa-search'></i></button></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='hidden' name='Menu' value=1>
                    <input type='submit' class='bouton_1' name='Request' value='Ajouter un régime'></form><br>
       
                    ");

                    if(count($PrintDiet[0]) == false)
                    {
                        echo "aucun résultat pour la recherche ".htmlspecialchars($_GET['Search'], ENT_QUOTES).".";
                    }
                    else
                    {
                        echo"<div class='shrink'><table border>";
                        for($i = 0 ; $i < count($PrintDiet[0]) ; $i++)
                        {
                            $compt = 0;
                                for($j = $i ; $PrintDiet[0][$i] == $PrintDiet[0][$j] ; $j++)
                                {
                                    $compt++;
                                    if($j == count($PrintDiet[0]) - 1)
                                    {
                                        break;
                                    }
                                }
                            if($i > 0)
                            {

                                if($PrintDiet[0][$i] == $PrintDiet[0][$i-1])
                                {
                                    $compt = 0;
                                }
                                else
                                {
                                    echo"<tr ><td rowspan='".$compt."'>".$PrintDiet[1][$i]."
                                    <p><form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Régimes'>
                                    <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                                    <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                                    <input type='submit' class='bouton_1' name='Request' value='Supprimer ce régime'></form></p>
                                    <p><form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Régimes'>
                                    <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                                    <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                                    <input type='submit' class='bouton_1' name='Request' value='Modifier ce régime'></form></p>
                                    <p><form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Régimes'>
                                    <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                                    <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'> 
                                    <input type='hidden' name='Menu' value=1>   
                                    <input type='submit' class='bouton_1' name='Request' value='Ajouter des catégories'></form></p>
                                    </td>";
                                }
                            }
                            else
                            {
                                echo"<tr><td rowspan='".$compt."'>".$PrintDiet[1][$i]."
                                <p><form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Régimes'>
                                <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                                <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                                <input type='submit' class='bouton_1' name='Request' value='Supprimer ce régime'></form></p>
                                <p><form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Régimes'>
                                <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                                <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                                <input type='submit' class='bouton_1' name='Request' value='Modifier ce régime'></form></p>
                                <p><form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Régimes'>
                                <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                                <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                                <input type='hidden' name='Menu' value=1>
                                <input type='submit' class='bouton_1' name='Request' value='Ajouter des catégories'></form></p>
                                </td>
                                ";                        
                            }
                            
                            echo("<td>
                            ".$PrintDiet[3][$i]);

                            if($compt != 1)
                            {
                                echo("<form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Régimes'>
                                <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                                <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                                <input type='hidden' name='idcat' value='".$PrintDiet[2][$i]."'>
                                <input type='hidden' name='cat' value='".$PrintDiet[3][$i]."'>
                                <input type='submit' class='bouton_1' name='SubRequest' value='Supprimer'></form>
                                ");
                            }
                            echo"</td></tr>";
                        }
                        echo("</table></div>");
                    }                    
                }
                else if($_GET['Request'] == "Supprimer ce régime")
                {
                    if(empty($_GET['answer']))
                    {
                        echo "Etes-vous sûr de vouloir supprimer le régime ".$_GET['diet']." ?<br>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='hidden' name='Request' value='Supprimer ce régime'>
                        <input type='hidden' name='iddiet' value='".$_GET['iddiet']."'>
                        <input type='hidden' name='diet' value='".$_GET['diet']."'>
                        <input type='submit' class='bouton_1' name='answer' value='Oui'></form>

                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='submit' class='bouton_1' value='Non'></form>
                        ";
                    }
                    else
                    {
                        echo"Le régime ".$_GET['diet']." à bien été effacé.";
                        echo("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='submit' class='bouton_1' value='Retour'></form>");
                    }
                }
                else if($_GET['Request'] == "Modifier ce régime")
                {
                    echo"
                    Régime
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='text'class='text_1' name='newdiet' value='".htmlspecialchars($_GET['diet'], ENT_QUOTES)."'/><br><br>
                    <input type='hidden' name='iddiet' value='".$_GET['iddiet']."'>
                    <input type='hidden' name='diet' value='".$_GET['diet']."'>
                    <input type='submit' class='bouton_1' name='Request' value='Modifier'></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='submit' class='bouton_1' value='Retour'></form>
                    ";
                }
                else if($_GET['Request'] == "Modifier")
                {
                    if(strlen($_GET['newdiet']) < 3
                    || strlen($_GET['newdiet']) > 40
                    || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['newdiet'])
                    || $CheckForm2 != 0
                    )
                    {
                        echo"
                        Régime
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='text'class='text_1' name='newdiet' value='".htmlspecialchars($_GET['newdiet'], ENT_QUOTES)."'/><br><br>
                        <input type='hidden' name='iddiet' value='".$_GET['iddiet']."'>
                        <input type='hidden' name='diet' value='".$_GET['diet']."'>";
                        
                        if(strlen($_GET['newdiet']) < 3)
                        {
                            echo("<FONT color='red'>Ce régime doit faire plus de 3 caractères<br><br></FONT>");
                        }
                        else if(strlen($_GET['newdiet']) > 39)
                        {
                            echo("<FONT color='red'>Ce régime doit faire moins de 40 caractères</FONT><br><br>");
                        }
                        else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['newdiet']))
                        {
                            echo("<FONT color='red'>Ce régime est incorrecte</FONT><br><br>");
                        }
                        else if($CheckForm2 != 0)
                        {
                            echo("<FONT color='red'>Ce régime alimentaire existe déjà</FONT><br><br>");
                        }

                        echo("<input type='submit' class='bouton_1' name='Request' value='Modifier'></form>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='submit' class='bouton_1' value='Retour'></form>
                        ");
                    }
                    else
                    {
                        echo"Le régime ".$_GET['diet']." a été modifié en ".$_GET['newdiet'].".";
                        echo("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='submit' class='bouton_1' value='Retour'></form>");
                    }
                }
                else if($_GET['Request'] == "Ajouter des catégories")//=========================================================================================================================
                {
                    if(empty($_GET['SubRequest']))
                    {
                        echo("<p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='hidden' name='iddiet' value='".$_GET['iddiet']."'>
                        <input type='hidden' name='diet' value='".$_GET['diet']."'>
                        Choisissez une ou des catégories alimentaires avec lesquelles votre régime n'est pas compatible:<br><br>
                        <select name='Kind0'>
                        <option value=''>--Choisissez une catégorie alimentaire--</option>
                        ");
                        
                        for($i = 0 ; $i < count($Kind[0]) ; $i++)
                        {
                            echo("<option value=".$Kind[0][$i].">".$Kind[1][$i]."</option>");
                        }
                        
                        echo("</select>
                        <input type='hidden' name='Request' value='Ajouter des catégories'>
                        <input type='submit' class='bouton_1' name='SubRequest' value='+'></p>
                        <input type='hidden' name='Menu' value=".$_GET['Menu'].">
                        <input type='submit' class='bouton_1' name='SubRequest' value='Ajouter'>
                        </form>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='submit' class='bouton_1' value='Retour'></form>");
                    }
                    else
                    {
                        if($_GET['SubRequest'] == "Ajouter")
                        {
                            if($CheckMenu2 == "double"
                            || $CheckMenu2 == "void"
                            || $CheckForm3 != 0)
                            {
                                echo ("<p><form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Régimes'>
                                <input type='hidden' name='iddiet' value='".$_GET['iddiet']."'>
                                <input type='hidden' name='diet' value='".$_GET['diet']."'>
                                <p>Choisissez une ou des catégories alimentaires avec lesquelles votre régime n'est pas compatible:<br><br>");
                                
                        
                                for($j = 0 ; $j < $Menu2 ; $j++ )
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
                        
                                if( $Menu2 > 1 )
                                {
                                    echo("<input type='submit' class='bouton_1' name='SubRequest' value='-'> ");
                                }
                                
                                echo("<input type='hidden' name='Request' value='Ajouter des catégories'>
                                <input type='submit' class='bouton_1' name='SubRequest' value='+'></p>
                                <input type='hidden' name='Menu' value=".$Menu2.">");
                                
                                if($CheckMenu2 == "double")
                                {
                                    echo("<FONT color='red'>Une catégorie alimentaire a été selectionné deux fois ou plus</FONT><br><br>");
                                }
                                else if($CheckMenu2 == "void")
                                {
                                    echo("<FONT color='red'>Veuillez séléctionner une valeur dans chacun des formulaires</FONT><br><br>");
                                }
                                else if($CheckForm3 != 0)
                                {
                                    echo("<FONT color='red'>Une des catégorie alimentaire est déjà présente dans ce régime alimentaire</FONT><br><br>");
                                }
                                
                                echo("<input type='submit' class='bouton_1' name='SubRequest' value='Ajouter'>
                                </form>
                                <p><form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Régimes'>
                                <input type='submit' class='bouton_1' value='Retour'></form>");
                            }
                            else
                            {
                                echo"Le régime ".$_GET['diet']." a bien été mis à jour";
                                echo("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='submit' class='bouton_1' value='Retour'></form>");
                            }
                        }
                        else if($_GET['SubRequest'] == "+"
                        || $_GET['SubRequest'] == "-" )
                        {
                            echo ("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='hidden' name='iddiet' value='".$_GET['iddiet']."'>
                            <input type='hidden' name='diet' value='".$_GET['diet']."'>
                            <p>Choisissez une ou des catégories alimentaires avec lesquelles votre régime n'est pas compatible:<br><br>");
                            
                    
                            for($j = 0 ; $j < $Menu2 ; $j++ )
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
                    
                            if( $Menu2 > 1 )
                            {
                                echo("<input type='submit' class='bouton_1' name='SubRequest' value='-'> ");
                            }
                            
                            echo("<input type='hidden' name='Request' value='Ajouter des catégories'>
                            <input type='submit' class='bouton_1' name='SubRequest' value='+'></p>
                            <input type='hidden' name='Menu' value=".$Menu2.">
                            <input type='submit' class='bouton_1' name='SubRequest' value='Ajouter'>
                            </form>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='submit' class='bouton_1' value='Retour'></form>");
                        }
                    }
                }//===================================================================================================================================================================================          
            }
            else
            {
                echo("
                    <form action='Index.php' method='get'>
                    <input type='search' class='text_1'placeholder = 'Rechercher un regime...' name='Search'/>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='hidden' name='Request' value='Search'>
                    <button type='submit'class='bouton_1'> <i class='fa fa-search'></i></button></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Régimes'>
                    <input type='hidden' name='Menu' value=1>
                    <input type='submit' class='bouton_1' name='Request' value='Ajouter un régime'></form><br>
                    <div class='shrink'>
                    <table border>       
                ");

                for($i = 0 ; $i < count($PrintDiet[0]) ; $i++)
                {
                    $compt = 0;
                        for($j = $i ; $PrintDiet[0][$i] == $PrintDiet[0][$j] ; $j++)
                        {
                            $compt++;
                            if($j == count($PrintDiet[0]) - 1)
                            {
                                break;
                            }
                        }
                    if($i > 0)
                    {

                        if($PrintDiet[0][$i] == $PrintDiet[0][$i-1])
                        {
                            $compt = 0;
                        }
                        else
                        {
                            echo"<tr ><td rowspan='".$compt."'>".$PrintDiet[1][$i]."
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                            <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                            <input type='submit' class='bouton_1' name='Request' value='Supprimer ce régime'></form></p>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                            <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                            <input type='submit' class='bouton_1' name='Request' value='Modifier ce régime'></form></p>
                            <p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Régimes'>
                            <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                            <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                            <input type='hidden' name='Menu' value=1>
                            <input type='submit' class='bouton_1' name='Request' value='Ajouter des catégories'></form></p>
                            </td>";
                        }
                    }
                    else
                    {
                        echo"<tr><td rowspan='".$compt."'>".$PrintDiet[1][$i]."
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                        <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                        <input type='submit' class='bouton_1' name='Request' value='Supprimer ce régime'></form></p>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                        <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                        <input type='submit' class='bouton_1' name='Request' value='Modifier ce régime'></form></p>
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                        <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                        <input type='hidden' name='Menu' value=1>
                        <input type='submit' class='bouton_1' name='Request' value='Ajouter des catégories'></form></p>
                        </td>
                        ";                        
                    }
                    
                    echo("<td>
                    ".$PrintDiet[3][$i]);

                    if($compt != 1)
                    {
                        echo("<form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Régimes'>
                        <input type='hidden' name='iddiet' value='".$PrintDiet[0][$i]."'>
                        <input type='hidden' name='diet' value='".$PrintDiet[1][$i]."'>
                        <input type='hidden' name='idcat' value='".$PrintDiet[2][$i]."'>
                        <input type='hidden' name='cat' value='".$PrintDiet[3][$i]."'>
                        <input type='submit' class='bouton_1' name='SubRequest' value='Supprimer'></form>
                        ");
                    }
                    echo"</td></tr>";
                }
                echo("</table></div>");
            }
        
        ?>
        </div>
    </div>
    </body>
</html>