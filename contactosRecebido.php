<?php
session_start();

if (empty($_SESSION['id'])) {
    header("location: ./Validar_user_logado.php");

}
    ?>  
<?php
include('config/db.php');
include('header.php');
include('sidebar.php');

$query = "SELECT * FROM contacto  WHERE Direcao ='Admin' AND userID = '" . $_SESSION['id'] . "'  ORDER BY id DESC";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$row1 = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>

        <?php /*if (empty($row1)) : ?>
            <p>Não foram encontrados dados.</p>
        <?php else : ?>
            <table id="example1" class="table table-bordered table-striped">
                <!-- ... Your existing table code ... -->
            </table>
        <?php endif; */?>
    

<?
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



<div class="content-wrapper">
  <section class="content-header">
  <h1>
Meus contactos enviado
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
<i class="fa fa-user"></i> <h3 class="box-title"> Página de contacto</h3>
</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<div>
<!--button type="button" onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button-->
</div>
<div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Assunto</th>
            <th>Documento</th>
            <th>Opções</th>
            </tr>
            </thead>
            <tbody>
               <?php
   foreach ($row1 as $row)
    {
$s1=mysqli_query($connection," SELECT name FROM patientregister WHERE id='".$row['name']."'");
$w1 =mysqli_query($connection," SELECT name FROM patientregister WHERE id='".$row['name']."'") ;//or die(mysqli_error($connection));
//print_r($w1); exit;
$row2=mysqli_fetch_array($w1);//or die (mysqli_error($connection));
 //print_r($row2); exit();
?> <tr>  
<td><?php echo $row['name'];?></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['assunto'];?></td> 

<!--td><img src="./Upload/File/<?php echo $row['file'];?>" style="height:100px;width:100px;" alt="<?php echo pathinfo($row['file'], PATHINFO_FILENAME) ?>"/></td-->

<td>
  <?php
  $filePath = "./Upload/File/" . $row['file'];
  $allowedExtensions = ['pdf', 'txt', 'xls', 'xlsx', 'doc', 'docx'];

  if (!empty($row['file']) && file_exists($filePath)) {
    $fileExtension = strtolower(pathinfo($row['file'], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
      // Display default document icon
      ?>
      <img src="./Upload/File/pdf.jpg" style="height:35px;width:60px;" alt="Default Image" />
   <?php
    } else {
      // Display the actual image
      ?>
      <img src="<?php echo $filePath; ?>" style="height:35px;width:60px;" alt="<?php echo pathinfo($row['file'], PATHINFO_FILENAME) ?>" />
      <?php
    }
  } else {
    // Display default image when the file is empty or doesn't exist
    ?>
    <img src="./Upload/File/not found.jpg" style="height:35px;width:60px;" alt="Default Image" />
    <?php
  }
  ?>
</td>

<td>
  <a href="ver_contactoUser.php?id=<?php echo $row['id']; ?>" class="btn bg-blue">
    <i class="fa fa-eye"></i> 
  </a>&nbsp;&nbsp;

  <a href="./Admin/donwload.php?file=<?php echo $row['file']; ?>" class="btn bg-blue">
    <i class="fa fa-download"></i> 
  </a>&nbsp;

  <?php
  // Check if there is an image to display
  if (!empty($row['file']) && file_exists($filePath)) {
  ?>
    <a href="./Upload/File/<?php echo $row['file']; ?>" target="_blank" class="btn btn-primary">
      <i class="fa fa-eye"></i> 
    </a>
  <?php
  } else {
    // Display a disabled button if there is no image
    ?>
    <button class="btn btn-primary" disabled>
      <i class="fa fa-eye"></i> 
    </button>
   
    <?php
  }
  ?>
   <a href="./ResponseContactUser.php?id=<?php echo $row['id']; ?>"><span class="btn bg-blue"><i class="fa fa-send"></i> </span></a>
</td>



<!--a href="./Admin/deleted.php?id=<?php // +echo $row['id']; ?>"><span class="btn btn-danger"><i class="fa fa-trash-o"></i> Apagar</span></a></td-->

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