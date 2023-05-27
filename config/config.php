<?php
    define("KEY_TOKEN","JEM.dl-23*");
    define("MONEDA", 'S/');

    function currency($amount) {
        $formattedAmount = number_format($amount, 2, '.', ',');
        return MONEDA . ' ' . $formattedAmount;
    }
    
    

?>