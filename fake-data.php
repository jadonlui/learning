<?php
require __DIR__ . '/parts/connect_db.php';

// $sql="INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES ('李lin','aaa@test.com','0928099404','1987-11-23','南投市',NOW())";

// $stmt=$pdo->query($sql);
//避免sql injection(SQL 隱碼attack)
//儘量不要直接use query

$sql="INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES (?,?,?,?,?,NOW())";// ? 佔位字元

//只要是user input 的就use->prepare execute 
$stmt=$pdo->prepare($sql);
$stmt->execute([
    "李lqwe's pen",
    'aawa@test.com',
    '0988099404',
    '1987-11-23',
    '南w市'
]);
//"李lqwe's pen"-->" "幫 ' 跳脫

echo $stmt->rowCount();//新加給筆
