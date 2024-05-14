<?php
if(!defined('_CODE')){
    die('Access denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])){
    $productId = $filterAll['id'];
    $productDetail = getRows("SELECT * FROM product WHERE id = '$productId'");
    if($productDetail > 0){
            $deleteProduct = delete('product',"id = $productId");
            if($deleteProduct){
                setFlashData('msg','Xoá sản phẩm thành công!');
                setFlashData('msg_type','success');
            }else{
                setFlashData('msg','Lỗi hệ thống!');
                setFlashData('msg_type','error');
            }
    }else{
        setFlashData('msg','Sản phẩm không tồn tại trong hệ thống!');
        setFlashData('msg_type','error');
    }
}else{
    setFlashData('msg','Liên kết không tồn tại!');
    setFlashData('msg_type','error');
}

redirect('?module=users&action=product-list');