<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="/favicon.ico" type="image/ico">
    <title><?= $site_title ?></title>

    <script src="scripts.js"></script>

    <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet'>

    <style>
        body {
            font-family: 'Raleway', Arial, sans-serif;
            padding-left: 10%;
            padding-right: 10%;
        }
    </style>

</head>

<body>

    <div class="container p-3 my-3 text-dark">
        <div class="card rounded d-flex flex-row" style=" background-color: #FFeedd;">
            <div class="w-70 mr-5">
                <a href="/index.php"><img src="/GrowToBeMe_LOGO_hp.png" class="img-fluid"></a>
            </div>
        </div>
        <?= $this->renderSection('menu') ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sign In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" name="username" id="usernameFeild">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password" id="passwordFeild">
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary" id="signInButton" data-dismiss="modal">Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <?= $this->renderSection('content') ?>

</body>



</html>