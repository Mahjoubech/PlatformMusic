<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicly - Register</title>
    <link rel="shortcut icon" href="../../public/images/icons/purple-play-button.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/master.css">
    <link rel="stylesheet" href="../../public/css/register.css">
</head>
<body>
   
    <div class="signup">
        <div class="logo">
            <a href=""><img src="../../public/images/icons/purple-play-button.png" alt=""> Musicly</a>
        </div>
        <form action="" method="post">
            <div class="inputItem">
                <label for="fname">User Name</label>
                <input type="text" placeholder="User Name" name="Uname">
            </div> 
            <div class="inputItem">
                <label for="email">Email</label>
                <input type="email" placeholder="email@example.com" name="email">
            </div>
            <div class="inputItem">
                <label for="password">Password</label>
                <input type="password" placeholder="password" name="password">
            </div>
            <div class="inputItem">
                <label for="cpassword">Confirm Password</label>
                <input type="password" placeholder="confirm password" name="cpassword">
            </div>
            <button type="submit">Signup</button>
        </form>
    </div>
</body>
</html>