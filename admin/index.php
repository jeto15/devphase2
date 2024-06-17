<?php
/**
 * Defualt
 */
session_start();
if( $_SESSION['Dashboard'] == 0){
    header("Location: patient");
}else {
    header("Location: home");
}


exit();