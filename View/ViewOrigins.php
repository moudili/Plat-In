<html>
    <head>
        <title>Origines</title>
    </head>
    
    <body>
        <?php

            require("View/ViewBanner.php");  
            if(!empty($_GET['Request']))
            {

        ?>
        
        <form action='Index.php' method='get'>
        <input type='submit' name='Request' value='Ajouter une origine'></form><br>       
        
        <?php
            
            }

        ?>
    </body>
</html>