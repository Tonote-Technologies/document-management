<?php require_once('private/initialize.php');

$page = 'Login';
$page_title = 'ToNote | Login';

$errors = [];
$email = '';
$password = '';


if (is_post_request()) { 

  $login = $_POST['login'] ?? '';
  if ($login) {

    $email = $login['email'] ?? '';
    $password = $login['password'] ?? ''; 

    // Validations
    if (is_blank($email)) {
      $errors[] = "Email cannot be blank.";
    }
    if (is_blank($password)) {
      $errors[] = "Password cannot be blank.";
    }


    // if there were no errors, try to login
    if (empty($errors)) {
      $admin = Admin::find_by_email($email);

      
      // test if admin found and password is correct
      if ($admin != false && $admin->verify_password($password)) {
        // Logged out Customer and riders before login in Admin
        $session->logout(true); //for admin logout
        $session->logout('', true); //for Riders logout

        // Mark admin as logged in
        $session->login($admin);
        
        //for logging actions in the log file
        log_action('Admin Login', "{$admin->full_name()} Logged in.", "login");
        redirect_to(url_for('dashboard/'));

      } else {
        // email not found or password does not match
        $errors[] = "Log in not successful.";
      }
      // end
      
    }
  }
} else {
  $admin = new Admin;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToNote Document Management</title>
    <link rel="stylesheet" type="text/css" href="login/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="login/css/iofrm-theme1.css">
    <link rel="icon" type="image/png" href="login/images/fav.png">
</head>

<body>
    <div class="form-body">


        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Get more things done the easy way.</h3>
                    <img src="login/images/graphic1.svg" alt="">
                </div>

            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <a href="#">
                                <div class="logo">
                                    <img class="logo-size" src="login/images/logo-light.png" alt="">
                                </div>
                            </a>
                        </div>


                        <div class="page-links">
                            <a href="login.php" class="active">Login</a>
                            <a href="register.php">SignUp</a>
                        </div>
                        <p>Enter your credentials below to logIn.</p>
                        <?php if ($errors) { ?>
                        <?php echo display_errors($errors); ?>
                        <?php } ?>
                        <form method="post" id='login_form'>

                            <input class="form-control" type="email" name="login[email]" placeholder="Email" required
                                value="">
                            <input class="form-control" id="password" type="password" name="login[password]"
                                placeholder="Password" required value="">
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Proceed</button>
                                <a href="forget.php">Forget password?</a>
                            </div>
                        </form>
                        <div class="other-links">
                            <span>Or login as a</span> <a href="#">Notary Public</a>
                            <!-- <a href="#">Admin</a> -->
                        </div>

                        <div class="mt-2"></div>
                        <!-- <a href="www.gettonote.com" class="text-light " style="font-size: 12px;">
                            &copy; <?php echo date('Y') ?> Powered by: ToNote Technologies Ltd.
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="login/js/jquery.min.js"></script>
<script src="login/js/popper.min.js"></script>
<script src="login/js/bootstrap.min.js"></script>
<script src="login/js/main.js"></script>

<script type="text/javascript">
// $(document).on('submit', '#login_form', function(e) {
//     e.preventDefault();
//     window.location.href = "dashboard/"
// })
</script>

</html>