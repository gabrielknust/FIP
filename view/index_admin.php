<!DOCTYPE html>
<html>
<title>FIP</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
  session_start();
  if(!isset($_SESSION['ocorrencia'])){
    header('Location: ../control/Control.php?metodo=listarTodos&nomeClasse=OcorrenciaControle&nextPage=../view/index_admin.php');
  }
  if(isset($_SESSION['usuario']) && isset($_SESSION['ocorrencia'])){
    $ocorrencia = $_SESSION['ocorrencia'];
    session_destroy();  
  }
?>
<link
<script type="text/javascript">
  
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
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}

.alta {
  background-color:  rgba(255, 0, 0, 0.5);
}
.mediana {
  background-color:  rgba(255, 255, 0, 0.5);
}
.baixa {
  background-color: rgba(0,128,0,0.5);
}
.resolvida {
  background-color: rgba(192,192,192,0.5);
}
i{
}
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>FIP</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="./index.php" class="w3-bar-item w3-button w3-hover-white">Fazer Ocorrência</a> 
    <a href="ultimasOcorrencias.php" class="w3-bar-item w3-button w3-hover-white">Últimas ocorrências</a> 
    <a href="#" class="w3-bar-item w3-button w3-hover-white">Administrador</a> 

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

    <h1 class="w3-xxxlarge w3-text-red"><b>Bem Vindo, Administrador</b></h1>
  
    <div class="w3-padding w3-white notranslate">
      <table class="table" style="margin-top: 40px;">
      <thead>
        <tr>
          <th>CEP</th>
          <th>Bairro</th>
          <th>Rua</th>
          <th>Referencia</th>
        </tr>
      </thead>
    </table>
  </div>
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
function excluir(endereco,poste,ocorrencia)
{
  window.location.replace("../control/Control.php?metodo=excluir&nomeClasse=OcorrenciaControle&endereco="+endereco+"&poste="+poste+"&ocorrencia="+ocorrencia);
}
function alterar(ocorrencia)
{
  window.location.replace("../control/Control.php?metodo=alterar&nomeClasse=OcorrenciaControle&ocorrencia="+ocorrencia);
}
</script>

<script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<script>
  $(function(){
    var ocorrencia = <?php echo $_SESSION['ocorrencia']; unset($_SESSION['ocorrencia']);   ?>;
    console.log(ocorrencia);
    $.each(ocorrencia,function(i,item){
      $("table").append($("<tbody />").append($("<tr />").attr("class",item.classificaUrgencia).append($("<td />").text(item.cep)).append($("<td />").text(item.bairro)).append($("<td />").text(item.rua)).append($("<td />").text(item.referencia)).append($("<td />").attr("onclick","alterar('"+item.id_ocorrencia+"')").html("<button><i class='fas fa-edit'></i></button>")).append($("<td />").attr("onclick","excluir('"+item.id_endereco+"','"+item.id_poste+"','"+item.id_ocorrencia+"')").html("<button><i class='fas fa-trash-alt'></i></button>"))));
    });
  });
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
