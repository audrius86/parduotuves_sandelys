<?php

if(isset($_POST['product_category'])){
    $product_category = $_POST['product_category'];

    $errors = [];

    $sql = "SELECT * FROM products_categories WHERE category = '$product_category'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result)) {
        $errors['product_category'][] = 'This product category already exist!';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO products_categories (category) VALUES ('$product_category')";
        $result = mysqli_query($connection, $sql);
        header('Location: index.php');
    }
}

?>

<form action="index.php?action=product_category" method="post">
    <input type="text" name="product_category" placeholder="Category title " required="required"/><br> <?php
    if (isset($errors['product_category'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['product_category']);?></span>
        <?php
    }
    ?><br/>
    <input type="submit" value="Save Product Category">
</form>