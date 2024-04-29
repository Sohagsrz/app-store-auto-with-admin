<?php 


if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    
try {
    if(!isset($_POST['email'])){
        throw new Exception('Email is empty');
    }
    if(!isset($_POST['password'])){
        throw new Exception('Password is empty');
    }
 
    auth()->login($_POST['email'], $_POST['password'], isset($_POST['remember']));
    redirect('/dashboard');
}
catch (\Delight\Auth\InvalidEmailException $e) {
    $_SESSION['error']='Wrong email address'; 
    
    redirect('/dashboard/login');
}
catch (\Delight\Auth\InvalidPasswordException $e) { 
    $_SESSION['error']='Wrong password'; 
    
    redirect('/dashboard/login');
}
catch (\Delight\Auth\EmailNotVerifiedException $e) { 
    $_SESSION['error']='Email not verified'; 
    
    redirect('/dashboard/login');
}
catch (\Delight\Auth\TooManyRequestsException $e) { 
    $_SESSION['error']='Too many requests';
    
    redirect('/dashboard/login');
}
catch(Exception $e){
    $_SESSION['error']=$e->getMessage();
    
    redirect('/dashboard/login');
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="login-container">
          <h2 class="text-center mb-4">Login</h2>
          <form method="post" action="" > 
            <?php 
            if(isset($_SESSION['error'])){
                echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }?>

            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password"  name="password" placeholder="Password">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" name="remember" id="remember-me">
              <label class="form-check-label"  for="remember-me">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
