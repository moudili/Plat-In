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
        <form action='Index.php' method='get'>
        <input type='hidden' name='page' value='Sociale'>
        <input type='hidden' name='Request' value="Demande amis">
        <input type='submit' value="Demande d'amis"></form>
        

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
                                echo ("<br>
                                <img src='Pictures/random_user.svg' alt='' width='200'>");
                            }
                            else
                            {

                            }
                            
                            $alreadyBlock = 0;
                            foreach ($MesBloques as $Monbloque) 
                            {
                                if ($Monbloque['user'] == $Search[1][$i])
                                {
                                    $alreadyBlock = 1;
                                }
                            }


                            if($alreadyBlock == 0)
                            {

                                $alreadyFriend = 0;
                                foreach ($Myfriends as $Myfriend) 
                                {
                                    if ($Myfriend['user'] == $Search[1][$i]) 
                                    {
                                        $alreadyFriend = 1;
                                    }
                                }
                                $alreadyInvited = 0;

                                foreach ($MesInvitations as $Moninvite) 
                                {
                                    if ($Moninvite['user'] == $Search[1][$i])
                                    {
                                        
                                        $alreadyInvited = 1;
                                    }
                                }

                                $alreadyRequested = 0;
                                foreach ($MesRequetes as $MaRequete) 
                                {
                                    if ($MaRequete['user'] == $Search[1][$i])
                                    {
                                        
                                        $alreadyRequested = 1;
                                    }
                                }

                                $alreadyMyBlock = 0;
                                foreach ($MoiBloquer as $MaBloquer) 
                                {
                                    if ($MaBloquer['user'] == $Search[1][$i])
                                    {
                                        
                                        $alreadyMyBlock = 1;
                                    }
                                }

                                if ($alreadyInvited == 0 && $alreadyRequested == 0 && $alreadyMyBlock == 0) 
                                {
                                    if ($alreadyFriend == 0)
                                    {
                                        echo("
                                        <form action='Index.php' method='get'>
                                        <input type='hidden' name='page' value='Sociale'>
                                        <input type='hidden' name='User' value='".$Search[1][$i]."'>
                                        <input type='hidden' name='id' value='".$Search[0][$i]."'>
                                        <input type='submit' name='Request' value='Ajouter un ami'></form>
                                        ");
                                    }
                                    else
                                    {
                                        echo("<br>Vous êtes déja ami avec ".$Search[1][$i]."<br><br>");
                                    }


                                    echo("
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Sociale'>
                                    <input type='hidden' name='User' value='".$Search[1][$i]."'>
                                    <input type='hidden' name='id' value='".$Search[0][$i]."'>
                                    <input type='submit' name='Request' value='Bloquer'></form>");

                                }
                                elseif($alreadyInvited == 1 )
                                {
                                    echo("<br>Vous avez déja une rêquete d'ami avec ".$Search[1][$i]."<br><br>");

                                }
                                elseif($alreadyRequested == 1 )
                                {
                                    echo("<br>Vous avez déja une demande d'ami qui vous attend avec ".$Search[1][$i]."<br><form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Sociale'>
                                    <input type='hidden' name='Request' value='Demande amis'>
                                    <input type='submit' value='Demande d&#39;amis'></form>
                                    <br>");

                                }
                                elseif ($alreadyMyBlock == 1) {
                                    echo("<br>
                                    Vous êtes bloqué par cet utilisateur.<br><br>
                                    <form action='Index.php' method='get'>
                                    <input type='hidden' name='page' value='Sociale'>
                                    <input type='hidden' name='User' value='".$Search[1][$i]."'>
                                    <input type='hidden' name='id' value='".$Search[0][$i]."'>
                                    <input type='submit' name='Request' value='Bloquer'></form>
                                    <br>"
                                    );
                                    
                                }

                            }
                            else
                            {
                                echo("
                                <br>".$Search[1][$i]." est bloqué<br><br>
                                <form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Sociale'>
                                <input type='hidden' name='User' value='".$Search[1][$i]."'>
                                <input type='hidden' name='id' value='".$Search[0][$i]."'>
                                <input type='submit' name='Request' value='Debloquer'></form>");
                            }
                        
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
            
                }
                elseif ($_GET['Request'] == "Supprimer un ami")
                {

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
                elseif ($_GET['Request'] == "Demande amis")
                {
                    foreach ($MesRequetes as $Requete) {
                    echo ($Requete["user"]);

                    echo("
                    <p><form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Sociale'>
                    <input type='hidden' name='Request' value='Accepter ami'>
                    <input type='hidden' name='id' value='".$Requete["ID"]."'>
                    <input type='hidden' name='User' value='".$Requete["user"]."'>
                    <br><input type='submit' name='' value='Accepter'></form>

                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Sociale'>
                    <input type='hidden' name='Request' value='Refuser ami'>
                    <input type='hidden' name='id' value='".$Requete["ID"]."'>
                    <input type='hidden' name='User' value='".$Requete["user"]."'>
                    <br><input type='submit' name='' value='Refuser'></form></p>
                    <br> <br>

                        ");

                 }
                
                
                }
                elseif ($_GET['Request'] == "Accepter ami")
                {

                    if (empty($_GET['Answer'])) {
                        
                        echo("
                        Voulez-vous accepter  ".$_GET['User']." à votre liste d'ami ?
                        
                        
    
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Accepter amis'>
                     
                        <input type='hidden' name='User' value='".$_GET['User']."'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <br><input type='submit' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Accepter amis'>
                        <br><input type='submit' name='Answer' value='Non'></form>
                        ");
                    }
                }
                elseif ($_GET['Request'] == "Refuser ami")
                {

                    if (empty($_GET['Answer'])) {
                        
                        echo("
                        Voulez-vous refuser ".$_GET['User']." à votre liste d'ami ?
                        
                        
    
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Refuser ami'>
                     
                        <input type='hidden' name='User' value='".$_GET['User']."'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <br><input type='submit' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Refuser ami'>
                        <br><input type='submit' name='Answer' value='Non'></form>
                        ");
                    }
                }
                elseif ($_GET['Request'] == "Bloquer")
                {

                    if (empty($_GET['Answer'])) {
                        
                        echo("
                        Voulez-vous bloquer ".$_GET['User']." ?
                        
                        
    
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Bloquer'>
                     
                        <input type='hidden' name='User' value='".$_GET['User']."'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <br><input type='submit' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Bloquer'>
                        <br><input type='submit' name='Answer' value='Non'></form>
                        ");
                    }
                }
                elseif ($_GET['Request'] == "Debloquer")
                {

                    if (empty($_GET['Answer'])) {
                        
                        echo("
                        Voulez-vous debloquer ".$_GET['User']." ?
                        
                        
    
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Debloquer'>
                        
                        <input type='hidden' name='User' value='".$_GET['User']."'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <br><input type='submit' name='Answer' value='Oui'></form>
                        
                        
                        <p><form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Sociale'>
                        <input type='hidden' name='Request' value='Debloquer'>
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

                for($i = 0 ; $i < count($Search[0]) ; $i++ )
                {
                    echo $Search[1][$i];
                    if($Search[2][$i] == NULL)
                    {
                        echo "<br>
                        <img src='Pictures/random_user.svg' alt='' width='200'>";
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

        
        ?>
        </div>

    </body>
</html>