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
            <div class="card text-bg-light m-3 shadow">
                <div class="card-header">Categories</div>
                <div class="card-body px-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- send new cat to db -->
                            <?php
                            insert_categories();
                            ?>
                            <form method="post" action="">
                                <div class="mb-3 mt-3 ">
                                    <label for="exampleInputEmail1" class="form-label">Add Category</label>
                                    <input type="text" name="cat_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <button name="submit" type="submit" class="btn btn-dark">Add Category</button>
                            </form>
                            <!-- Form to update -->
                            <?php
                            if (isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];
                                include './update_cat.php';
                            }
                            ?>
                            <!-- Form to update -->
                        </div>
                        <div class="col-sm-6">
                            <table class="table mt-3 table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php findAllCategories(); ?>
                                    <!-- Delete category -->
                                    <?php deleteCategory(); ?>
                                    <!-- Delete category -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- Form to add category End-->
<?php include 'inc/footer.php'; ?>