<?php
include("../inc/connect.php");

if(isset($_POST['submit'])) {
    if (isset($_POST['patient'])) {
        $score = $_POST['score'];
        $iduser = ($_SESSION['id']);
        $nome = ($_POST['patient']);
        $dataProva = ($_POST['dataProva']);
        $datafin = ($_POST['dataExpiracao']);

        if ($score > 2) {
            $resultado = "Apto";
        } else {
            $resultado = "Não Apto";
        }

        // Corrected SQL query syntax
        $sql = "INSERT INTO exameeletronico (iduser, nome, pontuacao, resultado, Descricao, data)
                VALUES ('$iduser', '$nome', '', '$resultado', '', '$datafin', '$dataProva')";

        $sqlQuery = mysqli_query($connection, $sql);

        header("Location: ./actividades.php");
        exit();  // Add exit to stop further execution
    }
}
?>
