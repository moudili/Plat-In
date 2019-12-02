<html>
    <head>
        <title>Sociale</title>
    </head>
    
    <body>
        <?php
            
            require("View/ViewBanner.php");     
        
        ?>



        <?php
            
            if(!empty($_GET['Request']))
            {

                if($_GET['Request'] == "Search")
                {
                    if($Search != false)
                    {
                        echo"<form action='Index.php' method='get'>
                        <input type='search' value='".htmlspecialchars($_GET['Usr'], ENT_QUOTES)."' name='Usr'/>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Search'>
                        <input type='submit' value=' '></form>";

                        for($i = 0 ; $i < count($Search[0]) ; $i++ )
                        {
                            echo $Search[1][$i];
                            if($Search[2][$i] == NULL)
                            {
                                echo "<br>
                                <img src='Pictures/random_user.svg' alt='' width='200'>";
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
                    else
                    {
                        echo("<form action='Index.php' method='get'>
                        <input type='search' name='Usr' value='".htmlspecialchars($_GET['Usr'], ENT_QUOTES)."'/>
                        <input type='hidden' name='page' value='Gestion des droits'>
                        <input type='hidden' name='Request' value='Search'>
                        <input type='submit' value=' '></form>
                        <br>aucun résultat pour la recherche ".$_GET['Usr'].".");                         
                    }
                }


            }
            else
            {
                echo("<form action='Index.php' method='get'>
                <input type='search' placeholder = 'Rechercher un utilisateur...' name='Usr'/>
                <input type='hidden' name='page' value='Sociale'>
                <input type='hidden' name='Request' value='Search'>
                <input type='submit' value=' '></form>");
            }

        
        ?>

    </body>
</html>