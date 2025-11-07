<?php 
  $server = 'localhost';
  $user = 'root';
  $password = '';
  $db = 'avaliacao_formadora_3';
  
  $conexao = mysqli_connect($server, $user, $password, $db);
  
  if (!$conexao) {
      die("Falha na conexão: " . mysqli_connect_error());
  }
?>

