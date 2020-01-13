<?php

    function SelectEvent()
    {
        require('Model\ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT service_name FROM dishes");
        $Req -> execute();
        $Events=array();
        while($n = $Req -> fetch())
        {
            array_push($Events, $n[0]);
        }
        return $Events;
    }
?>