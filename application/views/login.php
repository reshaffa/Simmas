<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?=$title?></title>
    <link rel="icon" href="<?=site_url('assets/images/sites/logo.png')?>" sizes="32x32" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=site_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?=site_url()?>assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=site_url()?>assets/libs/css/style.css">
    <link rel="stylesheet" href="<?=site_url()?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {height: 100%;}
    body {display: -ms-flexbox;display: flex;-ms-flex-align: center;align-items: center;padding-top: 40px;padding-bottom: 40px;}
    .logo-img{width:180px;padding-bottom: 20px;}
    </style>
</head>

<body>
    <div class="splash-container">
        <div class="card ">
            <div class="card-body">
                <div class="text-center"><a href="../index.html"><img class="logo-img" src="<?=site_url()?>assets/images/sites/simmas.png" alt="logo"></a></div>
                <form id="form-login" action="javascript:;">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off">
                        <div class="error-username text-danger"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" autocomplete="off">
                        <div class="error-password text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Ingatkan saya</span>
                        </label>
                    </div>
                    <div id="login-alert"></div>
                    <button type="submit" class="btn btn-secondary btn-lg btn-block" id="btn-login">Masuk</button>
                </form>
            </div>
        </div>
    </div>
    <script src="<?=site_url()?>assets/sites/login.js"></script>
    <script src="<?=site_url()?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?=site_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <script type="text/javascript">
        SimmasLogin.baseUrl = "<?=site_url()?>";
        SimmasLogin.init();
    </script>
</body>
</html>