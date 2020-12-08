<?php
require './Conexao.php';

if (empty($_SESSION['login'])) {
  header('Location: login.php');
}

$stmtSelect = $conn->prepare('SELECT * FROM produtos AS p2 
JOIN fornecedores AS f2 on f2.IDFornecedor = p2.IDFornecedor
JOIN categorias c2 on c2.IDCategoria = p2.IDCategoria ORDER BY 1 DESC
');
$stmtSelect->execute();

$produtos = $stmtSelect->fetchAll();

if (!empty($_GET['acao'])) {
  if ($_GET['acao'] == 'deletar') {
    $id = $_GET['id'];

    $sql = "
      DELETE FROM ordens_detalhes WHERE IDProduto = :idOrdem;
      DELETE FROM produtos WHERE IDProduto = :idProduto;
    ";
    $sql = $conn->prepare($sql);
    $sql->bindValue(":idOrdem", $id);
    $sql->bindValue(":idProduto", $id);
    $sql->execute();

    header('Location: listagemProduto.php');
  }
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
    <title>Listagem de Produtos - Bootstrap</title>
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
<br><br>
  <a href="./cadastroProduto.php" class="btn btn-primary">Adicionar</a>    
  <table class="table">
    <thead>
      <tr>
        <th scope="col">codigo</th>
        <th scope="col">Nome Produto</th>
        <th scope="col">Nome Fornecedor</th>
        <th scope="col">Nome Categoria</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($produtos as $item) { ?>
      <tr>          
        <td><?= $item['IDProduto'] ?></td>
        <td><?= $item['NomeProduto'] ?></td>
        <td><?= $item['NomeCompanhia'] ?></td>
        <td><?= $item['NomeCategoria'] ?></td>
        <td>
          <a href="alterarProduto.php?id=<?= $item['IDProduto'] ?>" class="btn btn-info">Alterar</a>
          <a href="?acao=deletar&id=<?= $item['IDProduto'] ?>"class="btn btn-danger">Exclui</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</body>
</html>