<html>
    <head>
        <title>Aliments</title>
    </head>
    <body>

<?php 
            require("View/ViewBanner.php");
?>
            <form action="Index.php" method='get'>
            <input type="hidden" name="page" value="Aliments">
            <input type="text" name="TextAddFood" value="">
            <button type="submit">Ajouter cet aliment</button></form>
<?php

foreach ($Aliments as $Aliment): ?>

        <li>

        <?= $Aliment['ID_food'] ?> <?= $Aliment['food_name'] ?>
        


        <form action="Index.php" method='get'>
        <input type='hidden' name="page" value="Aliments">
        <input type="text" name="TextChangeFood" value="<?= $Aliment['food_name']?>">
        <button type="submit" name="ModifierAliment" value="<?= $Aliment['ID_food'] ?>">Modifier</button></form>
        
        <form action="Index.php" method='get'>
        <input type="hidden" name="page" value="Aliments">
        <button type="submit" name="SupprimerAliment" value="<?= $Aliment['ID_food'] ?>">Supprimer</button></form>

        </li>

<?php endforeach; ?> 

    </body>
</html>