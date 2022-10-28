<?php
require_once './inc/init.php';
require_once './inc/head_inc.php';
// var_dump($connect);


?>
<title>Netflix Project | Member profile Management</title>
</head>


<body>

    <?php

    $error = '';

    if ($_POST) {

        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars(addslashes($value));
        }

        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            $dbImg = $_POST['actual-picture'];
        }

        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $req = $connect->query("SELECT * FROM member WHERE email = '$email' AND phone = '$phone'");
        $state = $req->rowCount();

        // --------------------------AJOUT D'IMAGE--------------------------------


        if (!empty($_FILES['picture'])) {

            $picture = $_FILES['picture'];

            $imgName = time() . '_'  . $picture['name'];

            $dbImg = URL . "img/$imgName";

            define("BASE", $_SERVER['DOCUMENT_ROOT'] . '/netflix_project/');

            $imgFile = BASE . "img/$imgName";

            if ($picture['size'] <= 8000000) {

                $info = pathinfo($picture['name'], PATHINFO_EXTENSION);

                $tabExt = ['jpg', 'png', 'jpeg', 'gif', 'webp', 'JPG', 'PNG', 'JPEG', 'GIF', 'WEBP', 'Jpg', 'Png', 'Jpeg', 'Gif', 'Webp'];

                if (in_array($info, $tabExt)) {
                    copy($picture['tmp_name'], $imgFile);
                } else {
                    $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
                Format not allowed !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            } else {
                $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">
            Check your image size !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }

        if (isset($_GET['action']) && $_GET['action'] == 'edit') {

            $connect->query("UPDATE member SET email = '$email',
                                               phone = '$phone',
                                               avatar_img = '$dbImg' WHERE member_id = '$_GET[member_id]'");

            $error .= '<div class="alert alert-dismissible fade show alert-success" role="alert">
            Your account has been edited!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

            header('location:profile.php');
        } else {

            if ($state >= 1) {
                $error .= '<div class="alert alert-dismissible fade show alert-danger" role="alert">E-mail or phone number already used!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }

        $alert .= $error;
    }

    ?>


    <title>Netflix Project | Registration</title>
    </head>

    <body>
        <?php

        require_once './inc/header_inc.php';

        if (!userConnected()) {
            header('location:authentication.php');
            exit();
        }

        ?>
        <div class="container mt-3 mb-3">
            <?= $alert ?>
        </div>
        <div class="container d-flex justify-content-center">

            <?php

            if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                $edit = $connect->query("SELECT * FROM member WHERE member_id = '$_GET[member_id]'");
                $data = $edit->fetch(PDO::FETCH_ASSOC);
            }

            $mId = (isset($data['member_id'])) ? $data['member_id'] : '';
            $eml = (isset($data['email'])) ? $data['email'] : '';
            $pho = (isset($data['phone'])) ? $data['phone'] : '';
            $pic = (isset($data['avatar_img'])) ? $data['avatar_img'] : '';

            ?>
            <div class="register-card d-flex align-items-center">
                <div class="row d-flex justify-content-center">
                    <div class="col-10">
                        <?= $alert; ?>
                        <h1 class="register-h1 text-center">Want to change your email, phone number or avatar picture?</h1>
                        <?php if (!empty($pic)) : ?>
                            <div class="d-flex justify-content-center mt-3 mb-3">
                                <img src="<?= $pic; ?>" style="max-width:100px;">
                            </div>
                        <?php endif; ?>
                        <form action="" method="POST" class="w-100 mt-3 mb-3" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" name="product_id" value="<?= $mId ?>">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" value="<?= $eml ?>">
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="phone" class="form-control" id="phone" name="phone" value="<?= $pho ?>">
                                <label for="phone">Phone number</label>
                            </div>
                            <div class="mb-3">
                                <label for="picture" class="form-label avatar">Avatar</label>
                                <input type="file" class="form-control" name="picture" id="picture" value="<?= $pic ?>">
                                <input type="hidden" name="actual-picture" value="<?= $pic; ?>">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn btn-danger register-btn">Edit my data</button>
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