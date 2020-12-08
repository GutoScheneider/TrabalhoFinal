<?php
require_once './Conexao.php';

try{
  if(empty($_POST['email']) || empty($_POST['password'])){
    throw new Exception('Valores obrigatorios não preenchidos'); 
  }else{

    $stmtSelect = $conn->prepare('SELECT * FROM USUARIO WHERE EMAIL = :email and SENHA = :password');
    $stmtSelect->bindValue(':email', $_POST['email']);
    $stmtSelect->bindValue(':password', $_POST['password']);
    $stmtSelect->execute();

    $_SESSION['login'] = $stmtSelect->fetch();

    if($stmtSelect->rowCount() > 0){
      header('Location: listagemProduto.php');
    }
    }
}catch(\Exception $e){
    $mensagem['tipo'] ='danger'; 
    $mensagem['texto'] = $e->getMessage();
 }

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Tela de Login - Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/signin.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
 
  </head>
  <body class="text-center">
    <form method="post" class="form-signin">
     <h1 class="h3 mb-3 font-weight-normal">Logar</h1>
     <label for="email"  class="sr-only">Email </label>
     <input type="text" 
            name="email"
            id="email" 
            class="form-control" 
            placeholder="email" 
            required 
            autofocus>
     <label for="password"  class="sr-only">Senha</label>
     <input type="password" 
            name="password"
            id="password" 
            class="form-control" 
            placeholder="password" 
            required>
     <button class="btn btn-lg btn-primary btn-block" type="submit">Conectar-se</button>
    </form>
  </body>
</html>
