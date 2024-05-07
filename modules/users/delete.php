<?php
if(!defined('_CODE')){
    die('Access denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])){
    $userId = $filterAll['id'];
    $userDetail = getRows("SELECT * FROM users WHERE id = '$userId'");
    if($userDetail > 0){
        $deleteToken = delete('tokenlogin',"user_id = $userId");
        if($deleteToken){
            $deleteUser = delete('users',"id = $userId");
            if($deleteUser){
                setFlashData('msg','Xoá người dùng thành công!');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','Lỗi hệ thống!');
                setFlashData('msg_type','error');
            }
        }
    }else{
        setFlashData('msg','Người dùng không tồn tại trong hệ thống!');
        setFlashData('msg_type','error');
    }
}else{
    setFlashData('msg','Liên kết không tồn tại!');
    setFlashData('msg_type','error');
}

redirect('?module=users&action=list');