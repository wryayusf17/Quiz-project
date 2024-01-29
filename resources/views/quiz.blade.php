<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css" />
  <title>Quiz</title>
  
</head>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
}

.logout-btn {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 20px;
    color: #ccc;
    margin: 15px;
    padding-left: 15px ;
    background: red;
    border-top-left-radius: 5px;
    border-radius: 5px;
    width: 100px;
    height: 50px;
    display: flex;
    align-items: center;
    text-align: center;
    box-shadow: 0 0 5px #ccc;
    cursor: pointer;
    border-color: transparent;
}

</style>
<body>
  <form id="logoutForm" action="/" method="get">
    <button type="submit" class="logout-btn">Logout</button>
</form>
  <div class="container">
    <div class="start-screen">
      <h1 class="heading">• • • Quiz • • •</h1>
      <div class="settings">
        <label for="num-questions">Number of Questions:</label>
        <select id="num-questions">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="20">30</option>
          <option value="20">40</option>
          <option value="20">50</option>
        </select>
        <label for="category">Select Category:</label>
        <select id="category">
          <option value="">any category</option>
          <option value="9">general knowledge</option>
          <option value="10">books</option>
          <option value="17">science and nature</option>
          <option value="18">computers</option>
          <option value="19">mathematics</option>
          <option value="20">mythology</option>
          <option value="21">sports</option>
          <option value="28">vehicles</option>
        </select>
        <label for="difficulty">Select difficulty:</label>
        <select id="difficulty">
          <option value="">any difficulty</option>
          <option value="easy">easy</option>
          <option value="medium">medium</option>
          <option value="hard">hard</option>
        </select>
        <label for="time">Select time per question:</label>
        <select id="time">
          <option value="10">10 seconds</option>
          <option value="15">15 seconds</option>
          <option value="20">20 seconds</option>
          <option value="25">25 seconds</option>
          <option value="30">30 seconds</option>
          <option value="60">60 seconds</option>
        </select>
      </div>
      <button id="btnstart" class="btn start">Start Quiz</button>
    </div>
    <div class="quiz hide">
      <div class="timer">
        <div class="progress">
          <div class="progress-bar"></div>
          <span class="progress-text"></span>
        </div>
      </div>
      <div class="question-wrapper">
        <div class="number">
          Question <span class="current">1</span>
          <span class="total">/10</span>
        </div>
        <div class="question">This is a question This is a question?</div>
      </div>
      <div class="answer-wrapper">
        <div class="answer selected">
          <span class="text">answer</span>
          <span class="checkbox">
            <i class="fas fa-check"></i>
          </span>
        </div>
      </div>
      <button class="btn submit" disabled>Submit</button>
      <button class="btn next">Next</button>
    </div>
    <div class="end-screen hide">
      <h1 class="heading">Quiz App</h1>
      <div class="score">
        <span class="score-text">Your score:</span>
        <div>
          <span class="final-score">0</span>
          <span class="total-score">/10</span>
        </div>
      </div>
      <button class="btn restart">Restart Quiz</button>
    </div>
  </div>

</body>

<script>
  const progressBar = document.querySelector(".progress-bar"),
    progressText = document.querySelector(".progress-text");

  const progress = (value) => {
    const percentage = (value / time) * 100;
    progressBar.style.width = `${percentage}%`;
    progressText.innerHTML = `${value}`;
  };

  const startBtn = document.querySelector(".start"),
    numQuestions = document.querySelector("#num-questions"),
    category = document.querySelector("#category"),
    difficulty = document.querySelector("#difficulty"),
    timePerQuestion = document.querySelector("#time"),
    quiz = document.querySelector(".quiz"),
    startScreen = document.querySelector(".start-screen");

  let questions = [],
    time = 30,
    score = 0,
    currentQuestion,
    timer;

  const startQuiz = () => {
    const num = numQuestions.value,
      cat = category.value,
      difficulty = difficulty.value;
    loadingAnimation();
    const url = `https://opentdb.com/api.php?amount=${num}&category=${cat}&difficulty=${difficulty}&type=boolean`;
    fetch(url)
      .then((res) => res.json())
      .then((data) => {
        questions = data.results;
        setTimeout(() => {
          startScreen.classList.add("hide");
          quiz.classList.remove("hide");
          currentQuestion = 1;
          showQuestion(questions[0]);
        }, 1000);
      });
  };

  
  // start event
  startBtn.addEventListener("click", startQuiz);

  const showQuestion = (question) => {
    const questionText = document.querySelector(".question"),
      answersWrapper = document.querySelector(".answer-wrapper");
    questionNumber = document.querySelector(".number");

    questionText.innerHTML = question.question;

    const answers = [
      ...question.incorrect_answers,
      question.correct_answer.toString(),
    ];
    answersWrapper.innerHTML = "";
    answers.sort(() => Math.random() - 0.5);
    answers.forEach((answer) => {
      answersWrapper.innerHTML += `
                  <div class="answer ">
            <span class="text">${answer}</span>
            <span class="checkbox">
              <i class="fas fa-check"></i>
            </span>
          </div>
        `;
    });

    questionNumber.innerHTML = ` Question <span class="current">${questions.indexOf(question) + 1
    }</span>
            <span class="total">/${questions.length}</span>`;
    //add event listener to each answer
    const answersDiv = document.querySelectorAll(".answer");
    answersDiv.forEach((answer) => {
      answer.addEventListener("click", () => {
        if (!answer.classList.contains("checked")) {
          answersDiv.forEach((answer) => {
            answer.classList.remove("selected");
          });
          answer.classList.add("selected");
          submitBtn.disabled = false;
        }
      });
    });

    time = timePerQuestion.value;
    startTimer(time);
  };

  const startTimer = (time) => {
    timer = setInterval(() => {

      if (time >= 0) {
        progress(time);
        time--;
      } else {
        checkAnswer();
      }
    }, 1000);
  };

  const loadingAnimation = () => {
    startBtn.innerHTML = "Loading";
    const loadingInterval = setInterval(() => {
      if (startBtn.innerHTML.length === 10) {
        startBtn.innerHTML = "Loading";
      } else {
        startBtn.innerHTML += ".";
      }
    }, 500);
  };


  // check answer btn
  const submitBtn = document.querySelector(".submit"),
    nextBtn = document.querySelector(".next");
  submitBtn.addEventListener("click", () => {
    checkAnswer();
  });

  // next question btn
  nextBtn.addEventListener("click", () => {
    nextQuestion();
    submitBtn.style.display = "block";
    nextBtn.style.display = "none";
  });

  const checkAnswer = () => {
    clearInterval(timer);
    const selectedAnswer = document.querySelector(".answer.selected");
    if (selectedAnswer) {
      const answer = selectedAnswer.querySelector(".text").innerHTML;
      console.log(currentQuestion);
      if (answer === questions[currentQuestion - 1].correct_answer) {
        score++;
        selectedAnswer.classList.add("correct");
      } else {
        selectedAnswer.classList.add("wrong");
        const correctAnswer = document
          .querySelectorAll(".answer")
          .forEach((answer) => {
            if (
              answer.querySelector(".text").innerHTML ===
              questions[currentQuestion - 1].correct_answer
            ) {
              answer.classList.add("correct");
            }
          });
      }
    } else {
      const correctAnswer = document
        .querySelectorAll(".answer")
        .forEach((answer) => {
          if (
            answer.querySelector(".text").innerHTML ===
            questions[currentQuestion - 1].correct_answer
          ) {
            answer.classList.add("correct");
          }
        });
    }
    const answersDiv = document.querySelectorAll(".answer");
    answersDiv.forEach((answer) => {
      answer.classList.add("checked");
    });

    submitBtn.style.display = "none";
    nextBtn.style.display = "block";
  };

  const nextQuestion = () => {
    if (currentQuestion < questions.length) {
      currentQuestion++;
      showQuestion(questions[currentQuestion - 1]);
    } else {
      showScore();
    }
  };

  const endScreen = document.querySelector(".end-screen"),
    finalScore = document.querySelector(".final-score"),
    totalScore = document.querySelector(".total-score");
  const showScore = () => {
    endScreen.classList.remove("hide");
    quiz.classList.add("hide");
    finalScore.innerHTML = score;
    totalScore.innerHTML = `/ ${questions.length}`;
  };

  const restartBtn = document.querySelector(".restart");
  restartBtn.addEventListener("click", () => {
    window.location.reload();
  });


  showlogoutbtn();
</script>

<style>
  @import url(https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }

  body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #dddfeb;
  }

  .container {
    position: relative;
    width: 100%;
    max-width: 400px;
    background: #1f2847;
    padding: 30px;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .heading {
    text-align: center;
    font-size: 40px;
    color: #fff;
    margin-bottom: 50px;
  }

  label {
    display: block;
    font-size: 12px;
    margin-bottom: 10px;
    color: #fff;
  }

  select {
    width: 100%;
    padding: 10px;
    border: none;
    text-transform: capitalize;
    border-radius: 5px;
    margin-bottom: 20px;
    background: #fff;
    color: #1f2847;
    font-size: 14px;
  }

  .start-screen .btn {
    margin-top: 50px;
  }

  .hide {
    display: none;
  }

  .timer {
    width: 100%;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin-bottom: 30px;
  }

  .timer .progress {
    position: relative;
    width: 100%;
    height: 40px;
    background: transparent;
    border-radius: 30px;
    overflow: hidden;
    margin-bottom: 10px;
    border: 3px solid #3f4868;
  }

  .timer .progress .progress-bar {
    width: 100%;
    height: 100%;
    border-radius: 30px;
    overflow: hidden;
    background: linear-gradient(to right, red, grey);
    transition: 0.5s linear;
  }

  .timer .progress .progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    font-size: 16px;
    font-weight: 500;
  }

  .question-wrapper .number {
    color: #a2aace;
    font-size: 25px;
    font-weight: 500;
    margin-bottom: 20px;
  }

  .question-wrapper .number .total {
    color: #576081;
    font-size: 18px;
  }

  .question-wrapper .question {
    color: #fff;
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 20px;
  }

  .answer-wrapper .answer {
    width: 100%;
    height: 60px;
    padding: 20px;
    border-radius: 10px;
    color: #fff;
    border: 3px solid #3f4868;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    cursor: pointer;
    transition: 0.3s linear;
  }

  .answer .checkbox {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid #3f4868;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
  }

  .answer .checkbox i {
    color: #fff;
    font-size: 10px;
    opacity: 0;
    transition: all 0.3s;
  }

  .answer:hover:not(.checked) .checkbox,
  .answer.selected .checkbox {
    background-color: #0c80ef;
    border-color: #0c80ef;
  }

  .answer.selected .checkbox i {
    opacity: 1;
  }

  .answer.correct {
    border-color: #0cef2a;
  }

  .answer.wrong {
    border-color: #fc3939;
  }

  .question-wrapper,
  .answer-wrapper {
    margin-bottom: 50px;
  }

  .btn {
    width: 100%;
    height: 60px;
    background: #0c80ef;
    border: none;
    border-radius: 10px;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s linear;
  }

  .btn:hover {
    background: #0a6bc5;
  }

  .btn:disabled {
    background: #576081;
    cursor: not-allowed;
  }

  .btn.next {
    display: none;
  }

  .end-screen .score {
    color: #fff;
    font-size: 25px;
    font-weight: 500;
    margin-bottom: 80px;
    text-align: center;
  }

  .score .score-text {
    color: #a2aace;
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 120px;
  }

  @media (max-width: 468px) {
    .container {
      min-height: 100vh;
      max-width: 100%;
      border-radius: 0;
    }
  }
</style>

</html>