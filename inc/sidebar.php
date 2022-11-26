        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search (not working)</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Login -->



            <div class="card mb-4">
                <form action="inc/login.php" method="post">
                    <div class="card-header">Login</div>
                    <?php if (isset($_SESSION['user_role'])) : ?>
                        <div class="card-body">
                            <h4>Hello <?= $_SESSION['username'] ?></h4>
                            <a href="inc/logout.php" class="btn btn-primary">Logout</a>
                        </div>
                    <?php else : ?>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control mb-2" type="text" placeholder="Enter username" name="username" />
                            </div>
                            <div class="input-group">
                                <input class="form-control mb-2" type="password" placeholder="Enter your password" name="password" />
                            </div>
                            <button class="btn btn-primary" name="login" type="submit">login</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>



            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <?php
                                $query = "SELECT * FROM categories";
                                $stat = $conn->query($query);
                                $result = $stat->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php foreach ($result as $item) : ?>
                                    <?php
                                    $cat_id = $item['cat_id'];
                                    $cat_title = $item['cat_title'];
                                    ?>
                                    <li><a href="category.php?category=<?= $cat_id ?>"><?= $cat_title ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>