<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="theme/default/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="theme/default/assets/css/custom.css" rel="stylesheet" media="screen">
        <title>Signin!</title>
    </head>
    <body>

        <div class="container">
            <div class="page-header">
                <h1 class="text-center">Postmin</h1>
            </div>
<?php if($auth->authError()) { ?>
            <div class="col-md-6 col-md-offset-3 text-center">
                <div class="alert alert-danger">
                    <p><strong>Failed!</strong> <?php echo $auth->authError(); ?></p>
                </div>
            </div>
<?php } ?>
            <form class="form-signin" action="index.php" method="post">
                <input type="text" class="form-control" name="loginUsername" placeholder="Email address" autofocus>
                <input type="password" class="form-control" name="loginPassword" placeholder="Password">
                <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
            </form>
        </div> <!-- /container -->

        <footer>
            <div class="container">
                <p class="text-center">Powered by <a href="http://www.8bitnet.com/">Postmin</a></p>
            </div>
        </footer>

        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="theme/default/assets/js/bootstrap.min.js"></script>
    </body>
</html>


