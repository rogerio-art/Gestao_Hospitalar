<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php session_start();    

if (empty($_SESSION['email'])) {
    header("location: ./Validar_user_logado.php");
    exit();
}
    ?>



<!DOCTYPE html>
<html lang="pt">

<head>
    

<title>Exame Eletrónico</title>


  <style>
        body {
            font-family: Arial, sans-serif;
            color:white;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #exam-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #16035a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #question-container {
            margin-bottom: 20px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
            color: black;
        }

        #result-container {
            text-align: center;
        }
    </style>
      <style>
        /* Definindo a cor da barra de progresso */
        #progress-bar {
            background-color: ; /* Cor de fundo */
        }

        #progress-bar::-webkit-progress-value {
            background-color: red; /* Cor da barra de progresso preenchida */
        }
    </style>
</head>

<body>
<div class="content-wrapper">
        <section class="content-header">
      <h1>
      <font color="black">Prova eletrónica</font>  
        <small></small>
       </h1>
     <ol class="breadcrumb">
       <li><a href="./index.php"><i class="fa fa-dashboard"></i>Casa</a></li>
       <li class="active">Minhas Actividades</li><br>
       <!-- Barra de progresso -->
    <progress id="progress-bar"  class="form-control" max="60" value="60"></progress>

     </ol>
   </section>
   <section class="content">
   <div id="timer"style="color: red;">Tempo restante: 1:00</div>
     <div class="box box-primary">
       <div class="box-header with-border">
         <i class=""></i>
        
          </div>
    <div id="exam-container">
        <h1>Exame Eletrónico</h1>
        <div id="question-container">
            <!-- Questões e opções de respostas serão carregadas aqui dinamicamente -->
        </div>
        <button id="next-btn" type="button" class="btn"STYLE ="color: black; background-color: lavanda;">Próxima Pergunta</button>
        <button id="submit-btn" style="display:none;">Submeter Exame</button>
        <div id="result-container" style="display:none;">
            <h2>Resultado:</h2>
            <p id="score"></p>
            <p id="name"></p>
        </div>
    </div>
    <form id="exam-form" method="post" action="./exameEletronicScript.php">
    <input type="hidden" name="score" id="score-input" value="">
</form>
<br></br>
<br></br>

    <script>
    // Perguntas e respostas (substitua com suas próprias perguntas e respostas)
    const questions = [{
                question: "Qual é a capital do Brasil?",
                options: ["Rio de Janeiro", "Brasília", "São Paulo"],
                correctAnswer: "Brasília",
            },
            {
                question: "Quantos estados tem o Brasil?",
                options: ["24", "26", "27"],
                correctAnswer: "26",
            },
            {
                question: "Qual é o rio mais extenso do Brasil?",
                options: ["Amazonas", "São Francisco", "Tocantins"],
                correctAnswer: "Amazonas",
            },
            {
                question: "Em que ano o Brasil foi descoberto?",
                options: ["1492", "1500", "1520"],
                correctAnswer: "1500",
            },
            {
                question: "Qual é o maior bioma brasileiro?",
                options: ["Pantanal", "Cerrado", "Amazônia"],
                correctAnswer: "Amazônia",
            },
        ];

    

    let currentQuestion = 0;
    let score = 0;

    const questionContainer = document.getElementById("question-container");
    const nextBtn = document.getElementById("next-btn");
    const submitBtn = document.getElementById("submit-btn");
    const resultContainer = document.getElementById("result-container");
    const scoreDisplay = document.getElementById("score");
    const nameDisplay = document.getElementById("name");

    function resetQuiz() {
        currentQuestion = 0;
        score = 0;
        loadQuestion();
        questionContainer.style.display = "block";
        nextBtn.style.display = "block";
        submitBtn.style.display = "none";
        resultContainer.style.display = "none";
    }

    // Função para carregar a próxima pergunta
    function loadQuestion() {
        const currentQuestionData = questions[currentQuestion];
        const optionsHTML = currentQuestionData.options.map(
            (option, index) =>
                `<li><label><input type="radio" name="answer" value="${option}"> ${option}</label></li>`
        );

        questionContainer.innerHTML = `
            <h2>${currentQuestionData.question}</h2>
            <ul>${optionsHTML.join("")}</ul>
        `;
    }

    // Event listener para o botão "Próxima Pergunta"
    nextBtn.addEventListener("click", function () {
        const selectedAnswer = document.querySelector('input[name="answer"]:checked');

        if (selectedAnswer) {
            if (selectedAnswer.value === questions[currentQuestion].correctAnswer) {
                score += 2;
            }

            currentQuestion++;

            if (currentQuestion < questions.length) {
                loadQuestion();
            } else {
                showResult();
            }
        } else {
            alert("Selecione uma resposta antes de avançar.");
        }
    });

    // Função para exibir o resultado final
   function showResult() {
    questionContainer.style.display = "none";
        nextBtn.style.display = "none";
        submitBtn.style.display = "block";
        resultContainer.style.display = "block";

   // const studentName = prompt("Digite seu nome:");
  //  nameDisplay.textContent = `Nome: ${studentName}`;

    // Definir o valor do input oculto
    document.getElementById("score-input").value = score;

    // Submeter o formulário
   document.getElementById("exam-form").submit();
   alert("Exame Concluido com sucesso!");
}

    // Event listener para o botão "Submeter Exame"
    submitBtn.addEventListener("click", function () {
        // Lógica para submeter o exame (se necessário)
// Enviar pontuação e nome para o servidor usando AJAX ou Fetch API em PHP

    // Função para enviar a variável para o PHP
    
        resetQuiz();
    });

    // Iniciar o carregamento da primeira pergunta
    resetQuiz();
</script>
 <!-- Elemento para exibir o temporizador -->
 <script>
        let timeLeft;

        // Verificar se há um valor salvo no armazenamento local
        const storedTime = localStorage.getItem('timeLeft');
        if (storedTime) {
            timeLeft = parseInt(storedTime, 10);
        } else {
            // Se não houver valor salvo, definir o tempo inicial em segundos (3 minutos)
            timeLeft = 60;
        }

        const timerElement = document.getElementById('timer');
        const progressBar = document.getElementById('progress-bar');
        //  const submitBtn = document.getElementById('submit-btn');

        // Função para atualizar o temporizador a cada segundo
        const timerInterval = setInterval(() => {
            // Se o tempo restante for menor ou igual a zero, parar o temporizador
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                localStorage.removeItem('timeLeft'); // Remover o valor do armazenamento local
                // Função para submeter o formulário
                // Enviar a pontuação para o servidor
    const formData = new FormData();
    formData.append('score', score); // Adicione a pontuação ao formulário de dados

    // Use AJAX ou Fetch API para enviar os dados para o servidor
    fetch('./exameEletronicScript.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            // Se a resposta do servidor estiver ok, então submeta o formulário
            //document.getElementById("exam-form").submit();
        } else {
            // Se houver um erro ao enviar a pontuação, exiba uma mensagem de erro
            console.error('Erro ao enviar pontuação para o servidor');
        }
    })
    .catch(error => {
        console.error('Erro ao enviar pontuação para o servidor:', error);
    });
                //submitBtn.click(); simular o click do botão sobre uma condição
                    window.location.href = 'actividades.php'; // Redirecionar para index.php
            } else {
                // Atualizar a barra de progresso
                progressBar.value = timeLeft;

                // Converter o tempo restante para minutos e segundos
                const minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                // Adicionar um zero à esquerda se os segundos forem menores que 10
                seconds = seconds < 10 ? '0' + seconds : seconds;
                // Atualizar o texto do temporizador
                timerElement.textContent = `Tempo restante: ${minutes}:${seconds}`;

                // Decrementar o tempo restante e salvar no armazenamento local
                timeLeft--;
                localStorage.setItem('timeLeft', timeLeft.toString());
            }
        }, 1000); // Executar a cada segundo
    </script>
</body>
            </div>
       
            </div>        


            <?php include('footer.php'); ?>
      </div>
    </div>
  </div>
  </div>
</section>


        </html>