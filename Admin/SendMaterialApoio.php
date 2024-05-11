<?php
session_start();    

if (empty($_SESSION['id'])) {
    header("location: ../Validar_user_logado.php");
    
}
    ?>
<?php include('../controllers/ContactoCodeAdmin.php'); ?>
<?php include"../Include/header.php";?>
<?php include"../Include/sidebar.php";?>  
<?php 



$query=mysqli_query($connection, "SELECT * FROM contacto ")or die (mysqli_error($connection));
$numrows=mysqlI_num_rows($query)or die (mysqli_error($connection));
$row1=mysql_fetch_all($query);
//echo $row1; 

function mysql_fetch_all($query)

{
$all = array();
while ($all[] = mysqli_fetch_assoc($query)) {$temp=$all;}
return $temp;
}
 ?>
<script src="../dist/dist/jquery.min.js"></script>

<script>
$(function() {
    $("#nome").change(function() {
        var idSelecionado = $("#nome option:selected").val(); // Obtém o valor do option selecionado
        $("#id").val(idSelecionado); // Atualiza o valor do elemento com ID 'id' com o valor selecionado
    });
});
</script>

        <!doctype html>
        <html lang="en">
        <head>
    <meta charset="utf-8">

</head>
<!-- The sidebar -->
  <!-- Bootstrap 3.3.7 -->                                       
  <!--link rel="stylesheet" href="CSS/bootstrap.min.css"-->
  <?php
  foreach ($row1 as $row)
    {
$s1=mysqli_query($connection," SELECT name FROM patientregister WHERE id='".$row['name']."'");
$w1 =mysqli_query($connection," SELECT name FROM patientregister WHERE id='".$row['name']."'") ;//or die(mysqli_error($connection));
//print_r($w1); exit;
$row2=mysqli_fetch_array($w1);//or die (mysqli_error($connection));
 //print_r($row2); exit();
?> <?php } ?><tr>  

             <!-- Page content -->
        <div class="content-wrapper">
        <section class="content-header">
      <h1>
      <font color="black">Responder Contacto</font>  
      <small></small>
      </h1>
     <ol class="breadcrumb">
       <li><a href="./index.php"><i class="fa fa-dashboard"></i>Casa</a></li>
  
     </ol>
   </section>
   <section class="content">
     <div class="box box-primary">
       <div class="box-header with-border">
   <form method="POST" enctype="multipart/form-data" class="row g-3">
   <div class="col-md-6">
       
     <label for="exampleInputEmail1">Nome do Aluno</label><br>

     <select name="nome" id="nome" class="form-control select2" style="width:100%;" required="required">
    <option>Escolher</option>
    <?php
    $p_query = "SELECT * FROM patientregister";
    $res = mysqli_query($connection, $p_query);
    while ($row1 = mysqli_fetch_array($res)) {
        ?>
        <option value="<?php echo $row1['id']; ?>"><?php echo htmlentities($row1['name']); ?></option>
    <?php } ?>
</select>
</div>
          <input type="hidden" class="form-control" name="id" id="id" value=""  readonly="readonly">

                        <div class="col-md-6">
                        <label>Seu e-mail</label>
                        <input type="text" placeholder="" class="form-control" name="email" id="email" required="required" value="<?php echo $_SESSION['username'];?>" />
                    </div>

                    <div class="col-md-6">
                        <label>Assunto</label>
                        <input type="text" class="form-control" placeholder="" name="assunto" id="assunto" required="required" value="Material de apoio" />  
                    </div>

                   
                    <div class="col-md-6">
                        <label>Telefone</label>
                        <input type="text" class="form-control" name="telefone" required="required" id="telefone" value="<?php echo $_SESSION['telefone'];?>" />

                    </div>

                    <div class="col-md-6">
  <label >Tipo de Contacto</label>
      <select name="contactType" id="contactType"  class="form-control" required="required">
      <option value="" disabled selected="selected">Escolher</option>
      <option>Candidatura</option>
      <option>Contacto</option>
      <option>Solicitação de Justificativo</option>
      </select>
      </div>

                    <div class="col-md-6">
  <label>Anexar Ficheiro</label>
   <input class="form-control" type="file" name="file" id="fileToUpload">

  </br>     
</div>
<div class="col-md-12">
<label for="inputState" class="form-label">Digite Sua Mensagem</label>
                    
<textarea id="editor1" name="mensagem" class="form-control"  required="required" ></textarea>
                    </div>

                    
     
  <div class="col-md-12">
    <br>
    <input name="submit" type="submit" onclick="myfunction()" id="log-btn" value="Enviar" STYLE = "color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #16035a;" size = "10" maxlength = "30" class="form-control" class="btn btn-primary "  />
     
                    </div>         
                                      
<div class="col-md-6">
 
  </div>
  
  </form>


                  </div>
</div>

     
      
</section>
 

</body>
</div>   
<?php include "../Include/footer.php";?>
     </html>

     <script src="../bower_components/ckeditor/ckeditor.js">
</script>
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
 