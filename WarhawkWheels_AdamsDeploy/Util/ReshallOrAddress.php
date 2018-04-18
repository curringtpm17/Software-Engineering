<?php

include "LookupTables/ReshallLookup.php";

function reshall_addressDisplay($oncampus, $resHall, $address){
    if ($oncampus == 1){
        return ResidentHall_Lookup($resHall);
    }
    else if ($oncampus == 0) {
        return $address;
    }
}