<!-- Đăng ký tài khoản -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])){
    $userId = $filterAll['id'];
    $userDetail = oneRaw("SELECT * FROM users WHERE id = '$userId'");
    if(!empty($userDetail)){
        setFlashData('user-detail',$userDetail);
    }else{
        redirect('?module=users&action=list');
    }
}else{
    redirect('?module=users&action=list');
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
        $sql = "SELECT id FROM users WHERE email = '$email' AND id <> $userId";
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

    if(!empty($filterAll['password'])){
        // Validate password confirm
        if(empty($filterAll['password_confirm'])){
            $error['password_confirm']['required'] = 'Vui lòng nhập lại mật khẩu.';
        }else{
            if($filterAll['password_confirm'] != $filterAll['password']){
                $error['password_confirm']['match'] = 'Mật khẩu nhập lại không đúng.';
            }
        }
    }

    if(empty($error)){
        $dataUpdate = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
            'status' => $filterAll['status'],
            'create_at' => date('Y-m-d H:i:s')
        ];

        if(!empty($filterAll['password'])){
            $dataUpdate['password'] = password_hash($filterAll['password'],PASSWORD_DEFAULT);
        }

        $condition = "id = $userId";
        $updateStatus = update('users', $dataUpdate, $condition);
        
        if($updateStatus){
            setFlashData('msg','Sửa người dùng thành công!');
            setFlashData('msg_type','success');
        }else{
            setFlashData('msg','Hệ thống đang lỗi, vui lòng thử lại sau!');
            setFlashData('msg_type','error');
        }
    }else{
        setFlashData('msg','Vui lòng kiểm tra lại dữ liệu!');
        setFlashData('msg_type','error');
        setFlashData('error',$error);
        setFlashData('old',$filterAll);
    }
    redirect('?module=users&action=edit&id='.$userId);
}


$data = [
    'pageTitle' => 'Sửa người dùng | Grocery Mart'
];
layouts('header',$data);

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('error');
$old = getFlashData('old');
$userDetailll = getFlashData('user-detail');
if(!empty($userDetailll)){
    $old = $userDetailll;
}

?>

<main class="auth">
    <!-- Auth content -->
    <div class="auth__content">
        <div class="auth__content-inner">
            <a href="./" class="logo">
                <img src="./assets/icons/logo.svg" alt="grocerymart" class="logo__img" />
                <h1 class="logo__title">grocerymart</h1>
            </a>
            <h1 class="auth__heading">Sửa người dùng</h1>
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
                        <input type="password" name="password" id="" class="form__input" placeholder="Password (Không nhập nếu không thay đổi)">
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
                <input type="hidden" name="id" id="" value="<?php echo $userId ?>">
                <div class="form__group auth__btn-group">
                    <button type="submit" class="btn btn--primary auth__btn">Sửa người dùng</button>
                    <a href="?module=users&action=list" class="btn btn--outline auth__btn" style="margin: 0;">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php

?>