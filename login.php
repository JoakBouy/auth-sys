<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>

<?php

    //check for the submit

    //take the data and do the query

    //execute the query

    //fetch the data

    //check for the row count

    //Use the password_verify function to check the password


    if(isset($_SESSION['user_id'])){
        header("Location: index.php");
    }

    if(isset($_POST['submit'])){
      if($_POST['email'] == '' OR $_POST['password'] == '') {
        echo "Please fill in all fields";

      } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $conn->query("SELECT * FROM users WHERE email = '$email'");

        $login->execute();

        $data = $login->fetch(PDO::FETCH_ASSOC);

        if($login->rowCount() > 0){
          if(password_verify($password, $data['mypassword'])){
            $_SESSION['user_id'] = $data['id'];
            header("Location: index.php");
          } else {
            $error = "Incorrect password";
          }
          echo $login->rowCount();
          
        }
      } 
    }
?>        


<main class="form-signin w-50 m-auto">
  <form method = "POST" action="login.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account  <a href="register.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
