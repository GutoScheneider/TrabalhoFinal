<?php
require './Conexao.php';
if (empty($_SESSION['login'])) {
  header('Location: login.php');
}
$stmtSelect = $conn->prepare('SELECT * FROM fornecedores');
$stmtSelect->execute();
$fornecedores = $stmtSelect->fetchAll();

$stmtSelect = $conn->prepare('SELECT * FROM categorias');
$stmtSelect->execute();
$categorias = $stmtSelect->fetchAll();

if (empty($_GET['id'])) {
  header('Location: listagemProduto.php');
}

$id = $_GET['id'];

$stmtSelect = $conn->prepare('SELECT * FROM  produtos WHERE IDProduto = :id');
$stmtSelect->bindValue(':id', $id);
$stmtSelect->execute();

if ($stmtSelect->rowCount() == 0 ) {
  header('Location: listagemProduto.php');
}

$produto = $stmtSelect->fetch();

if (!empty($_POST['nome'])) {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $idFornecedor = $_POST['fornecedor'];
  $idCategoria = $_POST['categoria'];
  $quantidadePorUnidade = $_POST['quantidade'];
  $precoUnitario = $_POST['preco'];
  $unidadesEstoque = $_POST['unidadeEmEstoque'];
  $unidadesEmOrdem = $_POST['unidadeEmOrdem'];
  $nivelreposicao = $_POST['nivel'];
  $descontinuado = $_POST['descontinuado'];

  $stmtSelect = $conn->prepare('
  UPDATE produtos SET NomeProduto = :n
, IDFornecedor = :f, IDCategoria = :c, QuantidadePorUnidade = :q, PrecoUnitario = :p
    , UnidadesEmEstoque = :ue
    , IDProduto = :id
    , UnidadesEmOrdem = :uo
    , NivelDeReposicao = :nr
    , Descontinuado = :d
  WHERE IDProduto = :id
  ');

  $stmtSelect->bindValue(':id', $id);
  $stmtSelect->bindValue(':n', $nome);
  $stmtSelect->bindValue(':f', $idFornecedor);
  $stmtSelect->bindValue(':c', $idCategoria);
  $stmtSelect->bindValue(':q', $quantidadePorUnidade);
  $stmtSelect->bindValue(':p', $precoUnitario);
  $stmtSelect->bindValue(':ue', $unidadesEstoque);
  $stmtSelect->bindValue(':uo', $unidadesEmOrdem);
  $stmtSelect->bindValue(':nr', $nivelreposicao);
  $stmtSelect->bindValue(':d', $descontinuado);
  $stmtSelect->execute();

  header('Location: listagemProduto.php');
}
?>

<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Alterar de Produtos - Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/css/signin.css">
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
    <!-- Custom styles for this template --> 
  </head>
  <body>
<form method="POST">
    <div class="form-group">
     <label for="fornecedor">Fornecedor : </label>
     <select class="form-control" name="fornecedor" id="fornecedor">
     <?php foreach($fornecedores as $fornecedor) { ?>
       <option value="<?= $fornecedor['IDFornecedor'] ?>"><?= $fornecedor['NomeCompanhia'] ?></option>
     <?php } ?>
     </select>
     <hr>
    </div>

    <div class="form-group">
     <label for="categoria">categoria : </label>
     <select class="form-control" name="categoria" id="categoria">
      <?php foreach($categorias as $categoria) { ?>
        <option value="<?= $categoria['IDCategoria'] ?>"><?= $categoria['NomeCategoria'] ?></option>
      <?php } ?>
     </select>
    </div>

    <div class="form-group">
     <label for="produto">Produto : </label>
      <input type="text" class="form-control" name="id" placeholder="id produto" value="<?= $produto['IDProduto'] ?>">
      <input type="text" class="form-control" name="nome" placeholder="nome produto" value="<?= $produto['NomeProduto'] ?>">
     </div>
  
    <div class="form-group">
      <label for="quantidade">Quantidade: </label>
      <input type="text" class="form-control" name="quantidade" placeholder="quantidade" value="<?= $produto['QuantidadePorUnidade'] ?>">
    </div>

    <div class="form-group">
      <label for="preco">Preço: </label>
      <input type="text" class="form-control" name="preco" placeholder="preco" value="<?= $produto['PrecoUnitario'] ?>">
    </div>

    <div class="form-group">
      <label for="unidadeEmEstoque">Unidades Em Estoque: </label>
      <input type="text" class="form-control" name="unidadeEmEstoque" placeholder="quantidade" value="<?= $produto['UnidadesEmEstoque'] ?>">
    </div>

    <div class="form-group">
      <label for="unidadeEmOrdem">Unidade em Ordem: </label>
      <input type="text" class="form-control" name="unidadeEmOrdem" placeholder="unidadeEmOrdem" value="<?= $produto['UnidadesEmOrdem'] ?>">
    </div>

    <div class="form-group">
      <label for="nivel">Nivel de reposição: </label>
      <input type="text" class="form-control" name="nivel" placeholder="nivel" value="<?= $produto['NivelDeReposicao'] ?>">
    </div>

    <div class="form-group">
     <p>Descontinuado<br>
     <select name="descontinuado" id="descontinuado">
       <option value="T">T</option>
       <option value="F">F</option>
     </select>
    </div>
   <hr>
   <button type="submit" class="btn btn-primary">Alterar</button> 
   <a href="./listagemProduto.php" class="btn btn-primary">Voltar</a> 
</form>
  </body>
</html>
