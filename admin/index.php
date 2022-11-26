<?php include 'inc/header.php'; ?>
<?php include 'inc/navbar.php' ?>
<!-- Form to add category Start-->
<?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') : ?>
    <div id="layoutSidenav">
        <?php include './inc/navside.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="text-center bg-light">
                    <h3 class="p-5">welcome <?= strtoupper($_SESSION['username']) ?> to your dashboard
                    </h3>
                </div>
                <div class="container-fluid">
                    <div class="row row-cols-auto g-4">
                        <div class="col">
                            <div class="card bg-light mb-3 shadow" style="min-width: 18rem; max-width: 24rem;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <i class="fa-solid fa-newspaper" style="font-size: 80px;"></i>
                                    <div class="d-flex flex-column align-items-center">
                                        <!-- count dynamic post -->
                                        <?php
                                        $query = "SELECT COUNT(*) FROM posts";
                                        $stat = $conn->query($query);
                                        $post_count = $stat->fetchColumn();
                                        ?>
                                        <span style="font-size: 50px;"><?= $post_count ?></span>
                                        <p class="p-0 m-0">posts</p>
                                    </div>
                                </div>
                                <a href="posts.php" role="button" class="card-header d-flex justify-content-between align-items-center text-decoration-none text-dark">
                                    <p class="p-0 m-0">View details</p>
                                    <div><i class="fa-solid fa-circle-arrow-right"></i></div>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-dark text-white mb-3 shadow" style="min-width: 18rem; max-width: 24rem;">
                                <div class="card-body d-flex justify-content-between align-items-center" style="border-bottom: 1px solid gray;">
                                    <i class="fa-solid fa-comments" style="font-size: 80px;"></i>
                                    <div class="d-flex flex-column align-items-center">
                                        <!-- count dynamic Comment -->
                                        <?php
                                        $query = "SELECT COUNT(*) FROM comments";
                                        $stat = $conn->query($query);
                                        $comment_count = $stat->fetchColumn();
                                        ?>
                                        <span style="font-size: 50px;"><?= $comment_count ?></span>
                                        <p class="p-0 m-0">Comments</p>
                                    </div>
                                </div>
                                <a href="comments.php" role="button" class="card-header d-flex justify-content-between align-items-center text-decoration-none text-white">
                                    <p class="p-0 m-0">View details</p>
                                    <div><i class="fa-solid fa-circle-arrow-right"></i></div>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-light mb-3 shadow" style="min-width: 18rem; max-width: 24rem;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <i class="fa-solid fa-user-large" style="font-size: 80px;"></i>
                                    <div class="d-flex flex-column align-items-center">
                                        <!-- count dynamic users -->
                                        <?php
                                        $query = "SELECT COUNT(*) FROM users";
                                        $stat = $conn->query($query);
                                        $user_count = $stat->fetchColumn();
                                        ?>
                                        <span style="font-size: 50px;"><?= $user_count ?></span>
                                        <p class="p-0 m-0">Users</p>
                                    </div>
                                </div>
                                <a href="users.php" role="button" class="card-header d-flex justify-content-between align-items-center text-decoration-none text-dark">
                                    <p class="p-0 m-0">View details</p>
                                    <div><i class="fa-solid fa-circle-arrow-right"></i></div>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-dark text-white mb-3 shadow" style="min-width: 18rem;max-width: 24rem;">
                                <div class="card-body d-flex justify-content-between align-items-center" style="border-bottom: 1px solid gray;">
                                    <i class="fa-solid fa-table-list" style="font-size: 80px;"></i>
                                    <div class="d-flex flex-column align-items-center">
                                        <!-- count dynamic users -->
                                        <?php
                                        $query = "SELECT COUNT(*) FROM categories";
                                        $stat = $conn->query($query);
                                        $cetegory_count = $stat->fetchColumn();
                                        ?>
                                        <span style="font-size: 50px;"><?= $cetegory_count ?></span>
                                        <p class="p-0 m-0">Categories</p>
                                    </div>
                                </div>
                                <a href="categories.php" role="button" class="card-header d-flex justify-content-between align-items-center text-decoration-none text-white">
                                    <p class="p-0 m-0">View details</p>
                                    <div><i class="fa-solid fa-circle-arrow-right"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light mb-3 container-fluid p-0 shadow">
                        <div class="card-header">Chart</div>
                        <div class="card-body bg-white p-4 m-0 ">
                            <div class="mt-5">
                                <script type="text/javascript">
                                    google.charts.load('current', {
                                        'packages': ['bar']
                                    });
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                            ['Data', 'Count'],
                                            <?php
                                            $element_text = ['Active Posts', 'Categories', 'Users', 'Comments'];
                                            $element_count = [$post_count, $cetegory_count, $user_count, $comment_count];
                                            for ($i = 0; $i < 4; $i++) {
                                                echo "['$element_text[$i]'" . "," . "$element_count[$i]],";
                                            } ?>
                                        ]);

                                        var options = {
                                            chart: {
                                                title: '',
                                                subtitle: '',
                                            }
                                        };
                                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                                        chart.draw(data, google.charts.Bar.convertOptions(options));
                                    }
                                </script>
                                <div id="columnchart_material" style="width:'fit-content'; height: 500px; margin:'auto';"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php else : ?>
    <?php
    header('Location:../index.php');
    ?>
<?php endif ?>
<?php include 'inc/footer.php'; ?>