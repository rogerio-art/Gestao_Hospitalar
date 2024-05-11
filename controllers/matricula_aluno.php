<?php
   
    // Database connection
    include('config/db.php');
  //  require_once './vendor/autoload.php';
    
 
    if($_SESSION["email"]) {
    ?>
    <?php
    }else header("Location: ./Validar_user_logado.php");
  
?>

<?php

// Consulta para recuperar o último código de fatura
$sql = "SELECT MAX(cod_matricula) as ultimo_codigo FROM addappointment";
//$result = $connection->query($sql);
$query=mysqli_query($connection,$sql)or die (mysqli_error($connection));
$row=mysqli_fetch_array($query)or die (mysqli_error($connection));

//$ultimo_codigo = intval($row["cod_matricula"]);

    if(isset($_POST["submit"])) {
        $id = $_POST["id"];
        $especialidade = $_POST["especialidade"];
      
        $numerodetelefone = $_POST["numerodetelefone"];
        $doctor = $_POST["doctor"];
        $dataconsulta = $_POST["dataconsulta"];// fiz uma gambiarra os campos do formularios erstão a apontar para os campos contrarios mais fiz uma gambiarra para acertar***************
        $nomepaciente = $_POST["nomepaciente"];
        $Hora = $_POST["Hora"];
        $preco = $_POST["preco"];
        

    // Upload file
    if (!empty($_FILES["file"]["name"])) {
        $target_dir = "./Upload/Documento/";
        $file = $_FILES["file"]["name"];
        $size = $_FILES["file"]["size"];
        
        // Check if the file size is within the limit (10 megabytes)
        if ($size <= 10 * 1024 * 1024) {
            $temp = $_FILES["file"]["tmp_name"];
            $error = $_FILES["file"]["error"];

            // Move the uploaded file if there are no errors
            if ($error === UPLOAD_ERR_OK) {
                move_uploaded_file($temp, $target_dir . $file);
                //echo "ola mundo" . $target_dir."/". $file;
           
            } else {
                echo "Erro ao Carregar o ficheiro. Tenta novamente por favor.";
            }
        } else {
            echo "O tamanho do ficheiro excede o limite de Mega Byte. Por favor carrega um ficheiro até 10 megabytes.";
        }
    } else {
        $file = null; // If file is not uploaded, set it to null
    }

        // Verify if form values are not empty
        if(!empty($id) && !empty($doctor) && !empty($Hora) && !empty($numerodetelefone)&& !empty($dataconsulta)&& !empty($especialidade)&& !empty($nomepaciente)){
            
            // check if user emailpaciente already exist
            
                // clean the form data before sending to database
                $_first_name = mysqli_real_escape_string($connection, $nomepaciente);
                $_last_name = mysqli_real_escape_string($connection, $doctor);
                $_mobile_number = mysqli_real_escape_string($connection, $numerodetelefone);
    //            $_hora = mysqli_real_escape_string($connection, $hora);
                $_dataconsulta = mysqli_real_escape_string($connection, $dataconsulta);
                $_especialidade = mysqli_real_escape_string($connection, $especialidade);
                
           
         // Consulta para verificar se a especialidade já existe
      // Consulta SQL para contar o número de registros com base nos critérios de seleção
$count_sql = "SELECT COUNT(*) AS total 
FROM addappointment 
WHERE patient='" . $_SESSION['id'] . "' 
AND especialidade = '$especialidade'";

// Executar a consulta SQL de contagem
$count_result = mysqli_query($connection, $count_sql);

// Obter o número total de registros
$total_rows = mysqli_fetch_assoc($count_result)['total'];

// Verificar se existem registros duplicados
if ($total_rows > 0) {
    echo '<script type="text/javascript">
              setTimeout(function() {
                  alert("Matrícula duplicada");
                  window.location.href = "fichadematricula.php"; // Redirecionar para a página index
              }, 100); // 3000 milissegundos = 3 segundos
          </script>';
exit();
}

                $ultimo_cod = $row[0];

                 // Incrementa o último código de fatura
        $cod_matricula = str_pad($ultimo_cod + 1, 6, '0', STR_PAD_LEFT); // Adiciona zeros à esquerda
       
                // Insere a nova matricula no banco de dados
                    $sql = "INSERT INTO addappointment(patient, doctor, app_date, hora, especialidade, preco,sms, namepatient, estado, cod_matricula, file)
                    VALUES(
                    '{$id}', 
                    '{$doctor}', 
                    '{$dataconsulta}', 
                    '{$Hora}',
                    '{$especialidade}', 
                    '{$preco}', '1',
                    '{$nomepaciente}','3','{$cod_matricula}','{$file}')";
                    
                    // Create mysql query
                    $sqlQuery = mysqli_query($connection, $sql);
              
                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    } 
                    header("Location: ./consulta_sucesso.php");
                    }
                    
                    } else {
            if(empty($nomepaciente)){
                $fNameEmptyErr = '<div class="alert alert-danger">
                    O campo nome não pode estar em branco.
                </div>';
            }
            if(empty($doctor)){
                $lNameEmptyErr = '<div class="alert alert-danger">
                O campo sobre-nome não pode estar em branco.
                </div>';
            }
            if(empty($emailpaciente)){
                $emailpacienteEmptyErr = '<div class="alert alert-danger">
                O campo e-mail não pode estar em branco.
                </div>';
            }
            if(empty($numerodetelefone)){
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