<?php 
    session_start();

    // checks if the  user is login in a device
    if(!isset($_SESSION['username']) || !isset($_SESSION['email'])){
        header("location: ../../../../index.php");
    }
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JulianHub</title>
  <link rel="shortcut icon" type="image/png" href="" /> <!-- fav icon  -->
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">

                <p class="text-center">Register new Administrator account</p>

                <form action="controls/registerNewAdmin.php" method="post">

                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputtext1" aria-describedby="textHelp">
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>

                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  </div>

                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="submit"> Sign up </button>

                  <div class="d-flex align-items-center justify-content-center">
                    <a class="text-primary fw-bold ms-2" href="index.php">Cancel</a>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>