<form method="post" action="">
    <div class="mb-3 mt-3 ">
        <label for="exampleInputEmail1" class="form-label">Edit Category</label>
        <!-- get the category to the input -->
        <?php if (isset($_GET['edit'])) : ?>
            <?php
            $cat_id =  $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $select_cat = mysqli_query($conn, $query);
            $result = mysqli_fetch_all($select_cat, MYSQLI_ASSOC);
            ?>
            <?php foreach ($result as $item) : ?>
                <?php
                $cat_id = $item['cat_id'];
                $cat_title = $item['cat_title'];
                ?>
                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" type="text" name="cat_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php endforeach; ?>
        <?php endif ?>
    </div>
    <!-- get the category to the input -->
    <!-- submit the edit  -->
    <?php
    if (isset($_POST['update_category'])) {
        $cat_title = $_POST['cat_title'];
        $query_update = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $cat_id ";
        $query_update = mysqli_query($conn, $query_update);
        header('Location: categories.php');
        if (!$query_update) {
            die("FIELD" . mysqli_error($conn));
            echo "<div class='alert alert-warning' role='alert'>";
            echo "<h3>";
            echo "This field should not be empty!";
            echo "</h3>";
            echo "</div>";
        }
    }

    ?>
    <button name="update_category" type="submit" class="btn btn-dark">Edit Category</button>
    <!-- submit the edit  -->
</form>