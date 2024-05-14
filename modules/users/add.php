<!-- Thêm người dùng -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

if(isPost()){
    $filterAll = filter();

    $error = []; // Mảng chứa lỗi Validate

    // Validate fullname
    if(empty($filterAll['fullname'])){
        $error['fullname']['required'] = 'Họ tên bắt buộc phải nhập.';
    }else{
        if(strlen($filterAll['fullname']) < 5){
            $error['fullname']['min'] = 'Họ tên phải có ít nhất 5 ký tự.';
        }
    }

    // Validate email
    if(empty($filterAll['email'])){
        $error['email']['required'] = 'Email bắt buộc phải nhập.';
    }else{
        $email = $filterAll['email'];
        $sql = "SELECT id FROM users WHERE email = '$email'";
        if(getRows($sql)>0){
            $error['email']['unique'] = 'Email đã tồn tại.';
        }
    }

    // Validate số điện thoại
    if(empty($filterAll['phone'])){
        $error['phone']['required'] = 'Số điện thoại bắt buộc phải nhập.';
    }else{
        if(!isPhone($filterAll['phone'])){
            $error['phone']['isPhone'] = 'Số điện thoại không hợp lệ.';
        }
    }

    // Validate password
    if(empty($filterAll['password'])){
        $error['password']['required'] = 'Mật khẩu bắt buộc phải nhập.';
    }else{
        if(strlen($filterAll['password']) < 8){
            $error['password']['min'] = 'Mật khẩu phải có ít nhất 8 ký tự.';
        }
    }

    // Validate password confirm
    if(empty($filterAll['password_confirm'])){
        $error['password_confirm']['required'] = 'Vui lòng nhập lại mật khẩu.';
    }else{
        if($filterAll['password_confirm'] != $filterAll['password']){
            $error['password_confirm']['match'] = 'Mật khẩu nhập lại không đúng.';
        }
    }

    if(empty($error)){
        $dataInsert = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
            'password' => password_hash($filterAll['password'],PASSWORD_DEFAULT),
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
        redirect('?module=users&action=add');
    }
}


$data = [
    'pageTitle' => 'Thêm người dùng | Grocery Mart'
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
            <h1 class="auth__heading">Thêm người dùng</h1>
            <?php
                if(!empty($msg)){
                    getMsg($msg,$msg_type);
                } 
            ?>
            <form action="" method="post" class="auth__form">
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="text" name="fullname" id="" class="form__input" placeholder="Full name" value="<?php echo old('fullname',$old) ?>">
                        <img src="./assets/icons/message.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('fullname','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="email" name="email" id="" class="form__input" placeholder="Email" value="<?php echo old('email',$old) ?>">
                        <img src="./assets/icons/message.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('email','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="tel" name="phone" id="" class="form__input" placeholder="Phone" value="<?php echo old('phone',$old) ?>">
                        <img src="./assets/icons/message.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('phone','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="password" name="password" id="" class="form__input" placeholder="Password">
                        <img src="./assets/icons/lock.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('password','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="password" name="password_confirm" id="" class="form__input" placeholder="Confirm password">
                        <img src="./assets/icons/lock.svg" alt="" class="form__input-icon">
                    </div>
                    <?php
                        echo form_error('password_confirm','<span class="form__message-error">','</span>',$errors);
                    ?>
                </div>
                <div class="form__group">
                    <select name="status" id="" class="form__control">
                        <option value="0" <?php echo old('status',$old)==0 ? 'selected' : false; ?>>Chưa kích hoạt</option>
                        <option value="1" <?php echo old('status',$old)==1 ? 'selected' : false; ?>>Đã kích hoạt</option>
                    </select>
                </div>
                <div class="form__group auth__btn-group">
                    <button type="submit" class="btn btn--primary auth__btn">Thêm người dùng</button>
                    <a href="?module=users&action=list" class="btn btn--outline auth__btn" style="margin: 0;">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php

?>