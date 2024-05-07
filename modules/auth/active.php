<!-- Kích hoạt tài khoản -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Active account'
];
layouts('header',$data);

$token = filter()['token'];
if(!empty($token)){
    $tokenQuery = oneRaw("SELECT id FROM users WHERE activeToken = '$token'");
    if(!empty($tokenQuery)){
        $userId = $tokenQuery['id'];
        $dataUpdate = [
            'status' => 1,
            'activeToken' => null
        ];
        $updateStatus = update('users',$dataUpdate, "id = $userId");
        if($updateStatus){
            setFlashData('msg','Kích hoạt tài khoản thành công, bạn có thể đăng nhập ngay bây giờ!');
            setFlashData('msg_type','success');
        }else{
            setFlashData('msg','Kích hoạt tài khoản không thành công, vui lòng liên hệ admin!');
            setFlashData('msg_type','error');
        }

        redirect('?module=auth&action=login');
    }else{
        getMsg('Liên kết không tồn tại hoặc đã hết hạn!','error');
    }
}else{
    getMsg('Liên kết không tồn tại hoặc đã hết hạn!','error');
}