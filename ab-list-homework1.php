<?php
require __DIR__ . '/parts/connect_db.php';
$pagename = 'ab-list';
$title = '通訊錄列表 - qwe網站';



$perpage = 20; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location:?page=1');
    exit;
}
$aaaa = 1;
$t_sql = "SELECT COUNT(1) FROM address_book";
echo $t_sql;
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 總筆數
echo $totalRows;
echo "one:" . isset($aaaa);

echo "two:" . empty($aaaa);

//(PDO::FETCH_NUM)[0];索引式陣列

$totalPages = ceil($totalRows / $perpage); // 總共有幾頁
//PHP式use blocking
$rowtemp = [];
if ($totalRows > 0) {
    //頁碼若超過total頁數
    if ($page > $totalPages) {
        header('Location:?page=' . $totalPages);
        // header("Location: ?page=$totalPages");(別的寫法)
        exit;
    }
    $sql = sprintf("SELECT * FROM  address_book ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perpage, $perpage);
    //($page - 1) * $perpage totl
    $rowss = $pdo->query($sql);
    $rowss = $rowss->fetchAll();
}
echo 'Location:?page=$totalPages';
//---------------------------------------------------


?>


<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">

                <ul class="pagination">


                    <li class=" d-flex page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link pt-2 " href="?page=1 ">
                            <i class="fa-solid fa-angles-left "></i>
                        </a>
                    </li>



                    <li class="d-flex page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link pt-2" href="?page= <?= $page - 1 ?>">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>

                    <!-- 神奇的頁碼 -->
                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor;
                    ?>


                    <li class="d-flex page-item <?= $page == $totalPages ? 'disabled' : '' ?>">

                        <a class="page-link pt-2" href="?page= <?= $page + 1 ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>

                    <li class="d-flex page-item <?= $page == $totalPages ? 'disabled' : '' ?>">

                        <a class="page-link pt-2" href="?page=<?php echo $totalPages ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>

                    <!-- <?php echo $totalPages ?>=<?= $totalPages ?> -->
                </ul>
            </nav>

        </div>

    </div>



    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                <th scope="col">#</th>
                <th scope="col">NAME</th>
                <th scope="col">cell</th>
                <th scope="col">e-mail</th>
                <th scope="col">bir</th>
                <th scope="col">adress</th>
                <th scope="col">
                    <i class="fa-solid fa-pen-to-square"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rowss as $r) : ?>
                <tr>
                    <td>
                        <a href="#" onclick="trashCanClicked(event); return false;"><i class="fa-solid fa-trash-can">
                                <?php echo $r['sid'] ?>
                            </i></a>
                    </td>
                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['name'] ?></td>
                    <td><?= $r['mobile'] ?></td>
                    <td><?= $r['email'] ?></td>
                    <td><?= $r['birthday'] ?></td>
                    <td><?= $r['address'] ?></td>
                    <td>
                        <a href="#">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</div>

<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    function trashCanClicked(event) {
        // console.log(event.currentTarget);
        // console.log(event.target);
        const a_tag = event.currentTarget;
        const upfound = a_tag.closest('tr');//往上找到tr
        console.log(upfound);
        upfound.remove();
    }
</script>



<?php include __DIR__ . '/parts/html-foot.php' ?>