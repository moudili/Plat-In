<html>
    <head>
        <link rel="stylesheet" href="Css\ErrorChamp.css">
        <title>Evènement</title>
    </head>
    
    <body>
        <?php
             
            require("View/ViewBanner.php");     
        
            if (empty($_GET['event']))
            {
                if ($Events==array())
                {
                    echo("<div class='text-center mt-5'>
                    Pas d'évènement créé<br></br>
                    Venez vite en créer ci-dessous !<br></br>
                    <form action='Index.php' method='get'>
                        <input type='submit' name='event' value='Ajouter un evenement'>
                        <input type='hidden' name='MenuRecipe' value=1>
                        <input type='hidden' name='MenuUser' value=1>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    </div>");
                }
                else
                {
                    echo("<div class='text-center mt-5'>
                    <form action='Index.php' method='get'>
                        <input type='submit' name='event' value='Ajouter un evenement'>
                        <input type='hidden' name='MenuRecipe' value=1>
                        <input type='hidden' name='MenuUser' value=1>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <p>Evenement :</p>
                    ");
                    for ($i=0;$i<count($Events);$i++)
                    {
                        echo($Events[$i]."<br><br>");
                    }
                }
            }
            else if ($_GET['event']=='Ajouter un evenement')
            {
                if (empty($_GET['Request']) AND empty($_GET['RequestRecipe']) AND empty($_GET['RequestUser']))
                {
                    echo("<div class='text-center mt-5'>
                    <form action='Index.php' method='get'>
                    <h2>Ajouter un évènement</h2>
                    <br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value=''></p>
                    <p>Personne à inviter à cette évènement : 
                    <select name='utilisateur0'>");
                    for ($i=0;$i<count($Users[0]);$i++)
                    {
                        echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]."</option><br>");
                    }
                    echo("</select>
                    <br>
                    <input type='hidden' name='MenuUser' value='".$_GET['MenuUser']."'>
                    <input type='submit' name='RequestUser' value='+'>
                    </p>
                    <p>Recette disponible : 
                    <select name='recette0'>
                    ");
                    for ($i=0;$i<count($Recipes[0]);$i++)
                    {
                        echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                    }
                    echo("</select></p>
                    <p>Ceci est <select name='service0'>
                    <option value='entrée'>une entrée</option>
                    <option value='plat'>un plat</option>
                    <option value='dessert'>un dessert</option>
                    </select></p>
                    <input type='hidden' name='MenuRecipe' value='".$_GET['MenuRecipe']."'>
                    <p><input type='submit' name='RequestRecipe' value='+'></p>
                    <p><input type='date' name='date'><input type='time' name='time'></p>
                    <p><TEXTAREA name='description' rows=4 cols=40></TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Ajouter un evenement'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    </div>");
                }
                else if (!empty($_GET['RequestRecipe']) AND ($_GET['RequestRecipe'] == "+"
                || $_GET['RequestRecipe'] == "-"))
                {
                    echo("<div class='text-center mt-5'>
                    <form action='Index.php' method='get'>
                    <h2>Ajouter un évènement</h2>
                    <br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>
                    <p>");
                    for($j = 0 ; $j < $_GET['MenuUser'] ; $j++ )
                    {
                        echo("Personne à inviter à cette évènement : 
                        <select name='utilisateur0'>");
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]."</option>");
                        }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$_GET['MenuUser']."'>
                    </p><input type='submit' name='RequestUser' value='+'>");
                    
                    if($_GET['MenuUser'] > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    echo("</p>
                    <p>
                    ");
                    for($j = 0 ; $j < $MenuRecipe ; $j++ )
                    {
                        echo("Recette disponible : ");
                        echo("<select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>
                        <option value='entrée'>une entrée</option>
                        <option value='plat'>un plat</option>
                        <option value='dessert'>un dessert</option>
                        </select></p>
                        ");
                    }
                    echo("
                    <input type='hidden' name='MenuRecipe' value=".$MenuRecipe.">
                    <p><input type='submit' name='RequestRecipe' value='+'>");

                    if( $MenuRecipe > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("</p>
                    <p><input type='date' name='date'><input type='time' name='time'></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Ajouter un evenement'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    </div>");
                }
                else if (!empty($_GET['RequestUser']) AND ($_GET['RequestUser'] == "+"
                OR $_GET['RequestUser'] == "-"))
                {
                    echo("<div class='text-center mt-5'>
                    <form action='Index.php' method='get'>
                    <h2>Ajouter un évènement</h2>
                    <br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>
                    <p>");
                    for($j = 0 ; $j < $MenuUser ; $j++ )
                    {
                        echo("Personne à inviter à cette évènement : 
                        <select name='utilisateur0'>");
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]."</option>");
                        }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$MenuUser."'>
                    <input type='submit' name='RequestUser' value='+'>");
                    
                    if( $MenuUser > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    echo("</p>");
                    for($j = 0 ; $j < $_GET['MenuRecipe'] ; $j++ )
                    {
                        echo("Recette disponible : ");
                        echo("<p><select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>
                        <option value='entrée'>une entrée</option>
                        <option value='plat'>un plat</option>
                        <option value='dessert'>un dessert</option>
                        </select></p>
                        ");
                    }
                    echo("<p>
                    <input type='hidden' name='page' value='Evènement'>
                    <input type='hidden' name='event' value='Ajouter un evenement'>
                    <input type='hidden' name='MenuRecipe' value=".$_GET['MenuRecipe'].">
                    <input type='submit' name='RequestRecipe' value='+'>");
                    if($_GET['MenuRecipe'] > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("</p>
                    <p><input type='date' name='date'><input type='time' name='time'></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Ajouter un evenement'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    </div>");
                }
                else if ($_GET['Request'] == "Confirmer")
                {
                    echo("<div class='text-center mt-5'>
                    Vous avez bien créé votre évènement !
                    <br><br>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    </div>");
                }
            }
        ?> 
    </body>
</html>