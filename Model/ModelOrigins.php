<?php

    function origins()
    {
        require("Model\ModelNewPDO.php");
        $Req = $Bdd -> prepare("SELECT ID_origin,origin_name FROM origins");
        $Req -> execute();
        $Origins = $Req -> fetchall();
        return $Origins;
    }

?>