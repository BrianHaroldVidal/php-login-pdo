<?php
require 'config.php';
include 'inc/header.php';
include 'lib/user.php';

onsession::userSession();
user::create_page();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="css/bootstrap.css">
     <style type="text/css">
         .wrapper{
             width: 500px;
             margin: 0 auto;
         }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-group<?php echo (!empty($name_err)) ?'has-error': ''?>">
                           <label>Name</label>
                           <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                           <span class="help-block"><?php echo $name_err?></span>
                        </div>
                        <div class="form-group<?php echo (!empty($address_err)) ?'has-error': ''?>">
                           <label>Address</label>
                           <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                           <span class="help-block"><?php echo $name_err?></span>
                        </div>
                        <div class="form-group<?php echo (!empty($salary_err)) ?'has-error': ''?>">
                           <label>Salary</label>
                           <input type="text" name="salary" class="form-control" value="<?php echo $name; ?>">
                           <span class="help-block"><?php echo $salary_err?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="profile.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>