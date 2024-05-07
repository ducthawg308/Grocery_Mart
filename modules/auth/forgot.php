<!-- Quên mật khẩu -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Reset your password | Grocery Mart'
];
layouts('header',$data);

// Kiểm tra trạng thái đăng nhập
if(isLogin()){
    redirect('?module=home&action=dashboard');
}

if(isPost()){
    $filterAll = filter();
    if(!empty($filterAll['email'])){
        $email = $filterAll['email'];
        $queryUser = oneRaw("SELECT id FROM users WHERE email = '$email'");
        if(!empty($queryUser)){
            $userId = $queryUser['id'];
            $forgotToken = sha1(uniqid().time());
            $dataUpdate = [
                'forgotToken' => $forgotToken
            ];
            $updateStatus = update('users', $dataUpdate,"id = $userId");
            if($updateStatus){
                $linkReset = _WEB_HOST.'?module=auth&action=reset&token='.$forgotToken;

                $subject = 'Yêu cầu khôi phục mật khẩu.';
                $content = 'Chào bạn. </br>';
                $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để thay đổi mật khẩu: </br>';
                $content .= $linkReset. '. </br>';
                $content .= 'Trân trọng cảm ơn!';

                $sendMail = sendMail($email,$subject,$content);
                if($sendMail){
                    setFlashData('msg','Vui lòng kiểm tra email để xem hướng dẫn đặt lại mật khẩu!');
                    setFlashData('msg_type','success');
                }else{
                    setFlashData('msg','Lỗi hệ thống, vui lòng thử lại sau!');
                    setFlashData('msg_type','error');
                }

            }else{
                setFlashData('msg','Lỗi hệ thống, vui lòng thử lại sau!');
                setFlashData('msg_type','error');
            }

        }else{
            setFlashData('msg','Email này chưa được đăng ký!');
            setFlashData('msg_type','error');
        }

    }else{
        setFlashData('msg','Vui lòng nhập địa chỉ email!');
        setFlashData('msg_type','error');
    }

    redirect('?module=auth&action=forgot');
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>
<main class="auth">
    <!-- Auth intro -->
    <div class="auth__intro">
        <img src="./assets/img/auth/forgot-password.png" alt="" class="auth__intro-img">
    </div>
    <!-- Auth content -->
    <div class="auth__content">
        <div class="auth__content-inner">
            <a href="./" class="logo">
                <img src="./assets/icons/logo.svg" alt="grocerymart" class="logo__img" />
                <h1 class="logo__title">grocerymart</h1>
            </a>
            <h1 class="auth__heading">Reset your password</h1>
            <p class="auth__desc">Enter your email and we'll send you a link to reset your password.</p>
            <?php
                if(!empty($msg)){
                    getMsg($msg,$msg_type);
                } 
            ?>
            <form action="" method="post" class="auth__form">
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="email" name="email" id="" class="form__input" placeholder="Email">
                        <img src="./assets/icons/message.svg" alt="" class="form__input-icon">
                    </div>
                </div>
                <div class="form__group auth__btn-group">
                    <button class="btn btn--primary auth__btn">Reset password</button>
                </div>
            </form>

            <p class="auth__text">
                <a href="?module=auth&action=login" class="auth__link auth__text-link">Back to Sign In</a>
            </p>
        </div>
    </div>
</main>
<?php

?>