<?php
  include ("proteger.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
  <body>
    
    <div class="container text-center mt-5">
      <div class="row">
        <div class="col-4 offset-4">


          <div class="mb-3 text-end">
            <h6>
              <i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION["nome"] ?> 
              
              <span style="margin-left: 20px; cursor: pointer" onClick="window.location.href='logout.php'">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
              </span>
              
            </h6>
          </div>


          <div class="mb-3 text-center mt-5">
            <h2>PET SHOP DA PRAÇA</h2>
          </div>

          <div class="mb-3 text-center mt-5">
            <button type="button" class="btn btn-primary" onclick="window.location.href='cadUsuario.php'">Usuários</button>
         
            <button type="button" class="btn btn-primary">Agenda</button>
         
            <button type="button" class="btn btn-primary">Clientes</button>
         
            <button type="button" class="btn btn-primary">Serviços</button>
          </div>
          
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>