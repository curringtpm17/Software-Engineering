<?php ?>
<form name="loginForm" action=<?php echo htmlspecialchars("index.php"); ?> method="post">
    <br>
    <label>Username:</label> <input type="text" name="username" value="test"><br/>
    <label>Password:</label> <input type="password" name="password" value="test" /><br/>
    <?php
    if (isset($loginError)) {
        echo "<span class=\"error\">".$loginError . "</span><br>";
    }
    ?>
    <input class="green" type="submit" Value="Login"/>
</form>
