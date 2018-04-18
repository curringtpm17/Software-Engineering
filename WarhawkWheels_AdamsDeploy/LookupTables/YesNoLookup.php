<?php

function YesNo_Lookup($val) {
    switch ($val){
        case 0:
        case 3:
            return "No";
            break;
        case 1:
        case 2:
            return "Yes";
            break;
    }
}