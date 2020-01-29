<?php
    require('Model/ModelRelation.php');
    require('ControllerStaple.php');
    $ListeUtilisateur = ListeUtilisateur();
    $Relation = Relation();
    if($_GET['Relation']=='Mettre a jour')
    {
        Modifier();
        header("Location:Index.php?page=Relation");

    }elseif($_GET['Relation']=='Supprimer')
    {
        Supprimer();
        header("Location:Index.php?page=Relation");
    }elseif($_GET['Relation']=='Inserer')
    {
        Inserer();
        header("Location:Index.php?page=Relation");
    }
    CheckSesion();
    CheckLogOut();
    require("View/ViewRelation.php");

?>