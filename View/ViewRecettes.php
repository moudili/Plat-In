<?php

require("View/ViewBanner.php");
?>
<html>
    <head>
        <title>Gérer les recettes</title>
        <link rel="stylesheet" href="Css/Bootstrap/PersonalCss.css">
        <link rel="stylesheet" href="Css/Bootstrap/background.css">
        <style> 
        .rating {
			width: 226px;
			margin: 0 auto 1em;
			font-size: 45px;
			overflow:hidden;
		}
        .rating input {
        float: right;
        opacity: 0;
        position: absolute;
        }
                .rating a,
            .rating label {
                    float:right;
                    color: #aaa;
                    text-decoration: none;
                    -webkit-transition: color .4s;
                    -moz-transition: color .4s;
                    -o-transition: color .4s;
                    transition: color .4s;
                }
        .rating label:hover ~ label,
        .rating input:focus ~ label,
        .rating label:hover,
                .rating a:hover,
                .rating a:hover ~ a,
                .rating a:focus,
                .rating a:focus ~ a		{
                    color: orange;
                    cursor: pointer;
                }
                .rating2 {
                    direction: rtl;
                }
                .rating2 a {
                    float:none
                }
                body{
                text-align: center;
                }
        </style>
    </head>
    
    <body class='backgroundhat center'>
        <div class='arriereprofil'>
            <div class="profil">
        <?php
            if (empty($_GET['Request']))
            {
                echo("
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='Menu' value=1>
                    <input type='submit' class='bouton_1' name='Request' value='Ajouter une recette'>
                    </br></br>
                    <input type='hidden' name='page' value='Recettes'>
                    </form>
                    <table border=4 align='center'>
                    Recettes<br><br>");
                for ($i=0;$i<count($Recipes[0]);$i++)
                {
                    if ($Note[$i]>0 AND $Note[$i]<=5)
                                    {
                                        $Note[$i]=round($Note[$i], 1);
                                        echo("<form action='Index.php' method='get'>
                                        <tr><td><p>".$Recipes[0][$i]."</p>
                                        <p>Créer par : ".$Recipes[5][$i]."</p>
                                        <p>Note des utilisateurs : ".$Note[$i]."/5</p></td>
                                        <td><input type='submit' class='bouton_1' name='Request' value='Afficher'></br>
                                        <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                                        <input type='hidden' name='page' value='Recettes'>
                                        <input type='submit' class='bouton_1' name='Request' value='Modifier'>
                                        <input type='hidden' name='Menu' value=1>
                                        <input type='submit' class='bouton_1' name='Request' value='Supprimer'></td></tr>
                                        </form>");   
                                    }
                                    else
                                    {
                                        echo("<form action='Index.php' method='get'>
                                        <tr><td><p>".$Recipes[0][$i]."</p>
                                        <p>Créer par : ".$Recipes[5][$i]."</p>
                                        <p>Note des utilisateurs : ".$Note[$i]."</p></td>
                                        <td><input type='submit' class='bouton_1' name='Request' value='Afficher'></br>
                                        <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                                        <input type='hidden' name='page' value='Recettes'>
                                        <input type='submit' class='bouton_1' name='Request' value='Modifier'>
                                        <input type='hidden' name='Menu' value=1>
                                        <input type='submit' class='bouton_1' name='Request' value='Supprimer'></td></tr>
                                        </form>");
                                    }
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
                            <form action='Index.php' method='get'>
                            <p align=center>".$Recipes[0][$i]."</p>
                            <p align=center>Date de création : ".$Recipes[2][$i]."</p>
                            <p align=center>Temps de préparation : ".$Recipes[3][$i]."</p>
                            <p align=center>Créer par : ".$Recipes[5][$i]."</p>");
                            echo(nl2br("<p align=center> Description : <br/><br/>".$Recipes[1][$i]."</p>
                            <input type='hidden' name='page' value='Recettes'>
                            <input type='hidden' name='id' value='".$_GET['id']."'>
                            <br>
                            <input type='hidden' name='Request' value='Afficher'>
                            <input type='submit' class='bouton_1' name='RequestReview'value='Donner une note'>
                            </form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Recettes'>
                            <input type='submit' class='bouton_1' value='Retour'>
                            </form>"));
                            } 
                        }
                    }
                }
                else if ($_GET['RequestReview']=='Donner une note')
                {
                    echo("
                    Merci de rentrer votre note pour cette recette.
                    <form action='Index.php' method='get'>
                    <div class='rating'>
                    <input name='stars' id='e5' type='radio' value='5'></a><label for='e5'>☆</label>
                    <input name='stars' id='e4' type='radio' value='4'></a><label for='e4'>☆</label>
                    <input name='stars' id='e3' type='radio' value='3'></a><label for='e3'>☆</label>
                    <input name='stars' id='e2' type='radio' value='2'></a><label for='e2'>☆</label>
                    <input name='stars' id='e1' type='radio' value='1'></a><label for='e1'>☆</label>
                    </div>
                    <input type='hidden' name='page' value='Recettes'>
                    <input type='hidden' name='Request' value='Afficher'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='submit' class='bouton_1' name='RequestReview' value='Valider'>
                    </form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recettes'>
                    <input type='hidden' name='Request' value='Afficher'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='submit' class='bouton_1' value='Retour'>
                    </form>");
                }
                else if ($_GET['RequestReview']=='Valider' AND !empty($_GET['stars']))
                {
                    echo("
                    Nous avons bien enregistrer votre note
                    </br></br>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recettes'>
                    <input type='hidden' name='Request' value='Afficher'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='submit' class='bouton_1' value='Retour'>
                    </form>");
                }
                else if ($_GET['RequestReview']=='Valider' AND empty($_GET['stars']))
                {
                    echo("
                    Merci de rentrer votre note pour cette recette.
                    <form action='Index.php' method='get'>
                    <div class='rating'>
                    <input name='stars' id='e5' type='radio' value='5'></a><label for='e5'>☆</label>
                    <input name='stars' id='e4' type='radio' value='4'></a><label for='e4'>☆</label>
                    <input name='stars' id='e3' type='radio' value='3'></a><label for='e3'>☆</label>
                    <input name='stars' id='e2' type='radio' value='2'></a><label for='e2'>☆</label>
                    <input name='stars' id='e1' type='radio' value='1'></a><label for='e1'>☆</label>
                    </div>
                    <input type='hidden' name='page' value='Recettes'>
                    <input type='hidden' name='Request' value='Afficher'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='submit' class='bouton_1' name='RequestReview' value='Valider'>
                    </form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recettes'>
                    <input type='hidden' name='Request' value='Afficher'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='submit' class='bouton_1' value='Retour'>
                    </form>");
                }
            }
            else if ($_GET['Request']=='Modifier')
            {
                if (empty($_GET['RequestModif']))
                    {
                        for ($i=0;$i<count($Recipes[0]);$i++)
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
                                    
                                        echo("<select class='text_1'name='food0'>
                                        <option value=''>--Choisissez un aliment--</option>");
                                        for($k = 0 ; $k < count($Foods[0]) ; $k++)
                                        {
                                            echo("<option value=".$Foods[0][$k].">".$Foods[1][$k]."</option>"); 
                                        }                
                                        echo("</select>");
                                    echo("<input type='hidden' name='Menu' value=".$Menu2.">
                                    <input type='hidden' name='page' value='Recettes'>
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
                                    <p align=center>Temps de préparation : <SELECT class='text_1'name='time' size='1'>");
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
                                        echo("<OPTION value='01:00:00'>1h");
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
                                    Origine de la recette : <select class='text_1'name='origine'>
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
                                    <p align=center> Description : <TEXTAREA name='text' class='text_1'rows=15 cols=90>".$Recipes[1][$i]."</TEXTAREA></p>
                                    <br><input type='submit' class='bouton_1' name='RequestModif' value='Confirmation'>
                                    </form>
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Recettes'>
                                    <input type='submit' class='bouton_1' value='Retour'>
                                    </form>");
                            }
                        }
                    }
                    else if ($_GET['RequestModif'] == "+"
                    || $_GET['RequestModif'] == "-")
                    {
                        for ($i=0;$i<count($Recipes[0]);$i++)
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
                                        echo("<select class='text_1'name='food".$j."'>
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
                                    <p align=center>Temps de préparation : <SELECT class='text_1'name='time' size='1'>");
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
                                    Origine de la recette : <select class='text_1'name='origine'>
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
                                    <p align=center> Description : <TEXTAREA name='text' class='text_1'rows=15 cols=90>".$Recipes[1][$i]."</TEXTAREA></p>
                                    <input type='hidden' name='page' value='Recettes'>
                                    <br><input type='submit' class='bouton_1' name='RequestModif' value='Confirmation'>
                                    </form>
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Recettes'>
                                    <input type='submit' class='bouton_1' value='Retour'>
                                    </form>");
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
                            <input type='hidden' name='page' value='Recettes'>
                            <input type='hidden' name='succes' value='modifier'>
                            <br><input type='submit' class='bouton_1' value='Retour'></form>");
                        }
                        else
                        {
                            for ($i=0;$i<count($Recipes[0]);$i++)
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
                                            echo("<select class='text_1'name='food".$j."'>
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
                                        <p align=center>Temps de préparation : <SELECT class='text_1'name='time' size='1'>");
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
                                        Origine de la recette : <select class='text_1'name='origine'>
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
                                        <p align=center> Description : <TEXTAREA name='text' class='text_1'rows=15 cols=90>".$Recipes[1][$i]."</TEXTAREA></p>
                                        <input type='hidden' name='page' value='Recettes'>");
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
                            <input type='hidden' name='page' value='Recettes'>
                            <input type='submit' class='bouton_1' value='Retour'>
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
                        if ($Recipes[6][$i]==$_GET['id'])
                        {
                            echo("
                            Voulez-vous vraiment supprimer la recette ".$Recipes[0][$i]." de Plat-In ?
                            </br></br>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Recettes'>
                            <input type='hidden' name='Request' value='Supprimer'>
                            <input type='hidden' name='id' value='".$_GET['id']."'>
                            <input type='submit' class='bouton_1' name='RequestSupp' value='Oui'>
                            </form>
                            </br>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Recettes'>
                            <input type='submit' class='bouton_1' value='Retour'>
                            </form>");
                        }
                    }
                }
                else if ($_GET['RequestSupp']=='Oui')
                {
                    echo("
                    Vous avez bien supprimé votre recette 
                    <br>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recettes'>
                    <input type='submit' class='bouton_1' value='Retour'>
                    </form>");
                }
            }
            else if ($_GET['Request']=='Ajouter une recette')
            {
                echo("
                <p>Créer une recette</p>
                <form action='Index.php' method='get'>
                <p>image : <input id='get_compte' type='text' class='text_1'class='text_1'name='img' value=''></p>
                <p> Nom de la recette : <input id='get_compte' type='text' class='text_1'class='text_1'name='name' value=''></p>
                <p> Aliments : <select class='text_1'name='food0'>
                <option value=''>--Choisissez un aliment--</option>");
                for($i = 0 ; $i < count($Foods[0]) ; $i++)
                {
                    echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>"); 
                }                
                echo("</select> <input type='submit' class='bouton_1' name='Request' value='+'></p></p>
                <input type='hidden' name='Menu' value=".$_GET['Menu'].">
                <p> Temps de préparation : <SELECT class='text_1'name='time' size='1'>
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
                <p>Origine de la recette : <select class='text_1'name='origine'>
                <option value=''>--Choisissez une origine--</option>");
                for($i = 0 ; $i < count($Origines[0]) ; $i++)
                {
                    echo("<option value=".$Origines[0][$i].">".$Origines[1][$i]."</option>"); 
                }                
                echo("</select></p>

                
                <p> Recette : <br><TEXTAREA class='text_1'name='text' rows=15 cols=90></TEXTAREA></p>
                <p>
                <input type='hidden' name='page' value='Recettes'>
                <br><input type='submit' class='bouton_1' name='Request'value='Valider'></form>");

                echo("<p><form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Recettes'>
                <br><input type='submit' class='bouton_1' value='Retour'></form>");
            } 
            else if ($_GET['Request'] == "+"
            || $_GET['Request'] == "-")
            {
                echo("
                <p>Créer une recette</p>
                <form action='Index.php' method='get'>
                <p>image : <input id='get_compte' type='text' class='text_1'class='text_1'name='img' value='".$_GET['img']."'></p>
                <p> Nom de la recette : <input id='get_compte' type='text' class='text_1'class='text_1'name='name' value='".$_GET['name']."'></p>
                <p> Aliments : ");

                for($j = 0 ; $j < $Menu ; $j++ )
                {
                    echo("<select class='text_1'name='food".$j."'>
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
                <p> Temps de préparation : <SELECT class='text_1'name='time' size='1'>");
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
                    echo("<OPTION value='00:30:00'>30");
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
                <p>Origine de la recette : <select class='text_1'name='origine'>
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

                
                <p> Recette : <br><TEXTAREA class='text_1'name='text' rows=15 cols=90></TEXTAREA></p>
                <p>
                <input type='hidden' name='page' value='Recettes'>
                <br><input type='submit' class='bouton_1' name='Request'value='Valider'></form>");

                echo("<p><form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Recettes'>
                <br><input type='submit' class='bouton_1' value='Retour'></form>");
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
                    <input type='hidden' name='succes' value='reussi'>
                    <br><input type='submit' class='bouton_1' value='Retour'></form>");
                }
                else
                {
                    echo("
                    Votre recette n'as pas pu être mise en ligne !<br></br>");

                    echo("
                    
                    <form action='Index.php' method='get'>
                    <p>image : <input id='get_compte' type='text' class='text_1'class='text_1'name='img' value='".$_GET['img']."'></p>
                    <p> Nom de la recette : <input id='get_compte' type='text' class='text_1'class='text_1'name='name' value='".$_GET['name']."'></p>
                    <p> Aliments : ");

                    for($j = 0 ; $j < $Menu ; $j++ )
                    {
                        echo("<select class='text_1'name='food".$j."'>
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
                    <p> Temps de préparation : <SELECT class='text_1'name='time' size='1'>");
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
                        echo("<OPTION value='00:30:00'>30");
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
                    <p>Origine de la recette : <select class='text_1'name='origine'>
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
                    <p> Recette : <br><TEXTAREA class='text_1'name='text' rows=15 cols=90</TEXTAREA></p>
                    <p>
                    <input type='hidden' name='page' value='Recettes'>");

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
                    <input type='hidden' name='page' value='Recettes'>
                    <br><input type='submit' class='bouton_1' value='Retour'></form>");
                }
            }

        ?>
    </body>
</html>