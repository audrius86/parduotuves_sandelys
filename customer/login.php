<?php
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $errors = [];

    if (empty($email) || empty($password)) {
        $errors['email_password'][] = 'Empty fields in form!';
    }

    $sql = "SELECT password, email FROM customers WHERE email='$email'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

    if($result['email'] === null){
        $errors['email_password'][] = 'Email doesn`t exist!';
    }

        if ($result['password'] != null) {
            if (($result['password'] != $password) ?? null) {
                $errors['password'][] = 'Incorrect password!';
            }
        }


    if (empty($errors)) {
        $_SESSION['email'] = $email;
        header('Location: customer.php?action=home');
    }
}
?>
<h1>Login</h1>
<form action="customer.php?action=login" method="post">
    <?php if (isset($errors['email_password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['email_password']);?></span>
    <?php } ?>
    <br>
    <input type="text" name="email" value="<?php echo $_GET['email'] ?? null ?>">

    <input type="password" name="password">
    <?php if (isset($errors['password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['password']);?></span>
        <br>
    <?php } ?>
    <input type="submit" value="Login">
</form>