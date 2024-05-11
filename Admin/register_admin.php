<?php
session_start();
include("../inc/connect.php");

$nameAdmin = mysqli_real_escape_string($connection, $_POST['name']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$telefone = mysqli_real_escape_string($connection, $_POST['telefone']);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";

if (!preg_match($regex_email, $email)) {
    echo "Email no formato incorreto. Tente novamente...";
    exit();
}

$senha = md5(md5(mysqli_real_escape_string($connection, $_POST['senha'])));
if (strlen($senha) < 3) {
    echo "A senha deve conter no mínimo 3 caracteres. Tente novamente...";
    exit();
}

$sobre = $_POST['sobrenome'];
$duplicate_user_query = "SELECT id FROM login WHERE username='$email'";
$duplicate_user_result = mysqli_query($connection, $duplicate_user_query) or die(mysqli_error($connection));
$rows_fetched = mysqli_num_rows($duplicate_user_result);

if ($rows_fetched > 0) {
    ?>
    <script>
        window.alert("Este email já existe na base de dados! Escolha outro email válido.");
    </script>
    <meta http-equiv="refresh" content="1;url=acess.php" />
    <?php
    exit();
}

$name_file = null;

if (!empty($_FILES["file"]["name"])) {
    $target_dir = "../Upload/Adminprofile/";
    $name_file = $_FILES["file"]["name"];
    $temp = $_FILES["file"]["tmp_name"];
    $error = $_FILES["file"]["error"];

    if ($error === UPLOAD_ERR_OK) {
        move_uploaded_file($temp, $target_dir . $name_file);
    } else {
        echo "Erro ao carregar o arquivo. Tente novamente, por favor.";
        exit();
    }
}

$user_registration_query = "INSERT INTO login (profile, fname, lname, username, password, telefone) 
    VALUES ('$name_file', '$nameAdmin', '$sobre', '$email', '$senha', '$telefone')";

$user_registration_result = mysqli_query($connection, $user_registration_query) or die(mysqli_error($connection));


?>
<script>
    window.alert("Registro inserido com sucesso!");
</script>
<meta http-equiv="refresh" content="1;url=../Index/index.php" />
