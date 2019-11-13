<?php

function CheckMdp()
{

    $Ndu = $_GET['ndu'];
    $FirstName = $_GET['first_name'];
    $LastName = $_GET['last_name'];
    $Adresse = $_GET['adresse'];
    $Mail = $_GET['mail'];
    $Phone = $_GET['phone'];
    $Mdp = $_GET['mdp'];
    $Cmdp = $_GET['cmdp'];

    if ($Mdp != $Cmdp) 
    {
        echo('
        <input id="hidden" name="ndu" type="hidden" value="'.$Ndu.'">
        <input id="hidden" name="paswword" type="hidden" value="'.$Mdp.'">
        <input id="hidden" name="first_name" type="hidden" value="'.$FirstName.'">
        <input id="hidden" name="last_name" type="hidden" value="'.$LastName.'">
        <input id="hidden" name="adresse" type="hidden" value="'.$Adresse.'">
        <input id="hidden" name="mail" type="hidden" value="'.$Mail.'">
        <input id="hidden" name="phone_number" type="hidden" value="'.$Phone.'">
        ');
        require('View\ViewSignUpFalse.php');
    } else 
    {
        require('Model\ModelSignUp.php');
        ModelSignUp ($Ndu, $FirstName, $LastName, $Adresse, $Mail, $Phone, $Mdp, $Cmdp);
        if ($_GET['create'] == true) 
        {
            require('View\ViewSignUpGood.php');
        } else 
        {
            echo('
        <input id="hidden" name="ndu" type="hidden" value="'.$Ndu.'">
        <input id="hidden" name="paswword" type="hidden" value="'.$Mdp.'">
        <input id="hidden" name="first_name" type="hidden" value="'.$FirstName.'">
        <input id="hidden" name="last_name" type="hidden" value="'.$LastName.'">
        <input id="hidden" name="adresse" type="hidden" value="'.$Adresse.'">
        <input id="hidden" name="mail" type="hidden" value="'.$Mail.'">
        <input id="hidden" name="phone_number" type="hidden" value="'.$Phone.'">
        ');
        require('View\ViewSignUpFalse.php');
        }
    }
   
}

?>