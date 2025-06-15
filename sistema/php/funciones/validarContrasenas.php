<?php

function validarContrasenas($clave1, $clave2){

    if ($clave1 === $clave2) {
        return true;
    }else {
        return false;
    }

}

?>