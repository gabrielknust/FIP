<!DOCTYPE html>
<html>
<title>FIP</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
	if(isset($_SESSION['usuario'])){
		session_destroy();	
	}
?>
<script>
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }

    }

    function testaCPF(strCPF) { //strCPF é o cpf que será validado. Ele deve vir em formato string e sem nenhum tipo de pontuação.
            var strCPF = strCPF.replace(/[^\d]+/g,''); // Limpa a string do CPF removendo espaços em branco e caracteres especiais. 
                                                        // PODE SER QUE NÃO ESTEJA LIMPANDO COMPLETAMENTE. FAVOR FAZER O TESTE!!!!
            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000") return false;
            
            for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;
            
            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
            
            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;
            
            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
            return true;
    }

    function validarCPF(strCPF){

    	if (!testaCPF(strCPF)){
    		$('#cpfInvalido').show();
    		document.getElementById("enviar").disabled = true;

    	}else{
    		$('#cpfInvalido').hide();

    		document.getElementById("enviar").disabled = false;
    	}

    }
   </script>
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>FIP</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-hover-white">Fazer Ocorrência</a> 
    <a href="ultimasOcorrencias.php" class="w3-bar-item w3-button w3-hover-white">Últimas ocorrências</a> 
    <a href="admin.php" class="w3-bar-item w3-button w3-hover-white">Administrador</a> 

  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>FIP</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Header -->
  <div class="w3-container" style="margin-top:80px" id="showcase">
    <h1 class=""><b>Gerenciador de falta de iluminação pública</b></h1> <br/>

    <h1 class="w3-xxxlarge w3-text-red"><b>Faça sua ocorrência.</b></h1>
    <hr style="width:50px;border:5px solid #EDE574" class="w3-round">
  </div>
  



			<form class="contact1-form validate-form" action="../control/Control.php" method="POST" enctype="multipart/form-data">

				<h4>Endereço do poste</h4>
				<br/>
				<div class="wrap-input1 validate-input" data-validate = "CEP é necessário">
					<input class="input1" type="text" name="cep" placeholder="CEP" required>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Bairro é necessário">
					<input class="input1" type="text" name="bairro" placeholder="Bairro" required>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Rua é necessário" required>
					<input class="input1" type="text" name="rua" placeholder="Rua" required>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Ponto de referência é necessário">
					<textarea class="input1" name="ponto_de_referencia" placeholder="Ponto de referência" required></textarea>
				</div>
				<h4>Urgência</h4>
				<div class="wrap-input1 validate-input" data-validate = "Urgência é necessário">
					<br/>
					<label>Baixa <input class="input1" style="width: 20px" type="radio" name="classificaUrgencia" value="baixa"> </label>
				</div>
				<div class="wrap-input1 validate-input" data-validate = "Urgência é necessário">

					<label>Média <input class="input1" style="width: 20px" type="radio" name="classificaUrgencia" value="mediana" required> </label>
				</div>
				<div class="wrap-input1 validate-input" data-validate = "Urgência é necessário">

					<label>Alta <input class="input1" style="width: 20px" type="radio" name="classificaUrgencia" value="alta"> </label>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Descrição da urgência é necessário">
					<textarea class="input1" name="descricaoUrgencia" placeholder="Descrição da urgência" required></textarea>
				</div>

				<h4>Outros</h4>

				<br/>
				Numeração do poste (se houver)
				<div style="margin-top: 5px;" class="wrap-input1 validate-input">
					<input class="input1" type="text" name="numeracao" placeholder="Númeração do poste">
				</div>
				
				Foto do poste (opcional)
				<div style="margin-top: 5px;" class="wrap-input1 validate-input">
					<input class="" type="file" name="foto">
				</div>
				<input type="hidden" name="nomeClasse" value="OcorrenciaControle">

				<input type="hidden" name="metodo" value="incluir">
				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn" type="submit">
						<span>
							Enviar ocorrência
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>

			<br/><br/>
  

<!-- End page content -->
</div>

<!-- W3.CSS Container -->

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<script>
	<?php

		if (isset($_GET['msg'])){
		$msg = $_GET['msg'];
	?>
		alert('<?php echo $msg; ?>');
	<?php
		}
	?>
</script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
