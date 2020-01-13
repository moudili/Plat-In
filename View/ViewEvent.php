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
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    </div>");
                }
                else
                {
                    echo("<div class='text-center mt-5'>
                    <form action='Index.php' method='get'>
                        <input type='submit' name='event' value='Ajouter un evenement'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    Evenement :
                    ");
                    for ($i=0;$i<count($Events);$i++)
                    {
                        echo($Events[$i]."<br>");
                    }
                }
            }
            else if ($_GET['event']=='Ajouter un evenement')
            {
                echo("<div class='text-center mt-5'>
                <h2>Ajouter un évènement</h2>
                <br><br>
                <p>Personne à inviter à cette évènement : </p>
                <p>Recette disponible : 
                <select name='recette'>
                ");
                for ($i=0;$i<count($Recipes[0]);$i++)
                {
                    echo("<option value='".$Recipes[2]."'>".$Recipes[0][$i]."</option>");
                }
                echo("</select></p>
                <p>Ceci est <select name='service'>
                <option value='entrée'>une entrée</option>
                <option value='plat'>un plat</option>
                <option value='dessert'>un dessert</option>
                </select></p>
                <form action='Index.php' method='get'>
                    <input type='submit' name='event' value='Confirmer'>
                    <input type='hidden' name='page' value='Evènement'>
                </form>
                <form action='Index.php' method='get'>
                    <input type='submit' value='Retour'>
                    <input type='hidden' name='page' value='Evènement'>
                </form>
                </div>");
            }
        ?> 
    </body>
</html>