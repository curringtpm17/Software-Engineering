<?php

function Access_Lookup($accessLevel) {
    switch ($accessLevel){
        case 1:
            return "Student";
            break;
        case 2:
            return "Staff";
            break;
        case 3:
            return "Coordinator";
            break;
    }
        
}