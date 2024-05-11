<!-- Đăng ký tài khoản -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

if(isPost()){
    $filterAll = filter();

    $error = []; // Mảng chứa lỗi Validate

    // Validate title
    if(empty($filterAll['title'])){
        $error['title']['required'] = 'Tên sản phẩm bắt buộc phải nhập.';
    }

    // Validate brand
    if(empty($filterAll['brand'])){
        $error['brand']['required'] = 'Nhà sản xuất bắt buộc phải nhập.';
    }

    // Validate description
    if(empty($filterAll['brand'])){
        $error['description']['required'] = 'Mô tả sản phẩm bắt buộc phải nhập.';
    }

    // Validate price
    if(empty($filterAll['price'])){
        $error['price']['required'] = 'Giá bán bắt buộc phải nhập.';
    }

    // Validate discount
    if(empty($filterAll['discount'])){
        if($filterAll['discount'] >= $filterAll['price']){
            $error['discount']['max'] = 'Giá discount phải bé hơn giá bán!';
        }
    }

    if(empty($error)){
        $dataInsert = [
            'title' => $filterAll['title'],
            'brand' => $filterAll['brand'],
            'description' => $filterAll['description'],
            'price' => $filterAll['price'],
            'discount' => $filterAll['discount'],
            'status' => $filterAll['status'],
            'create_at' => date('Y-m-d H:i:s')
        ];

        $insertStatus = insert('users', $dataInsert);
        
        if($insertStatus){
            setFlashData('msg','Thêm người dùng mới thành công!');
            setFlashData('msg_type','success');
            redirect('?module=users&action=list');
        }else{
            setFlashData('msg','Hệ thống đang lỗi, vui lòng thử lại sau!');
            setFlashData('msg_type','error');
            redirect('?module=users&action=add');
        }
    }else{
        setFlashData('msg','Vui lòng kiểm tra lại dữ liệu!');
        setFlashData('msg_type','error');
        setFlashData('error',$error);
        setFlashData('old',$filterAll);
        redirect('?module=users&action=product-add');
    }
}


$data = [
    'pageTitle' => 'Thêm sản phẩm | Grocery Mart'
];
layouts('header',$data);

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('error');
$old = getFlashData('old');

?>

<main class="auth">
    <!-- Auth content -->
    <div class="auth__content">
        <div class="auth__content-inner">
            <a href="./" class="logo">
                <img src="./assets/icons/logo.svg" alt="grocerymart" class="logo__img" />
                <h1 class="logo__title">grocerymart</h1>
            </a>
            <h1 class="auth__heading">Thêm sản phẩm</h1>
            <?php
                if(!empty($msg)){
                    getMsg($msg,$msg_type);
                } 
            ?>
            <form action="" method="post" class="auth__form" enctype="multipart/form-data">
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="file" name="thumbnail" id="">
                    </div>
                    <?php
                        echo form_error('title','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="text" name="title" id="" class="form__input" placeholder="Nhập tên sản phẩm" value="<?php echo old('title',$old) ?>">
                        <img src="./assets/icons/message.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('title','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="text" name="brand" id="" class="form__input" placeholder="Nhập nhà sản xuất" value="<?php echo old('brand',$old) ?>">
                        <img src="./assets/icons/message.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('brand','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="text" name="description" id="" class="form__input" placeholder="Nhập mô tả sản phẩm" value="<?php echo old('description',$old) ?>">
                        <img src="./assets/icons/message.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('brand','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="number" name="price" id="" class="form__input" placeholder="Nhập giá bán" value="<?php echo old('price',$old) ?>">
                        <img src="./assets/icons/message.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('price','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="number" name="discount" id="" class="form__input" placeholder="Nhập giá bán đã giảm giá" value="<?php echo old('discount',$old) ?>">
                        <img src="./assets/icons/lock.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('discount','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <select name="status" id="" class="form__control">
                        <option value="0" <?php echo old('status',$old)==0 ? 'selected' : false; ?>>Chưa kích hoạt</option>
                        <option value="1" <?php echo old('status',$old)==1 ? 'selected' : false; ?>>Đã kích hoạt</option>
                    </select>
                </div>
                <div class="form__group auth__btn-group">
                    <button type="submit" name="submit" class="btn btn--primary auth__btn">Thêm sản phẩm</button>
                    <a href="?module=users&action=product-list" class="btn btn--outline auth__btn" style="margin: 0;">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php

?>