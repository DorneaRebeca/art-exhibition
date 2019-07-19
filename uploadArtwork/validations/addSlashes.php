<?php

    function addSlashes($postData) : array
    {
        $slashedData = [];
        foreach ($postData as $toBeSlashed)
        {
            $slashedData[key($toBeSlashed)] = addslashes($toBeSlashed);
        }
    }


