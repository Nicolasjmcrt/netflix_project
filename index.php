<?php
require_once './inc/init.php';
require_once './inc/head_inc.php';

?>
<title>Netflix Project | Home</title>
</head>

<body>
    <?php

    require_once './inc/header_inc.php';

    ?>
    <?php if (userConnected()) : ?>
        <div class="container">
            <div class="ratio ratio-16x9">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/hf8EYbVxtCY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    <?php else : ?>
        <div class="container main-content mt-3 mb-3">
            <h1 class="text-center">Unlimited movies, TV shows, and more.</h1>
            <h2 class="text-center">Watch anywhere. Cancel anytime.</h2>
            <h3 class="text-center">Ready to watch? Click "Get started" to create or restart your membership.</h3>
            <a href="registration.php" class="started">Get started ></a>
        </div>
</body>

</html>
<?php endif ?>