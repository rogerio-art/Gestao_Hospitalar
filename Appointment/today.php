<?php include "../Include/header.php";?>
<?php include "../Include/sidebar.php";?>
<?php
include "../inc/connect.php";

?>
<?php
$s=("SELECT * FROM addappointment ");
$query=mysqli_query($connection,$s)or die (mysqli_error($connection));

$numrows=mysqli_num_rows($query)or die (mysqli_error($connection));
$row1=mysql_fetch_all($query);
function mysql_fetch_all($query) {
    $all = array();
    while ($all[] = mysqli_fetch_assoc($query)) {$temp=$all;}
    return $temp;
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Matrículas Activas<small></small></h1>
    <ol class="breadcrumb">
      <li><a href="../Index"><i class="fa fa-dashboard"></i> Início</a></li>
      <li class="active">Nova Matrícula</li>
    </ol>
  </section>
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-user"></i> <h3 class="box-title">Matrículas Activas</h3>
          </div>
          <br>
          <a href="./addappointment.php"><button type="submit" name="submit" class="btn btn-success bg-blue"><i class="fa fa-plus-square"></i> Nova Matrícula</button></a>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Nº de Matrícula</th>
                  <th>Aluno</th>
                  <th>Data</th>
                  <th>Preço</th>
                  <th>Formador</th>
                  <th>Curso</th>
                  <th>Hora</th>
                  <th>Estado</th>
                  <th>Opção</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($row1 as $row) { 
                  $sql1 = mysqli_query($connection, "SELECT name FROM patientregister ");
                  $write1 = mysqli_query($connection, "SELECT name FROM patientregister") or die(mysqli_error($connection));
                  $row2 = mysqli_fetch_array($write1) or die(mysqli_error($connection));
                ?>
                <tr>
                  <td><?php echo $row['cod_matricula'];   ?></td>
                  <td><?php echo $row['namepatient'];?></td>
                  <td><?php echo $row['app_date'];?></td>
                  <td><?php echo $row['preco'];?></td>
                  <td><?php echo $row['doctor'];?></td> 
                  <td><?php echo $row['especialidade'];?></td>
                  <td><?php echo $row['hora'];?></td>
                  
                  <?php
                  if ($row['estado'] == '1') { ?>
                    <td> <label type="" class=""><i class=""></i><font color="green">Confirmado</font></label></td>
                  <?php } elseif ($row['estado'] == '2') { ?>
                    <td> <a href="apdateestatos.php?id=<?php echo $row["id"]; ?>"><label type="" class=""><i class=""></i>Cancelado</label></a></td>
                  <?php } elseif ($row['estado'] == '3') { ?>
                    <td> <label type="" class=""><i class=""></i><font color="red"> Pendente </font></label></td>
                  <?php } ?>
                  <td> <a href="apdateestatos.php?id=<?php echo $row["id"]; ?>"><button type="button" <span class="btn bg-blue"><i class=""></i>Confirmar  </span></button></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include "../Include/footer.php";?> 
