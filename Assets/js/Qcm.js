function setScore(score) {
    localStorage.setItem('score', score);
}

function getScore() {
    return parseInt(localStorage.getItem('score')) || 0;
}

var id_question, question_id, next_question_id, question, xmlfile;
var pathToXml = '../' + xmlPath;

var score = getScore();

function restartQuiz() {    
    setScore(0); 
    window.location.href = "../View/qcm.php?path=" + encodeURIComponent(xmlPath) + "&q=1";
}


function returnHome() {
    setScore(0); 
    window.location.href = "DashboardBasic.php"; 
}

document.addEventListener("DOMContentLoaded", function () {
    var nextButton = document.getElementById('nextButton');

    if (nextButton) {
        nextButton.addEventListener('click', function () {
            var radios = document.getElementsByName('reponse[' + id_question + ']');
            var checked = false;
            var selectedAnswer = null;
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    checked = true;
                    selectedAnswer = radios[i].value;
                    radios[i].parentElement.classList.add('selected-answer'); 
                } else {
                    radios[i].parentElement.classList.remove('selected-answer'); 
                }
            }
            if (checked) {
                var correctAnswer = question.correct_answer;
                if (selectedAnswer === correctAnswer) {
                    score++;
                }

                setScore(score);

                var lastQuestionId = xmlfile.question.length;
                var currentQuestionId = question_id;
                if (currentQuestionId === lastQuestionId) {
                    var scoreContainer = document.createElement('div');
                    scoreContainer.innerHTML = "<h2>Score final:</h2><p>" + score + "/" + xmlfile.question.length + "</p><p>Merci d'avoir soumis vos réponses!</p>";

                    if (score < 5) {
                        var message = document.createElement('p');
                        message.textContent = "Votre score est en deçà de nos attentes. Nous vous encourageons vivement à envisager de suivre le cours pour approfondir vos connaissances.";
                        scoreContainer.appendChild(message);
                    } else {
                        var message = document.createElement('p');
                        message.textContent = "Félicitations pour votre score! Pour enrichir davantage vos connaissances, nous vous recommandons également de suivre le cours.";
                        scoreContainer.appendChild(message);
                    }



                    var buttonContainer = document.createElement('div');
                    buttonContainer.className = "button-container";

                    var restartButton = document.createElement('button');
                    restartButton.innerHTML = "Recommencer le quiz";
                    restartButton.className = "button-qcm"; 
                    restartButton.addEventListener('click', restartQuiz);
                    buttonContainer.appendChild(restartButton);

                    
                    var homeButton = document.createElement('button');
                    homeButton.innerHTML = "Retour à l'accueil";
                    homeButton.className = "button-qcm"; 
                    homeButton.addEventListener('click', returnHome);
                    buttonContainer.appendChild(homeButton);

                    var quizContainer = document.querySelector('.game-quiz-container');
                    quizContainer.innerHTML = ''; 
                    quizContainer.appendChild(scoreContainer);
                    quizContainer.appendChild(buttonContainer);
                }
                else {
                    var nextQuestionId = next_question_id;
                    var currentPath = window.location.pathname;

                    var queryParams = window.location.search;

                    var redirectTo = currentPath + queryParams + "&q=" + nextQuestionId;

                    window.location.href = redirectTo;

                }
            } else {
                alert('Veuillez sélectionner une réponse.');
            }
        });
    }

    var buttonContainer = document.createElement('div');
    buttonContainer.className = "button-container";

    
    if (question_id > 1) {
        var restartButton = document.createElement('button');
        restartButton.innerHTML = "Recommencer le quiz";
        restartButton.className = "button-qcm"; 
        restartButton.addEventListener('click', restartQuiz);
        buttonContainer.appendChild(restartButton);
    }

    
    var homeButton = document.createElement('button');
    homeButton.innerHTML = "Retour à l'accueil";
    homeButton.className = "button-qcm"; 
    homeButton.addEventListener('click', returnHome);
    buttonContainer.appendChild(homeButton);

    
    var quizContainer = document.querySelector('.game-quiz-container');
    quizContainer.appendChild(buttonContainer);
});
document.addEventListener("DOMContentLoaded", function () {
    var options = document.querySelectorAll('.game-options-container label');

    
    function selectOption(label) {
        
        options.forEach(option => {
            option.style.color = ''; 
        });

        
        label.style.color = 'red'; 
    }

    
    options.forEach(option => {
        option.addEventListener('click', function () {
            selectOption(this);
        });
    });
});