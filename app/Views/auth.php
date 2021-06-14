<?php
    $session = \Config\Services::session();
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/maarif.ico">
    <title>Auth | Sistem Pengelolaan Kas PKK Griya Bangkalan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body style="background: url('/assets/img/pexels-julius-silver-753626.jpg') no-repeat center;overflow: hidden">
<?php
    if ($session->has('error')):
?>
    <div class="fixed-top mt-sm-2 mr-sm-2 alert-toast">
        <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
            <div class="toast fade show" data-autohide="false" style="position: absolute; top: 0; right: 0;">
                <div class="toast-header">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-circle-fill text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                    <strong class="mr-auto ml-2 text-danger">Alert</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="toast-body">
                    <?= $session->getFlashdata('error') ?>
                </div>
            </div>
        </div>
    </div>
<?php
    endif;
?>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative shadow">
            <div class="auth-box row justify-content-center shadow-none">
                <div class="col-lg-7 col-md-7 bg-white rounded shadow-lg">
                    <div class="p-3 py-sm-5">
                        <div class="text-center">
                            <img src="/assets/img/icon.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <h5 class="mt-3 text-center">Sistem Pengelolaan Kas PKK Griya Bangkalan</h5>
                        <form class="mt-4" action="/auth" method="post">
                            <div class="row mx-3">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="floatingInput" name="username" placeholder="masukkan username anda" value="<?= old('username') ?>">
                                        <label for="floatingInput">Username</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" name="password" id="floatingPassword" placeholder="Password" value="<?= old('password') ?>">
                                        <label for="floatingPassword">Password</label>
                                        <div class="invalid-feedback">
                                          <?= $validation->getError('password') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center mt-3">
                                    <button type="submit" class="btn btn-block btn-dark">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="/libs/bootstrap/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        setTimeout(function(){
            $('.alert-toast').fadeOut()
        }, 8000);
        $(".preloader ").fadeOut();
    </script>
</body>

</html>