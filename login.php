<?php
  session_start();
  session_unset();
  session_destroy();
  session_write_close();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js" integrity="sha512-6DC1eE3AWg1bgitkoaRM1lhY98PxbMIbhgYCGV107aZlyzzvaWCW1nJW2vDuYQm06hXrW0As6OGKcIaAVWnHJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

      function enviar_email(){
        var email    = document.querySelector("#email").value;
        var mensagem = "<a href='#'>Clique aqui</a> para redefinir sua senha.";

        $.ajax({
            url: "https://formsubmit.co/ajax/" + email,
            method: "POST",
            data: {
                name: "FormSubmit",
                message: mensagem
            },
            success: function (resp){
              if (resp.success == 'true'){                
                alert("E-mail enviado com sucesso!");
              }else{
                alert("Houve um erro ao enviar o e-mail!");
              }
            },
            dataType: "json"
        });
      }

      function exibir_mensagem(titulo, conteudo){
        document.querySelector("#modalTitulo").innerHTML   = titulo;
        document.querySelector("#modalConteudo").innerHTML = conteudo;
        var myModal = new bootstrap.Modal(document.getElementById('minhaModal'))
        myModal.show();
      }

    </script>

  </head>
  <body>

    <!-- Modal -->
      <div class="modal fade" id="minhaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalTitulo">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalConteudo">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
            </div>
          </div>
        </div>
      </div>


    <?php
      session_start();
      if (isset($_SESSION['erro'])){
        echo "<script>exibir_mensagem('Dados incorretos!', 'Usuário ou senha inválida!');</script>";
        unset($_SESSION['erro']);
        echo "entrou aqui bro";
      }
    ?>


    <div class="container text-left mt-5">
      <div class="row">
        
        <div class="col-4 offset-4">
          <div class="mb-3 text-center">
            <h1>Login</h1>
          </div>
          <div class="mb-3">
            <form action="usuarioDAO.php" method="post">
              
              <input type="hidden" class="form-control" id="acao" name="acao" value="login" placeholder="name@example.com">
              
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">

              <label for="senha" class="form-label mt-3">Senha</label>
              <input type="password" class="form-control" id="senha" name="senha">

              <a href="#">Não tenho cadastro</a> | 
              <a href="#" onClick="enviar_email()">Esqueci a senha</a><br><br>

              <button type="submit" class="btn btn-primary mt-3">Entrar</button>
              
            </form>
          </div>
        </div>       
        
      </div>
    </div>


  </body>
</html>