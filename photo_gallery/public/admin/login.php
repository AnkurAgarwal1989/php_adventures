<?php
/* 
 * Login Page
 */
require_once ('../../includes/functions.php');
require_once ('../../includes/session.php');
require_once ('../../includes/database.php');
require_once ('../../includes/user.php');

//If session is already logged in...redirect to admin index page
if(($session->is_logged_in())){
    redirect_to('index.php');
}

if(isset($_POST['submit'])){
    //If form has been posted with 'submit'
    //perform the operations for validation n such
    
    //Clean the data that comes in
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    //Check database if usename/password combination exists
    $found_user = User::authenticate($username, $password);
    
    //Once authenticated...add to session...redirect to right page
    if($found_user){
        echo "Login Successful";
        $session->login($found_user);
        $message = "Log in successful...";
        redirect_to('index.php');
        
    }
    else{
        $message = "Username/Password combination does not exist";
    }
    
}
//else form was not submitted
else{
    $username = "";
    $password = "";
}
?>
<html>
    <head>
        <title>Photo Gallery Login</title>
        <link href="../stylesheets/main.css" media="all" rel="stylesheet"
              type="text/css" />
    </head>
    
    <body>
        <div id ="header">
            <h1>Photo Gallery Login</h1>
        </div>
        
        <div id ="main">
            <h2>Staff Login</h2>
            <?php if(isset($message)) echo output_message($message); ?>
        
            <form action="login.php" method="post">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type ="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type ="text" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type ="submit" name="submit" value="Login" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        
        <div id ="footer">
            Copyright <?php echo date('Y', time()); ?>, Ankur
        </div>
    </body>
</html>