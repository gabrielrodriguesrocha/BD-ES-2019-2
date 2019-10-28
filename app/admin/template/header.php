<h3> <a href="/">Dashboard administrativo</a></h3>
<h5>Bem-vindo, <?php echo $_SESSION['username']; ?></h5>
<form method="post" action="/logout.php" id="formlogout" name="formlogout">
    <input type="submit" value="Logout" />
</form>