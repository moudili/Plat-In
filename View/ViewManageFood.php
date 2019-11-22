<html>
<head>
    <title>Gestion des aliments</title>
</head>
<body>

<ul>


<?php 

foreach ($Aliments as $Aliment): ?>

        <li>

        <?= $Aliment['ID_food'] ?> <?= $Aliment['food_name'] ?>
        <button type="submit" 
        <a href="modifier.php?ID_food=<?= $dossier['ID_food'] ?>">Modifier</a>
        <a href="supprimer.php?ID_food=<?= $aliment['ID_food'] ?>">Supprimer</a>

    
        </li>

<?php endforeach; ?>

</body>
</html>