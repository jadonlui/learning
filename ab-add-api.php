<?php require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
    'lastInsertId' => 0
];


//to do 欄位檢查 後端檢查
//先剪砸必田欄位
if (empty($_POST['name'])) {

    $output['error'] = 'no name';
    $output['code'] = 400;

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$name = $_POST['name'];
// $email = $_POST['email'] ??'';//如果$_POST['email']是undefind use ''
$email = $_POST['email'] ?'':$_POST['email'];
$mobile = $_POST['mobile'] ?'':$_POST['mobile'];
// $mobile = $_POST['mobile'] ?? '';
$birthday = empty($_POST['birthday']) ? NULL : $_POST['birthday'];
$address = $_POST['address'] ?? '';

if(!empty($email) and filter_var($email,FILTER_VALIDATE_EMAIL)===false)
{
    $output['error'] = 'email 格式錯誤';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}



$sql = "INSERT INTO `address_book`(
    `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
    ) VALUES (
        ?,?,?,?,?,NOW()    
    )";



$stmt = $pdo->prepare($sql);
$stmt->execute([
    $name,
    $email,
    $mobile,
    $birthday,
    $address,
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;

    //最近新加的primery key
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = 'data error';
}
//isser()->有沒有設，有use = vs empty()沒有設(=)or''


echo json_encode($output, JSON_UNESCAPED_UNICODE);//不要編碼朱文