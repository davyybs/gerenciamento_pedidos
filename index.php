<?php 
  session_start();
  require_once 'config/conexao.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Formadora III</title>
</head>

<body>
  <h1 class="fw-bold mb-5">Cardápio</h1>


  <!-- Produtos -->
  <div class="produtos">
    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        date_default_timezone_set('America/Sao_Paulo');

        $id_lanche = $_POST['id_lanche'];
        $id_cliente = 1;
        $data_pedido = date('Y-m-d H:i:s');
        $endereco_entrega = 'Rua #### Lt ## Qd ##';
        $preco = $conexao->query("SELECT preco FROM comida WHERE id_comida=$id_lanche")->fetch_assoc()['preco'];

        $sql = "INSERT INTO pedidos (id_cliente, id_comida, data_pedido, endereco_entrega, valor_total) VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "iissd", $id_cliente, $id_lanche, $data_pedido, $endereco_entrega, $preco);
        mysqli_stmt_execute($stmt);

        echo "<p class='text-success'>Pedido registrado com sucesso!</p>";
      }

      $sql = 'SELECT * FROM comida';
      
      $comidas = mysqli_query($conexao, $sql);
      if (mysqli_num_rows($comidas) > 0) {
        foreach ($comidas as $comida) {
    ?>
    <div class="card border-3">
      <img src="<?= $comida['foto']?>" alt="x-burguer" class="card-img-top">
      <hr class="m-0">
      <form method="post">
        <div class="card-body d-flex justify-content-center align-items-center flex-column">
          <h3 class="card-title text-center fs-4"><?= $comida['nome']?></h3>
          <p class="fs-5 fw-semibold">R$<?= $comida['preco']?></p>
          <input type='hidden' name='id_lanche' value='<?= $comida['id_comida']?>'>
          <button class="btn btn-warning fs-5">Pedir</button>
        </div>
      </form>
    </div>
    
    <?php 
      }
    } else {
      echo '<h5>Nenhuma comida foi encontrada</h5>';
    }
    ?>
  </div>

    <a href="pedidos.php" class="btn btn-success mt-3">Ver Pedidos</a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
</body>

</html>