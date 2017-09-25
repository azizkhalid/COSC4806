<!DOCTYPE html>
<!--
Name: Aziz
course:WDM assignment # 1 
description: creating basic login form that display to the screen results
If the username does't exist in the array will display  warning on the login screen.
-->
<html>
<body>
<h2>Login Form</h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
  
         <?php
            $msg = '';
			$passarray["Aziz"] = "pwd1"; 
			$passarray["John"] = "12345";
			$passarray["user1"] = "54321";
                        
            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])){
				$name = $_POST['username'];
				$pwd = $_POST['password'];
				$found = False;
				foreach($passarray as $x => $x_value) {
					if(($x == $name) && ($x_value == $pwd)) {
						$found = True;
				 }
				}
               if ($found == True){
                  $msg = 'Welcome '.$name;	   
              }else{  
                  $msg = 'Wrong username or password';
                  }
		}		
         ?>      
         <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
              <h4><?php echo $msg; ?></h4>
              <input type = "text" name = "username" placeholder = "username" required autofocus></br>
              <input type = "password" name = "password" placeholder = "password" required><br/>
              <button type = "submit"name = "login">Login</button><br/>
              <button type="reset">Clear</button>
         </form>
</form>
</body>
</html>