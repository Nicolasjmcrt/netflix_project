<?php
require_once './inc/init.php';
require_once './inc/head_inc.php';

// var_dump($connect);

?>


<!-------------------TRAITEMENT--------------------->

<?php


$error = '';



if ($_POST) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    foreach ($_POST as $key => $val) {
        $_POST[$key] = htmlspecialchars(addslashes($val));
    }


    $reqMail = $connect->query("SELECT * FROM member WHERE email = '$email'");
    $stateMail = $reqMail->rowCount();

    if ($stateMail >= 1) {
        $error .=  '<div class="alert alert-dismissible fade show alert-danger" role="alert">
    This email is already used !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
    E-mail address <span>' . $email . '</span> is not considered valid!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    $reqPhone = $connect->query("SELECT * FROM member WHERE phone = '$phone'");
    $statePhone = $reqPhone->rowCount();

    if ($statePhone >= 1) {
        $error .=  '<div class="alert alert-dismissible fade show alert-danger" role="alert">
    This phone number is already used!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (empty($phone) || strlen($phone) != 10) {
        $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
    You must enter a valid phone number!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (empty($_POST['password'])) {
        $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
    You must enter a password!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (empty($error)) {
        $connect->query("INSERT INTO member(email, phone, password) VALUES ('$email', '$phone', '$password')");

        $error .= '<div class="alert alert-dismissible fade show alert-success" role="alert">
        You are registered, welcome to Netflix!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    $alert .= $error;
}

?>

<title>Netflix Project | Registration</title>
</head>
<body>
    <?php

    require_once './inc/header_inc.php';

    ?>
<div class="container d-flex justify-content-center">
    <div class="register-card d-flex align-items-center">
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <?= $alert; ?>
                <h1 class="register-h1 text-center">Create a password to start your membership</h1>
                <form action="" method="POST" class="w-100 mt-3 mb-3">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="name@example.com">
                        <label for="phone">Phone number</label>
                        <div id="emailHelp" class="form-text">We'll never share your email or phone number with anyone else.</div>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Password">
                        <label for="password">Add a password</label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-danger register-btn">Netflix, here I come!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>