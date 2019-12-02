<?php

    function Origins()
    {
        if(empty($_GET['Request']))
        {
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("SELECT ID_origin,origin_name FROM origins ORDER BY origin_name");
            $Req -> execute();
            $Origins = array(array(),array());
            while($n = $Req -> fetch())
            {
                array_push($Origins[0], $n[0]);
                array_push($Origins[1], $n[1]);               
            }
            
            return $Origins;
        }
    }

    function CheckForm ($Org) 
    {
        if($_GET['Request'] == "Ajouter")
        {
            echo strlen($_GET['Org']);
            if(!empty($_GET['Org'])
            && strlen($_GET['Org']) > 2
            && strlen($_GET['Org']) < 40
            && preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Org'])
            )
            {
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT count(ID_origin) FROM origins WHERE origin_name LIKE :origin");
                $Req -> bindParam(':origin',$Org,PDO::PARAM_STR);
                $Req -> execute();
                $n = $Req -> fetch();
                $CheckForm = $n[0];

                if($CheckForm == 0)
                {
                    $Req = $Bdd -> prepare("INSERT INTO `origins` (`ID_origin`, `origin_name`) VALUES (NULL, :origin);");
                    $Req -> bindParam(':origin',$Org,PDO::PARAM_STR);
                    $Req -> execute();                    

                }

                return $CheckForm;

            }
        }
    }

    function DeletOrigin() 
    {
        if($_GET['Request'] == "Supprimer")
        {
            if(!empty($_GET['Answer']))
            {
                $Id = $_GET['id'];
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("DELETE FROM `origins` WHERE `origins`.`ID_origin` = :id");
                $Req -> bindParam(':id',$Id,PDO::PARAM_STR);
                $Req -> execute();       

            }
        }
    }

    function ModifOrigin($Org)
    {
        if($_GET['Request'] == "Modifier cette origine")
        {
            if(!empty($_GET['Org'])
            && strlen($_GET['Org']) > 2
            && strlen($_GET['Org']) < 40
            && preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Org'])
            )
            {
                $Id = $_GET['id'];
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT count(ID_origin) FROM origins WHERE origin_name LIKE :origin");
                $Req -> bindParam(':origin',$Org,PDO::PARAM_STR);
                //$Req -> bindParam(':id',$Id,PDO::PARAM_STR);
                $Req -> execute();
                $n = $Req -> fetch();
                $CheckForm = $n[0];

                if($CheckForm == 0)
                {
                    $Req = $Bdd -> prepare("UPDATE `origins` SET `origin_name` = :origin WHERE `origins`.`ID_origin` = :id;");
                    $Req -> bindParam(':origin',$Org,PDO::PARAM_STR);
                    $Req -> bindParam(':id',$Id,PDO::PARAM_STR);
                    $Req -> execute();                    

                }

                return $CheckForm;
            }
        }
    }

    function SearchOrigin($Org)
    {
        if($_GET['Request'] == "Search")
        {
            require("Model/ModelNewPDO.php");
            if(empty($_GET['Org']))
            {
                $Req = $Bdd -> prepare("SELECT ID_origin,origin_name FROM origins ORDER BY origin_name");
                $Req -> execute();
                $Origins = array(array(),array());
                while($n = $Req -> fetch())
                {
                    array_push($Origins[0], $n[0]);
                    array_push($Origins[1], $n[1]);               
                }
            }
            else
            {
                $Req = $Bdd -> prepare('SELECT ID_origin,origin_name FROM origins WHERE origin_name LIKE "%'.$Org.'%" ORDER BY origin_name');
                $Req -> execute();
                $Origins = array(array(),array());
                if($Req->rowCount() > 0)
                {
                    while($n = $Req -> fetch())
                    {
                        array_push($Origins[0], $n[0]);
                        array_push($Origins[1], $n[1]);               
                    }
                }
                else
                {
                    $Origins = false;
                }
            }
            return $Origins;
        }
    }

?>