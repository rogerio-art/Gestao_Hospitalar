<?php 
include("./inc/connect.php") ;
if(isset($_GET['id']))
      {
      	$sql="DELETE FROM addappointment WHERE  id=".$_GET['id']."";
      	//exit;
      	$write =mysqli_query($connection,$sql) or die(mysqli_error($connection));
            
              header("location:matricula.php");
      }
      else
      	echo "erro ao tentar eliminar matricula";
   ?>