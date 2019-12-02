<html>
    <head>
        <title>Gestion des droits</title>
    </head>
    
    <body>
        <?php    
            require("View/ViewBanner.php");     
        ?>
        <div class="text-center mt-5">
        <?php
        
            if(!empty($_GET['Request']))
            {

                if($_GET['Request'] == "Search")
                {
                    if($Search != false)
                    {
                        echo("<form action='Index.php' method='get'>
                        <input type='search' name='Usr' value='".htmlspecialchars($_GET['Usr'], ENT_QUOTES)."'/>
                        <input type='hidden' name='page' value='Gestion des droits'>
                        <input type='hidden' name='Request' value='Search'>
                        <input type='submit' value=' '></form>
                        ");
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

                            
                            if($Search[3][$i] == "ban")
                            {
                                echo("
                                <form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Gestion des droits'>
                                <input type='hidden' name='User' value='".$Search[1][$i]."'>
                                <input type='hidden' name='id' value='".$Search[0][$i]."'>
                                <input type='submit' name='Request' value='Débannir'></form>");
                            }
                            else
                            {
                                echo("<form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Gestion des droits'>
                                <input type='hidden' name='User' value='".$Search[1][$i]."'>
                                <input type='hidden' name='id' value='".$Search[0][$i]."'>
                                <input type='submit' name='Request' value='Modifier les droits'></form>
                                <form action='Index.php' method='get'>
                                <input type='hidden' name='page' value='Gestion des droits'>
                                <input type='hidden' name='User' value='".$Search[1][$i]."'>
                                <input type='hidden' name='id' value='".$Search[0][$i]."'>
                                <input type='submit' name='Request' value='Bannir'></form>");
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
                }
                else if($_GET['Request'] == "Bannir")
                {
                    if(empty($_GET['Answer']))
                    {
                    echo "Etes-vous sur de vouloir bannir l'utilisateur ".$_GET['User']."?
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Gestion des droits'>
                    <input type='hidden' name='User' value='".$_GET['User']."'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='Request' value='Bannir'>
                    <input type='submit' name='Answer' value='Oui'></form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Gestion des droits'>
                    <input type='submit' value='Retour'></form>
                    ";
                    }
                    else
                    {
                        echo"L'utilisateur ".$_GET['User']." à bien été banni.";
                    }
                }
                else if($_GET['Request'] == "Débannir")
                {
                    if(empty($_GET['Answer']))
                    {
                    echo "Etes-vous sur de vouloir débannir l'utilisateur ".$_GET['User']."?
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Gestion des droits'>
                    <input type='hidden' name='User' value='".$_GET['User']."'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='hidden' name='Request' value='Débannir'>
                    <input type='submit' name='Answer' value='Oui'></form>
                    <form action='Index.php' method='get'>
                    <input type='hidden' name='page' value='Gestion des droits'>
                    <input type='submit' value='Retour'></form>
                    ";
                    }
                    else
                    {
                        echo"L'utilisateur ".$_GET['User']." à bien été débanni.";
                    }                    
                }
                else if($_GET['Request'] == "Modifier les droits")
                {
                    echo"<p>Quels droits souhaitez vous attribuer à l'utilisateur ".$_GET['User']."?</p>
                    <form action='Index.php' method='get'>
                    <select name='rights'>
                        <option value='membre'>Membre</option>
                        <option value='operator'>Modérateur</option>
                    </select>
                    <p><input type='hidden' name='page' value='Gestion des droits'>
                    <input type='hidden' name='User' value='".$_GET['User']."'>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <input type='submit' name='Request' value='Modifier'></p></form>
                    ";
                }
                else if($_GET['Request'] == "Modifier")
                {
                    if($CheckRights == true)
                    {
                    echo"L'utilisateur ".$_GET['User']." est maintenent un ".$_GET['rights'].".";
                    }
                    else
                    {
                        echo"<p>Quels droits souhaitez vous attribuer à l'utilisateur ".$_GET['User']."?</p>
                        <form action='Index.php' method='get'>
                        <select name='rights'>
                            <option value='membre'>Membre</option>
                            <option value='operator'>Modérateur</option>
                        </select>
                        <p><input type='hidden' name='page' value='Gestion des droits'>
                        <input type='hidden' name='User' value='".$_GET['User']."'>
                        <input type='hidden' name='id' value='".$_GET['id']."'>
                        <p><FONT color='red'>Cet utilisateur possède déjà ces droits</FONT><p>
                        <input type='submit' name='Request' value='Modifier'></p></form>
                        ";                        
                    }
                }
            }
            else
            {
                echo ("<form action='Index.php' method='get'>
                <input type='search' placeholder = 'Rechercher un utilisateur...' name='Usr'/>
                <input type='hidden' name='page' value='Gestion des droits'>
                <input type='hidden' name='Request' value='Search'>
                <input type='submit' value=' '></form>
                ");

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

                    
                    if($Search[3][$i] == "ban")
                    {
                        echo("
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Gestion des droits'>
                        <input type='hidden' name='User' value='".$Search[1][$i]."'>
                        <input type='hidden' name='id' value='".$Search[0][$i]."'>
                        <input type='submit' name='Request' value='Débannir'></form>");
                    }
                    else
                    {
                        echo("<form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Gestion des droits'>
                        <input type='hidden' name='User' value='".$Search[1][$i]."'>
                        <input type='hidden' name='id' value='".$Search[0][$i]."'>
                        <input type='submit' name='Request' value='Modifier les droits'></form>
                        <form action='Index.php' method='get'>
                        <input type='hidden' name='page' value='Gestion des droits'>
                        <input type='hidden' name='User' value='".$Search[1][$i]."'>
                        <input type='hidden' name='id' value='".$Search[0][$i]."'>
                        <input type='submit' name='Request' value='Bannir'></form>");
                    }
                }
            }

        
        ?>
    </div>
    </body>
</html>