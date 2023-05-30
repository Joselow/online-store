<?php
    define("KEY_TOKEN","JEM.dl-23*");
    define("MONEDA", 'S/');

    session_start();  // crea una sesión

    function currency($amount) {
        $formattedAmount = number_format($amount, 2, '.', ',');
        return MONEDA . ' ' . $formattedAmount;
    }
    
    $num_cart = 0;
    if( isset($_SESSION['cart']['products'])){
        $num_cart = count($_SESSION['cart']['products']);
    }

?>