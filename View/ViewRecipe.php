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
                    <table border");
                    for ($i=0;$i<count($Recipes[0]);$i++)
                    {
                        echo("<tr><td><p>Nom de la recette </td><td>".$Recipes[0][$i]." 
                        <input type='submit' name='Request' value='Supprimer'></td></tr></p>");
                    }
                    echo("</table></form>");
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
                    echo("<input type='hidden' name='Menu' value=".$Menu.">
                    <input type='submit' name='Request' value='+'>");

                    if( $Menu > 1 )
                    {
                        echo("<input type='submit' name='Request' value='-'>");
                    }

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
                    if (empty($_GET['name']) 
                    OR empty($_GET['food0']) 
                    OR empty($_GET['time'])
                    OR empty($_GET['origine']) OR $CheckForm!=0)
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
                        echo("<input type='hidden' name='Menu' value=".$Menu.">
                        <input type='submit' name='Request' value='+'>");

                        if( $Menu > 1 )
                        {
                            echo("<input type='submit' name='Request' value='-'>");
                        }

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
                        else if (empty($_GET['origine']))
                        {
                            echo("<FONT color='red'>Veuillez entrer une origine à votre recette.</FONT><br><br>");
                        }
                        
                        echo("<br><input type='submit' name='Request'value='Valider'></form>");


                        echo("<p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <br><input type='submit' value='Retour'></form>");
                        }
                    else
                    {
                        echo("<div class='text-center mt-5'>
                        Votre recette est maintenant en ligne !");
                        echo("<p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Recette'>
                        <input type='hidden' name='succes' value='reussi'>
                        <br><input type='submit' value='Retour'></form>");
                    }
                }
            }
        
        ?>
    </body>
</html>