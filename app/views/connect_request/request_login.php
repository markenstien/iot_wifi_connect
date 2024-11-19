<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="col-md-6 col-xs-8" id="baseContainer">
    <dialog data-modal style="font-size: 3rem">
                <button
                    data-close
                    style="font-size: 2rem; position: absolute; top: 0; right: 0"
                >
                    &times;
                </button>
                <div data-content></div>
            </dialog>
            
        <nav class="navbar navbar-dark bg-dark">
                <!-- Navbar content -->
            <div style="text-align: center; width:100%">
                <h1 class="text-white">Wise Portal</h1>
            </div>
        </nav>
        <div class="container">
            <div class="mt-3"></div>
            <h4 class="text-center">Request Connections</h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <th style="width: 20%;">Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </thead>
                    
                    <tbody id="request_connect_list_tbody">

                    </tbody>
                </table>

                <h1 id="request_total" style="display: none;">Request Total : <span></span> </h1>
            </div>
        </div>
        <div class="mt-4"></div>
        <div style="background-color: #000; padding:10px; color:#fff">
            <div class="text-center">
                <p>Wiseportal <?php echo date('Y')?> v.1</p>
                <p><a href="/admin-login">Login as Admin</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>   
    <script type="module" src="public/assets/js/main.js"></script>
</body>
</html>