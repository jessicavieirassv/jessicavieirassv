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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js" integrity="sha512-6DC1eE3AWg1bgitkoaRM1lhY98PxbMIbhgYCGV107aZlyzzvaWCW1nJW2vDuYQm06hXrW0As6OGKcIaAVWnHJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

      function limpar(){
        document.querySelector("#id").value  = "";
        document.querySelector("#nome").value  = "";
        document.querySelector("#email").value = "";
        document.querySelector("#senha").value = "";

        document.querySelector("#titulo").innerHTML = "Cadastrar usuário";
      }

      function excluir(id){
        var json  = {};
        json.id   = id;
        json.acao = "delete";

        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
              exibir_mensagem("Resultado da solicitação", resp);
              consultar();
          }
        });
      }


      function inserir(){
        var json = {};
        json.nome  = document.querySelector("#nome").value;
        json.email = document.querySelector("#email").value;
        json.senha = document.querySelector("#senha").value;

        json.id    = document.querySelector("#id").value;

        if (json.id==""){
          json.acao  = "insert";
        }else{
          json.acao  = "update";
        }


        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
              exibir_mensagem("Resultado da solicitação", resp);
              consultar();
          }
        });
      }

      function editar(id, nome, email){
        document.querySelector("#id").value    = id;
        document.querySelector("#nome").value  = nome;
        document.querySelector("#email").value = email;
        document.querySelector("#senha").value = "";

        document.querySelector("#titulo").innerHTML   = "Alterar usuário";

      }

      function consultar(){
        var json = {};
        json.acao  = "select";

        $.ajax({
          url : "usuarioDAO.php",
          data: json,
          type: "post",
          success: function (resp){
            var linhas = JSON.parse(resp);
            document.querySelector("#corpoTabela").innerHTML = "";
            for (i=0;i<linhas.length;i++){
              var id    = linhas[i].id;
              var nome  = linhas[i].nome;
              var email = linhas[i].email;

              var linha = `<tr>
                  <td><button type="button" class="btn btn-outline-secondary" onClick="editar(${id}, '${nome}', '${email}')">Editar</button></td>
                  <td><button type="button" class="btn btn-outline-danger" onClick="excluir(${id})">Excluir</button></td>
                  <td>${id}</td>
                  <td>${nome}</td>
                  <td>${email}</td>
                </tr>`;

              document.querySelector("#corpoTabela").innerHTML += linha;

            }
          }
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



    <div class="container text-left mt-5">
      <div class="row">
        <div class="col-6 offset-3">
          <div class="mb-3">
            <h2 id="titulo">Cadastrar usuário</h2>
          </div>

          <div class="mb-3 mt-5 lh-1">
            <label for="id" class="form-label">Id</label>
            <input type="text" class="form-control" id="id" placeholder="" readonly disabled>
          </div>

          <div class="mb-3 lh-1">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="">
          </div>
          <div class="mb-3 lh-1">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="">
          </div>
          <div class="mb-3 lh-1">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" placeholder="">
          </div>
          <div class="mb-3 lh-1">
            <button type="button" class="btn btn-primary" onclick="window.location.href='principal.php'">Voltar</button>
            <button type="button" class="btn btn-primary" onClick="consultar()">Consultar</button>
            <button type="button" class="btn btn-primary" onClick="inserir()">Salvar</button>
            <button type="button" class="btn btn-primary" onClick="limpar()">Limpar</button>

            
          </div>

          <div class="mb-3">
            <table class="table caption-top">
              <thead>
                <tr>
                  <th scope="col">editar</th>
                  <th scope="col">excluir</th>
                  <th scope="col">ID</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody id="corpoTabela">
                <!--Linha da tabela aqui-->
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>