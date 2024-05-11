<?php include('./controllers/matricula_aluno.php'); ?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php
session_start();    

if (empty($_SESSION['email'])) {
    header("location: ./Validar_user_logado.php");
    exit();
}
    ?>

<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
 
       
</head>

<body>
  <div class="content-wrapper">
        <section class="content-header">
      <h1>
      <font color="black">Matrícula Online </font> 
        <small></small>
       </h1>
     <ol class="breadcrumb">
       <li><a href="index.php"><i class="fa fa-dashboard"></i>Casa</a></li>
       <li class="active"></li>
     </ol>
   </section>
   <section class="content">
     <div class="box box-primary">
      
       <div class="box-header with-border">
         <i class=""></i>
        
             <!-- Page content -->
             <script>
function getdoctor(val) {
	$.ajax({
		type: "POST",
		url: "get_doctor.php",
		data: 'specilizationid=' + val,
		success: function(data) {
			$("#doctor").html(data);

			// Após carregar os ddicos, chama a função para carregar os preços
			getfee($("#Nome").val());
		}
	});
}

function getfee(val) {
	$.ajax({
		type: "POST",
		url: "get_doctor.php",
		data: 'Price=' + val,
		success: function(data) {
			$("#Preco").html(data);
		}
	});
}
</script>
<!-- <script src="./dist/dist/jquery.min.js"></script>

<script>
$ (function (){
$ ("#Nome") .change(function(){
    var mostrarnome=$("#Nome option:selected").text();
    $ ("#Preco") .val (mostrarnome);
   })
})
</script>  -->

<form action="" method="post" enctype="multipart/form-data"  class="row g-3">

<div class="col-md-6">
  <label>Nome do Aluno</label>
 <select name="nomepaciente" id="nomepaciente" class="form-control " >
 <option ><?php echo ($_SESSION['name']); ?></option>

<?php

 $p_query="SELECT * FROM beneficiario WHERE id='".$_SESSION['id']."'";
$res=mysqli_query($connection,$p_query);
while ($row1 =mysqli_fetch_array($res)) {
   echo $row1['id'];?>
<option value="<?php echo $row1['namebenif'];?>"><?php echo $row1['namebenif'];?>
 </option>            
  
<?php } ?> 

</select>
</select>  
</div>
 
  <div class="col-md-6">
  <!--label>Email do Paciente</label-->
  <input type="hidden" class="form-control" name="emaildocliente" id="emailpaciente" value="<?php echo ($_SESSION ['email'] ); ?>"/>
  </div>
 
  <div class="form-group">
  <div class="col-md-6">
  <label for="DoctorSpecialization">Curso</label>
							<select name="especialidade" id ="Nome" class="form-control"  onChange="getdoctor(this.value);" onclick="getfee(this.value);" required="required">
																<option value="">Selecione o Curso</option>
<?php $ret=mysqli_query($connection,"select * from especialidade");
while($row=mysqli_fetch_array($ret))
{
?>
<option value="<?php echo ($row['Nome']);?>">
																	<?php echo ($row['Nome']);?>
																</option>
																<?php } ?>
                                </select>
                                
            </div>
            </div>

            <div class="form-group">
            <div class="col-md-6">
															<label >
																Formador
															</label>
						<select name="doctor" class="form-control" id="doctor"  required="required">
						<option value="">Selecione o Formador</option>
						</select>
														</div>
                          
  <div class="form-group">
            <div class="col-md-6">
															<label >
																Preço
															</label>
                              <select name="preco" class="form-control" id="Preco"   required="required">
						<option value="">Selecione o Preço</option>
						</select>
														</div>
                          </div>


                          <div class="col-md-6">
  <label>Data</label>
  <input class="form-control datepicker" name="dataconsulta"  required="required" value="<?php echo date('Y-m-d');  ?>"  data-date-format="yyyy-mm-dd">
  </div>
  
            <div class="form-group">
            <div class="col-md-6">
  <!--label >Hora</label-->
  <?php $time = exec('time /T'); ?>
  <input type="hidden" class="form-control" name="Hora" id=""   required="required" value="<?php echo $time;  ?>" >
            </div>
            <div class="col-md-6">
  <label>E-mail</label>
  <input type="text" class="form-control" name="email" id="numerodetelefone" value="<?php echo ($_SESSION ['email'] ); ?>"/>
  </div>
            
                            </div>
                            <div class="col-md-6">
  <label>Telefone</label>
  <input type="text" class="form-control" name="numerodetelefone" id="numerodetelefone" value="<?php echo ($_SESSION ['phone'] ); ?>"/>
  </div>
  
  <div class="col-md-6">
  <label>Anexar Dcumento</label>
   <input class="form-control" type="file" name="file" id="fileToUpload">
   </div>
                                                      
  <div class="col-md-6">
   <input type="hidden" class="form-control" readonly="readonly"  name="id" id="id" value="<?php echo ($_SESSION ['id'] ); ?>"/>
  </div>

  <div class="col-md-12">
  </br> 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" id="submit" value="Submeter" class="btn" STYLE ="color: white; background-color: #16035a;"/><!--&nbsp;&nbsp;-->
&nbsp;&nbsp;<a href="actividades.php"><span class="btn"STYLE ="color: white; background-color: #16035a;"><i class=""></i><?= '&nbsp;&nbsp'?>Voltar</span><!--&nbsp;&nbsp;-->
    
  </div>
 </div>
  
</form>         
</div>     
</div>
</section>

<script src="bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

</body>

</div>


<?php include('footer.php');?>
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
</html>

