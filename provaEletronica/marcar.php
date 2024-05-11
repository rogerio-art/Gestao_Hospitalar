<?php include"../Include/header.php";?>
<?php include"../Include/sidebar.php";?>
<?php
include("../inc/connect.php");

$query=mysqli_query($connection, "SELECT * FROM exameeletronico")or die (mysqli_error($connection));
$numrows=mysqlI_num_rows($query)or die (mysqli_error($connection));
$row1=mysql_fetch_all($query);
//echo $row1; 
$p_query=mysqli_query($connection, "SELECT * FROM patientregister")or die (mysqli_error($connection));
$p_numrows=mysqlI_num_rows($p_query)or die (mysqli_error($connection));
$p_row1=mysql_fetch_all($p_query);

function mysql_fetch_all($query)

{
$all = array();
while ($all[] = mysqli_fetch_assoc($query)) {$temp=$all;}
return $temp;
}
//print_r($row1); 
//print_r($p_row1);exit;
//$row1[]=mysql_fetch_assoc($query)or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Marcação de Prova</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Marcação de Prova</title>
    
   <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 25px;
        }

        form {
            background-color: #172b4d;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .form-group label {
            color: #fff;
        }

        .form-control {
            background-color: #30404d;
            color: #fff;
            border: 1px solid #30404d;
        }

        .form-control:focus {
            background-color: #30404d;
            color: #fff;
            border: 1px solid #30404d;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="content-wrapper">
  <section class="content-header">
  <h1>

    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="../Index"><i class="fa fa-dashboard"></i> Casa</a></li>
  
  </ol>
</section>
<section class="content">
<div class="row">

</div>
<form id="provaForm" method="POST" action="./scriptProva.php">

<h3 class="box-title"> Provas Eletrónica</h3>
        <div class="form-group">
            <label for="dataProva">Data da Prova:</label>
            <input type="date" class="form-control" id="dataProva" name="dataProva" required>
        </div>

        <div class="form-group">
            <label for="nomeAluno">Nome do Aluno:</label>
            <select name="patient" id="patient"  class="form-control" class="select2"  style="width:100%;" required="required">
<option>

<?php $p_query="SELECT * FROM beneficiario ";
$res=mysqli_query($connection,$p_query);
while ($row1 =mysqli_fetch_array($res)) {
  echo "Escolher";  ?>
<option value="<?php echo $row1['id'];?>"><?php echo $row1['namebenif'];?>
</option>            
 
<?php } ?> 
</option>
<?php

 $p_query="SELECT * FROM patientregister";
$res=mysqli_query($connection,$p_query);
while ($row1 =mysqli_fetch_array($res)) {
  echo $row1['id'];?>
<option value="<?php echo $row1['id'];?> "><?php echo $row1['name'];?> 
 </option>
<?php } ?></select>
        </div>

        <div class="form-group">
            <label for="nomeProva">Nome da Prova:</label>
            <input type="text" class="form-control" id="nomeProva" name="nomeProva" required>
        </div>

        <div class="form-group">
            <label for="dataExpiracao">Data de Expiração:</label>
            <input type="date" name="dataExpiracao" class="form-control" id="dataExpiracao" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Marcar Prova</button>

    </form>
<br><br>
   
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById("provaForm").addEventListener("submit", function (event) {
        event.preventDefault();
        // Adicione aqui a lógica para processar os dados do formulário, se necessário
        alert("Prova marcada com sucesso!");
    });
</script>




      </div>
  
</section>
</div>

</body>
</html>
<?php include "../Include/footer.php";?>
