<?php
/* 
    Simplogin register example
    
    By Giovanni Kosman
    www.kreativeweb.nl
*/

// Load the class

require '../../simplogin/simplogin.class.php';

$simplogin = new Simplogin();

$message = false;

if (isset($_POST['username']) && isset($_POST['password']))
{
    if ($simplogin->register($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password2']) == true)
    {
        $message = 'Your account is created!';
    }
    else
    {
        $message = 'Something went wrong!';
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
        E-mail:
        <input type="text" name="email">
    </label>
    <br><br>
    
    <label>
        Password:
        <input type="password" name="password">
    </label>
    <br><br>
    
    <label>
        Password confirmation:
        <input type="password" name="password2">
    </label>
    <br><br>
    
    <label>
        <input type="submit" value="Register">
    </label>
</form>