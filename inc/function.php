<?php

function userConnected() {

    if (!isset($_SESSION['member'])) {
        
        return false;

    } else {

        return true;

    }
}