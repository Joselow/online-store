<?php
    require 'config/database.php';
    require 'config/config.php';

    $db = new Database();
    $con = $db->connect();

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';

    $token_tmp = hash_hmac('sha1',$id, KEY_TOKEN);

    if ( $id == '' || $token == '' ||$token != $token_tmp ){
        echo 'Error al procesar la pertición';
        exit;
    }

    
    $sql = $con->prepare("SELECT count(id) FROM products WHERE id=? AND is_active=1");
    $sql->execute([$id]);
    if( $sql->fetchColumn() > 0  ) {
        $sql = $con->prepare("SELECT id,name, description, price, discount FROM products WHERE id=? AND is_active=1");
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);



        $discount =  $result['discount'] > 0 ? $result['price'] - ($result['price'] * $result['discount']/100) : 0;
        $rutaImg = "images/products/".$result['id']."/main.jpg";
        
        $rutaImg = !file_exists($rutaImg) ? "images/default.jpg": $rutaImg;
        // var_dump($result);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiena Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<header data-bs-theme="dark">
  <div class="collapse text-bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
 
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark navbar-expand-lg bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand ">
        <strong>Tienda </strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarHeader">
        <ul class="navbar-nav  me-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
                <a href="" class="nav-link active">Catalogo</a>
            </li>   
            <li class="nav-item">
                <a href="" class="nav-link ">Contacto</a>
            </li>  
            
        </ul>
        <a class="btn btn-primary" href="carrito.php">Carrito</a>
      </div>
    </div>
  </div>
</header>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <img src=" <?php
                   echo  $rutaImg
                    ?>" alt="">
            </div>
            <div class="col-md-6 order-md-2">
                <h2>
                    <?php
                       echo $result['name'];
                    ?>
                </h2>

                <?php
                    if($discount > 0) { ?>
                <p> <del> <?php echo  currency($result['price'])?> </del> </p>
                <h2>
                    <?php
                       echo  currency($discount);
                    ?>
                    <small class="text-success">
                        <?php
                            echo  $result['discount']." %Desc."
                        ?>
                    </small>

                </h2>
            <?php } else{ ?>
                <h2>
                    <?php
                       echo  currency($result['price']);
                    ?>
                </h2>
             <?php }?>

                <p class="lead">
                <?php
                       echo $result['description'] ;
                    ?>
                </p>
                <div class="d-grid gap-3 col-10 mx-auto">
                    <button class="btn btn-primary">Comprar Ahora</button>
                    <button class="btn btn-outline-primary">Agregar al Carrito</button>
                </div>

            </div>

        </div>
    
    </div>
</main>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>