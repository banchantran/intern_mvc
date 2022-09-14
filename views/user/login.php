<?php
require_once('core/configFb.php');

if (isset($_SESSION['access_token'])) {
    header("Location: index.php");
    exit();
}


$redirectTo = "https://paraline.local:80/?controller=user&action=callback";
$data = ['email'];
$fullURL = $handler->getLoginUrl($redirectTo, $data);
?>


<body>

    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3" align="center">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <input type="submit" value="Enter" class="btn btn-primary">
                    <input type="button" onclick="window.location = '<?php echo $fullURL ?>'" value="Login with Facebook" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

</body>

</html>