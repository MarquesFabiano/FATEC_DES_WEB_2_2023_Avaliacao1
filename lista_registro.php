<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: login.php');
  exit;
}

$registros = file('registros.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Lista de Registros</title>
</head>

<body>

  <h1>Lista de Registros</h1>

  <?php if (count($registros) > 0) : ?>
    <ul>
      <?php foreach ($registros as $registro) : ?>
        <li><?php echo $registro; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php else : ?>
    <p>Nenhum registro encontrado.</p>
  <?php endif; ?>

  <br>

  <a href="cadastro.php">Voltar para o Cadastro</a>

</body>

</html>
