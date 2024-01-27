<!DOCTYPE html>
<html>

  <head>
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  </head>
  <style>
    form {

border-radius: 5px;
padding: 20px;
width: 300px;
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
input::placeholder{
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
    <form method="post" action="/login">
        @csrf
        <div class="loginform">
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" placeholder="email">
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Password">
      <br>
      <button type="submit" class="">Login</button>
      
    </form>
    <form action="/reregister" method="post">
        @csrf
        <button type="submit" class="">go to Signup</button>
    </form>
</div>
  </body>
</html>
