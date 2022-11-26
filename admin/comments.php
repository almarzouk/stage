<?php include 'inc/header.php'; ?>
<?php include 'inc/navbar.php' ?>
<!-- Form to add category Start-->
<div id="layoutSidenav">
    <?php include './inc/navside.php' ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="text-center bg-light">
                <h3 class="p-5">welcome <?= strtoupper($_SESSION['username']) ?> to your dashboard</h3>
            </div>
            <div class="container-fluid px-4">
                <?php
                if (isset($_GET['source'])) {
                    $source = $_GET['source'];
                } else {
                    $source = '';
                }
                switch ($source) {
                    case 'add_post';
                        include './inc/add_post.php';
                        break;
                    case 'edit_post';
                        include './inc/edit_post.php';
                    default:
                        include './inc/view_all_comments.php';
                        break;
                }

                ?>
            </div>
        </main>
    </div>
</div>
<!-- Form to add category End-->
<?php include 'inc/footer.php'; ?>