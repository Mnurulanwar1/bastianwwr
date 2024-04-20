<?php
	@ob_start();
	session_start();
	if(isset($_POST['proses'])){
		require 'config.php';
			
		$user = strip_tags($_POST['user']);
		$pass = strip_tags($_POST['pass']);

		$sql = 'select member.*, login.user, login.pass
				from member inner join login on member.id_member = login.id_member
				where user =? and pass = md5(?)';
		$row = $config->prepare($sql);
		$row -> execute(array($user,$pass));
		$jum = $row -> rowCount();
		if($jum > 0){
			$hasil = $row -> fetch();
			$_SESSION['admin'] = $hasil;
			echo '<script>alert("Login Sukses");window.location="index.php"</script>';
		}else{
			echo '<script>alert("Login Gagal");history.go(-1);</script>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - Warroengg</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d1e7dd; /* Light green */
            color: #155724; /* Dark green for text */
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 40px;
        }

        .btn-primary {
            background-color: #4CAF50; /* Green */
            border-color: #4CAF50; /* Green */
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #45a049; /* Darker green */
            border-color: #45a049; /* Darker green */
        }

        .form-control {
            border-radius: 25px;
            padding: 12px 25px;
        }

        .form-control:focus {
            border-color: #4CAF50; /* Green */
            box-shadow: none;
        }

        .btn-block {
            border-radius: 25px;
            padding: 12px 0;
        }
    </style>
</head>

<body class="bg-gradient-success">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="h4 text-gray-900 mb-4"><b>Login admin</b></h4>
                            </div>
                            <form class="form-login" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="user"
                                        placeholder="User ID" autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="pass"
                                        placeholder="Password">
                                </div>
                                <button class="btn btn-primary btn-block" name="proses" type="submit"><i
                                        class="fa fa-lock"></i>
                                    LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
</body>

</html>

