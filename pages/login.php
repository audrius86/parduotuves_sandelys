<?php
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT r.role FROM roles r join employees e on r.id = e.role_id WHERE e.email='$email'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    if($result) {
        $role = $result['role'];
    }

    $errors = [];

    if (empty($email) || empty($password)) {
        $errors['email_password'][] = 'Empty fields in form!';
    }

    $sql = "SELECT password FROM employees WHERE email='$email'";
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

    if($password != null) {
        if ($result['password'] != $password) {
            $errors['password'][] = 'Incorrect password!';
        }
    }

    if (empty($errors)) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        header('Location: index.php');
    }
}
?>
<h1>Login</h1>
<form action="index.php?action=login" method="post">
    <?php if (isset($errors['email_password'])) { ?>
        <span style="color: red"><?php echo implode(',', $errors['email_password']);?></span>
    <?php } ?>
        <br>
    <input type="text" name="email">

    <input type="password" name="password">
    <?php if (isset($errors['password'])) { ?>
    <span style="color: red"><?php echo implode(',', $errors['password']);?></span>
    <br>
    <?php } ?>
    <input type="submit" value="Login">
</form>