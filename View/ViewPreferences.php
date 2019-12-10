<html>
    <head>
        <title>Préférences alimentaires</title>   
    </head>
    <body>

        <?php

        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == '+' || $_GET['Request'] == '-')
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
                <input type='hidden' name='Menu' value= ".$Menu." >
                </form>";                     
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
            <input type='submit' name='Request' value='+'></p>
            <input type='hidden' name='Menu' value= 1 >

            </form>
            ";     
        }
        ?>

    </body>
</html>