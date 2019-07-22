<?php


    function addSlashesToInput($postData) : array
    {
        $slashedData = [];
        foreach ($postData as $toBeSlashed)
        {
            $slashedData[key($toBeSlashed)] = addslashes($toBeSlashed);
        }

    }

    var_dump(addslashes($_POST));


