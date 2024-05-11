<?php
include("../inc/connect.php") ;

if(isset($_POST["submit"])) {
    $id              = $_POST["patient"];
    $hora            = $_POST["hora"];
    $medico          = $_POST["doctor"];      
    $especialidade   = $_POST["especialidade"];
    $preco           = $_POST["preco"];
    $namepatient     = $_POST["patient"];
    $data            = $_POST["data"];

    $p_query = "SELECT name FROM patientregister WHERE id = $id";
    $res = mysqli_query($connection, $p_query);
    $row = mysqli_fetch_array($res);
    $namepatient = $row['name']; 

    $sql = "SELECT MAX(cod_matricula) as ultimo_codigo FROM addappointment";
//$result = $connection->query($sql);
$query=mysqli_query($connection,$sql)or die (mysqli_error($connection));
$row3=mysqli_fetch_array($query)or die (mysqli_error($connection));

        // Consulta para verificar se a especialidade já existe
      // Consulta SQL para contar o número de registros com base nos critérios de seleção
$count_sql = "SELECT COUNT(*) AS total 
FROM addappointment 
WHERE patient = '$id'
AND especialidade = '$especialidade'";

//exit();
// Executar a consulta SQL de contagem
$count_result = mysqli_query($connection, $count_sql);

// Obter o número total de registros
$total_rows = mysqli_fetch_assoc($count_result)['total'];

// Verificar se existem registros duplicados
if ($total_rows > 0) {
    echo '<script type="text/javascript">
              setTimeout(function() {
                  alert("Matrícula duplicada, Escolhe outro Curso");
                  window.location.href = "../Appointment/addappointment.php"; // Redirecionar para a página index
              }, 100); // 3000 milissegundos = 3 segundos
          </script>';
exit();
}

                $ultimo_cod = $row3[0];

                 // Incrementa o último código de fatura
        $cod_matricula = str_pad($ultimo_cod + 1, 6, '0', STR_PAD_LEFT); // Adiciona zeros à esquerda
       

    // PHP valnomepatientation
    // Verify if form values are not empty
    if(!empty($id)  || !empty($namepatient)|| !empty($hora) || !empty($data) || !empty($especialidade) || !empty($medico) || !empty($preco)){
       ?>
        <!--meta http-equiv="refresh" content="0;url=addappointment.php" /-->
<?php
        // check if user emaildocliente already exist
            // clean the form data before sending to database
            // $_first_name = mysqli_real_escape_string($connection, $id);
            // $_last_name = mysqli_real_escape_string($connection, $hora);
            // $_mobile_number = mysqli_real_escape_string($connection, $medico);
            // // $_name_patient = mysqli_real_escape_string($connection, $namepatient);
            // $especialidade = mysqli_real_escape_string($connection, $especialidade);
        
        
   $sql = "INSERT INTO addappointment(patient, doctor, app_date, hora, especialidade,preco,sms,namepatient,estado, cod_matricula) VALUES ('{$id}', 
 '{$medico}','{$data}',   '{$hora}',
'{$especialidade}', '{$preco}', '1', '{$namepatient}','1', '{$cod_matricula}')";
                
                $sqlQuery = mysqli_query($connection, $sql);
          
                // Create mysql query
               //  $sqlQuery = mysqli_query($connection, $sql); se descomentar esta linha eu vi adicionar dois registros  
              
                if(!$sqlQuery){
                    die("MySQL query failed!" . mysqli_error($connection));
                } 
                echo " <script>alert('Consulta Marcada com sucesso...');</script>";
   
                header("Location: ../Appointment/today.php");
            }
        }
     else {
        if(empty($nomepaciente)){
            $fNameEmptyErr = '<div class="alert alert-danger">
                O campo nome não pode estar em branco.
            </div>';
        }
        if(empty($hora)){
            $lNameEmptyErr = '<div class="alert alert-danger">
            O campo sobre-nome não pode estar em branco.
            </div>';
        }
        if(empty($emaildocliente)){
            $emaildoclienteEmptyErr = '<div class="alert alert-danger">
            O campo e-mail não pode estar em branco.
            </div>';
        }
        if(empty($medico)){
            $mobileEmptyErr = '<div class="alert alert-danger">
            O campo Telefone não pode estar em branco.
            </div>';
        }
        if(empty($morada)){
            $moradaEmptyErr = '<div class="alert alert-danger">
            O campo morada não pode estar em branco.
            </div>';
        }           
    
        if(empty($data)){
            $moradaEmptyErr = '<div class="alert alert-danger">
            O campo morada não pode estar em branco.
            </div>';
        }  
     
    
    }


?>