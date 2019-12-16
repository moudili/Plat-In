<html>
    <head>
        <title>Sociale</title>
    </head>
    
    <body>
        <?php
            
            require("View/ViewBanner.php");     
        
        ?>

        <form action='Index.php' method='get'>
        <input type='hidden' name='page' value='Sociale'>
        <input type='hidden' name='Request' value='Amis'>
        <input type='submit' value="Amis"></form>
        

        <div class="text-center mt-5">



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
                            <input type='submit' name='Request' value='Ajouter un ami'></form>
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
                }elseif ($_GET['Request'] == 'Ajouter un ami') {
                    if (empty($_GET['Answer'])) {
                    
                    echo("
                    Voulez-vous ajouter ".$_GET['User']." à votre liste d'ami ?
                    
                    

                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Sociale'>
                    <input type='hidden' name='Request' value='Search'>
                 
                    <input type='hidden' name='User' value='".$_GET['User']."'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <br><input type='submit' name='Answer' value='Oui'></form>
                    
                    
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Sociale'>
                    <input type='hidden' name='Request' value='Search'>
                    <br><input type='submit' name='Answer' value='Non'></form>
                    ");
                    }

                }
                elseif($_GET['Request'] == "Amis")
                {

                    foreach ($Myfriends as $Myfriend) {
                        var_dump($Myfriend);
                        echo("<br> <br>");

                    echo ($Myfriend["user"]);


                    echo("
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Sociale'>
                    <input type='hidden' name='Request' value='Supprimer un ami'>
                 
                    <input type='hidden' name='id' value='".$Myfriend["ID"]."'>
                    <input type='hidden' name='User' value='".$Myfriend["user"]."'>

                    <br><input type='submit' name='' value='Supprimer'></form>
                    
                    
                    
                    
                    
                    <br> <br>");



                    }
            
                }elseif ($_GET['Request'] == "Supprimer un ami") {

                    if (empty($_GET['Answer'])) {
                        
                        echo("
                        Voulez-vous ajouter  ".$_GET['User']." à votre liste d'ami ?
                        
                        
    
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Amis'>
                     
                        <input type='hidden' name='User' value='".$_GET['User']."'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <br><input type='submit' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Amis'>
                        <br><input type='submit' name='Answer' value='Non'></form>
                        ");
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
        </div>

    </body>
</html>