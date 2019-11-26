<html>
    <head>
        <title>Sociale</title>
    </head>
    
    <body>
        <?php
            
            require("View/ViewBanner.php");     
        
        ?>

            <form action='Index.php' method='get'>
            <input type='search' placeholder = 'Rechercher un utilisateur...' name='Usr'/>
            <input type='hidden' name='page' value='Sociale'>
            <input type='hidden' name='Request' value='Search'>
            <input type='submit' value=" "></form>

        <?php
            
            if(!empty($_GET['Request']))
            {

                if($_GET['Request'] == "Search")
                {
                    for($i = 0 ; $i < count($Search[0]) ; $i++ )
                    {
                        echo $Search[1][$i];
                        if($Search[2][$i] == NULL)
                        {
                            echo "<br>random";
                        }
                        else
                        {

                        }

                        echo "<form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='User' value='".$Search[1][$i]."'>
                        <input type='hidden' name='id' value='".$Search[0][$i]."'>
                        <input type='submit' name='Request' value='Ajouter en ami'></form>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='User' value='".$Search[1][$i]."'>
                        <input type='hidden' name='id' value='".$Search[0][$i]."'>
                        <input type='submit' name='Request' value='Bloquer'></form>";
                    }
                }

            }

        
        ?>

    </body>
</html>