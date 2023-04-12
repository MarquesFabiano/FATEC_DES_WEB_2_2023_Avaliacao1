<?php
session_start();

if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
    header("location: registro.php");
    exit;
}
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST["login"] == "fatec" && $_POST["senha"] == "araras"){
        session_start();
        $_SESSION["logged"] = true;
        header("location: registro.php");
    } else {
        $error = "Login ou senha inválidos. Verifique!";
    }
}
?>
 
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca da FATEQUE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Biblioteca da FATEC</h1>
    <h2>Área de Login</h2>
    <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Insira o Usúario:</label>
        <input type="text" name="login" required>
        <br><br>
        <label>Insira a senha:</label>
        <input type="password" name="senha" required>
        <br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
