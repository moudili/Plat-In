<html>
    <head>
        <title>Recette</title>
    </head>
    
    <body>
        <?php
             
            require("View/ViewBanner.php"); 


            if ($_SESSION['Co']==false)
            {
                echo("<div class='text-center mt-5'>
                Veuillez vous <a href='Index.php?page=Inscription'> inscrire</a> ou 
                vous <a href='Index.php?page=Connexion'> connecter</a> pour ajouter des recettes");
                echo("<div class='text-center mt-5'>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='Menu' value=1>
                    <input type='submit' name='Request' value='Ajouter une recette'>
                    </br></br>
                    <input type='hidden' name='page' value='Recette'>
                    <table border=4 align='center'>
                    <p>Recettes");
                    for ($i=0;$i<count($Recipes[0]);$i++)
                    {
                        echo("<tr><td><p>".$Recipes[0][$i]."</p>
                        <p>Créer par : ".$Recipes[5][$i]."</td>
                        </tr></p>");
                    }
                    echo("</table></form>");   
            } 
            else if ($_SESSION['Co']!=false)
            {
                if (empty($_GET['Request']))
                {
                    echo("<div class='text-center mt-5'>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='Menu' value=1>
                    <input type='submit' name='Request' value='Ajouter une recette'>
                    </br></br>
                    <input type='hidden' name='page' value='Recette'>
                    </form>
                    <table border=4 align='center'>
                    <p>Recettes");
                    for ($i=0;$i<count($Recipes[0]);$i++)
                    {
                        if ($Recipes[4][$i]==$_SESSION['id'])
                        {
                            echo("<form action='Index.php' method='get'>
                            <tr><td><p>".$Recipes[0][$i]."</p>
                            <p>Créer par : ".$Recipes[5][$i]."</td>
                            <td><input type='submit' name='Request' value='Afficher'></br>
                            <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                            <input type='hidden' name='page' value='Recette'>
                            <input type='submit' name='Request' value='Modifier'>
                            <input type='hidden' name='Menu' value=1>
                            <input type='submit' name='Request' value='Supprimer'></td></tr></p>
                            </form>");   
                        } 
                        else 
                        {
                            echo("<form action='Index.php' method='get'>
                            <tr><td><p>".$Recipes[0][$i]."</p>
                            <p>Créer par : ".$Recipes[5][$i]."</td>
                            <td><input type='submit' name='Request' value='Afficher'>
                            <input type='hidden' name='id' value='".$Recipes[6][$i]."'>
                            <input type='hidden' name='page' value='Recette'></td></tr></p>
                            </form>");
                        }
                    }
                    echo("</table>");
                } 
                else if ($_GET['Request']=='Ajouter une recette')
                {
                    echo("<div class='text-center mt-5'>
                    <p>Créer une recette</p>
                    <form action='Index.php' method='get'>
                    <p>image : <input id='get_compte' type='text' name='img' value=''></p>
                    <p> Nom de la recette : <input id='get_compte' type='text' name='name' value=''></p>
                    <p> Aliments : <select name='food0'>
                    <option value=''>--Choisissez un aliment--</option>");
                        for($i = 0 ; $i < count($Foods[0]) ; $i++)
                        {
                            echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>"); 
                        }                
                    echo("</select> <input type='submit' name='Request' value='+'></p></p>
                    <input type='hidden' name='Menu' value=".$_GET['Menu'].">
                    <p> Temps de préparation : <input id='get_compte' type='number' name='time' value='' min=1></p>

                    <p>Origine de la recette : <select name='origine'>
                            <option value=''>--Choisissez une origine--</option>");
                            for($i = 0 ; $i < count($Origines[0]) ; $i++)
                            {
                                echo("<option value=".$Origines[0][$i].">".$Origines[1][$i]."</option>"); 
                            }                
                            echo("</select></p>

                    
                    <p> Recette : <br><TEXTAREA name='text' rows=4 cols=40></TEXTAREA></p>
                    <p>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' name='Request'value='Valider'></form>");

                    echo("<p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' value='Retour'></form>");
                } 
                else if ($_GET['Request'] == "+"
                || $_GET['Request'] == "-")
                {
                    echo("<div class='text-center mt-5'>
                    <p>Créer une recette</p>
                    <form action='Index.php' method='get'>
                    <p>image : <input id='get_compte' type='text' name='img' value='".$_GET['img']."'></p>
                    <p> Nom de la recette : <input id='get_compte' type='text' name='name' value='".$_GET['name']."'></p>
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
                        echo("<input type='submit' name='Request' value='-'>");
                    }

                    echo("<input type='hidden' name='Menu' value=".$Menu.">
                    <input type='submit' name='Request' value='+'>");



                    echo("</p></p>
                    <p> Temps de préparation : <input id='get_compte' type='number' name='time' value='".$_GET['time']."' min=1></p>

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

                    
                    <p> Recette : <br><TEXTAREA name='text' rows=4 cols=40></TEXTAREA></p>
                    <p>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' name='Request'value='Valider'></form>");

                    echo("<p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' value='Retour'></form>");
                }
                else if ($_GET['Request']=='Valider')
                {
                    if (!empty($_GET['name']) 
                    AND !empty($_GET['food0']) 
                    AND !empty($_GET['time'])
                    AND !empty($_GET['origine'])
                    AND !empty($_GET['text'])
                    AND $_GET['time']>=1)
                    {
                        echo("<div class='text-center mt-5'>
                        Votre recette est maintenant en ligne !");
                        echo("<p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='succes' value='reussi'>
                        <br><input type='submit' value='Retour'></form>");
                    }
                    else
                    {
                        echo("<div class='text-center mt-5'>
                        Votre recette n'as pas pu être mise en ligne !<br></br>");

                        echo("<div class='text-center mt-5'>
                        
                        <form action='Index.php' method='get'>
                        <p>image : <input id='get_compte' type='text' name='img' value='".$_GET['img']."'></p>
                        <p> Nom de la recette : <input id='get_compte' type='text' name='name' value='".$_GET['name']."'></p>
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
                            echo("<input type='submit' name='Request' value='-'>");
                        }
                        
                        echo("<input type='hidden' name='Menu' value=".$Menu.">
                        <input type='submit' name='Request' value='+'>");



                        echo("</p></p>
                        <p> Temps de préparation : <input id='get_compte' type='number' name='time' value='".$_GET['time']."' min=1></p>
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
                        <p> Recette : <br><TEXTAREA name='text' rows=4 cols=40></TEXTAREA></p>
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
                        else if ($CheckForm!=0)
                        {
                            echo("<FONT color='red'>Le nom de votre recette existe déja</FONT><br><br>");
                        }
                        else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['name']))
                        {
                            echo("<FONT color='red'>Ce nom de recette est incorrecte</FONT><br><br>");
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
                        echo("<br><input type='submit' name='Request'value='Valider'></form>");
                        echo("<p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <br><input type='submit' value='Retour'></form>");
                    }
                }
                else if ($_GET['Request']=='Afficher')
                {
                    for ($i=0;$i<count($Recipes[0]);$i++)
                    {
                        if ($Recipes[6][$i]==$_GET['id'])
                        {
                            echo("<div class='text-center mt-5'>
                            <form action='Index.php' method='get'>
                            <p align=center>".$Recipes[0][$i]."</p>
                            <p align=center>Date de création : ".$Recipes[2][$i]."</p>
                            <p align=center>Temps de préparation : ".$Recipes[3][$i]."</p>
                            <p align=center>Créer par : ".$Recipes[5][$i]."</p>
                            <p align=center> Description : ".$Recipes[1][$i]."</p>
                            <input type='hidden' name='page' value='Recette'>
                            <br><input type='submit' value='Retour'>
                            </form>");
                        } 
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
                                echo("<div class='text-center mt-5'>
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
                                    <input type='submit' name='RequestModif' value='+'>");

                                    if( $Menu2 > 1 )
                                    {
                                        echo("
                                        <input type='submit' name='RequestModif' value='-'>");
                                    }

                                    echo("
                                    <p align=center>Date de création : ".$Recipes[2][$i]."</p>
                                    <p align=center>Temps de préparation : <input type='number' name='time' value='".$Recipes[3][$i]."'></p>
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
                                    <p align=center> Description : <TEXTAREA name='text' rows=4 cols=40>".$Recipes[1][$i]."</TEXTAREA></p>
                                    <br><input type='submit' name='RequestModif' value='Confirmation'>
                                    </form>
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Recette'>
                                    <input type='submit' value='Retour'>
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
                                echo("<div class='text-center mt-5'>
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
                                    <input type='submit' name='RequestModif' value='+'>");

                                    if( $Menu2 > 1 )
                                    {
                                        echo("
                                        <input type='hidden' name='Request' value='Modifier'>
                                        <input type='submit' name='RequestModif' value='-'>");
                                    }

                                    echo("
                                    <p align=center>Date de création : ".$Recipes[2][$i]."</p>
                                    <p align=center>Temps de préparation : <input type='number' name='time' value='".$Recipes[3][$i]."'></p>
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
                                    <p align=center> Description : <TEXTAREA name='text' rows=4 cols=40>".$Recipes[1][$i]."</TEXTAREA></p>
                                    <input type='hidden' name='page' value='Recette'>
                                    <br><input type='submit' name='RequestModif' value='Confirmation'>
                                    </form>
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Recette'>
                                    <input type='submit' value='Retour'>
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
                        AND $_GET['time']>=1)
                        {
                            echo("<div class='text-center mt-5'>
                            Votre recette est bien modifié !");
                            echo("<p><form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Recette'>
                            <input type='hidden' name='succes' value='modifier'>
                            <br><input type='submit' value='Retour'></form>");
                        }
                        else
                        {
                            for ($i=0;$i<count($Recipes[0]);$i++)
                            {
                                if ($Recipes[6][$i]==$_GET['id'])
                                {
                                    echo("<div class='text-center mt-5'>
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
                                        <input type='submit' name='RequestModif' value='+'>");

                                        if( $Menu2 > 1 )
                                        {
                                            echo("
                                            <input type='hidden' name='Request' value='Modifier'>
                                            <input type='submit' name='RequestModif' value='-'>");
                                        }

                                        echo("
                                        <p align=center>Date de création : ".$Recipes[2][$i]."</p>
                                        <p align=center>Temps de préparation : <input type='number' name='time' value='".$Recipes[3][$i]."'></p>
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
                                        <p align=center> Description : <TEXTAREA name='text' rows=4 cols=40>".$Recipes[1][$i]."</TEXTAREA></p>
                                        <input type='hidden' name='page' value='Recette'>");
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
                            else if ($CheckForm!=0)
                            {
                                echo("<FONT color='red'>Le nom de votre recette existe déja</FONT><br><br>");
                            }
                            else if(!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['name']))
                            {
                                echo("<FONT color='red'>Ce nom de recette est incorrecte</FONT><br><br>");
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
                            echo("<br><input type='submit' name='RequestModif' value='Confirmation'>
                            </form>
                            <form action='Index.php' method='get'>
                            <input type='hidden' name='page' value='Recette'>
                            <input type='submit' value='Retour'>
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
                                echo("<div class='text-center mt-5'>
                                Voulez-vous vraiment supprimer la recette ".$Recipes[0][$i]." de Plat-In ?
                                </br></br>
                                <form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Recette'>
                                <input type='hidden' name='Request' value='Supprimer'>
                                <input type='hidden' name='id' value='".$_GET['id']."'>
                                <input type='submit' name='RequestSupp' value='Oui'>
                                </form>
                                </br>
                                <form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Recette'>
                                <input type='submit' value='Retour'>
                                </form>");
                            }
                        }
                    }
                    else if ($_GET['RequestSupp']=='Oui')
                    {
                        echo("<div class='text-center mt-5'>
                        Vous avez bien supprimé votre recette 
                        <br>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='submit' value='Retour'>
                        </form>");
                    }
                }
            }
        
        ?>
    </body>
</html>