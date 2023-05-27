<?php
    require 'config/database.php';
    require 'config/config.php';
    $db = new Database();

    $con = $db->connect();
    $sql = $con->prepare("SELECT id,name, description, price FROM products WHERE is_active=1");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);


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
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
        <?php foreach($result as $item) { ?>
          <?php
            $id = $item['id'];
            $image = "images/products/".$id."/main.jpg";

            if (!file_exists($image)){
              $image = "images/default.jpg";
            }
          ?>
        <div class="col">

          <div class="card shadow-sm">
            <div class="card-body">
            <img width="200" src="<?php echo $image ; ?>" alt="">
              <p class="card-title"><?php echo $item['name'] ; ?></p>
              <p class="card-text">$ <?php echo currency($item['price']) ; ?></p>
              <div class="d-flex justify-content-between align-items-center">

                <div class="btn-group">
                    <a href="details.php?id=<?php echo $item['id']; ?>&token=<?php echo hash_hmac('sha1',$item['id'], KEY_TOKEN);?>" class="btn btn-primary">Detalles</a>
                </div>
                <a href="" class="btn btn-success">Agregar</a>
              </div>
              </div>
          </div>
        </div>
        <?php } 
        ?>
    </div>
</main>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>