<?php
session_start();    

if (empty($_SESSION['email'])) {
    header("location: ./Validar_user_logado.php");
    exit();
}
    ?>

<?php include"./header.php";?>
<?php include"./sidebar.php";?>
<?php
include("./inc/connect.php");

$query = "SELECT * FROM exameeletronico WHERE iduser = '" . $_SESSION['id'] . "' ORDER BY id DESC ";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$row1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

function mysql_fetch_all($query)
{
$all = array();
while ($all[] = mysqli_fetch_assoc($query)) {$temp=$all;}
return $temp;
}
?>


<div class="content-wrapper">
  <section class="content-header">
  <h1>

    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="./Index"><i class="fa fa-dashboard"></i> Casa</a></li>
  
  </ol>
</section>
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box box-primary">
<div class="box-header with-border">
<i class="fa fa-user"></i> <h3 class="box-title"> Nome :  <?php echo ($_SESSION ['name'] ); ?></h3>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="./recrutamentoLoged.php"><button type="submit"   name="submit" class="btn btn-primary"STYLE ="color: white; background-color: #16035a;">
  <i class="fa fa-plus-square"></i>&nbsp; Marcar Nova Prova</button></a><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<div>
<!--button type="button" onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button-->
</div>
<div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>Nome</th>
            <th>Pontuação</th>
            <th>Resultado</th>
            <th>Data</th>
            <th>Opções</th>
            <th>Estado</th>
            </tr>
            </thead>
            <tbody>
               <?php
   foreach ($row1 as $row)
    {
$s1=mysqli_query($connection," SELECT id FROM exameeletronico WHERE id='".$row['iduser']."'");
$w1 =mysqli_query($connection," SELECT nome FROM exameeletronico WHERE id='".$row['nome']."'") ;//or die(mysqli_error($connection));
//print_r($w1); exit;
$row2=mysqli_fetch_array($w1);//or die (mysqli_error($connection));
 //print_r($row2); exit();
?> <tr>  
<!--td><?php // echo $row['name'];?></td-->
<!--td><?php// echo $row['email'];?></td-->
<td><?php echo $row['nome'];?></td> 
<td><?php echo $row['pontuacao'];?></td>
<td><?php echo $row['resultado'];?></td>
<td><?php echo $row['data'];?></td>
<td>
  <a href="verexame.php?id=<?php echo $row['id']; ?>" class="btn"STYLE ="color: white; background-color: #16035a;">
    <i class="fa fa-eye"></i>
  </a>

  
<!--a href="./Admin/deleted.php?id=<?php // +echo $row['id']; ?>"><span class="btn btn-danger"><i class="fa fa-trash-o"></i> Apagar</span></a></td-->
<?php 
if (empty($row['pontuacao'])) {
?>
    <td>Pendente</td>
<?php 
} else {
?>
    <td>Conclído</td>
<?php
}
?>

</tr>
<?php } ?>
     </tbody>
    </table>
   
    </div>
      </form>
    </div>
    </section>
</div>
<?php include "./footer.php";?>
  </div>
</div>