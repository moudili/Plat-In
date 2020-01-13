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
                if ($Events=='')
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
                    for ($i=0;$i<count($Events);$i++)
                    {
                        echo($Events[$i]."<br>");
                    }
                    echo("<div class='text-center mt-5'>
                    <form action='Index.php' method='get'>
                        <input type='submit' name='event' value='Ajouter un evenement'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    </div>");
                }
            }
            else if ($_GET['event']=='Ajouter un evenement')
            {
                echo("<div class='text-center mt-5'>
                Ajouter un évènement
                <br><br>
                <form action='Index.php' method='get'>
                    <input type='submit' value='Retour'>
                    <input type='hidden' name='page' value='Evènement'>
                </form>
                </div>");
            }
        ?>
    </body>
</html>