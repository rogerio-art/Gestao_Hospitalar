<?php
    include('../config/db.php');
   
    ?>

<?php
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $assunto = $_POST["assunto"];
    $mensagem = $_POST["mensagem"];
    $telefone = $_POST["telefone"];
    $contactType = $_POST["contactType"];

    // Upload file inicio
    $d1 = date('Y-m-d');
    $patient = $_POST['email'];
    $title = $_POST['email'];

    $p_query = "SELECT name FROM patientregister WHERE id = $id";
    $res = mysqli_query($connection, $p_query);
    $row = mysqli_fetch_array($res);
    $nome = $row['name']; 

    $target_dir = "../Upload/File/";
    $name = $_FILES["file"]["name"];
    $type = $_FILES["file"]["type"];
    $size = $_FILES["file"]["size"];

    // Check if the file size is within the limit (10 megabytes)
    if ($size <= 10 * 1024 * 1024) {
        $temp = $_FILES["file"]["tmp_name"];
        $error = $_FILES["file"]["error"];

        // Move the uploaded file if there are no errors
        if ($error === UPLOAD_ERR_OK) {
            move_uploaded_file($temp, "../Upload/File/" . $name);
            //echo "Upload Complete";
        } else {
            echo "Error uploading file. Please try again.";
        }
    } else {
        echo "File size exceeds the limit. Please upload a file up to 10 megabytes.";
    }
}
//print_r($_FILES); exit();

//fim do upload file

        // check if mensagem already exist
    

        // PHP validation
        // Verify if form values are not empty
        if(!empty($email) && !empty($assunto) && !empty($id) && !empty($contactType) && !empty($mensagem) && !empty($telefone)){
            
            
          // Query
          $sql = "INSERT INTO contacto (userID, name, email, assunto, mensagem, telefone, contactType, file, Direcao, Data) VALUES ('{$id}', '{$nome}', '{$email}', '{$assunto}', '{$mensagem}', '{$telefone}','{$contactType}', '{$name}','Admin',now())";
          $sqlQuery = mysqli_query($connection, $sql);
                
                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    } 
                   header("Location: ./contacto_sucessoAdmin.php");
                    // Send verification mensagem
                    if($sqlQuery) {
                    
                        // Create the Transport
                        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                         ->setUsername('your_mensagem@gmail.com')
                        ->setPassword('your_mensagem_file');

                         // Create the Mailer using your created Transport
                         $mailer = new Swift_Mailer($transport);

                         // Create a message
                         $message = (new Swift_Message('Por favor, Verifica a sua caixa de e-mail!'))
                         ->setFrom([$mensagem => $email . ' ' . $assunto])
                         ->setTo($mensagem)
                        ->addPart($msg, "text/html")
                         ->setBody('Olá! Usuário');

                         // Send the message
                         $result = $mailer->send($message);
                          
                         if(!$result){
                         $mensagem_verify_err = '<div class="alert alert-danger">
                            Verificado, mensagem não enviado!!
                            </div>';
                        } else {
                            $mensagem_verify_success = '<div class="alert alert-success">
                               Verificado, mensagem enviado!
                       </div>';
                        }
                     }
                
            }
       
            
           
 

?>