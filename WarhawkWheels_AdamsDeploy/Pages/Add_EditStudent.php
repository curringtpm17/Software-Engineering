<?php ?>
<script language="Javascript">
    
function hideReshall()
{

    document.getElementById("ResHall").style.visibility="hidden";
    document.getElementById("Address").style.visibility="visible";    
}

function hideAddress()
{
    document.getElementById("Address").style.visibility="hidden";
    document.getElementById("ResHall").style.visibility="visible";

}


</script>
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
    Lives on campus?: <input type="radio" name="oncampus" value=0 onClick="hideReshall()" <?php if (isset($_SESSION["formeditOncampus"]) && $_SESSION["formeditOncampus"] == 0) {echo "checked";} ?>> No
    <input type="radio" name="oncampus" value=1 onClick="hideAddress()" <?php if (isset($_SESSION["formeditOncampus"]) && $_SESSION["formeditOncampus"] == 1) {echo "checked";} ?>>Yes 
    <span class="error"><?php if (isset($oncampusErr)) {echo "* " . $oncampusErr;}?></span><br> 
    <div id="ResHall" <?php if (isset($_SESSION["formeditOncampus"]) && $_SESSION["formeditOncampus"] == 0) {echo "style=\"Visibility: Hidden;\"";} ?>>Resident Hall: <select name="reshall">
        <option value=1 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 1) {echo "selected";} ?>>Arey</option>
        <option value=2 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 2) {echo "selected";} ?>>Benson</option>
        <option value=3 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 3) {echo "selected";} ?>>Bigelow</option>
        <option value=4 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 4) {echo "selected";} ?>>Clem</option>
        <option value=5 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 5) {echo "selected";} ?>>Fischer</option>
        <option value=6 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 6) {echo "selected";} ?>>Fricker</option>
        <option value=7 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 7) {echo "selected";} ?>>Knilans</option>
        <option value=8 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 8) {echo "selected";} ?>>Lee</option>
        <option value=9 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 9) {echo "selected";} ?>>Starin</option>
        <option value=10 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 10) {echo "selected";} ?>>Tutt</option>
        <option value=11 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 11) {echo "selected";} ?>>Wellers</option>
        <option value=12 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 12) {echo "selected";} ?>>Wells East</option>
        <option value=13 <?php if (isset($_SESSION["formeditReshall"]) && $_SESSION["formeditReshall"] == 13) {echo "selected";} ?>>Wells West</option>
    </select><br>
    </div>
    <div id="Address" <?php if (isset($_SESSION["formeditOncampus"]) && $_SESSION["formeditOncampus"] == 1) {echo "style=\"Visibility: Hidden;\"";} ?>>Street Address: <input type="text" name="address" <?php if (isset($_SESSION["formeditAddress"])) {echo "value=\"" . $_SESSION["formeditAddress"] . "\"";} ?>>
        <span class="error"><?php if (isset($addressErr)) {echo "* " . $addressErr;}?></span><br></div>
    Can Use Van 3: 
    <input type="radio" name="vanThree" value = 0 <?php if (isset($_SESSION["formeditVanThree"]) && $_SESSION["formeditVanThree"] == 0) {echo "checked";} ?>> No
    <input type="radio" name="vanThree" value = 1 <?php if (isset($_SESSION["formeditVanThree"]) && $_SESSION["formeditVanThree"] == 1) {echo "checked";} ?>>Yes 
    <span class="error"><?php if (isset($vanErr)) {echo "* " . $vanErr;}?></span><br> 
    <center>
    <input type="submit" name="Submit"  value="Submit">
    <input type="submit" name="Cancel" value="Cancel">
    </center>
</form>
