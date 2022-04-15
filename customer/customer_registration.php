<?php

if(isset($_POST['customer_full_name'])){
    $customer_full_name = $_POST['customer_full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $phone = $_POST['phone'];

    $errors = [];

    if(strlen($customer_full_name) < 7) {
        $errors['customer_full_name'][] = 'Your name is too short!';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'][] = 'Wrong email!';
    }

    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result)) {
        $errors['email'][] = 'This email already exist!';
    }

    if (strlen($password) < 6) {
        $errors['password'][] = 'Password should be longer than 5 symbols';
    }

    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors['password'][] = 'Password must contain at least 1 letter and 1 number';
    }

    if ($email == $password) {
        $errors['password'][] = 'Password and email can`t match!';
    }

    if ($password != $repeat_password) {
        $errors['repeat_password'][] = 'Passwords don`t match';
    }

    if (!(strlen($phone) == 12)) {
        $errors['phone'][] = 'Wrong number';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO customers (fullname, email, password, phone) VALUES ('$customer_full_name', '$email', '$password', '$phone')";
        $result = mysqli_query($connection, $sql);

        header('Location: customer.php?action=login&email=' . $email);
    }
}

?>

<form action="customer.php?action=customer_registration" method="post">
    <input type="text" name="customer_full_name" placeholder="Customer name" required="required"/> <?php
    if (isset($errors['customer_full_name'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['customer_full_name']);?></span>
        <br>
    <?php } ?>
    <br>
    <input type="email" name="email" placeholder="Customer email" required="required"/> <?php
    if (isset($errors['email'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['email']);?></span>
    <?php }?>
    <br>
    <input type="password" name="password" value="" placeholder="Enter a password" required="required"/> <?php
    if (isset($errors['password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['password']);?></span>
    <?php }?>
    <br>
    <input type="password" name="repeat_password" placeholder="Repeat password" required="required"/> <?php
    if (isset($errors['repeat_password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['repeat_password']);?></span>
    <?php }?>
    <br>
    <input type="text" value="+370" name="phone" placeholder="61234567" required="required"/> <?php
    if (isset($errors['phone'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['phone']);?></span>
        <br>
    <?php } ?>
    <br>
    <input type="submit" value="Register Customer">
</form>