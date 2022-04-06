<?php
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    if (empty($email) || empty($password)) {
        $errors[] = 'Yra tusciu lauku';
    }

    $sql = "SELECT password FROM users WHERE email='$email'";
    $result = mysqli_fetch_assoc(mysqli_query($database, $sql));

    if ($result['password'] != $password) {
        $errors[] = 'Slaptazodziai nesutampa';
    }

    if (empty($errors)) {
        $_SESSION['email'] = $email;
        header('Location: index.php');
    }
}
?>
<h1>Login</h1>
<form action="index.php?action=login" method="post">
    <table>
        <tr>
            <td>
                Paštas:
            </td>
            <td>
                <input type="text" name="email" value="<?php echo $_GET['email'] ?? null ?>">
            </td>
        </tr>
        <tr>
            <td>
                Slaptažodis:
            </td>
            <td>
                <input type="password" name="password">
            </td>
        </tr>
    </table>
    <br/><br/>
    <button type="submit">Prisijungti</button>
</form>