<html>
    <head>
        <title>Préférences alimentaires</title>   
    </head>
    <body>

        <?php

        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == '+' || $_GET['Request'] == '-' || $_GET['Request'] == 'Valider')
            {
                echo"<form action='../Controller/ControllerPreferences.php' method='get'>
                Préférences alimentaires<br><br>
                Séléctionner un ou plusieurs régimes alimentaires si nécessaire:<br><br>";
                
                for($j = 0 ; $j < $Menu ; $j++)
                {
                    echo "<select name='Diet".$j."'>
                    <option value=''>Aucun</option>";
                    for($i = 0 ; $i < count($PrintDiet[0]) ; $i++)
                    {
                        if($PrintDiet[0][$i] == $_GET['Diet'.$j])
                        {
                            echo("<option selected='selected' value=".$PrintDiet[0][$i].">".$PrintDiet[1][$i]."</option>");
                        }
                        else
                        {
                            echo("<option value=".$PrintDiet[0][$i].">".$PrintDiet[1][$i]."</option>");
                        }
                    }
                    echo"</select> ";

                    if( ($j+2)%5 == 1)
                    {
                        echo("<br><br>");
                    }

                }
                    
                if($Menu > 1)
                {
                    echo"<input type='submit' name='Request' value='-' > ";
                }
                echo"<input type='submit' name='Request' value='+' >
                <input type='hidden' name='Menu' value= ".$Menu." ><br><br>
                Choississez vos trois catégories alimentaires préférés:<br><br>";
            
                for($j = 0 ; $j < 3 ; $j++)
                {
                    echo "<select name='Food".$j."'>
                    <option value=''>Aucun</option>";
                    for($i = 0 ; $i < count($PrintFood[0]) ; $i++)
                    {
                        if($PrintFood[0][$i] == $_GET['Food'.$j])
                        {
                            echo("<option selected='selected' value=".$PrintFood[0][$i].">".$PrintFood[1][$i]."</option>");
                        }
                        else
                        {
                            echo("<option value=".$PrintFood[0][$i].">".$PrintFood[1][$i]."</option>");
                        }
                    }
                    echo"</select> ";                
                }
                
                if($_GET['Request'] == 'Valider' && $CheckMenu1 == "void")
                {
                    echo "<br><br><FONT color='red'>Vous devez séléctionner un régime alimentaire pour chaque menu déroulant ou n'avoir qu'un menu deroulant</FONT>";
                }
                else if($_GET['Request'] == 'Valider' && $CheckMenu1 == "double")
                {
                    echo "<br><br><FONT color='red'>Vous ne pouvez pas séléctionner deux fois le même régime</FONT>";
                }
                else if($_GET['Request'] == 'Valider' && $CheckMenu2 == "void")
                {
                    echo "<br><br><FONT color='red'>Vous devez séléctionner une catégorie alimentaire pour chaque menu déroulant</FONT>";
                }
                else if($_GET['Request'] == 'Valider' && $CheckMenu2 == "double")
                {
                    echo "<br><br><FONT color='red'>Vous ne pouvez pas séléctionner plusieurs fois la même catégorie alimentaire</FONT>";
                }
                else if($_GET['Request'] == 'Valider' && $CheckMenu3 == "false")
                {
                    echo "<br><br><FONT color='red'>Vous avez sélectionné un régime alimentaire et une catégorie aliemntaire incompatibles</FONT>";
                }

                echo "<br><br><input type='submit' name='Request' value='Valider'></form>
                <a href=../Index.php?Request=LogOut><input type='button' value = 'Retour'></a>
                ";                     
            }
        }
        else
        {
            echo"<form action='../Controller/ControllerPreferences.php' method='get'>
            Préférences alimentaires<br><br>
            Séléctionner un ou plusieurs régimes alimentaires si nécessaire:<br><br>
            <select name='Diet0'>
            <option value=''>Aucun</option>";
            for($i = 0 ; $i < count($PrintDiet[0]) ; $i++)
            {
                echo("<option value=".$PrintDiet[0][$i].">".$PrintDiet[1][$i]."</option>");
            }
            echo"</select>
            <input type='submit' name='Request' value='+'>
            <input type='hidden' name='Menu' value= 1 >

            <br><br>Choississez vos trois catégories alimentaires préférés:<br><br>";
            
            for($j = 0 ; $j < 3 ; $j++)
            {
                echo "<select name='Food".$j."'>
                <option value=''>Aucun</option>";
                for($i = 0 ; $i < count($PrintFood[0]) ; $i++)
                {
                    if($PrintFood[0][$i] == $_GET['Food'.$j])
                    {
                        echo("<option selected='selected' value=".$PrintFood[0][$i].">".$PrintFood[1][$i]."</option>");
                    }
                    else
                    {
                        echo("<option value=".$PrintFood[0][$i].">".$PrintFood[1][$i]."</option>");
                    }
                }
                echo"</select> ";                
            }
            
            echo "<br><br><input type='submit' name='Request' value='Valider'></form>
            <a href=../Index.php?Request=LogOut><input type='button' value = 'Retour'></a>
            ";    
        }
        ?>

    </body>
</html>