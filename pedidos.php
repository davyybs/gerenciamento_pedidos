<?php 
  session_start();
  require_once 'config/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Pedidos</title>
</head>

<body class="container">
  <h1>Pedidos</h1>

  <a href="index.php" class="btn btn-secondary">Voltar</a>

  <table class="table border border-2 mt-3">
    <thead>
      <tr>
        <th>Data</th>
        <th>Cliente</th>
        <th>Pedido</th>
        <th>Endereço</th>
        <th>Valor</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $sql = 'SELECT * FROM pedidos;';

      $pedidos = mysqli_query($conexao, $sql);
      if (mysqli_num_rows($pedidos) > 0) {
        foreach ($pedidos as $pedido) {
          $idCliente = $pedido['id_cliente'];
          $idComida = $pedido['id_comida'];
    ?>
      <tr>
        <td><?= $pedido['data_pedido']?></td>
        <td>
          <?php 
            $nomeCliente = "SELECT nome FROM clientes WHERE id_cliente = $idCliente";
            $stmt = mysqli_query($conexao, $nomeCliente);
            $cliente = mysqli_fetch_assoc($stmt);

            echo $cliente['nome'];
          ?>
        </td>
        <td>
          <?php 
            $nomeComida = "SELECT nome FROM comida WHERE id_comida = $idComida";
            $stmt = mysqli_query($conexao, $nomeComida);
            $comida = mysqli_fetch_assoc($stmt);

            echo $comida['nome'];
          ?>
        </td>
        <td><?= $pedido['endereco_entrega']?></td>
        <td><?= 'R$' . $pedido['valor_total']?></td>
      </tr>
      <?php 
          }
        }
      ?>
    </tbody>
  </table>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
</body>

</html>