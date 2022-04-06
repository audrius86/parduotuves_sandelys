<?php

if(isset($_POST['product_title'])){
    $category_id = $_POST['category_id'];
    $product_title = $_POST['product_title'];
    $price = $_POST['price'];
    $days_of_validity = $_POST['days_of_validity'];

    $errors = [];

    if(strlen($product_title) < 2) {
        $errors['product_title'][] = 'Product title is too short!';
    }

    $sql = "SELECT * FROM products WHERE product_title = '$product_title'";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result)) {
        $errors['email'][] = 'This product already exist!';
    }

    $sql = "SELECT * FROM products_categories WHERE id = '$category_id'";
    $result = mysqli_query($connection, $sql);
    if(!mysqli_num_rows($result)) {
        $errors['category_id'][] = 'Select product category!';
    }
    if (empty($errors)) {
        $sql = "INSERT INTO products (category_id, product_title, price, days_of_validity) VALUES ('$category_id', '$product_title', '$price', '$days_of_validity')";
        $result = mysqli_query($connection, $sql);
        header('Location: index.php');
    }
}

?>

<form action="index.php?action=create_product" method="post">
<?php
    $sql = "SELECT * FROM products_categories";
    $action = mysqli_query($connection ,$sql);
    echo '<br>';
    echo '<label><b>Select product category</b></label>';
    echo '<br>';
    echo "<select name='category_id'>";
        echo "<option value='-1'>–</option>";
        while ($row = mysqli_fetch_array($action)) {
        echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
        }
        echo "</select>";
    if (isset($errors['category_id'])) { ?>
    <span style="color: red"><?php echo implode(',', $errors['category_id']);?></span>
    <?php
    }
    ?>
    <br>
    <input type="text" name="product_title" placeholder="Product title" required="required"/> <?php
    if (isset($errors['product_title'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['product_title']);?></span>
        <br>
    <?php } ?>
    <input type="number" step="0.01" name="price" placeholder="Product price [9.99]" required="required"/> <br/>
    <input type="number" min="0" step="1" name="days_of_validity" placeholder="Days of validity" required="required"/> <br/>
    <br>
    <input type="submit" value="Save Product">
</form>