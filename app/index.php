<?php

session_start();

function MyAutoload($className) {
    $extension =  spl_autoload_extensions();
    require_once ('class/' . $className . $extension);
}

spl_autoload_extensions('.class.php'); // quais extensões iremos considerar
spl_autoload_register('MyAutoload');

$conn = Connection::getInstance();

$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    $username = isset($_POST['username']) ? addslashes(trim($_POST['username'])) : FALSE;
    $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;

    if (!$username || !$password) { // Empty username or password
        $loginError = 'É necessário fornecer usuário e senha';
    }
    else {
        $pHash = hash('sha256', $password);
        $record = Connection::attemptLogin($username, $pHash);
        if (!$record ||
            !($record['username'] === $username) ||
            !($record['password'] === $pHash)) { // Wrong user or pass
            $loginError = 'Usuário ou senha incorretos';
        }
        else {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $pHash;
            $_SESSION['employee'] = $record['employee'];
            if ($_SESSION['employee'])
                header('location:admin/');
            else
                header('location:user.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body style="height: 100vh; margin: 0">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" id="formlogin" name="formlogin" style="height: 100%; display: flex; align-items: center; justify-content: center;">
    <fieldset id="fie">
        <legend>Login</legend><br />
        <label>Usuário: </label>
        <input type="text" name="username" id="username"/><br/>
        <label>Senha:</label>
        <input type="password" name="password" id="password"/><br/>
        <input type="submit" value="Login" />
        <div style="color: red"><?php echo $loginError; ?></div>
    </fieldset>
    </form>
    <?php echo $_SESSION['username'];?>
    <?php echo $_SESSION['password'];?>
</body>
</html>