<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sending data to database</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <style>
          h1{
              color: purple;
          }
          .containingDIV{
              border: 1px solid #261cec;
              margin-top: 50px;
              border-radius: 15px;
          }
      </style>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10 containingDIV">
                <h1>Introduction:</h1>
                <?php
                //mysqli_connect(host, username, password, dbname)
                $host = 'localhost';
                $username = 'root';
                $Password = '';
                $dbname = 'store';
                $link = new mysqli($host, $username, $Password,$dbname) or die("ERROR: Unable to connect: ").$link->connect_error;
                
                echo "<p>Connected successfully to the server.</p>";
                
                
                
                
                //Error messages
                $missingFirstName = "<p><strong>Please enter your first name</strong></p>";
                $missingLastName = "<p><strong>Please enter your last name</strong></p>";
                $missingEmail = "<p><strong>Please enter your Email</strong></p>";
                $invalidEmail = "<p><strong>Please enter a valid Email</strong></p>";
                $missingPassword = "<p><strong>Please enter your Password</strong></p>";
                $errors = "";
                
                if(isset($_POST["submit"])){
                    //get user inputs
                    $id = $_POST["ID"];
                    $firstName = $_POST["firstname"];
                    $lastName = $_POST["lastname"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    
                    if(!$firstName){
                        $errors .= $missingFirstName;
                    }
                    else{
                        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
                    }
                    
                    if(!$lastName){
                        $errors .= $missingLastName;
                    }
                    else{
                        $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
                    }
                    
                    if(!$email){
                        $errors .= $missingEmail;
                    }
                    else{
                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $errors .= $invalidEmail;
                        }
                    }
                    
                    if(!$password){
                        $errors .= $missingPassword;
                    }
                    
                    if($errors){
                        $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
                        echo $resultMessage;
                    }
                    else{
                        //no errors, prepare variables for the query
                        $tblname = "users";
                        $firstName = mysqli_real_escape_string($link, $firstName);
                        $lastName = mysqli_real_escape_string($link, $lastName);
                        $email = mysqli_real_escape_string($link, $email);
                        $password = mysqli_real_escape_string($link, $password);
                        $password = md5($password); //convert the password into a 32 bit hash data. So the password column must have 32 bit space
                        
                        //execute insert query
                        if(!$id){
                            $sql = "INSERT INTO users(firstname, lastname, email, password) VALUES('$firstName','$lastName','$email','$password')";
                        }
                        else{
                            $sql = "INSERT INTO users(ID,firstname, lastname, email, password) VALUES('$id','$firstName','$lastName','$email','$password')";
                        }
                        
                        if(mysqli_query($link,$sql)){
                            $resultMessage = '<div class="alert alert-success">Data added successfully to the database table</div>';
                            echo $resultMessage;
                        }
                        else{
                            $resultMessage = '<div class="alert alert-warning">ERROR: Unable to execute: '.$sql.'. '.mysqli_error($link).'</div>';
                            echo $resultMessage;
                        }
                    }
                }
                
                ?>
                
                <form action="introduction.php" method="post">
                    <div class="form-group">
                        <label for="ID">ID</label>
                        <input type="number" name="ID" id="ID" placeholder="ID" class="form-control" maxlength="4"> <!--maxlength property to limit the input value-->
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control" maxlength="40">
                    </div>
                    <input type="submit" class="btn btn-success btn-lg" name="submit" value="Send Data">
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>