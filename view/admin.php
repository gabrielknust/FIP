<!DOCTYPE html>
<html>
<head>
	<title>FIP - Administrador</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<?php
	if(isset($_SESSION['usuario'])){
		session_destroy();	
	}
?>
<script>
	function goBack() {
   		window.location.href = "index.php";
	}
</script>


</head>
<body>
	<div class="contact1">

		<div class="">

			<form class="contact1-form" method="post" action="#">
				<span class="contact1-form-title">
					Para prosseguir insira seu usuário e senha de adminstrador
				</span>

				<div class="wrap-input1 validate-input" data-validate = "Usuário é requerida" >
					<input class="input1" type="text" name="usuario" id="usuario" placeholder="Usuário" required>
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Senha é requerida" >
					<input class="input1" type="password" name="senha" id="senha" placeholder="Senha" required>
					<span class="shadow-input1"></span>
				</div>

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn botao-azul" onclick="goBack()" type="button">
						<span>
							Voltar
							<i class="fa fa-long-arrow-left" aria-hidden="true"></i>
						</span>
					</button>
					<button class="contact1-form-btn" type="button" id="botao">
						<span>
							Continuar
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
	$("#botao").click(function(){
		if($("#usuario").val() == "admin" && $("#senha").val() == "admin" ){
			<?php
			session_start();
			$_SESSION['usu'] = "admin";
			$_SESSION['senha'] = "admin";
			?>
			window.location.href= "index_admin.php";
		}
		else{
			alert("Usuário e senha incorretos");
		}	

	});	
	</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

<!--===============================================================================================-->


</body>
</html>
