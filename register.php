<?php require_once('private/initialize.php');

$errors = [];
$email = '';
$password = '';

if (is_post_request()) {
   $args = $_POST;
   $args['created_by'] = 1;
   $args['admin_level'] = 1;

   $admin = new Admin($args);
   $admin->save();
   if ($admin == true) {
      $session->message('Account created successfully!.');
   }
   redirect_to(url_for('login.php'));
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
                    <!-- <p> A world of Digital Trust</p> -->
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
                            <!-- <h3>Get more things done the Easy way.</h3> -->

                        </div>


                        <div class="page-links">
                            <a href="login.php">Login</a>
                            <a href="register.php" class="active">SignUp</a>
                        </div>

                        <p>Enter your credentials below to SignUp.</p>
                        <p>
                            <?php if ($errors) : ?>
                            <?php echo display_errors($errors); ?>
                            <?php endif; ?>
                        </p>
                        <form method="post" id='notary_form'>

                            <input class="form-control" type="text" name="first_name" placeholder="Firstname" required
                                value="">
                            <input class="form-control" type="text" name="last_name" placeholder="Lastname" required
                                value="">


                            <input class="form-control" type="email" name="email" placeholder="Email" required value="">

                            <input class="form-control" type="text" name="phone_no" placeholder="Phone Number" required
                                value="">

                            <input class="form-control" id="password" type="password" name="password"
                                placeholder="Password" required value="">
                            <input class="form-control" id="password" type="password" name="confirm_password"
                                placeholder="Confirm Password" required value="">
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Proceed</button>
                            </div>
                        </form>
                        <div class="mt-2"></div>
                        <a href="www.gettonote.com" class="text-light " style="font-size: 12px;">
                            &copy; <?php echo date('Y') ?> Powered by: ToNote Technologies Ltd.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>