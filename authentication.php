<?php
require_once './inc/init.php';
require_once './inc/head_inc.php';

?>
<title>Netflix Project | Authentication</title>
</head>

<body>


    <?php

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        header('location:index.php');
    }

    $error = '';

    if ($_POST) {
        $userLogin = $_POST['userLogin'];
        $password = $_POST['password'];

        if (!empty($userLogin)) {

            $req1 = $connect->query("SELECT * FROM member WHERE email = '$userLogin' OR phone = '$userLogin'");

            if ($req1->rowCount() >= 1) {
                $member = $req1->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $member['password'])) {
                    $_SESSION['member']['member_id'] = $member['member_id'];
                    $_SESSION['member']['phone'] = $member['phone'];
                    $_SESSION['member']['email'] = $member['email'];
                    $_SESSION['member']['avatar_img'] = $member['avatar_img'];

                    header('location:profile.php');
                } else {

                    $error .= '<div class="alert alert-danger" role="alert">
                There is an error with the password!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            } else {

                $error .= '<div class="alert alert-danger" role="alert">
            There is an error with the your email or phone number!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }

        $alert .= $error;
    }

    ?>
    <?php

    require_once './inc/header_inc.php';

    ?>
    <div class="container d-flex justify-content-center">
        <div class="register-card d-flex align-items-center">
            <div class="row d-flex justify-content-center w-100">
                <div class="col-10">
                    <?= $alert ?>
                    <h1 class="register-h1 text-center">Sign in</h1>
                    <form action="" method="POST" class="w-100">
                        <div class="form-floating mb-3">
                            <input type="userLogin" class="form-control" id="userLogin" name="userLogin" placeholder="name@example.com">
                            <label for="userLogin">Email or phone number</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control mb-2" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <button type="submit" name="submit" class="btn btn-danger register-btn">Sign in</button>
                        </div>
                    </form>
                    <div class="login-signup">
                        New to Netflix?
                        <a href="<?= URL ?>registration.php">Sign up now!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>