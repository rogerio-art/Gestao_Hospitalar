<?php
session_start();
?>
<?php
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}
?>
<?php include "../Include/header.php";?>
<?php include "../Include/sidebar.php";?>  
<?php 
include("../inc/connect.php");

if(isset($_POST['submit'])) {
    $especialidade = $_POST['especialidade'];
    $nomemedico = $_POST['nome'];
    $emaildomedico = $_POST['email'];
    $numerodetelefone = $_POST['telefone'];
    $morada = $_POST['morada'];
    $timework = $_POST['escala'];
    $idade = $_POST['idade'];

    $name = null; // Inicializa a variável de nome de arquivo como nulo

    if (!empty($_FILES["file"]["name"])) {
        // Se um novo arquivo foi enviado, faça o upload como faria com um novo arquivo
        $target_dir = "../Upload/Formadores/";
        $name = $_FILES["file"]["name"];
        $size = $_FILES["file"]["size"];
       
        if ($size <= 10 * 1024 * 1024) {
            $temp = $_FILES["file"]["tmp_name"];
            $error = $_FILES["file"]["error"];

            if ($error === UPLOAD_ERR_OK) {
                move_uploaded_file($temp, $target_dir . $name);
            } else {
                echo "Erro ao Carregar o ficheiro. Tenta novamente por favor.";
            }
        } else {
            echo "O tamanho do ficheiro excede o limite de Mega Byte. Por favor carrega um ficheiro até 10 megabytes.";
        }
    } else {
        // Se nenhum novo arquivo foi enviado, verifique se há um arquivo existente no campo "file"
        if (!empty($_POST['current_file'])) {
            // Use o arquivo existente
            $name = $_POST['current_file'];
        }
    }

    $write = mysqli_query($connection,"INSERT INTO medicos(`nomemedico`,`especialidade`,`emaildomedico`,`numerodetelefone`,`morada`,`timework`,`file`,`idade`) 
        VALUES ('$nomemedico','$especialidade','$emaildomedico','$numerodetelefone','$morada','$timework','$name','$idade')") 
        or die(mysqli_error($connection));
        echo " <script>setTimeout(\"location.href='../medico/listdotor.php';\",150);</script>";
}
  
?>
<?php
$p_query=mysqli_query($connection,"SELECT * FROM medicos")or die (mysqli_error($connection));
$p_numrows=mysqli_num_rows($p_query)or die (mysqli_error($connection));
$p_row1 = mysqli_fetch_all($p_query, MYSQLI_ASSOC);


function mysql_fetch_all($query) {
  $all = array();
  while ($all[] = mysqli_fetch_assoc($query)) {$temp=$all;}
  return $temp;
}
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Cadastrar Médico<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> casa</a></li>
            <li class="active"> Cadastrar Médico</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border bg-blue">
                        <i class="fa fa-edit"></i> <h3 class="box-title">Cadastrar Formador</h3>
                    </div>
                   
                    <form method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                        <div class="col-md-6">
                                <label for="exampleInputEmail1">Nome do Formador</label>
                                <input type="text" name="nome" required="required" class="form-control">
                                </div>
                               
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Curso</label>
                                    <select name="especialidade" required="required" class="form-control select2">
                                        <option>..Escolher..</option>
                                        <?php
                                        $p_query = "SELECT * FROM especialidade";
                                        $res = mysqli_query($connection,$p_query);
                                        while ($row1 = mysqli_fetch_array($res)) {
                                            echo $row1['Id'];?>
                                            <option value="<?php echo $row1['Nome'];?>"><?php echo $row1['Nome'];?>
                                            </option>
                                        <?php } ?></select>
                                </div>
                                <div class="col-md-6">
                                <label >Telefone</label>
                                <input type="text" name="telefone" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                        
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="text" name="email" class="form-control" required="required" value="">
                    </div>

                   
                    <div class="col-md-6">
                        <label>Idade</label>
                        <input type="text" class="form-control" name="idade" required="required" id="idade" value="" />

                    </div>
                            
                    <div class="col-md-6">
                                <label>Foto</label>
                                <input class="form-control" type="file" name="file" id=""> 
                            </div>
                           
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Competências do Formador</label>
                                <textarea id="editor1" name="morada" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Horário do Formador</label>
                                <textarea id="editor2" name="escala" class="form-control"></textarea>
                            </div>
                            
                        </div>
                        <!-- Hidden field to store the current file name -->
                        <input type="hidden" name="current_file" value="<?php if(!empty($name)) echo $name; ?>">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" name="submit" class="btn bg-blue">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include "../Include/footer.php";?>
<script src="../bower_components/ckeditor/ckeditor.js"></script>
<script>
$(function () { 
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
})

$(function () { 
    // Replace the <textarea id="editor2"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
})
$(function () { 
    // Replace the <textarea id="editor3"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor3')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
})
</script>
