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
                <input type='submit' name='Request' value='Ajouter une recette'>
                <input type='hidden' name='Menu' value=1>
                <input type='hidden' name='page' value='Recette'>
                </form>");
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
                    <p>image : <input id='get_compte' type='text' name='img' value=''></p>
                    <p> Nom de la recette : <input id='get_compte' type='text' name='name' value=''></p>
                    <p> Aliments : ");

                    for($j = 0 ; $j < $Menu ; $j++ )
                    {
                        echo("<select name='food".$j."'>
                        <option value=''>--Choisissez un aliment--</option>");
                        for($i = 0 ; $i < count($Foods[0]) ; $i++)
                        {
                            echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>"); 
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
                else if ($_GET['Request']=='Valider' AND $CheckForm==0)
                {
                    echo("<div class='text-center mt-5'>
                    Votre recette est maintenant en ligne !");
                    echo("<p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Recette'>
                    <br><input type='submit' value='Retour'></form>");
                }
                else if ($CheckForm!=0 
                OR empty($_GET['name']) 
                OR empty($_GET['food']) 
                OR empty($_GET['time'])
                OR empty($_GET['origine'])
                OR empty($_GET['text']) AND $_GET['Request']=='Valider')
                {
                    echo("<div class='text-center mt-5'>
                    Votre recette n'as pas pu être mise en ligne !<br></br>");

                    echo("
                    <form action='Index.php' method='get'>
                    <p>image : <input id='get_compte' type='text' name='img' value=''></p>
                    <p> Nom de la recette : <input id='get_compte' type='text' name='name' value=''></p>
                    <p> Aliments : <select name='food'>
                    <option value=''>--Choisissez un aliment--</option>");
                        for($i = 0 ; $i < count($Foods[0]) ; $i++)
                        {
                            echo("<option value=".$Foods[0][$i].">".$Foods[1][$i]."</option>"); 
                        }                
                    echo("</select></p>
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
            }
        
        ?>
    </body>
</html>