<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<br>
<form class="left" action="<?php echo htmlspecialchars("index.php"); ?>" method="post">
    <p><span class="error">* All Fields Required.</span></p>
    <?php if (isset($_SESSION["formeditUserId"])){ echo "User Id: " . $_SESSION["formeditUserId"] . "<br>"; }?>
    First Name: <input type="text" name="firstName" <?php if (isset($_SESSION["formeditFirst"])) {echo "value=\"" . $_SESSION["formeditFirst"] . "\"";} ?>>
    <span class="error"> <?php if (isset($firstNameErr)) {echo "* " . $firstNameErr;}?></span><br>
    Last Name: <input type="text" name="lastName" <?php if (isset($_SESSION["formeditLast"])) {echo "value=\"" . $_SESSION["formeditLast"] . "\"";} ?>>
    <span class="error"><?php if (isset($lastNameErr)) {echo "* " . $lastNameErr;}?></span><br>
    UWW Email: <input type="text" name="email" <?php if (isset($_SESSION["formeditEmail"])) {echo "value=\"" . $_SESSION["formeditEmail"] . "\"";} ?>>
    <span class="error"><?php if (isset($emailErr)) {echo "* " . $emailErr;}?></span><br>
    UWW ID Number: <input type="text" name="UWWID" <?php if (isset($_SESSION["formeditUWWID"])) {echo "value=\"" . $_SESSION["formeditUWWID"] . "\"";} ?>>
    <span class="error"><?php if (isset($UWWIDErr)) {echo "* " . $UWWIDErr;}?></span><br>
    Phone Number (XXX-XXX-XXXX): <input type="text" name="phone" <?php if (isset($_SESSION["formeditPhone"])) {echo "value=\"" . $_SESSION["formeditPhone"] . "\"";} ?>>
    <span class="error"><?php if (isset($phoneErr)) {echo "* " . $phoneErr;}?></span><br>
    Access Level: <select name="accessLevel">
        <option value=2 <?php if (isset($_SESSION["formeditAccessLevel"]) && $_SESSION["formeditAccessLevel"] == 2) {echo "selected";} ?>>Staff</option>
        <option value=3 <?php if (isset($_SESSION["formeditAccessLevel"]) && $_SESSION["formeditAccessLevel"] == 3) {echo "selected";} ?>>Coordinator</option>
    </select>
    <br>
    <center>
    <input type="submit" name="Submit" value="Submit">
    <input type="submit" name="Cancel" value="Cancel">
    </center>
</form>