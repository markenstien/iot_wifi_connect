<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <style>
        body{
            padding: 0px;
        }
    </style>
</head>
<body>
    <div style="background-color: #000">
        <img src="public/assets/image/wise_portal.jpg" alt="" style="width: 100%;">
    </div>

    <div style="height: 30px; background-color:#160F29"></div>
    <div id="main">
        <div class="col-md-6 col-xs-8" id="baseContainer">
            <div class="container-fluid">
                <div class="mt-3"></div>
                    <h4 class="text-center">Login</h4>
                <hr>

                <form action="">
                    <div class="form-group">
                        <label for="#">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="#">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="login">
                    </div>
                </form>
            </div>
            <div class="mt-4"></div>
            <div style="background-color: #000; padding:10px; color:#fff">
                <div class="text-center">
                    <p>W1SEPORTAL <?php echo date('Y')?> v.1</p>
                    <!-- <p><a href="/admin-login">Login as Admin</a></p> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>