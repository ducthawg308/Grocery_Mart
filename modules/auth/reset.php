<!-- Reset password -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Reset your password | Grocery Mart'
];
layouts('header',$data);

$token = filter()['token'];
if(!empty($token)){
    $tokenQuery = oneRaw("SELECT id, fullname, email FROM users WHERE forgotToken = '$token'");
    if(!empty($tokenQuery)){
        $userId = $tokenQuery['id'];
        if(isPost()){
            $filterAll = filter();
            $errors = [];
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
                $passwordHash = password_hash($filterAll['password'],PASSWORD_DEFAULT);
                $dataUpdate = [
                    'password' => $passwordHash,
                    'forgotToken' => null,
                    'update_at' => date('Y-m-d H:i:s')
                ];

                $updateStatus = update('users', $dataUpdate, "id = $userId");
                if($updateStatus){
                    setFlashData('msg','Thay đổi mật khẩu thành công!');
                    setFlashData('msg_type','success');
                    redirect('?module=auth&action=login');
                }else{
                    setFlashData('msg','Lỗi hệ thống, vui lòng thử lại sau!');
                    setFlashData('msg_type','error');
                }

            }else{
                setFlashData('msg','Vui lòng kiểm tra lại dữ liệu!');
                setFlashData('msg_type','error');
                setFlashData('error',$error);
                redirect('?module=auth&action=reset&token='.$token);
            }
        }

        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('error');


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
                        <?php
                            if(!empty($msg)){
                                getMsg($msg,$msg_type);
                            } 
                        ?>
                        <form action="" method="post" class="auth__form">
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
                            <input type="hidden" name="token" value="<?php echo $token ?>">
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

    }else{
        getMsg('Liên kết không tồn tại hoặc đã hết hạn!','error');
    }
}else{
    getMsg('Liên kết không tồn tại hoặc đã hết hạn!','error');
}
?>