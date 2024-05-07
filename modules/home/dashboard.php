<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Grocery Mart'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle'])?$data['pageTitle']:'Grocery Mart' ?></title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo _WEB_HOST_ASSETS?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo _WEB_HOST_ASSETS?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo _WEB_HOST_ASSETS?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="./assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ASSETS?>/fonts/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ASSETS?>/css/main.css">

    <!-- Script --> 
    <script src="<?php echo _WEB_HOST_ASSETS?>/js/scripts.js"></script>
</head>
<body>
    <?php
        if(isLogin()):
            layouts('header-logined',$data);
            ?>
                <main class="container home">
                    <?php
                        layouts('Slideshow');
                        layouts('Categories');
                        layouts('Products');
                    ?>
                </main>   
            <?php
            layouts('footer');
    ?>

    <?php
        else:
            layouts('header-no-login',$data);
            ?>
                <main class="container home">
                    <?php
                        layouts('Slideshow');
                        layouts('Categories');
                        layouts('Products');
                    ?>
                </main>   
            <?php
            layouts('footer');
    ?>

    <?php
        endif;
    ?>
</body>
</html>


