<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Product list'
];

$listProducts = getRaw("SELECT * FROM product");

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

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
                <div class="container">
                    <div class="table">
                        <section class="table__header">
                            <h1 class="table__header-heading">Danh sách sản phẩm</h1>
                            <a href="?module=users&action=product-add" class="btn-success add-user">Thêm sản phẩm <i class="fa-solid fa-plus"></i></a>
                            <?php
                                if(!empty($msg)){
                                    getMsg($msg,$msg_type);
                                } 
                            ?>
                        </section>
                        <section class="table__body">
                            <table>
                                <thead>
                                    <th>STT</th>
                                    <th>Danh mục</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Nhà sản xuất</th>
                                    <th>Giá</th>
                                    <th>Giảm giá</th>
                                    <th>Mô tả</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($listProducts)):
                                            $count = 0;
                                            foreach($listProducts as $item):
                                                $count++;
                                    ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td>
                                                <?php
                                                    $category =  oneRaw("SELECT name FROM category WHERE id='$item[category_id]'");
                                                    echo $category['name'];
                                                ?>
                                            </td>
                                            <td><?php echo $item['title']; ?></td>
                                            <td><img class="product-img" src="<?php echo $item['thumbnail']; ?>" alt=""></td>
                                            <td><?php echo $item['brand']; ?></td>
                                            <td><?php echo $item['price']; ?></td>
                                            <td><?php echo $item['discount']; ?></td>
                                            <td style="width:25%;"><p class="product-desc"><?php echo $item['description']; ?></p></td>
                                            <td><a href="<?php echo _WEB_HOST; ?>?module=users&action=product-edit&id=<?php echo $item['id'] ?>" class="btn-edit"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                            <td><a href="<?php echo _WEB_HOST; ?>?module=users&action=product-delete&id=<?php echo $item['id'] ?>"class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"><i class="fa-solid fa-trash"></i></a></td>
                                        </tr>
                                    <?php
                                            endforeach;
                                        endif;
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
            <?php
    ?>

    <?php
        else:
            redirect('?module=auth&action=login');
    ?>

    <?php
        endif;
    ?>
</body>
</html>


<?php

?>




