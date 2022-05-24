<?php require __DIR__ . '/parts/connect_db.php';
$pagename = 'ab-add';
$title = 'new data'
?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">new data</h5>
                    <!-- ---------------- -->
                    <form name="form1" onsubmit="sendData(); return false" novalidate>
                        <!-- novalidate 不要use html5 的檢查方法 -->

                        <div class="mb-3">
                            <label for="name" class="form-label">*name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" pattern="09\d{8}">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
                            <!-- textarea較大哭間 不要哭行 -->
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>



                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php' ?>

<script>
    async function sendData() {
        //to do 欄位檢查
        const fd = new FormData(document.form1);
        const r = await fetch('ab-add-api.php', {
            method: 'POST',
            body: fd
        });
        const result = await r.json();
        console.log(result);
    }
</script>



<?php include __DIR__ . '/parts/html-foot.php' ?>