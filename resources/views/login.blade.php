<!DOCTYPE html>
<html>

<head>
  <title>Login Form</title>
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<style>
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



  /* login css codes */
  .form1 {
    border-radius: 10px;
    padding: 20px;
    width: 300px;
    margin: 0 auto;
    background-color: #1f2847;
  }

  .form2 {
    border-radius: 5px;
    padding-top: 20px;
    width: 260px;
    margin: 0 auto;
    background-color: #1f2847;
  }

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
  }

  input[type=text],
  input[type=password] {
    padding: 5px;
    width: 100%;
    border-radius: 3px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
  }

  input::placeholder {
    color: black;

  }

  button {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
  }

  button:hover {
    background-color: #45a049;
  }
</style>



<body>



  <form method="post" action="/login" class="form1">
    @csrf
    <div class="loginform">
      <h3 class="container-fluid  txt-center" style="color: white; height: 50px; ;" align="center">Login</h3>

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" placeholder="Email...">
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Password...">
      <br>
      <button type="submit" class="">Login</button>

  </form>
  <form action="/reregister" method="post" class="form2">
    @csrf
    <button type="submit" class="btn btn-restart" style="height: 40px; border-radius: 5px;">Sign Up</button>
  </form>
  </div>

</body>

</html>