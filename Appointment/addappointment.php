<?php include"../Include/header.php";?>
<?php include"../Include/sidebar.php";?> 
<?php //include"../controllers/marcarconsulta_admin.php";?>  
<?php 
  include("../inc/connect.php") ;

?>
<script src="../dist/dist/jquery.min.js"></script>
<script>
function getdoctor(val) {
    $.ajax({
        type: "POST",
        url: "../get_doctor.php",
        data: 'specilizationid=' + val,
        success: function(data) {
            $("#doctor").html(data);
        }
    });
}

function getfee(val) {
    $.ajax({
        type: "POST",
        url: "../get_doctor.php", // Corrigi o nome do arquivo PHP para receber a solicitação de preço
        data: 'Price=' + val,
        success: function(data) {
            $("#Preco").html(data);
        }
    });
}

$(function() {
    $("#patient").change(function() {
        var idSelecionado = $("#patient option:selected").val();
        $("#id").val(idSelecionado);
    });
});

</script>

<?php
$p_query=mysqli_query($connection,"SELECT * FROM patientregister")or die (mysqli_error($connection));
$p_numrows=mysqli_num_rows($p_query)or die (mysqli_error($connection));
$p_row1=mysql_fetch_all($p_query);

function mysql_fetch_all($query) {
    $all = array();
    while ($all[] = mysqli_fetch_assoc($query)) {$temp=$all;}
    return $temp;
}
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
       Matrícula
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../Index"><i class="fa fa-dashboard"></i> Casa</a></li>
        <li class="active"></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
<div class="col-md-12">
    <div class="box box-primary">
            <div class="box-header with-border bg-blue">
             <i class="fa fa-edit"></i> <h3 class="box-title">Área de Matrícula</h3>
            </div>
        <form action="../controllers/marcarconsulta_admin.php" method="POST" enctype="multipart/form-data" >
              <div class="box-body">
                <div class="form-group">
                <label for="exampleInputEmail1">Aluno</label>
                <select name="patient" id="patient" class="form-control select2"  required="required">
                <option value="">Selecione o Aluno</option>
                
                <?php
    $p_query = "SELECT * FROM patientregister";
    $res = mysqli_query($connection, $p_query);
    while ($row1 = mysqli_fetch_array($res)) {
        ?>
        <option value="<?php echo $row1['id']; ?>"><?php echo htmlentities($row1['name']); ?></option>
    <?php } ?>
</select>
</div>

<div class="form-group">
                <label for="DoctorSpecialization">
																Curso 
															</label>
							<select name="especialidade" class="form-control"  onChange="getdoctor(this.value);" onclick="getfee(this.value);" required="required">
																<option value="">Selecione o curso</option>
<?php $ret=mysqli_query($connection,"select * from especialidade");
while($row=mysqli_fetch_array($ret))
{
?>
<option value="<?php echo htmlentities($row['Nome']);?>">
																	<?php echo htmlentities($row['Nome']);?>
																</option>
																<?php } ?>
                                </select>         
                  
                </div>
              
<label >
																Formador
															</label>
						<select name="doctor" class="form-control" id="doctor"  required="required">
						<option value="">Selecione o Formador</option>
						</select>


              	<label >
																Preço
															</label>
                              <select name="preco" class="form-control" id="Preco"   required="required">
						<option value="">Selecione o Preço</option>
						</select>

<label for="exampleInputEmail1">Data da Matrícula</label><br>
<input type="text" class="form-control" name="id" id="id" value=""  readonly="readonly">
<!-- <label for="exampleInputEmail1">Data</label><br> -->
<input type="date" id="data" name="data" class="form-control" value="<?php echo date('Y-m-d');  ?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<div class="form-group">
                <label>Hora</label>
             
  <?php $time = exec('time /T'); ?>
  <input type="text" class="form-control" name="hora" id="hora"   required="required" value="<?php echo $time;  ?>" >
    </div>
               
                
            <div class="form-group">
          

      
           

<!-- 
                <div class="form-group">
                  <label for="exampleInputPassword1">Telefone</label>
                  <input type="text" class="form-control" name="phone" id="phpne" />
                </div> -->
              
        
          </div>
          
          <button type="submit"  name="submit" class="btn bg-blue">Salvar</button>
      </form>
    </div>
  
</section>
</div>
<?php include "../Include/footer.php";?>
</div>
</div>
<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});

			$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
		</script>
		  <script type="text/javascript">
            $('#timepicker1').timepicker();
        </script>
<script src="../bower_components/ckeditor/ckeditor.js">
</script>
<script>
  $(function () { 
    // Replace the <input id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.input').wysihtml5()
  })

  $(function () { 
    // Replace the <input id="editor2"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    $('.input').wysihtml5()
  })
   $(function () { 
    // Replace the <input id="editor3"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor3')
    //bootstrap WYSIHTML5 - text editor
    $('.input').wysihtml5()
  })
</script>