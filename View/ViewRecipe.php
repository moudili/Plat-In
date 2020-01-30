<?php
    require("View/ViewBanner.php"); 
?>
<html>
    <head>
        <title>Recette</title>
        <link rel="stylesheet" href="Css/Bootstrap/PersonalCss.css">
        <link rel="stylesheet" href="Css/Bootstrap/background.css">
        <link rel="stylesheet" href="Css/Bootstrap/rating.css">
    </head>
    
    <body class='backgroundhat center'>
        <?php

            if ($_SESSION['Co']==false)
            {
                if (empty($_GET['Request']) || $_GET['Request'] == "Search")
                {
                    echo("<div><div class='arriereplan'>
                    <div class='recetterecherche'>
                    <form action='Index.php' method='get'>
                    <input type='search' placeholder = 'Rechercher une recette...' name='Org'");
                    if(!empty($_GET['Org']))
                    {
                        echo"value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'>";
                    }
                    else
                    {
                        echo"value=''>";
                    }
                    echo("<input type='hidden' name='page' value='Recette'>
                    <input type='hidden' name='Request' value='Search'>");
                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                    {
                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                        ";
                    }                    
                    echo("<input type='submit' class='bouton_1' value=' '></form>
                    
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <input type='hidden' name='Request' value='Filtre'>
                    <input type='submit' class='bouton_1' value='Filtrer les résultats'></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <input type='submit' class='bouton_1' value='Enlever les filtres'></form></div>
                    <div>
                    Veuillez vous <a href='Index.php?page=Inscription'> inscrire</a> ou 
                    vous <a href='Index.php?page=Connexion'> connecter</a> pour ajouter des recettes </div></div>");
                    if(count($Recipes[0]) != 0)
                    {
                        echo"<table border=4 align='center'>
                        <p>Recettes";

                        
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            $Food = "";
                            $CountRecipes = 0;
    
                            for ($j=$i ; $j<count($Recipes[0]) ; $j++)
                            {
                                if($j == count($Recipes[0])-1 || $Recipes[6][$j] == $Recipes[6][$j+1])
                                {
                                    $Food = $Food.$Recipes[8][$j].",";
                                }
                                else
                                {
                                    $Food = $Food.$Recipes[8][$j];
                                    break 1;
                                }
                            }
                                
                            if($i == 0 || $Recipes[6][$i] != $Recipes[6][$i-1])
                            {
                                if ($Note[$i]>0 AND $Note[$i]<=5)
                                {
                                    $Note[$i]=round($Note[$i], 1);
                                    echo("<form action='Index.php' method='get'>
                                    <tr><td align='center'><img src='Pictures/recipe.png' alt='' width='200'>
                                    <p>".$Recipes[0][$i]."</p>
                                    <p>Ingédients:".$Food."</p>
                                    <p>Créer par : ".$Recipes[5][$i]."
                                    <p>Note des utilisateurs : ".$Note[$i]."/5</p></td>
                                    <td><input type='submit' class='bouton_1' name='Request' value='Afficher'>
                                    <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                                    <input type='hidden' name='page' value='Recette'></td>");
                                    if(!empty($_GET['Request']) && $_GET['Request'] == "Search")
                                    {
                                        echo"<input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                    }
                                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                    {
                                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                        ";
                                    }
                                    echo("</tr></p></form>");
                                }
                                else
                                {
                                    echo("<form action='Index.php' method='get'>
                                    <tr><td align='center'><img src='Pictures/recipe.png' alt='' width='200'>
                                    <p>".$Recipes[0][$i]."</p>
                                    <p>Ingédients:".$Food."</p>
                                    <p>Créer par : ".$Recipes[5][$i]."
                                    <p>Note des utilisateurs : ".$Note[$i]."</p></td>
                                    <td><input type='submit' class='bouton_1' name='Request' value='Afficher'>
                                    <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                                    <input type='hidden' name='page' value='Recette'></td>");
                                    if(!empty($_GET['Request']) && $_GET['Request'] == "Search")
                                    {
                                        echo"<input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                    }
                                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                    {
                                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                        ";
                                    }
                                    echo("</tr></p></form>");
                                }
                            }
                        }
                        echo("</table>");
                    }
                    else
                    {
                        echo"Aucun résultat n' été obtenu";
                    }
                    echo("</div>");  
                } 
                else if ($_GET['Request']=='Afficher')
                {
                    for ($i=0;$i<count($Recipes[0]);$i++)
                    {
                        if($i == 0 || $Recipes[6][$i] != $Recipes[6][$i-1])
                        {
                            if ($Recipes[6][$i]==$_GET['id'])
                            {
                                echo("
                                <div class='arriereplan'>
                                <div>
                                <form action='Index.php' method='get'>
                                <div><h1>".$Recipes[0][$i]."</h1></div>
                                <div class = 'row'>
                                <div><h4>Date de création : ".$Recipes[2][$i]."</h4></div>
                                <div><h4>Temps de préparation : ".$Recipes[3][$i]."</h4></div>
                                </div>
                                <div>Créer par : ".$Recipes[5][$i]."<br><br></div>
                                ");
                                echo(nl2br("<div class='recetterecherche'>Description : <br/><br/>".$Recipes[1][$i]."</div>
                                <input type='hidden' name='page' value='Recette'>
                                <br><input type='submit' class='bouton_1' value='Retour'>"));
                                if(!empty($_GET['Org']))
                                {
                                    echo"<input type='hidden' name='Request' value='Search'>
                                    <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                }
                                if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                {
                                    echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                    <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                    <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                    ";
                                }
                                echo("</form></div></div>");
                            }
                        } 
                    }
                }
                //----------------------------------------------------------------------------------------------------------------------
                else if($_GET['Request']=='Filtre')
                {
                    echo"<div class = 'arriereplan'>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    Origine : <select name='Filtre0'>
                    <option value=''>Toutes</option>";
                    for($i = 0 ; $i < count($MenuFiltre[0]) ; $i++)
                    {
                        echo("<option value=".$MenuFiltre[0][$i].">".$MenuFiltre[1][$i]."</option>"); 
                    } 
                    echo"</select><br><br>aliment : <select name='Filtre1'>
                    <option value=''>Tous</option>";
                    for($i = 0 ; $i < count($MenuFiltre[2]) ; $i++)
                    {
                        echo("<option value=".$MenuFiltre[2][$i].">".$MenuFiltre[3][$i]."</option>"); 
                    } 
                    echo"</select><br><br>catégorie alimentaire : <select name='Filtre2'>
                    <option value=''>Toutes</option>";
                    for($i = 0 ; $i < count($MenuFiltre[4]) ; $i++)
                    {
                        echo("<option value=".$MenuFiltre[4][$i].">".$MenuFiltre[5][$i]."</option>"); 
                    }

                    echo"</select>
                    <br><br> 
                    <input type='submit' class='bouton_1' value='Ajouter ces filtres'>
                    </form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <input type='submit' class='bouton_1' value='Retour'>";
                    if(!empty($_GET['Org']))
                    {
                        echo"<input type='hidden' name='Request' value='Search'>
                        <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                    }
                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                    {
                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                        ";
                    }                    
                    echo"</div>";
                }
            }
            else if ($_SESSION['Co']!=false)
            {
                if (empty($_GET['Request']) || $_GET['Request'] == "Search")
                {
                    echo("<div><div class='arriereplan'>
                    <div class='recetterecherche'> 
                    <form action='Index.php' method='get'>
                    <input type='search' placeholder = 'Rechercher une recette...' name='Org'");
                    if(!empty($_GET['Org']))
                    {
                        echo"value='".htmlspecialchars($_GET['Org'], ENT_QUOTES)."'>";
                    }
                    else
                    {
                        echo"value=''>";
                    }
                    echo("<input type='hidden' name='page' value='Recette'>
                    <input type='hidden' name='Request' value='Search'>");
                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                    {
                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                        ";
                    }
                    echo("<input type='submit' class='bouton_1' value=' '></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='Menu' value=1>
                    <input type='submit' class='bouton_1' name='Request' value='Ajouter une recette'>
                    <input type='hidden' name='page' value='Recette'>
                    </form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <input type='hidden' name='Request' value='Filtre'>
                    <input type='submit' class='bouton_1' value='Filtrer les résultats'></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <input type='submit' class='bouton_1' value='Enlever les filtres'></form></div><div>");

                    if(count($Recipes[0]) != 0)
                    {
                        echo"<table border=4 align='center'>
                        <p>Recettes";
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {

                            $Food = "";
                            $CountRecipes = 0;
    
                            for ($j=$i ; $j<count($Recipes[0]) ; $j++)
                            {
                                if($j == count($Recipes[0])-1 || $Recipes[6][$j] == $Recipes[6][$j+1])
                                {
                                    $Food = $Food.$Recipes[8][$j].",";
                                }
                                else
                                {
                                    $Food = $Food.$Recipes[8][$j];
                                    break 1;
                                }
                            }

                            if($i == 0 || $Recipes[6][$i] != $Recipes[6][$i-1])
                            {

                                if ($Recipes[4][$i]==$_SESSION['id'])
                                {
                                    if ($Note[$i]>0 AND $Note[$i]<=5)
                                    {
                                        $Note[$i]=round($Note[$i], 1);
                                        echo("<form action='Index.php' method='get'>
                                        <tr><td align='center'><img src='Pictures/recipe.png' alt='' width='200'>
                                        <p>".$Recipes[0][$i]."</p>
                                        <p>Ingédients:".$Food."</p>
                                        <p>Créer par : ".$Recipes[5][$i]."</p>
                                        <p>Note des utilisateurs : ".$Note[$i]."/5</p></td>
                                        <td align='center'><input type='submit' class='bouton_1' name='Request' value='Afficher'></br><br>
                                        <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                                        <input type='hidden' name='page' value='Recette'>
                                        <input type='submit' class='bouton_1' name='Request' value='Modifier'></br><br>
                                        <input type='hidden' name='Menu' value=1>
                                        <input type='submit' class='bouton_1' name='Request' value='Supprimer'></td></tr></p>");
                                        if(!empty($_GET['Org']))
                                        {
                                            echo"<input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                        }
                                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                        {
                                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                            ";
                                        }                                        
                                        echo("</form>");   
                                    }
                                    else
                                    {
                                        echo("<form action='Index.php' method='get'>
                                        <tr><td align='center'><img src='Pictures/recipe.png' alt='' width='200'>
                                        <p>".$Recipes[0][$i]."</p>
                                        <p>Ingédients:".$Food."</p>
                                        <p>Créer par : ".$Recipes[5][$i]."</p>
                                        <p>Note des utilisateurs : ".$Note[$i]."</p></td>
                                        <td align='center'><input type='submit' class='bouton_1' name='Request' value='Afficher'></br><br>
                                        <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                                        <input type='hidden' name='page' value='Recette'>
                                        <input type='submit' class='bouton_1' name='Request' value='Modifier'><br><br>
                                        <input type='hidden' name='Menu' value=1>
                                        <input type='submit' class='bouton_1' name='Request' value='Supprimer'></td></tr></p>");
                                        if(!empty($_GET['Org']))
                                        {
                                            echo"<input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                        }
                                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                        {
                                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                            ";
                                        }                                        
                                        echo("</form>");
                                    }
                                } 
                                else 
                                {
                                    if ($Note[$i]>0 AND $Note[$i]<=5)
                                    {
                                        $Note[$i]=round($Note[$i], 1);
                                        echo("<form action='Index.php' method='get'>
                                        <tr><td><img src='Pictures/recipe.png' alt='' width='200'>
                                        <p>".$Recipes[0][$i]."</p>
                                        <p>Créer par : ".$Recipes[5][$i]."</p>
                                        <p>Note des utilisateurs : ".$Note[$i]."/5</p></td>
                                        <td><input type='submit' class='bouton_1' name='Request' value='Afficher'>
                                        <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                                        <input type='hidden' name='page' value='Recette'></td></tr></p>");
                                        if(!empty($_GET['Org']))
                                        {
                                            echo"<input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                        }
                                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                        {
                                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                            ";
                                        }
                                        echo("</form>");
                                    }
                                    else
                                    {
                                        echo("<form action='Index.php' method='get'>
                                        <tr><td><img src='Pictures/recipe.png' alt='' width='200'>
                                        <p>".$Recipes[0][$i]."</p>
                                        <p>Créer par : ".$Recipes[5][$i]."</p>
                                        <p>Note des utilisateurs : ".$Note[$i]."</p></td>
                                        <td><input type='submit' class='bouton_1' name='Request' value='Afficher'>
                                        <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                                        <input type='hidden' name='page' value='Recette'></td></tr></p>");
                                        if(!empty($_GET['Org']))
                                        {
                                            echo"<input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                        }
                                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                        {
                                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                            ";
                                        }                                        
                                        echo("</form>");
                                    }
                                }
                            }
                        }
                        echo("</table>");
                    }
                    else
                    {
                        echo"Aucun résultat n' été obtenu"; 
                    }
                    echo("</div>");
                } 
                else if ($_GET['Request']=='Ajouter une recette')
                {
                    echo("
                    <p>Créer une recette</p>
                    <form action='Index.php' enctype='multipart/form-data' method='get'>
                    <p>image  <input id='get_compte' type='file' name='photo'  value=''></p>
                    <p> Nom de la recette : <input id='get_compte' type='text' class='text_1'name='name' value=''></p>
                    <p> Aliments : <select name='food0'>
                    <option value=''>--Choisissez un aliment--</option>");
                    for($i = 0 ; $i < count($Foods[0]) ; $i++)
                    {
                        echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>"); 
                    }                
                    echo("</select> <input type='submit' class='bouton_1' name='Request' value='+'></p></p>
                    <input type='hidden' name='Menu' value=".$_GET['Menu'].">
                    <p> Temps de préparation : <SELECT name='time' size='1'>
                    <OPTION value='00:05:00'>5 min
                    <OPTION value='00:10:00'>10 min
                    <OPTION value='00:20:00'>20 min
                    <OPTION value='00:30:00'>30 min
                    <OPTION value='00:45:00'>45 min
                    <OPTION value='01:00:00'>1h
                    <OPTION value='01:30:00'>1h30
                    <OPTION value='02:00:00'>2h
                    <OPTION value='03:00:00'>2h+
                    </SELECT></p>
                    <p>Origine de la recette : <select name='origine'>
                            <option value=''>--Choisissez une origine--</option>");
                            for($i = 0 ; $i < count($Origines[0]) ; $i++)
                            {
                                echo("<option value=".$Origines[0][$i].">".$Origines[1][$i]."</option>"); 
                            }                
                            echo("</select></p>

                    
                    <p> Recette : <br><TEXTAREA name='text' rows=15 cols=90></TEXTAREA></p>
                    <p>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' class='bouton_1' name='Request'value='Valider'></form>");

                    echo("<p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>");
                    if(!empty($_GET['Org']))
                    {
                        echo"<input type='hidden' name='Request' value='Search'>
                        <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                    }
                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                    {
                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                        ";
                    }                    
                    echo("<br><input type='submit' class='bouton_1' value='Retour'></form>");
                } 
                else if ($_GET['Request'] == "+"
                || $_GET['Request'] == "-")
                {
                    echo("
                    <p>Créer une recette</p>
                    <form action='Index.php' enctype='multipart/form-data' method='get'>
                    <p>image  <input id='get_compte' type='file' name='photo' value=''></p>
                    <p> Nom de la recette : <input id='get_compte' type='text' class='text_1'name='name' value='".$_GET['name']."'></p>
                    <p> Aliments : ");

                    for($j = 0 ; $j < $Menu ; $j++ )
                    {
                        echo("<select name='food".$j."'>
                        <option value=''>--Choisissez un aliment--</option>");
                        for($i = 0 ; $i < count($Foods[0]) ; $i++)
                        {
                            if($Foods[0][$i] == $_GET['food'.$j])
                            {
                                echo("<option selected='selected' value=".$Foods[0][$i].">".$Foods[1][$i]."</option>");
                            }
                            else
                            {
                                echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>"); 
                            }
                        }                
                        echo("</select>");
                        if( ($j+2)%5 == 1)
                        {
                            echo("<br><br>");
                        }
                    }

                    if( $Menu > 1 )
                    {
                        echo("<input type='submit' class='bouton_1' name='Request' value='-'>");
                    }

                    echo("<input type='hidden' name='Menu' value=".$Menu.">
                    <input type='submit' class='bouton_1' name='Request' value='+'>");



                    echo("</p></p>
                    <p> Temps de préparation : <SELECT name='time' size='1'>");
                    if ($_GET['time']=="00:05:00")
                    {
                        echo("<OPTION selected='selected' value='00:05:00'>5 min");
                    }
                    else
                    {
                        echo("<OPTION value='00:05:00'>5 min");
                    }
                    if ($_GET['time']=="00:10:00")
                    {
                        echo("<OPTION selected='selected' value='00:10:00'>10 min");
                    }
                    else
                    {
                        echo("<OPTION value='00:10:00'>10 min");
                    }
                    if ($_GET['time']=="00:20:00")
                    {
                        echo("<OPTION selected='selected' value='00:20:00'>20 min");
                    }
                    else
                    {
                        echo("<OPTION value='00:20:00'>20 min");
                    }
                    if ($_GET['time']=="00:30:00")
                    {
                        echo("<OPTION selected='selected' value='00:30:00'>30 min");
                    }
                    else
                    {
                        echo("<OPTION value='00:30:00'>30 min");
                    }
                    if ($_GET['time']=="00:45:00")
                    {
                        echo("<OPTION selected='selected' value='00:45:00'>45 min");
                    }
                    else
                    {
                        echo("<OPTION value='00:45:00'>45 min");
                    }
                    if($_GET['time']=="01:00:00")
                    {
                        echo("<OPTION selected='selected' value='01:00:00'>1h");
                    }
                    else
                    {
                        echo("<OPTION value='01:00:00'>1h");
                    }
                    if ($_GET['time']=="01:30:00")
                    {
                        echo("<OPTION selected='selected' value='01:30:00'>1H30");
                    }
                    else
                    {
                        echo("<OPTION value='01:30:00'>1H30");
                    }
                    if ($_GET['time']=="02:00:00")
                    {
                        echo("<OPTION selected='selected' value='02:00:00'>2H");
                    }
                    else
                    {
                        echo("<OPTION value='02:00:00'>2H");
                    }
                    if ($_GET['time']=="03:00:00")
                    {
                        echo("<OPTION selected='selected' value='03:00:00'>2H+");
                    }
                    else
                    {
                        echo("<OPTION value='03:00:00'>2H+");
                    }
                    echo("</SELECT></p></p>
                    <p>Origine de la recette : <select name='origine'>
                            <option value=''>--Choisissez une origine--</option>");
                            for($i = 0 ; $i < count($Origines[0]) ; $i++)
                            {
                                if($Origines[0][$i] == $_GET['origine'])
                                {
                                    echo("<option selected='selected' value=".$Origines[0][$i].">".$Origines[1][$i]."</option>");
                                }
                                else
                                {
                                    echo("<option value=".$Origines[0][$i].">".$Origines[1][$i]."</option>"); 
                                }
                            }                
                            echo("</select></p>

                    
                    <p> Recette : <br><TEXTAREA name='text' rows=15 cols=90></TEXTAREA></p>
                    <p>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' class='bouton_1' name='Request'value='Valider'></form>");

                    echo("<p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>");
                    if(!empty($_GET['Org']))
                    {
                        echo"<input type='hidden' name='Request' value='Search'>
                        <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                    }
                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                    {
                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                        ";
                    }                    
                    echo("<br><input type='submit' class='bouton_1' value='Retour'></form>");
                }
                else if ($_GET['Request']=='Valider')
                {
                    if (!empty($_GET['name'])
                    AND !empty($_GET['food0']) 
                    AND !empty($_GET['time'])
                    AND !empty($_GET['origine'])
                    AND !empty($_GET['text'])
                    AND strlen($_GET['name'])<40)
                    {
                        

                        echo("
                        Votre recette est maintenant en ligne !");
                        echo("<p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='succes' value='reussi'>");
                        if(!empty($_GET['Org']))
                        {
                            echo"<input type='hidden' name='Request' value='Search'>
                            <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                        }
                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                        {
                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                            ";
                        }                        
                        echo("<br><input type='submit' class='bouton_1' value='Retour'></form>");
                    }
                    else
                    {
                        echo("
                        Votre recette n'as pas pu être mise en ligne !<br></br>");

                        echo("
                        
                        <form action='Index.php' enctype='multipart/form-data' method='get'>
                        <p>image  <input id='get_compte' type='file' name='photo' value=''></p>
                        <p> Nom de la recette : <input id='get_compte' type='text' class='text_1'name='name' value='".$_GET['name']."'></p>
                        <p> Aliments : ");

                        for($j = 0 ; $j < $Menu ; $j++ )
                        {
                            echo("<select name='food".$j."'>
                            <option value=''>--Choisissez un aliment--</option>");
                            for($i = 0 ; $i < count($Foods[0]) ; $i++)
                            {
                                if($Foods[0][$i] == $_GET['food'.$j])
                                {
                                    echo("<option selected='selected' value=".$Foods[0][$i].">".$Foods[1][$i]."</option>");
                                }
                                else
                                {
                                    echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>"); 
                                }
                            }                
                            echo("</select>");
                            if( ($j+2)%5 == 1)
                            {
                                echo("<br><br>");
                            }
                        }
                        if( $Menu > 1 )
                        {
                            echo("<input type='submit' class='bouton_1' name='Request' value='-'>");
                        }
                        
                        echo("<input type='hidden' name='Menu' value=".$Menu.">
                        <input type='submit' class='bouton_1' name='Request' value='+'>");



                        echo("</p></p>
                        <p> Temps de préparation : <SELECT name='time' size='1'>");
                        if ($_GET['time']=="00:05:00")
                        {
                            echo("<OPTION selected='selected' value='00:05:00'>5 min");
                        }
                        else
                        {
                            echo("<OPTION value='00:05:00'>5 min");
                        }
                        if ($_GET['time']=="00:10:00")
                        {
                            echo("<OPTION selected='selected' value='00:10:00'>10 min");
                        }
                        else
                        {
                            echo("<OPTION value='00:10:00'>10 min");
                        }
                        if ($_GET['time']=="00:20:00")
                        {
                            echo("<OPTION selected='selected' value='00:20:00'>20 min");
                        }
                        else
                        {
                            echo("<OPTION value='00:20:00'>20 min");
                        }
                        if ($_GET['time']=="00:30:00")
                        {
                            echo("<OPTION selected='selected' value='00:30:00'>30 min");
                        }
                        else
                        {
                            echo("<OPTION value='00:30:00'>30 min");
                        }
                        if ($_GET['time']=="00:45:00")
                        {
                            echo("<OPTION selected='selected' value='00:45:00'>45 min");
                        }
                        else
                        {
                            echo("<OPTION  value='00:45:00'>45 min");
                        }
                        if($_GET['time']=="01:00:00")
                        {
                            echo("<OPTION selected='selected' value='01:00:00'>1h");
                        }
                        else
                        {
                            echo("<OPTION value='01:00:00'>1h");
                        }
                        if ($_GET['time']=="01:30:00")
                        {
                            echo("<OPTION selected='selected' value='01:30:00'>1H30");
                        }
                        else
                        {
                            echo("<OPTION value='01:30:00'>1H30");
                        }
                        if ($_GET['time']=="02:00:00")
                        {
                            echo("<OPTION selected='selected' value='02:00:00'>2H");
                        }
                        else
                        {
                            echo("<OPTION value='02:00:00'>2H");
                        }
                        if ($_GET['time']=="03:00:00")
                        {
                            echo("<OPTION selected='selected' value='03:00:00'>2H+");
                        }
                        else
                        {
                            echo("<OPTION value='03:00:00'>2H+");
                        }
                        echo("</SELECT></p></p>
                        <p>Origine de la recette : <select name='origine'>
                                <option value=''>--Choisissez une origine--</option>");

                                for($i = 0 ; $i < count($Origines[0]) ; $i++)
                                {
                                    if($Origines[0][$i] == $_GET['origine'])
                                    {
                                        echo("<option selected='selected' value=".$Origines[0][$i].">".$Origines[1][$i]."</option>");
                                    }
                                    else
                                    {
                                        echo("<option value=".$Origines[0][$i].">".$Origines[1][$i]."</option>"); 
                                    }
                                }      

                        echo("</select></p>
                        <p> Recette : <br><TEXTAREA name='text' rows=15 cols=90></TEXTAREA></p>
                        <p>
                        <input type='hidden' name='page' value='Recette'>");

                        if(strlen($_GET['name']) < 3)
                        {
                            echo("<FONT color='red'>Le nom de votre recette est trop petite<br><br></FONT>");
                        }
                        else if(strlen($_GET['name']) > 39)
                        {
                            echo("<FONT color='red'>Le nom de votre recette doit faire moins de 40 caractères</FONT><br><br>");
                        }
                        else if($CheckMenu == "double")
                        {
                            echo("<FONT color='red'>Un aliment a été selectionné deux fois ou plus</FONT><br><br>");
                        }
                        else if($CheckMenu == "void")
                        {
                            echo("<FONT color='red'>Veuillez séléctionner une valeur dans chacun des formulaires</FONT><br><br>");
                        } 
                        else if (empty($_GET['time']))
                        {
                            echo("<FONT color='red'>Veuillez entrer un temps de préparation à votre recette.</FONT><br><br>");
                        }
                        else if (empty($_GET['origine']))
                        {
                            echo("<FONT color='red'>Veuillez entrer une origine à votre recette.</FONT><br><br>");
                        }   
                        else if (empty($_GET['text']))
                        {
                            echo("<FONT color='red'>Veuillez entrer une description de votre recette.</FONT><br><br>");
                        }                        
                        echo("<br><input type='submit' class='bouton_1' name='Request'value='Valider'></form>");
                        echo("<p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>");
                        if(!empty($_GET['Org']))
                        {
                            echo"<input type='hidden' name='Request' value='Search'>
                            <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                        }
                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                        {
                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                            ";
                        }                        
                        echo("<br><input type='submit' class='bouton_1' value='Retour'></form>");
                    }
                }
                else if ($_GET['Request']=='Afficher')
                {
                    if (empty($_GET['RequestReview']))
                    {
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if($i == 0 || $Recipes[6][$i] != $Recipes[6][$i-1])
                            {
                                if ($Recipes[6][$i]==$_GET['id'])
                                {
                                    echo("
                                    <div class='arriereplan'>
                                    <div>
                                    <form action='Index.php' method='get'>
                                    <div><h1>".$Recipes[0][$i]."</h1></div>
                                    <div class = 'row'>
                                    <div><h4>Date de création : ".$Recipes[2][$i]."</h4></div>
                                    <div><h4>Temps de préparation : ".$Recipes[3][$i]."</h4></div>
                                    </div>  
                                    <div>Créer par : ".$Recipes[5][$i]."<br><br></div>
                                    ");

                                    echo(nl2br("<div class='recetterecherche'> Description : <br><br>".$Recipes[1][$i]."</div>
                                        <input type='hidden' name='page' value='Recette'>
                                    <input type='hidden' name='id' value='".$_GET['id']."'>
                                    <br>
                                    <input type='hidden' name='Request' value='Afficher'>
                                    <input type='submit' class='bouton_1' name='RequestReview'value='Donner une note'>
                                    </form>
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Recette'>"));
                                    if(!empty($_GET['Org']))
                                    {
                                        echo"<input type='hidden' name='Request' value='Search'>
                                        <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                    }
                                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                    {
                                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                        ";
                                    }                                    
                                    echo("<input type='submit' class='bouton_1' value='Retour'>
                                    </form></div>");
                                } 
                            }
                        }
                    }
                    else if ($_GET['RequestReview']=='Donner une note')
                    {
                        echo("
                        Merci de rentrer votre notre pour cette recette.
                        <form action='Index.php' method='get'>
                        <div class='rating'>
                        <input name='stars' id='e5' type='radio' value='5'></a><label for='e5'>☆</label>
                        <input name='stars' id='e4' type='radio' value='4'></a><label for='e4'>☆</label>
                        <input name='stars' id='e3' type='radio' value='3'></a><label for='e3'>☆</label>
                        <input name='stars' id='e2' type='radio' value='2'></a><label for='e2'>☆</label>
                        <input name='stars' id='e1' type='radio' value='1'></a><label for='e1'>☆</label>
                        </div>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='Request' value='Afficher'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='submit' class='bouton_1' name='RequestReview' value='Valider'>
                        </form>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='Request' value='Afficher'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>");
                        if(!empty($_GET['Org']))
                        {
                            echo"<input type='hidden' name='Request' value='Search'>
                            <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                        }
                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                        {
                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                            ";
                        }                        
                        echo("<input type='submit' class='bouton_1' value='Retour'>
                        </form>");
                    }
                    else if ($_GET['RequestReview']=='Valider' AND !empty($_GET['stars']))
                    {
                        echo("
                        Nous avons bien enregistrer votre note
                        </br></br>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='Request' value='Afficher'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>");
                        if(!empty($_GET['Org']))
                        {
                            echo"<input type='hidden' name='Request' value='Search'>
                            <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                        }
                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                        {
                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                            ";
                        }                        
                        echo("<input type='submit' class='bouton_1' value='Retour'>
                        </form>");
                    }
                    else if ($_GET['RequestReview']=='Valider' AND empty($_GET['stars']))
                    {
                        echo("
                        Merci de rentrer votre notre pour cette recette.
                        <form action='Index.php' method='get'>
                        <div class='rating'>
                        <input name='stars' id='e5' type='radio' value='5'></a><label for='e5'>☆</label>
                        <input name='stars' id='e4' type='radio' value='4'></a><label for='e4'>☆</label>
                        <input name='stars' id='e3' type='radio' value='3'></a><label for='e3'>☆</label>
                        <input name='stars' id='e2' type='radio' value='2'></a><label for='e2'>☆</label>
                        <input name='stars' id='e1' type='radio' value='1'></a><label for='e1'>☆</label>
                        </div>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='Request' value='Afficher'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <input type='submit' class='bouton_1' name='RequestReview' value='Valider'>
                        </form>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='Request' value='Afficher'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>");
                        if(!empty($_GET['Org']))
                        {
                            echo"<input type='hidden' name='Request' value='Search'>
                            <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                        }
                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                        {
                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                            ";
                        }                        
                        echo("<input type='submit' class='bouton_1' value='Retour'>
                        </form>");
                    }
                }
                else if ($_GET['Request']=='Modifier')
                {
                    if (empty($_GET['RequestModif']))
                    {
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if($i == 0 || $Recipes[6][$i] != $Recipes[6][$i-1])
                            {
                                if ($Recipes[6][$i]==$_GET['id'])
                                {
                                    echo("
                                        <form action='Index.php' method='get'>
                                        <p align=center><input type='texte' name='name' value='".$Recipes[0][$i]."'></p>
                                        <p align=center>
                                        Votre recette contenait le ou les aliments suivants : ");
                                        for ($j=0;$j<count($NewFoods[0]);$j++)
                                        {
                                            echo($NewFoods[2][$j]." ");
                                        }
                                        echo("</p>
                                        <p align=center>Aliment(s) : ");
                                        
                                            echo("<select name='food0'>
                                            <option value=''>--Choisissez un aliment--</option>");
                                            for($k = 0 ; $k < count($Foods[0]) ; $k++)
                                            {
                                                echo("<option value=".$Foods[0][$k].">".$Foods[1][$k]."</option>"); 
                                            }                
                                            echo("</select>");
                                        echo("<input type='hidden' name='Menu' value=".$Menu2.">
                                        <input type='hidden' name='page' value='Recette'>
                                        <input type='hidden' name='Request' value='Modifier'>
                                        <input type='hidden' name='Menu' value=1>
                                        <input type='hidden' name='id' value='".$_GET['id']."'>
                                        <input type='submit' class='bouton_1' name='RequestModif' value='+'>");

                                        if( $Menu2 > 1 )
                                        {
                                            echo("
                                            <input type='submit' class='bouton_1' name='RequestModif' value='-'>");
                                        }

                                        echo("
                                        <p align=center>Date de création : ".$Recipes[2][$i]."</p>
                                        <p align=center>Temps de préparation : <SELECT name='time' size='1'>");
                                        if ($Recipes[3][$i]=="00:05:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:05:00'>5min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:05:00'>5min");
                                        }
                                        if ($Recipes[3][$i]=="00:10:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:10:00'>10min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:10:00'>10min");
                                        }
                                        if ($Recipes[3][$i]=="00:20:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:20:00'>20min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:20:00'>20min");
                                        }
                                        if ($Recipes[3][$i]=="00:30:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:30:00'>30min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:30:00'>30min");
                                        }
                                        if ($Recipes[3][$i]=="00:45:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:45:00'>45min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:45:00'>45min");
                                        }
                                        if($Recipes[3][$i]=="01:00:00")
                                        {
                                            echo("<OPTION selected='selected' value='01:00:00'>1h");
                                        }
                                        else
                                        {
                                            echo("<OPTION selected='selected' value='01:00:00'>1h");
                                        }
                                        if ($Recipes[3][$i]=="01:30:00")
                                        {
                                            echo("<OPTION selected='selected' value='01:30:00'>1H30");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='01:30:00'>1H30");
                                        }
                                        if ($Recipes[3][$i]=="02:00:00")
                                        {
                                            echo("<OPTION selected='selected' value='02:00:00'>2H");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='02:00:00'>2H");
                                        }
                                        if ($Recipes[3][$i]=="03:00:00")
                                        {
                                            echo("<OPTION selected='selected' value='03:00:00'>2H+");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='03:00:00'>2H+");
                                        }
                                        echo("</SELECT></p>
                                        <p align=center>Créer par : ".$Recipes[5][$i]."</p>
                                        Origine de la recette : <select name='origine'>
                                        <option value=''>--Choisissez une origine--</option>");
                                        for($j = 0 ; $j < count($Origines[0]) ; $j++)
                                        {
                                            if($Origines[0][$j] == $Recipes[7][$i])
                                            {
                                                echo("<option selected='selected' value=".$Origines[0][$j].">".$Origines[1][$j]."</option>");
                                            }
                                            else
                                            {
                                                echo("<option value=".$Origines[0][$j].">".$Origines[1][$j]."</option>"); 
                                            }
                                        }                
                                        echo("</select></p>
                                        <p align=center> Description :<br><TEXTAREA name='text' rows=15 cols=90>".$Recipes[1][$i]."</TEXTAREA></p>
                                        <br><input type='submit' class='bouton_1' name='RequestModif' value='Confirmation'>
                                        </form>
                                        <form action='Index.php' method='get'>
                                        <input type='hidden' name='page' value='Recette'>");
                                        if(!empty($_GET['Org']))
                                        {
                                            echo"<input type='hidden' name='Request' value='Search'>
                                            <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                        }
                                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                        {
                                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                            ";
                                        }                                        
                                        echo("<input type='submit' class='bouton_1' value='Retour'>
                                        </form>");
                                }
                            }
                        }
                    }
                    else if ($_GET['RequestModif'] == "+"
                    || $_GET['RequestModif'] == "-")
                    {
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if($i == 0 || $Recipes[6][$i] != $Recipes[6][$i-1])
                            {
                                if ($Recipes[6][$i]==$_GET['id'])
                                {
                                    echo("
                                        <form action='Index.php' method='get'>
                                        <p align=center><input type='texte' name='name' value='".$Recipes[0][$i]."'></p>
                                        <p align=center>
                                        Votre recette contenait le ou les aliments suivants : ");
                                        for ($j=0;$j<count($NewFoods[0]);$j++)
                                        {
                                            echo($NewFoods[2][$j]." ");
                                        }
                                        echo("</p>
                                        <p align=center>Aliment(s) : ");
                                        for($j = 0 ; $j < $Menu2 ; $j++ )
                                        {
                                            echo("<select name='food".$j."'>
                                            <option value=''>--Choisissez un aliment--</option>");
                                            for($k = 0 ; $k < count($Foods[0]) ; $k++)
                                            {
                                                if($Foods[0][$k] == $_GET['food'.$j])
                                                {
                                                    echo("<option selected='selected' value=".$Foods[0][$k].">".$Foods[1][$k]."</option>");
                                                }
                                                else
                                                {
                                                    echo("<option value=".$Foods[0][$k].">".$Foods[1][$k]."</option>"); 
                                                }
                                            }                
                                            echo("</select>");
                                            if( ($j+2)%5 == 1)
                                            {
                                                echo("<br><br>");
                                            }
                                        }       
                                        echo("<input type='hidden' name='Menu' value=".$Menu2.">
                                        <input type='hidden' name='Request' value='Modifier'>
                                        <input type='hidden' name='id' value='".$_GET['id']."'>
                                        <input type='submit' class='bouton_1' name='RequestModif' value='+'>");

                                        if( $Menu2 > 1 )
                                        {
                                            echo("
                                            <input type='hidden' name='Request' value='Modifier'>
                                            <input type='submit' class='bouton_1' name='RequestModif' value='-'>");
                                        }

                                        echo("
                                        <p align=center>Date de création : ".$Recipes[2][$i]."</p>
                                        <p align=center>Temps de préparation : <SELECT name='time' size='1'>");
                                        if ($_GET['time']=="00:05:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:05:00'>5min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:05:00'>5min");
                                        }
                                        if ($_GET['time']=="00:10:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:10:00'>10min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:10:00'>10min");
                                        }
                                        if ($_GET['time']=="00:20:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:20:00'>20min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:20:00'>20min");
                                        }
                                        if ($_GET['time']=="00:30:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:30:00'>30min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:30:00'>30min");
                                        }
                                        if ($_GET['time']=="00:45:00")
                                        {
                                            echo("<OPTION selected='selected' value='00:45:00'>45min");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='00:45:00'>45min");
                                        }
                                        if($_GET['time']=="01:00:00")
                                        {
                                            echo("<OPTION selected='selected' value='01:00:00'>1h");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='01:00:00'>1h");
                                        }
                                        if ($_GET['time']=="01:30:00")
                                        {
                                            echo("<OPTION selected='selected' value='01:30:00'>1H30");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='01:30:00'>1H30");
                                        }
                                        if ($_GET['time']=="02:00:00")
                                        {
                                            echo("<OPTION selected='selected' value='02:00:00'>2H");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='02:00:00'>2H");
                                        }
                                        if ($_GET['time']=="03:00:00")
                                        {
                                            echo("<OPTION selected='selected' value='03:00:00'>2H+");
                                        }
                                        else
                                        {
                                            echo("<OPTION value='03:00:00'>2H+");
                                        }
                                        echo("</SELECT></p>
                                        <p align=center>Créer par : ".$Recipes[5][$i]."</p>
                                        Origine de la recette : <select name='origine'>
                                        <option value=''>--Choisissez une origine--</option>");
                                        for($j = 0 ; $j < count($Origines[0]) ; $j++)
                                        {
                                            if($Origines[0][$j] == $Recipes[7][$i])
                                            {
                                                echo("<option selected='selected' value=".$Origines[0][$j].">".$Origines[1][$j]."</option>");
                                            }
                                            else
                                            {
                                                echo("<option value=".$Origines[0][$j].">".$Origines[1][$j]."</option>"); 
                                            }
                                        }                
                                        echo("</select></p>
                                        <p align=center> Description : <br><TEXTAREA name='text' rows=15 cols=90>".$Recipes[1][$i]."</TEXTAREA></p>
                                        <input type='hidden' name='page' value='Recette'>
                                        <br><input type='submit' class='bouton_1' name='RequestModif' value='Confirmation'>
                                        </form>
                                        <form action='Index.php' method='get'>
                                        <input type='hidden' name='page' value='Recette'>");
                                        if(!empty($_GET['Org']))
                                        {
                                            echo"<input type='hidden' name='Request' value='Search'>
                                            <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                        }
                                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                        {
                                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                            ";
                                        }                                        
                                        echo("<input type='submit' class='bouton_1' value='Retour'>
                                        </form>");
                                }
                            }
                        }
                    } 
                    else if ($_GET['RequestModif'] == 'Confirmation')
                    {
                        if (!empty($_GET['name']) 
                        AND !empty($_GET['food0']) 
                        AND !empty($_GET['time'])
                        AND !empty($_GET['origine'])
                        AND !empty($_GET['text'])
                        AND strlen($_GET['name'])<20)
                        {
                            echo("
                            Votre recette est bien modifié !");
                            echo("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Recette'>
                            <input type='hidden' name='succes' value='modifier'>");
                            if(!empty($_GET['Org']))
                            {
                                echo"<input type='hidden' name='Request' value='Search'>
                                <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                            }
                            if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                            {
                                echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                ";
                            }                            
                            echo("<br><input type='submit' class='bouton_1' value='Retour'></form>");
                        }
                        else
                        {//-------------------------------------------------------------------------------
                            for ($i=0;$i<count($Recipes[0]);$i++)
                            {
                                if($i == 0 || $Recipes[6][$i] != $Recipes[6][$i-1])
                                {
                                    if ($Recipes[6][$i]==$_GET['id'])
                                    {
                                        echo("
                                            <form action='Index.php' method='get'>
                                            <p align=center><input type='texte' name='name' value='".$Recipes[0][$i]."'></p>
                                            <p align=center>
                                            Votre recette contenait le ou les aliments suivants : ");
                                            for ($j=0;$j<count($NewFoods[0]);$j++)
                                            {
                                                echo($NewFoods[2][$j]." ");
                                            }
                                            echo("</p>
                                            <p align=center>Aliment(s) : ");
                                            for($j = 0 ; $j < $Menu2 ; $j++ )
                                            {
                                                echo("<select name='food".$j."'>
                                                <option value=''>--Choisissez un aliment--</option>");
                                                for($k = 0 ; $k < count($Foods[0]) ; $k++)
                                                {
                                                    if($Foods[0][$k] == $_GET['food'.$j])
                                                    {
                                                        echo("<option selected='selected' value=".$Foods[0][$k].">".$Foods[1][$k]."</option>");
                                                    }
                                                    else
                                                    {
                                                        echo("<option value=".$Foods[0][$k].">".$Foods[1][$k]."</option>"); 
                                                    }
                                                }                
                                                echo("</select>");
                                                if( ($j+2)%5 == 1)
                                                {
                                                    echo("<br><br>");
                                                }
                                            }       
                                            echo("<input type='hidden' name='Menu' value=".$Menu2.">
                                            <input type='hidden' name='Request' value='Modifier'>
                                            <input type='hidden' name='id' value='".$_GET['id']."'>
                                            <input type='submit' class='bouton_1' name='RequestModif' value='+'>");

                                            if( $Menu2 > 1 )
                                            {
                                                echo("
                                                <input type='hidden' name='Request' value='Modifier'>
                                                <input type='submit' class='bouton_1' name='RequestModif' value='-'>");
                                            }

                                            echo("
                                            <p align=center>Date de création : ".$Recipes[2][$i]."</p>
                                            <p align=center>Temps de préparation : <SELECT name='time' size='1'>");
                                            if ($_GET['time']=="00:05:00")
                                            {
                                                echo("<OPTION selected='selected' value='00:05:00'>5min");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='00:05:00'>5min");
                                            }
                                            if ($_GET['time']=="00:10:00")
                                            {
                                                echo("<OPTION selected='selected' value='00:10:00'>10min");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='00:10:00'>10min");
                                            }
                                            if ($_GET['time']=="00:20:00")
                                            {
                                                echo("<OPTION selected='selected' value='00:20:00'>20min");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='00:20:00'>20min");
                                            }
                                            if ($_GET['time']=="00:30:00")
                                            {
                                                echo("<OPTION selected='selected' value='00:30:00'>30min");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='00:30:00'>30min");
                                            }
                                            if ($_GET['time']=="00:45:00")
                                            {
                                                echo("<OPTION selected='selected' value='00:45:00'>45min");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='00:45:00'>45min");
                                            }
                                            if($_GET['time']=="01:00:00")
                                            {
                                                echo("<OPTION selected='selected' value='01:00:00'>1h");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='01:00:00'>1h");
                                            }
                                            if ($_GET['time']=="01:30:00")
                                            {
                                                echo("<OPTION selected='selected' value='01:30:00'>1H30");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='01:30:00'>1H30");
                                            }
                                            if ($_GET['time']=="02:00:00")
                                            {
                                                echo("<OPTION selected='selected' value='02:00:00'>2H");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='02:00:00'>2H");
                                            }
                                            if ($_GET['time']=="03:00:00")
                                            {
                                                echo("<OPTION selected='selected' value='03:00:00'>2H+");
                                            }
                                            else
                                            {
                                                echo("<OPTION value='03:00:00'>2H+");
                                            }
                                            echo("</SELECT></p>
                                            <p align=center>Créer par : ".$Recipes[5][$i]."</p>
                                            Origine de la recette : <select name='origine'>
                                            <option value=''>--Choisissez une origine--</option>");
                                            for($j = 0 ; $j < count($Origines[0]) ; $j++)
                                            {
                                                if($Origines[0][$j] == $Recipes[7][$i])
                                                {
                                                    echo("<option selected='selected' value=".$Origines[0][$j].">".$Origines[1][$j]."</option>");
                                                }
                                                else
                                                {
                                                    echo("<option value=".$Origines[0][$j].">".$Origines[1][$j]."</option>"); 
                                                }
                                            }                
                                            echo("</select></p>
                                            <p align=center> Description : <br><TEXTAREA name='text' rows=15 cols=90>".$Recipes[1][$i]."</TEXTAREA></p>
                                            <input type='hidden' name='page' value='Recette'>");
                                    }
                                }
                            }

                            if(strlen($_GET['name']) < 3)
                            {
                                echo("<FONT color='red'>Le nom de votre recette est trop petite<br><br></FONT>");
                            }
                            else if(strlen($_GET['name']) > 39)
                            {
                                echo("<FONT color='red'>Le nom de votre recette doit faire moins de 40 caractères</FONT><br><br>");
                            }
                            else if($CheckMenu2 == "double")
                            {
                                echo("<FONT color='red'>Un aliment a été selectionné deux fois ou plus</FONT><br><br>");
                            }
                            else if($CheckMenu2 == "void")
                            {
                                echo("<FONT color='red'>Veuillez séléctionner une valeur dans chacun des formulaires</FONT><br><br>");
                            } 
                            else if (empty($_GET['time']))
                            {
                                echo("<FONT color='red'>Veuillez entrer un temps de préparation à votre recette.</FONT><br><br>");
                            }
                            else if ($_GET['text']<=0)
                            {
                                echo("<FONT color='red'>Veuillez entrer une valeur au moins supérieur à 1 en temps de préparation de votre recette.</FONT><br><br>");
                            }
                            else if (empty($_GET['origine']))
                            {
                                echo("<FONT color='red'>Veuillez entrer une origine à votre recette.</FONT><br><br>");
                            }   
                            else if (empty($_GET['text']))
                            {
                                echo("<FONT color='red'>Veuillez entrer une description de votre recette.</FONT><br><br>");
                            }
                            echo("<br><input type='submit' class='bouton_1' name='RequestModif' value='Confirmation'>
                            </form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Recette'>");
                            if(!empty($_GET['Org']))
                            {
                                echo"<input type='hidden' name='Request' value='Search'>
                                <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                            }
                            if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                            {
                                echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                ";
                            }                            
                            echo("<input type='submit' class='bouton_1' value='Retour'>
                            </form>");
                            
                        }
                    }
                }
                else if ($_GET['Request']=='Supprimer')
                {
                    if (empty($_GET['RequestSupp']))
                    {
                        for ($i=0; $i < count($Recipes[0]);$i++)
                        {
                            if($i == 0 || $Recipes[6][$i] != $Recipes[6][$i-1])
                            {
                                if ($Recipes[6][$i]==$_GET['id'])
                                {
                                    echo("
                                    Voulez-vous vraiment supprimer la recette ".$Recipes[0][$i]." de Plat-In ?
                                    </br></br>
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Recette'>
                                    <input type='hidden' name='Request' value='Supprimer'>
                                    <input type='hidden' name='id' value='".$_GET['id']."'>
                                    <input type='submit' class='bouton_1' name='RequestSupp' value='Oui'>
                                    </form>
                                    </br>
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Recette'>");
                                    if(!empty($_GET['Org']))
                                    {
                                        echo"<input type='hidden' name='Request' value='Search'>
                                        <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                                    }
                                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                                    {
                                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                                        ";
                                    }                                    
                                    echo("<input type='submit' class='bouton_1' value='Retour'>
                                    </form>");
                                }
                            }
                        }
                    }
                    else if ($_GET['RequestSupp']=='Oui')
                    {
                        echo("
                        Vous avez bien supprimé votre recette 
                        <br>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>");
                        if(!empty($_GET['Org']))
                        {
                            echo"<input type='hidden' name='Request' value='Search'>
                            <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                        }
                        if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                        {
                            echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                            <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                            <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                            ";
                        }                        
                        echo("<input type='submit' class='bouton_1' value='Retour'>
                        </form>");
                    }
                }
                else if($_GET['Request']=='Filtre')
                {
                    echo"
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    Origine : <select name='Filtre0'>
                    <option value=''>Toutes</option>";
                    for($i = 0 ; $i < count($MenuFiltre[0]) ; $i++)
                    {
                        echo("<option value=".$MenuFiltre[0][$i].">".$MenuFiltre[1][$i]."</option>"); 
                    } 
                    echo"</select><br><br>aliment : <select name='Filtre1'>
                    <option value=''>Tous</option>";
                    for($i = 0 ; $i < count($MenuFiltre[2]) ; $i++)
                    {
                        echo("<option value=".$MenuFiltre[2][$i].">".$MenuFiltre[3][$i]."</option>"); 
                    } 
                    echo"</select><br><br>catégorie alimentaire : <select name='Filtre2'>
                    <option value=''>Toutes</option>";
                    for($i = 0 ; $i < count($MenuFiltre[4]) ; $i++)
                    {
                        echo("<option value=".$MenuFiltre[4][$i].">".$MenuFiltre[5][$i]."</option>"); 
                    }

                    echo"</select>
                    <br><br> 
                    <input type='submit' class='bouton_1' value='Ajouter ces filtres'>
                    </form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>";
                    if(!empty($_GET['Org']))
                    {
                        echo"<input type='hidden' name='Request' value='Search'>
                        <input type='hidden' name='Org' value='".$_GET['Org']."'>";
                    }
                    if(!empty($_GET['Filtre0']) || !empty($_GET['Filtre1']) || !empty($_GET['Filtre2']))
                    {
                        echo"<input type='hidden' name='Filtre0' value='".$_GET['Filtre0']."'>
                        <input type='hidden' name='Filtre1' value='".$_GET['Filtre1']."'>
                        <input type='hidden' name='Filtre2' value='".$_GET['Filtre2']."'>
                        ";
                    }                    
                    echo"<input type='submit' class='bouton_1' value='Retour'>
                    ";
                }
            }
        
        ?>
    </body>
</html>