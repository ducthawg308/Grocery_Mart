<!-- Đăng nhập tài khoản -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Sign in | Grocery Mart'
];
layouts('header',$data);

// Kiểm tra trạng thái đăng nhập
if(isLogin()){
    redirect('?module=home&action=dashboard');
}

if(isPost()){
    $filterAll = filter();
    if(!empty(trim($filterAll['email'])) && !empty(trim($filterAll['password']))){
        $email = $filterAll['email'];
        $password = $filterAll['password'];

        // Truy vấn thông tin users
        $userQuery = oneRaw("SELECT password, id FROM users WHERE email = '$email'");

        if(!empty($userQuery)){
            $passwordHash = $userQuery['password'];
            $user_id = $userQuery['id'];
            if(password_verify($password,$passwordHash)){
                // Tạo và insert token login
                $tokenLogin = sha1(uniqid().time());
                $dataInsert = [
                    'user_id' => $user_id,
                    'token' => $tokenLogin,
                    'create_at' => date('Y-m-d H:i:s')
                ];
                $insertStatus = insert('tokenlogin',$dataInsert);
                if($insertStatus){
                    // Lưu loginToken vào session
                    setSession('loginToken', $tokenLogin);

                    redirect('?module=home&action=dashboard');
                }else{
                    setFlashData('msg','Không thể đăng nhập, vui lòng thử lại sau.');
                    setFlashData('msg_type','error');
                }
            }else{
                setFlashData('msg','Mật khẩu không chính xác.');
                setFlashData('msg_type','error');
            }
        }else{
            setFlashData('msg','Email không tồn tại.');
            setFlashData('msg_type','error');
        }
    }else{
        setFlashData('msg','Vui lòng nhập email và mật khẩu.');
        setFlashData('msg_type','error');
    }
    redirect('?module=auth&action=login');
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

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
            <h1 class="auth__heading">Hello Again!</h1>
            <p class="auth__desc">Welcome back to sign in. As a returning customer, you have access to your previously saved all information.</p>
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
                <div class="form__group">
                    <div class="form__text-input">
                        <input type="password" name="password" id="" class="form__input" placeholder="Password">
                        <img src="./assets/icons/lock.svg" alt="" class="form__input-icon">
                    </div>
                </div>
                <div class="form__group form__group--inline">
                    <label class="form__checkbox">
                        <input type="checkbox" name="" id="" class="form__checkbox-input d-none" />
                        <span class="form__checkbox-label">Set as default card</span>
                    </label>
                    <a href="?module=auth&action=forgot" class="auth__link form__pull-right">Forgot password?</a>
                </div>
                <div class="form__group auth__btn-group">
                    <button class="btn btn--primary auth__btn">Sign in</button>
                    <button class="btn btn--outline auth__btn btn--no-margin">
                        <img src="./assets/icons/google.svg" alt="" class="btn__icon icon">
                        Sign in with Google
                    </button>
                </div>
            </form>

            <p class="auth__text">
                Don’t have an account yet?
                <a href="?module=auth&action=register" class="auth__link auth__text-link">Sign Up</a>
            </p>
        </div>
    </div>
</main>
<?php

?>