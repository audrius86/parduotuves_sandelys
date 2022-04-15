<?php

if(isset($_POST['customer_full_name'])){
    $customer_id = $_POST['customer_id'];
    $customer_full_name = $_POST['customer_full_name'];
    $amount_of_money = $_POST['amount_of_money'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $phone = $_POST['phone'];

    $errors = [];

    if(strlen($customer_full_name) < 7) {
        $errors['customer_full_name'][] = 'Your name is too short!';
    }

    if($amount_of_money < 0){
        $errors['amount_of_money'][] = 'Please write positive value';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'][] = 'Wrong email!';
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

        $sql = "SELECT wallet FROM customers WHERE id='$customer_id'";
        $money_in_account = mysqli_fetch_assoc(mysqli_query($connection, $sql));
        $wallet = $money_in_account['wallet'] + $amount_of_money;


        $sql = "UPDATE customers SET fullname='$customer_full_name', email='$email', password='$password', phone='$phone', wallet='$wallet' WHERE id = '$customer_id'";
        mysqli_query($connection, $sql);

        header('Location: customer.php?action=home');
    }
}

?>

<form action="customer.php?action=update_data" method="post">
    <?php
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    ?>

    <input type="number" name="amount_of_money" step="0.01" placeholder="Amount of money">
    <?php if (isset($errors['amount_of_money'])) { ?>
    <span style="color: red"><?php echo implode(',', $errors['amount_of_money']);?></span>
    <?php }?>

    <input type="hidden" name="customer_id" value="<?php echo $result['id'] ?>">
    <input type="text" name="customer_full_name" value="<?php echo $result['fullname'] ?>" placeholder="Customer name" required="required"/> <?php
    if (isset($errors['customer_full_name'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['customer_full_name']);?></span>
        <br>
    <?php } ?>
    <br>
    <input type="email" name="email" value="<?php echo $result['email'] ?>" placeholder="Customer email" required="required"/> <?php
    if (isset($errors['email'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['email']);?></span>
    <?php }?>
    <br>
    <input type="password" name="password" value="<?php echo $result['password'] ?>" placeholder="Enter a password" required="required"/> <?php
    if (isset($errors['password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['password']);?></span>
    <?php }?>
    <br>
    <input type="password" name="repeat_password" value="<?php echo $result['password'] ?>" placeholder="Repeat password" required="required"/> <?php
    if (isset($errors['repeat_password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['repeat_password']);?></span>
    <?php }?>
    <br>
    <input type="text" value="<?php echo $result['phone'] ?>" name="phone" placeholder="61234567" required="required"/> <?php
    if (isset($errors['phone'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['phone']);?></span>
        <br>
    <?php } ?>
    <br>
    <input type="submit" value="Update Data">
</form>