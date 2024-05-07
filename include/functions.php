<!-- Các hàm chung của project -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function layouts($layoutName='header', $data=[]){
    if(file_exists(_WEB_PATH_ASSETS. '/layout/'. $layoutName. '.php')){
        require_once(_WEB_PATH_ASSETS. '/layout/'. $layoutName. '.php');
    }
}

// Hàm gửi mail
function sendMail($to, $subject, $content){

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ducthangofficial@gmail.com';                     //SMTP username
        $mail->Password   = 'cbpw pqzs inik umya';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('ducthangofficial@gmail.com', 'Duc Thang');
        $mail->addAddress($to);     //Add a recipient

        //Content
        $mail-> CharSet = "UTF-8";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $sendMail = $mail->send();
        if($sendMail){
            return $sendMail;
        }
    } catch (Exception $e) {
        echo "Gửi mail thất bại. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Kiểm tra phương thức GET
function isGet(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;
    }
    return false;
}

// Kiểm tra phương thức POST
function isPost(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;
    }
    return false;
}

// Hàm Filter lọc dữ liệu
function filter(){
    $filterArr = [];
    if(isGet()){
        if(!empty($_GET)){
            foreach($_GET as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    if(isPost()){
        if(!empty($_POST)){
            foreach($_POST as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    return $filterArr;
}

// Kiểm tra email
function isEmail($email){
    $checkMail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkMail;
}

// Kiểm tra số nguyên INT
function isNumberInt($number){
    $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    return $checkNumber;
}

// Kiểm tra số thực FLOAT
function isNumberFloat($number){
    $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    return $checkNumber;
}

// Kiểm tra số điện thoại
function isPhone($phone){
    // Điều kiện 1: Số đầu tiên phải là số 0
    $checkZero = false;
    if($phone[0] == '0'){
        $checkZero = true;
        $phone = substr($phone,1);
    }

    // Điều kiện 2: Đằng sau nó phải là 9 số
    $checkNumber = false;
    if(isNumberInt($phone) && (strlen($phone) == 9)){
        $checkNumber = true;
    }

    if($checkNumber && $checkZero){
        return true;
    }
    
    return false;
}

// Thông báo lỗi
function getMsg($msg, $type = 'success'){
    echo '<span class="auth__'.$type.'">'.$msg.'</span>';
}

// Hàm chuyển hướng
function redirect($path=''){
    header("Location: $path");
    exit;
}

// Hàm thông báo lỗi
function form_error($key, $beforeHtml='', $afterHtml='',$errors){
    return (!empty($errors[$key]) ? $beforeHtml.reset($errors[$key]).$afterHtml: null);
}

// Hàm hiển thị dữ liệu cũ
function old($key, $oldData, $default = null){
    return (!empty($oldData[$key]) ? $oldData[$key]: $default);
}

// Hàm kiểm tra trạng thái đăng nhập
function isLogin(){
    $checkLogin = false;

    if(getSession('loginToken')){
        $tokenLogin = getSession('loginToken');

        $queryToken = oneRaw("SELECT user_id FROM tokenlogin WHERE token = '$tokenLogin'");
        if(!empty($queryToken)){
            $checkLogin = true;
        }else{
            removeSession('loginToken');
        }
    }

    return $checkLogin;
}