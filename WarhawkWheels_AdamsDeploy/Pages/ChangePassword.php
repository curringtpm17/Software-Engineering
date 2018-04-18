
<br>
<form name="loginForm" action=<?php echo htmlspecialchars("index.php");?> method="post">
    <br>Please Change Your Password:<br><br>
            <label>New Password: </label> <br><input type="password" name="newPassword" value=""><br/>
            <label>Confirm New Password: </label> <br><input type="password" name="confirmNewPassword" value=""><br/>
            <input type="submit" name="Submit" value="Change Password"> <input type="submit" name="Cancel" value="Cancel">
        </form>