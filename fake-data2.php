<div>
    <?php
    require __DIR__ . '/parts/connect_db.php';

    // exit;//關掉
    echo microtime(true) . "<br>";


    $lname = ['黃', '余', '柳', '劉', '王'];
    $fname = ['nu', 'ww', 're', 'rq', 'ww'];

    $sql = "INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES (?,?,?,?,?,NOW())"; // ? 佔位字元

    $stmt = $pdo->prepare($sql);


    for ($i = 0; $i < 100; $i++) {
        shuffle($lname); //亂字串
        shuffle($fname);
        // $ts = rand(0, time());
        $ts = rand(strtotime('1980-01-01'), strtotime('2022-01-01'));
        $stmt->execute([
            $lname[0] . $fname[0],
            "aa{$i}@test.com",
            '0988' . rand(100000, 999999),
            date('Y-m-d', $ts),
            '南w市'
        ]);
    }

    echo microtime(true) . "<br>";
    ?>
</div>