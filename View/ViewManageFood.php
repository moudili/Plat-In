<html>
    <head>
        <title>Aliments</title>
    </head>
    <body>

<?php 
            require("View/ViewBanner.php");
?>
            <!--Ajouter-->
            <form action="Index.php" method='get'>
            <input type="hidden" name="page" value="Aliments">
            <input type="text" name="TextAddFood" value="">
            <button type="submit">Ajouter cet aliment</button></form>
<?php
echo ("$MessageErreur");
foreach ($Aliments as $Aliment): ?>

        <li>

        <!--Afficher-->
        <?= $Aliment['ID_food'] ?> <?= $Aliment['food_name'] ?>
        
        <!--Modifier-->
        <form action="Index.php" method='get'>
        <input type='hidden' name="page" value="Aliments">
        <input type="text" name="TextChangeFood" value="<?= $Aliment['food_name']?>">
        <button type="submit" name="ModifierAliment" value="<?= $Aliment['ID_food'] ?>">Modifier</button></form>
        
        <!--Supprimer-->
        <form action="Index.php" method='get'>
        <input type="hidden" name="page" value="Aliments">
        <button type="submit" name="SupprimerAliment" value="<?= $Aliment['ID_food'] ?>">Supprimer</button></form>

        </li>

<?php endforeach; ?> 

    </body>
</html>