<?php
require_once './inc/init.php';
require_once './inc/head_inc.php';
// var_dump($connect);

if (!userConnected()) {
    header('location:authentication.php');
    exit();
}

?>
<title>Netflix Project | Member profile</title>
</head>


<body>

    <!-- TRAITEMENT -->

    <?php
    require_once './inc/header_inc.php';

    $memberSession = $_SESSION['member']['member_id'];
    $req = $connect->query("SELECT * FROM member WHERE member_id = '$memberSession]'");
    $user = $req->fetch(PDO::FETCH_ASSOC);

    // var_dump($memberSession);
    ?>

    <div class="container d-flex justify-content-center mt-3 mb-3">
        <h1 class="text-center mt-3">Member profile</h1>
    </div>
    <div class="container d-flex justify-content-center mt-3">
        <?= $alert; ?>
    </div>
    <div class="container d-flex justify-content-center mt-3">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $user['avatar_img']; ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Your profile</h5>
                        <p class="card-text"><strong>Your email : </strong><?php echo $user['email']; ?></p>
                        <p class="card-text"><strong>Your phone number : </strong><?php echo $user['phone']; ?></p>
                        <a href="<?= URL ?>member_management.php?action=edit&member_id=<?php echo $user['member_id']; ?>" class="btn btn-danger">Edit my profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>