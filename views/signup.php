    <?php 
    require_once "../controllers/Authcontroller.php"; 
    
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      handleSignup(); 
    }     
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
    </head>
    <body>
      <form action="" method="post">
        <input type="text" name="username" placeholder="username"> 
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password"> 
        <input type="password" name="confirm_password" placeholder="confirm your password"> 
        <button>Sign up</button>
      </form>
    </body>
    </html>