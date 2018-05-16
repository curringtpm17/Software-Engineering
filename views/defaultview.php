   <div class='col-xs-9' id='content'>
 <?php
        if (!isset($_SESSION['user'])){
?>
         <h3>Welcome to CSD-Transport Planner</h3>
         <h4>Please sign in</h4>
        <form action='index.php?mode=checkLogin' method='post'>
        <table class='table'>
          <tr>
                <td>Username: </td>
        <td><input type='text' name='username' placeholder='Enter username' /></td>
          </tr>
          <tr>
                <td>Password:</td>
                <td><input type='password' placeholder='Enter password' name='pwd' /></td>
           </tr>
        </table>
        <p><button type='submit' class='btn btn-primary' >Sign in </button>
           <button type='reset' class='btn' >Clear</button>
        </p>
        </form>
     </div>
<?php
}  else {
   // valid user. Display default view
?>

<h3 style="font-weight:bold;"> Welcome to the CSD Warhawk on Wheels Transportation Center!</h3>
<img src="views/warhawkvan1.png" alt="warhawk on wheels" width="750" align="middle" style="box-shadow:10px 10px 10px grey"> 
</div>   


<?php
} // end if
?>

