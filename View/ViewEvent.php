<?php
    require("View/ViewBanner.php"); 
?>

<html>
    <head>
        <link rel="stylesheet" href="Css/ErrorChamp.css">
        <title>Evènement</title>
    </head>
    <style>
         body{
            text-align: center;
            }
    </style> 
    <body>
        <?php
            if (empty($_GET['event']))
            {
                if ($Events==array() OR $Events==array(array(),array()))
                {
                    echo("
                    Pas d'évènement créé<br></br>
                    Venez vite en créer ci-dessous !<br></br>
                    <form action='Index.php' method='get'>
                        <input type='submit' name='event' value='Ajouter un evenement'>
                        <input type='hidden' name='MenuRecipe' value=1>
                        <input type='hidden' name='MenuUser' value=1>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>");
                    echo("Evenement en attente :");
                    for ($i=0;$i<count($Invitation[0]);$i++)
                    {
                        echo("<br>".$Invitation[1][$i]);
                    }

                    echo("");
                }
                
                else
                {
                    echo("
                    <form action='Index.php' method='get'>
                        <input type='submit' name='event' value='Ajouter un evenement'>
                        <input type='hidden' name='MenuRecipe' value=1>
                        <input type='hidden' name='MenuUser' value=1>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <p>Evenement :</p>
                    <table border=4 align='center'>");
                    for ($i=0;$i<count($Events[1]);$i++)
                    {
                        $Moi=false;
                        $Invite=false;
                        for ($j=0;$j<count($UsersSupp[0]);$j++)
                        {
                            if ($UsersSupp[0][$j]==$_SESSION['id'] 
                            AND $UsersSupp[1][$j]==$Events[0][$i] 
                            AND $UsersSupp[2][$j]=='admin')
                            {
                                $Moi=true;
                            }
                            else if ($UsersSupp[0][$j]==$_SESSION['id'] 
                            AND $UsersSupp[1][$j]==$Events[0][$i] 
                            AND $UsersSupp[2][$j]=='membre')
                            {
                                $Invite=true;
                            }
                        }

                        if ($Moi==true AND $Invite!=true)
                        {
                            echo("<form action='Index.php' method='get'>
                            <tr><td>".$Events[1][$i]."</td><td>
                            <br>
                            <input type='submit' name='event' value='Afficher'>
                            <br></br>
                            <input type='submit' name='event' value='Modifier'>
                            <input type='submit' name='event' value='Supprimer'>
                            <input type='hidden' name='evenement' value='".$Events[0][$i]."'>
                            <input type='hidden' name='Name' value='".$Events[1][$i]."'>
                            <input type='hidden' name='page' value='Evènement'>
                            </form>
                            <br></br>
                            </td></tr>");

                        }
                        else if ($Invite==true AND $Moi!=true)
                        {
                            echo("<form action='Index.php' method='get'>
                            <tr><td>".$Events[1][$i]."</td><td><br><input type='submit' name='event' value='Afficher'><br></td></tr>
                            <input type='hidden' name='evenement' value='".$Events[0][$i]."'>
                            <input type='hidden' name='Name' value='".$Events[1][$i]."'>
                            <input type='hidden' name='page' value='Evènement'>
                            </form>");
                        }
                    }
                    echo("</table>");
                    echo("Evenement en attente :");
                    if(count($Invitation[0]) != 0)
                    {
                        echo("<table border=4 align='center'>");
                        for ($i=0;$i<count($Invitation[0]);$i++)
                        {
                            echo("<tr><td>".$Invitation[1][$i]."</td><td><p><form action='Index.php' method='get'><input type='submit' name='event' value='Accepter'></p>
                            <p><input type='submit' name='event' value='Refuser'>
                            <input type='hidden' name='ID' value='".$Invitation[2][$i]."'>
                            <input type='hidden' name='page' value='Evènement'>
                            </form></p></td><tr>");
                        }

                        echo("</table>");
                    }
                }
            }
            else if ($_GET['event']=='Accepter')
            {
                echo("
                Vous avez accepter cette demande d'evenement
                <form action='Index.php' method='get'>
                    <input type='submit' value='Retour'>
                    <input type='hidden' name='page' value='Evènement'>
                </form>
                ");
            }
            else if ($_GET['event']=='Refuser')
            {
                echo("
                Vous avez refuser cette demande d'evenement
                <form action='Index.php' method='get'>
                    <input type='submit' value='Retour'>
                    <input type='hidden' name='page' value='Evènement'>
                </form>
                ");
            }
            else if ($_GET['event']=='Ajouter un evenement')
            {
                if (empty($_GET['Request']) AND empty($_GET['RequestRecipe']) AND empty($_GET['RequestUser']))
                {
                    echo("
                    <form action='Index.php' method='get'>
                    <h2>Ajouter un évènement</h2>
                    <br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value=''></p>
                    <p>Personne à inviter à cette évènement : 
                    <select name='utilisateur0'>");
                    for ($i=0;$i<count($Users[0]);$i++)
                    {
                        $Into=array();
                        for ($j=0;$j<count($Intolerance[0]);$j++)
                        {
                            if ($Intolerance[0][$j]==$Users[0][$i])
                            {
                                array_push($Into,$Intolerance[1][$j]);
                            }
                        }
                        $Into=implode(" ", $Into);
                        echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                    }
                    echo("</select>
                    <br>");
                    echo("<input type='hidden' name='MenuUser' value='".$_GET['MenuUser']."'>");

                    if ($_GET['MenuUser']<count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }
                    echo("</p>
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
                    <p>Lieu de l'évènement : <input type='text' name='location' value=''></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40></TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Ajouter un evenement'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if (!empty($_GET['RequestRecipe']) AND ($_GET['RequestRecipe'] == "+"
                || $_GET['RequestRecipe'] == "-"))
                {
                    echo("
                    <form action='Index.php' method='get'>
                    <h2>Ajouter un évènement</h2>
                    <br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>
                    <p>");
                    for($j = 0 ; $j < $_GET['MenuUser'] ; $j++ )
                    {
                        echo("<p>Personne à inviter à cette évènement : 
                        <select name='utilisateur".$j."'>");
                        
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            $Into=array();
                            for ($k=0;$k<count($Intolerance[0]);$k++)
                            {
                                if ($Intolerance[0][$k]==$Users[0][$i])
                                {
                                    array_push($Into,$Intolerance[1][$k]);
                                }
                            }
                            $Into=implode(" ", $Into);
                            
                            if ($_GET['utilisateur'.$j]==$Users[0][$i]) 
                            {
                                echo("<option selected value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                            else 
                            {
                                echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                        }
                    echo("</select>
                    <br>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$_GET['MenuUser']."'>");
                    if ($_GET['MenuUser']<count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }
                    if($_GET['MenuUser'] > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    for($j = 0 ; $j < $MenuRecipe ; $j++ )
                    {
                        echo("<p>Recette disponible : 
                        <select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if ($_GET['recette'.$j]==$Recipes[2][$i]) 
                            {
                                echo("<option selected value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo(" EGal :".$Recipes[0][$i]);
                            }
                            else 
                            {
                                echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo($Recipes[0][$i]);
                            }
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>");
                    
                            if ($_GET['service'.$j]=='entrée')
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='plat')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option selected value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='dessert')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option selected value='dessert'>dessert</option>");
                            }
                            else 
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuRecipe' value='".$MenuRecipe."'>
                    <p><input type='submit' name='RequestRecipe' value='+'>");
                    if($MenuRecipe > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("<p><input type='date' name='date' value='".$_GET['date']."'><input type='time' name='time' value='".$_GET['time']."'></p>
                    <p>Lieu de l'évènement : <input type='text' name='location' value='".$_GET['location']."'></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40 value=''>".$_GET['description']."</TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Ajouter un evenement'>
                    <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if (!empty($_GET['RequestUser']) AND ($_GET['RequestUser'] == "+"
                OR $_GET['RequestUser'] == "-"))
                {
                    echo("
                    <form action='Index.php' method='get'>
                    <h2>Ajouter un évènement</h2>
                    <br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>
                    <p>");
                    for($j = 0 ; $j < $MenuUser ; $j++ )
                    {
                        echo("<p>Personne à inviter à cette évènement : 
                        <select name='utilisateur".$j."'>");
                        
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            $Into=array();
                            for ($k=0;$k<count($Intolerance[0]);$k++)
                            {
                                if ($Intolerance[0][$k]==$Users[0][$i])
                                {
                                    array_push($Into,$Intolerance[1][$k]);
                                }
                            }
                            $Into=implode(" ", $Into);
                            
                            if ($_GET['utilisateur'.$j]==$Users[0][$i]) 
                            {
                                echo("<option selected value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                            else 
                            {
                                echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                        }
                    echo("</select>
                    <br>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$MenuUser."'>");
                    if ($MenuUser<count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }
                    if($MenuUser > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    for($j = 0 ; $j < $_GET['MenuRecipe'] ; $j++ )
                    {
                        echo("<p>Recette disponible : 
                        <select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if ($_GET['recette'.$j]==$Recipes[2][$i]) 
                            {
                                echo("<option selected value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo(" EGal :".$Recipes[0][$i]);
                            }
                            else 
                            {
                                echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo($Recipes[0][$i]);
                            }
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>");
                    
                            if ($_GET['service'.$j]=='entrée')
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='plat')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option selected value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='dessert')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option selected value='dessert'>dessert</option>");
                            }
                            else 
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuRecipe' value='".$_GET['MenuRecipe']."'>
                    <p><input type='submit' name='RequestRecipe' value='+'>");
                    if($_GET['MenuRecipe'] > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("<p><input type='date' name='date' value='".$_GET['date']."'><input type='time' name='time' value='".$_GET['time']."'></p>
                    <p>Lieu de l'évènement : <input type='text' name='location' value='".$_GET['location']."'></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40 value=''>".$_GET['description']."</TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Ajouter un evenement'>
                    <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if ($_GET['Request'] == "Confirmer"
                AND !empty($_GET['Name']) 
                AND !empty($_GET['time']) 
                AND !empty($_GET['date'])
                AND !empty($_GET['location'])
                AND !empty($_GET['description'])
                AND strlen($_GET['Name'])<20)
                {
                    echo("
                    Vous avez bien créé votre évènement !
                    <br><br>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if ($_GET['Request'] == "Confirmer"
                AND (empty($_GET['Name']) 
                OR empty($_GET['time']) 
                OR empty($_GET['date'])
                OR empty($_GET['location'])
                OR empty($_GET['description'])
                OR strlen($_GET['Name'])>20))
                {
                    echo("
                    <form action='Index.php' method='get'>
                    <h2>Ajouter un évènement</h2>
                    <br>
                    <h3 style='color: red'>Veuillez remplir tous les champs. Si tous les champs sont remplis alors votre nom d'événement est trop long</h3>
                    <br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>
                    <p>");
                    for($j = 0 ; $j < $_GET['MenuUser'] ; $j++ )
                    {
                        echo("<p>Personne à inviter à cette évènement : 
                        <select name='utilisateur".$j."'>");
                        
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            $Into=array();
                            for ($k=0;$k<count($Intolerance[0]);$k++)
                            {
                                if ($Intolerance[0][$k]==$Users[0][$i])
                                {
                                    array_push($Into,$Intolerance[1][$k]);
                                }
                            }
                            $Into=implode(" ", $Into);
                            
                            if ($_GET['utilisateur'.$j]==$Users[0][$i]) 
                            {
                                echo("<option selected value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                            else 
                            {
                                echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                        }
                    echo("</select>
                    <br>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$_GET['MenuUser']."'>");
                    if($_GET['MenuUser'] < count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }
            
                    if($_GET['MenuUser'] > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    for($j = 0 ; $j < $_GET['MenuRecipe'] ; $j++ )
                    {
                        echo("<p>Recette disponible : 
                        <select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if ($_GET['recette'.$j]==$Recipes[2][$i]) 
                            {
                                echo("<option selected value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo(" EGal :".$Recipes[0][$i]);
                            }
                            else 
                            {
                                echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo($Recipes[0][$i]);
                            }
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>");
                    
                            if ($_GET['service'.$j]=='entrée')
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='plat')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option selected value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='dessert')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option selected value='dessert'>dessert</option>");
                            }
                            else 
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuRecipe' value='".$_GET['MenuRecipe']."'>
                    <p><input type='submit' name='RequestRecipe' value='+'>");
                    if($_GET['MenuRecipe'] > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("<p><input type='date' name='date' value='".$_GET['date']."'><input type='time' name='time' value='".$_GET['time']."'></p>
                    <p>Lieu de l'évènement : <input type='text' name='location' value='".$_GET['location']."'></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40 value=''>".$_GET['description']."</TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Ajouter un evenement'>
                    <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
            }
            else if ($_GET['event']=='Afficher')
            {
                for ($i=0;$i<count($PrintEvent[0]);$i++)
                {
                    if($PrintEvent[0][$i]==$_GET['evenement'])
                    {
                        echo("<h1>".$PrintEvent[1][$i]."</h1>
                        <p>Date : ".$PrintEvent[3][$i]." Heure : ".$PrintEvent[2][$i]."</p>
                        <p>Lieu : ".$PrintEvent[4][$i]."
                        <p>Personne invité : </p>");
                    break;
                    } 
                }
                for ($i=0;$i<count($PrintUser[0]);$i++)
                {
                    if ($PrintUser[0][$i]==$_GET['evenement'])
                    {
                    
                        echo("
                        <p>".$PrintUser[2][$i]."<p>");
                    }
                }
                for ($i=0;$i<count($PrintEvent[0]);$i++)
                {
                    if ($PrintEvent[0][$i]==$_GET['evenement'])
                    {
                        echo("<p>Recette : ".$PrintEvent[8][$i]."</p>
                        <p>Type de recette : ".$PrintEvent[7][$i]."</p>");
                    }
                }
                for ($i=0;$i<count($PrintEvent[0]);$i++)
                {
                    if ($PrintEvent[0][$i]==$_GET['evenement'])
                    {
                        echo(nl2br("<p>Description : ".$PrintEvent[5][$i]));
                        break;
                    }
                }
                echo("
                <form action='Index.php' method='get'>
                    <input type='submit' value='Retour'>
                    <input type='hidden' name='page' value='Evènement'>
                </form>
                ");
            }
            else if ($_GET['event']=='Supprimer')
            {
                if (empty($_GET['Supp']))
                {
                    echo("
                    Êtes-vous sur de vouloir supprimer cette recette ?
                    <br><br>
                    <form action='Index.php' method='get'>
                        <input type='submit' name='Supp' value='Oui'>
                        <input type='hidden' name='event' value='Supprimer'>
                        <input type='hidden' name='page' value='Evènement'>
                        <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Non'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>");
                }
                else if ($_GET['Supp']=='Oui')
                {
                    echo("<br>
                    Vous avez bien supprimé votre évènement !
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>");
                }
            }
            else if ($_GET['event']=='Modifier')
            {
                if (empty($_GET['modif']) AND empty($_GET['RequestRecipe']) AND empty($_GET['RequestUser']) AND empty($_GET['Request']))
                {
                    $MenuUser=$Guests[5];
                    $MenuRecipe=$Dishes[5];
                    echo("
                    <form action='Index.php' method='get'>
                    Vous etes en train de modifier l'événement : ".$_GET['Name']);
                    echo("<br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$SelectEvent[1]."'></p>");
                    $Listes=array();
                    $verif=true;
                    $valeur=0;
                    $Verif=array();
                    for($j = 0 ; $j < $Guests[5] ; $j++ )
                    {
                        echo("<p>Personne à inviter à cette évènement : 
                        
                        <select name='utilisateur".$j."'>");
                        $Tailles=count($Guests[4]);
                        $Tailles=$Tailles;
                        for ($i=0;$i<$Tailles;$i++)
                        {
                            for ($h=0;$h<count($Listes);$h++)
                            {
                                if ($Listes[$h]==$Guests[1][$i] AND $Guests[2][$i]==$_GET['evenement'])
                                {
                                    $verif=false;
                                }
                            }

                            if ($Guests[2][$i]==$_GET['evenement'] AND $verif==true AND $valeur==$j)
                            {
                                $Into=array();
                                for ($k=0;$k<count($Intolerance[0]);$k++)
                                {
                                    if ($Intolerance[0][$k]==$Guests[1][$i])
                                    {
                                        array_push($Into,$Intolerance[1][$k]);
                                    }
                                }
                                $Into=implode(" ", $Into);
                                echo("<option value='".$Guests[1][$i]."'>".$Guests[4][$i]." Intolérances : ".$Into."</option><br>");
                                //echo("<option selected value='".$Guests[1][$i]."'>".$Guests[4][$i]."</option><br>");  
                                array_push($Listes, $Guests[1][$i]);
                                array_push($Verif, $Guests[1][$i]);
                                $valeur++;
                            }
                            $verif=true;
                        }
                        $nombre=$j;
                        for ($h=0;$h<count($Users[0]);$h++)
                        {
                            $VerifR=true;

                            for ($l=$nombre;$l<count($Verif);$l++)
                            {
                                if ($Verif[$l]==$Users[0][$h])
                                {
                                    $VerifR=false;
                                   
                                } 
                            }

                            if ($VerifR==true)
                            {
                                $Into=array();
                                for ($k=0;$k<count($Intolerance[0]);$k++)
                                {
                                    if ($Intolerance[0][$k]==$Users[0][$h])
                                    {
                                        array_push($Into,$Intolerance[1][$k]);
                                    }
                                }
                                $Into=implode(" ", $Into);
                                echo("<option value='".$Users[0][$h]."'>".$Users[1][$h]." Intolérances : ".$Into."</option><br>");
                            }
                        }

                        echo("</select>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$MenuUser."'>");
                    if ($MenuUser<count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }
                    if($MenuUser > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }
                    echo("</p>");
                    $Listes=array();
                    $verif=true;
                    $valeur=0;
                    $Element=array();
                    $Verif=array();
                    $Type=array();
                    for ($j = 0 ; $j < $Dishes[5]; $j++ )
                    {
                        echo("<p>Recette disponible : 
                        <select name='recette".$j."'>");
                        for ($i=0;$i<count($Dishes[0]);$i++)
                        {
                            for ($h=0;$h<count($Listes);$h++)
                            {
                                if ($Listes[$h]==$Dishes[0][$i])
                                {
                                    $verif=false;
                                }                                
                            }

                            if ($verif==true AND $valeur==$j AND $Dishes[1][$i]==$_GET['evenement'])
                            {
                                echo("<option selected value='".$Dishes[2][$i]."'>".$Dishes[4][$i]."</option>");
                                array_push($Listes, $Dishes[0][$i]);
                                array_push($Type, $Dishes[0][$i]);
                                array_push($Verif, $Dishes[2][$i]);
                                $valeur++;
                                echo($Dishes[4][$i]);
                            }
                            $verif=true;
                        }
                        $nombre=$j;

                        for ($h=0;$h<count($Recipes[0]);$h++)
                        {
                            $VerifR=true;

                            for ($l=$nombre;$l<count($Verif);$l++)
                            {
                                if ($Verif[$l]==$Recipes[2][$h])
                                {
                                    $VerifR=false;
                                   
                                } 
                            }

                            if ($VerifR==true)
                            {
                                echo("<option value='".$Recipes[2][$h]."'>".$Recipes[0][$h]."</option>");
                                
                            }
                        }

                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>");
                        for ($g=0;$g<count($Dishes[3]);$g++)
                        {
                            
                            if ($Type[$j]==$Dishes[0][$g])
                            {
                                echo($Dishes[3][$g]);
                                echo("<option selected value='".$Dishes[3][$g]."'>".$Dishes[3][$g]."</option>");
                                array_push($Element, $Dishes[3][$g]);
                            }
                        }
                        if ($Element[$j]=='entrée')
                        {
                            echo("<option value='plat'>plat</option>");
                            echo("<option value='dessert'>dessert</option>");
                        }
                        else if ($Element[$j]=='plat')
                        {
                            echo("<option value='entrée'>entrée</option>");
                            echo("<option value='dessert'>dessert</option>");
                        }
                        else if ($Element[$j]=='dessert')
                        {
                            echo("<option value='entrée'>entrée</option>");
                            echo("<option value='plat'>plat</option>");
                        }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuRecipe' value='".$MenuRecipe."'>
                    <p><input type='submit' name='RequestRecipe' value='+'>");
                    if($MenuRecipe > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }
                    echo("</p><p><input type='date' name='date' value='".$SelectEvent[3]."'><input type='time' name='time' value='".$SelectEvent[2]."'></p>
                    <p>Lieu de l'évènement : <input type='text' name='location' value='".$SelectEvent[4]."'></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40 value=''>".$SelectEvent[5]."</TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Modifier'>
                    <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if (!empty($_GET['RequestRecipe']) AND ($_GET['RequestRecipe'] == "+"
                || $_GET['RequestRecipe'] == "-"))
                {
                    echo("
                    <form action='Index.php' method='get'>
                    Vous etes en train de modifier l'événement : ".$_GET['Name']);
                    echo("<br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>");

                    for($j = 0 ; $j < $_GET['MenuUser'] ; $j++ )
                    {
                        echo("<p>Personne à inviter à cette évènement : 
                        <select name='utilisateur".$j."'>");
                        
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            $Into=array();
                            for ($k=0;$k<count($Intolerance[0]);$k++)
                            {
                                if ($Intolerance[0][$k]==$Users[0][$i])
                                {
                                    array_push($Into,$Intolerance[1][$k]);
                                }
                            }
                            $Into=implode(" ", $Into);
                            
                            if ($_GET['utilisateur'.$j]==$Users[0][$i]) 
                            {
                                echo("<option selected value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                            else 
                            {
                                echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                        }
                    echo("</select>
                    <br>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$_GET['MenuUser']."'>");
                    if ($_GET['MenuUser']<count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }
                    if($_GET['MenuUser'] > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    for($j = 0 ; $j < $MenuRecipe ; $j++ )
                    {
                        echo("<p>Recette disponible : 
                        <select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if ($_GET['recette'.$j]==$Recipes[2][$i]) 
                            {
                                echo("<option selected value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo(" EGal :".$Recipes[0][$i]);
                            }
                            else 
                            {
                                echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo($Recipes[0][$i]);
                            }
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>");
                    
                            if ($_GET['service'.$j]=='entrée')
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='plat')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option selected value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='dessert')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option selected value='dessert'>dessert</option>");
                            }
                            else 
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuRecipe' value='".$MenuRecipe."'>
                    <p><input type='submit' name='RequestRecipe' value='+'>");
                    if($MenuRecipe > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("<p><input type='date' name='date' value='".$_GET['date']."'><input type='time' name='time' value='".$_GET['time']."'></p>
                    <p>Lieu de l'évènement : <input type='text' name='location' value='".$_GET['location']."'></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40 value=''>".$_GET['description']."</TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Modifier'>
                    <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if (!empty($_GET['RequestUser']) AND ($_GET['RequestUser'] == "+"
                OR $_GET['RequestUser'] == "-"))
                {
                    echo("
                    <form action='Index.php' method='get'>
                    Vous etes en train de modifier l'événement : ".$_GET['Name']);
                    echo("<br><br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>");

                    for($j = 0 ; $j < $MenuUser ; $j++ )
                    {
                        echo("<p>Personne à inviter à cette évènement : 
                        <select name='utilisateur".$j."'>");
                        
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            $Into=array();
                            for ($k=0;$k<count($Intolerance[0]);$k++)
                            {
                                if ($Intolerance[0][$k]==$Users[0][$i])
                                {
                                    array_push($Into,$Intolerance[1][$k]);
                                }
                            }
                            $Into=implode(" ", $Into);
                            
                            if ($_GET['utilisateur'.$j]==$Users[0][$i]) 
                            {
                                echo("<option selected value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                            else 
                            {
                                echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                        }
                    echo("</select>
                    <br>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$MenuUser."'>");
                    if ($MenuUser<count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }
                    if($MenuUser > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    for($j = 0 ; $j < $_GET['MenuRecipe'] ; $j++ )
                    {
                        echo("<p>Recette disponible : 
                        <select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if ($_GET['recette'.$j]==$Recipes[2][$i]) 
                            {
                                echo("<option selected value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo(" EGal :".$Recipes[0][$i]);
                            }
                            else 
                            {
                                echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo($Recipes[0][$i]);
                            }
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>");
                    
                            if ($_GET['service'.$j]=='entrée')
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='plat')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option selected value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='dessert')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option selected value='dessert'>dessert</option>");
                            }
                            else 
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuRecipe' value='".$_GET['MenuRecipe']."'>
                    <p><input type='submit' name='RequestRecipe' value='+'>");
                    if($_GET['MenuRecipe'] > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("<p><input type='date' name='date' value='".$_GET['date']."'><input type='time' name='time' value='".$_GET['time']."'></p>
                    <p>Lieu de l'évènement : <input type='text' name='location' value='".$_GET['location']."'></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40 value=''>".$_GET['description']."</TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Modifier'>
                    <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if ($_GET['Request'] == "Confirmer"
                AND strlen($_GET['Name'])>20)
                {
                    echo("
                    <form action='Index.php' method='get'>
                    <h3 style='color: red'>Nom de l'évènement trop long</h3>");
                    echo("<br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>");

                    for($j = 0 ; $j < $_GET['MenuUser'] ; $j++ )
                    {
                        echo("<p>Personne à inviter à cette évènement : 
                        <select name='utilisateur".$j."'>");
                        
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            $Into=array();
                            for ($k=0;$k<count($Intolerance[0]);$k++)
                            {
                                if ($Intolerance[0][$k]==$Users[0][$i])
                                {
                                    array_push($Into,$Intolerance[1][$k]);
                                }
                            }
                            $Into=implode(" ", $Into);
                            
                            if ($_GET['utilisateur'.$j]==$Users[0][$i]) 
                            {
                                echo("<option selected value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                            else 
                            {
                                echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                        }
                    echo("</select>
                    <br>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$_GET['MenuUser']."'>");
                    if ($_GET['MenuUser']<count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }

                    if($_GET['MenuUser'] > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    for($j = 0 ; $j < $_GET['MenuRecipe'] ; $j++ )
                    {
                        echo("<p>Recette disponible : 
                        <select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if ($_GET['recette'.$j]==$Recipes[2][$i]) 
                            {
                                echo("<option selected value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo(" EGal :".$Recipes[0][$i]);
                            }
                            else 
                            {
                                echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo($Recipes[0][$i]);
                            }
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>");
                    
                            if ($_GET['service'.$j]=='entrée')
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='plat')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option selected value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='dessert')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option selected value='dessert'>dessert</option>");
                            }
                            else 
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuRecipe' value='".$_GET['MenuRecipe']."'>
                    <p><input type='submit' name='RequestRecipe' value='+'>");

                    if($_GET['MenuRecipe'] > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("<p><input type='date' name='date' value='".$_GET['date']."'><input type='time' name='time' value='".$_GET['time']."'></p>
                    <p>Lieu de l'évènement : <input type='text' name='location' value='".$_GET['location']."'></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40 value=''>".$_GET['description']."</TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Modifier'>
                    <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if ($_GET['Request'] == "Confirmer"
                AND (empty($_GET['Name']) 
                OR empty($_GET['time']) 
                OR empty($_GET['date'])
                OR empty($_GET['location'])
                OR empty($_GET['description'])))
                {
                    echo("
                    <form action='Index.php' method='get'>
                    Vous etes en train de modifier l'événement : ".$_GET['Name']."<br><br>
                    <h3 style='color: red'>Veuillez remplir tous les champs</h3>");
                    echo("<br>
                    <p>Titre de l'évènement : <input type='text' name='Name' value='".$_GET['Name']."'></p>");

                    for($j = 0 ; $j < $_GET['MenuUser'] ; $j++ )
                    {
                        echo("<p>Personne à inviter à cette évènement : 
                        <select name='utilisateur".$j."'>");
                        
                        for ($i=0;$i<count($Users[0]);$i++)
                        {
                            $Into=array();
                            for ($k=0;$k<count($Intolerance[0]);$k++)
                            {
                                if ($Intolerance[0][$k]==$Users[0][$i])
                                {
                                    array_push($Into,$Intolerance[1][$k]);
                                }
                            }
                            $Into=implode(" ", $Into);
                            
                            if ($_GET['utilisateur'.$j]==$Users[0][$i]) 
                            {
                                echo("<option selected value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                            else 
                            {
                                echo("<option value='".$Users[0][$i]."'>".$Users[1][$i]." Intolérances : ".$Into."</option><br>");
                            }
                        }
                    echo("</select>
                    <br>");
                    }
                    echo("<input type='hidden' name='MenuUser' value='".$_GET['MenuUser']."'>");
                    if($_GET['MenuUser'] < count($Users[0]))
                    {
                        echo("<input type='submit' name='RequestUser' value='+'>");
                    }
            
                    if($_GET['MenuUser'] > 1 )
                    {
                        echo("<input type='submit' name='RequestUser' value='-'>");
                    }

                    for($j = 0 ; $j < $_GET['MenuRecipe'] ; $j++ )
                    {
                        echo("<p>Recette disponible : 
                        <select name='recette".$j."'>");
                        for ($i=0;$i<count($Recipes[0]);$i++)
                        {
                            if ($_GET['recette'.$j]==$Recipes[2][$i]) 
                            {
                                echo("<option selected value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo(" EGal :".$Recipes[0][$i]);
                            }
                            else 
                            {
                                echo("<option value='".$Recipes[2][$i]."'>".$Recipes[0][$i]."</option>");
                                //echo($Recipes[0][$i]);
                            }
                        }
                        echo("</select></p>
                        <p>Ceci est <select name='service".$j."'>");
                    
                            if ($_GET['service'.$j]=='entrée')
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='plat')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option selected value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                            else if ($_GET['service'.$j]=='dessert')
                            {
                                echo("<option value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option selected value='dessert'>dessert</option>");
                            }
                            else 
                            {
                                echo("<option selected value='entrée'>entrée</option>");
                                echo("<option value='plat'>plat</option>");
                                echo("<option value='dessert'>dessert</option>");
                            }
                        echo("</select></p>");
                    }
                    echo("<input type='hidden' name='MenuRecipe' value='".$_GET['MenuRecipe']."'>
                    <p><input type='submit' name='RequestRecipe' value='+'>");
                    if($_GET['MenuRecipe'] > 1 )
                    {
                        echo("<input type='submit' name='RequestRecipe' value='-'>");
                    }

                    echo("<p><input type='date' name='date' value='".$_GET['date']."'><input type='time' name='time' value='".$_GET['time']."'></p>
                    <p>Lieu de l'évènement : <input type='text' name='location' value='".$_GET['location']."'></p>
                    Description : 
                    <p><TEXTAREA name='description' rows=4 cols=40 value=''>".$_GET['description']."</TEXTAREA></p>
                    <input type='submit' name='Request' value='Confirmer'>
                    <input type='hidden' name='event' value='Modifier'>
                    <input type='hidden' name='evenement' value='".$_GET['evenement']."'>
                    <input type='hidden' name='page' value='Evènement'>
                    </form>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
                else if ($_GET['Request'] == "Confirmer"
                AND !empty($_GET['Name']) 
                AND !empty($_GET['time']) 
                AND !empty($_GET['date'])
                AND !empty($_GET['location'])
                AND !empty($_GET['description']))
                {
                    echo("
                    Vous avez bien modifié votre évènement !
                    <br><br>
                    <form action='Index.php' method='get'>
                        <input type='submit' value='Retour'>
                        <input type='hidden' name='page' value='Evènement'>
                    </form>
                    ");
                }
            }
        ?> 
    </body>
</html>