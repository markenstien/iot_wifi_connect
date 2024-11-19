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
    <nav class="navbar navbar-dark bg-dark">
            <!-- Navbar content -->
        <div style="text-align: center; width:100%">
            <h1 class="text-white">W1SEPORTAL</h1>
        </div>
    </nav>
    <div id="main">
        <div class="col-md-6 col-xs-8" id="baseContainer">
            <div class="container-fluid">
                <div class="mt-3"></div>
                    <h4 class="text-center">Update Wifi Password</h4>
                <hr>
                <div class="table-responsive">
                    <?php if(!empty($message)) :?>
                        <p class="text-success"><?php echo $message?></p>
                    <?php endif?>
                    <form method="post">
                        <div style="display: flex;">
                            <div style="flex : 2; margin-right : 10px">
                                <input type="text" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div style="flex : 1">
                                <input type="submit" class="btn btn-sm btn-success" value="Update">
                            </div>
                        </div>
                        <div>
                            <div class="mt-2 mb-2" data-password="<?php echo $password?>" id="showPassword">show password</div>
                            <span id="currentWifiPassword"></span>
                        </div>
                    </form>

                    <h3 id="request_total" style="display: none;">Request Total : </h3>
                </div>
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

     <!-- Button trigger modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">App Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <p class="modal-message"></p>
            </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#currentWifiPassword').hide();
            $('#showPassword').click(function(e) {
                let dataPassword = $(this).attr('data-password');
                $('#currentWifiPassword').html(dataPassword);
                $('#currentWifiPassword').toggle();
            });
        })
    </script>
</body>
</html>