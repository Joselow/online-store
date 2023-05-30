<?php
    require '../config/config.php';

    $datos['ok'] = true;

    if (empty($_POST['id'])) {
        $datos['ok'] = false;
        // Return or exit here, as there is no need to proceed further
    }
    
    $id = $_POST['id'];
    $token = $_POST['token'];
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);  // temporary token for validating the route
    
    if ($token_tmp != $token) {
        $datos['ok'] = false;
        // Return or exit here, as there is no need to proceed further
    }
    if ( empty($_SESSION['cart']['products'][$id])){
        
        $_SESSION['cart']['products'][$id] = 1;
    }

    $_SESSION['cart']['products'][$id] += 1;

    $datos['numbers'] = count($_SESSION['cart']['products']);

    echo json_encode($datos);


?>