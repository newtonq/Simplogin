<?php
/* 
    Simplogin login example
    
    By Giovanni Kosman
    www.kreativeweb.nl
*/

// Load the class

require '../../simplogin/simplogin.class.php';

$simplogin = new Simplogin();

$message = false;

if (isset($_POST['username']) && isset($_POST['password']))
{
    if ($simplogin->login($_POST['username'], $_POST['password']) == true) {
        $message = 'Credentials were valid';
    }
    else
    {
        $message = 'Credentials were invalid';
    }
}
?>

<?php 
    if ($message) {
        echo $message;
    }
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label>
        Username:
        <input type="text" name="username">
    </label>
    <br><br>
    <label>
        Password:
        <input type="password" name="password">
    </label>
    <br><br>
    <label>
        <input type="submit" value="Login">
    </label>
</form>
<strong>Username is 'username' and the password is 'password'</strong>