<?php
session_start();
 
if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true){
    header("location: login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $arquivo = fopen("livros.txt", "a");
    
    fwrite($arquivo, $_POST["titulo"] . "," . $_POST["autor"] . "," . $_POST["ano"] . "\n");
    
    fclose($arquivo);
    
    $success = "Registro salvo com sucesso.";
}
 
$registros = array();
if(file_exists("livros.txt")){
    $arquivo = fopen("livros.txt", "r");
    
    while(!feof($arquivo)){
        $linha = fgets($arquivo);
        if(!empty($linha)){
            $registro = explode(",", $linha); //explora o registro, vai separar eles por index
            $registros[] = array("titulo" => $registro[0], "autor" => $registro[1], "ano" => $registro[2]);
        }
    }
    
    fclose($arquivo);
}
?>
 
<html>
<head>
    <title>Registros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Registros</h1>
    <?php if(isset($success)) { echo "<p>$success</p>"; } ?>
    <h2>Cadastrar novo livro</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Título:</label>
        <input type="text" name="titulo" required>
        <br><br>
        <label>Autor:</label>
        <input type="text" name="autor" required>
        <br><br>
        <label>Ano:</label>
        <input type="number" name="ano" required>
        <br><br>
        <input type="submit" value="Salvar">
    </form>
    <h2>Livros emprestados</h2>
    <?php if(count($registros) > 0) { ?>
        <table>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano do Livro</th>
            </tr>
            <?php foreach($registros as $registro) { ?>
                <tr>
                    <td><?php echo $registro["titulo"]; ?></td>
                    <td><?php echo $registro["autor"]; ?></td>
                    <td><?php echo $registro["ano"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Cadastre o primeiro livrinho!</p>
    <?php } ?>

    <p>
        <a href="logout.php"> SAIR DA CONTINHA</a>

    </p>
</body>
</html>
