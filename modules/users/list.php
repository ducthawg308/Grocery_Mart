<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Users list'
];

// Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
    redirect('?module=auth&action=login');
} else {
    layouts('header-logined',$data);
}

$listUsers = getRaw("SELECT * FROM users ORDER BY update_at ");

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>

<div class="container">
    <div class="table">
        <section class="table__header">
            <h1 class="table__header-heading">Quản lý người dùng</h1>
            <a href="?module=users&action=add" class="btn-success add-user">Thêm người dùng <i class="fa-solid fa-plus"></i></a>
            <?php
                if(!empty($msg)){
                    getMsg($msg,$msg_type);
                } 
            ?>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </thead>
                <tbody>
                    <?php
                        if(!empty($listUsers)):
                            $count = 0;
                            foreach($listUsers as $item):
                                $count++;
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $item['fullname']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                            <td><?php echo $item['status'] == '1' ? '<button class="btn-success">Đã kích hoạt</button>' : '<button class="btn-error">Chưa kích hoạt</button>'; ?></td>
                            <td><a href="<?php echo _WEB_HOST; ?>?module=users&action=edit&id=<?php echo $item['id'] ?>" class="btn-edit"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="<?php echo _WEB_HOST; ?>?module=users&action=delete&id=<?php echo $item['id'] ?>"class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa user này?')"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</div>

<?php

?>




