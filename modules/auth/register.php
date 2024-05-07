<!-- Đăng ký tài khoản -->
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
        $activeToken = sha1(uniqid().time());
        $dataInsert = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
            'password' => password_hash($filterAll['password'],PASSWORD_DEFAULT),
            'activeToken' => $activeToken,
            'create_at' => date('Y-m-d H:i:s')
        ];

        $insertStatus = insert('users', $dataInsert);
        
        if($insertStatus){
            // Tạo link kích hoạt
            $linkActive = _WEB_HOST. '?module=auth&action=active&token='.$activeToken;
            // Thiết lập gửi mail
            $subject = $filterAll['fullname']. ' vui lòng kích hoạt tài khoản!';
            $content = 'Chào '.$filterAll['fullname']. '</>';
            $content .= '. Vui lòng click vào link dưới đây để kích hoạt tài khoản: </br>';
            $content .= $linkActive. '</br>';
            $content .= '. Trân trọng cảm ơn!';
            // Tiến hành gửi mail
            $sendMail = sendMail($filterAll['email'],$subject,$content);
            if($sendMail){
                setFlashData('msg','Đăng ký thành thông, vui lòng kiểm tra email để kích hoạt tài khoản!');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','Hệ thống đang gặp sự cố, vui lòng thử lại sau!');
                setFlashData('msg_type','error');
            }
        }else{
            setFlashData('msg','Đăng ký không thành công!');
            setFlashData('msg_type','error');
        }
        redirect('?module=auth&action=register');
    }else{
        setFlashData('msg','Vui lòng kiểm tra lại dữ liệu!');
        setFlashData('msg_type','error');
        setFlashData('error',$error);
        setFlashData('old',$filterAll);
        redirect('?module=auth&action=register');
    }
}


$data = [
    'pageTitle' => 'Sign up | Grocery Mart'
];
layouts('header',$data);

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('error');
$old = getFlashData('old');

?>

<main class="auth">
    <!-- Auth intro -->
    <div class="auth__intro">
        <img src="./assets/img/auth/intro.svg" alt="" class="auth__intro-img">
        <p class="auth__intro-text">The best of luxury brand values, high quality products, and innovative services</p>
    </div>
    <!-- Auth content -->
    <div class="auth__content">
        <div class="auth__content-inner">
            <a href="./" class="logo">
                <img src="./assets/icons/logo.svg" alt="grocerymart" class="logo__img" />
                <h1 class="logo__title">grocerymart</h1>
            </a>
            <h1 class="auth__heading">Sign Up</h1>
            <p class="auth__desc">Let’s create your account and Shop like a pro and save money.</p>
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
                <div class="form__group auth__btn-group">
                    <button type="submit" class="btn btn--primary auth__btn">Sign Up</button>
                    <button class="btn btn--outline auth__btn btn--no-margin">
                        <img src="./assets/icons/google.svg" alt="" class="btn__icon icon">
                        Sign in with Google
                    </button>
                </div>
            </form>

            <p class="auth__text">
                You have an account yet?
                <a href="?module=auth&action=login" class="auth__link auth__text-link">Sign In</a>
            </p>
        </div>
    </div>
</main>

<?php

?>