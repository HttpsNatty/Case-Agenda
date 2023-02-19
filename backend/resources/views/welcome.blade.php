<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>
<body>
<div class="container">
 <form id="login" onsubmit="process(event)">
   <p>Preencha seu número de telefone:</p>
   <input id="phone" type="tel" name="phone" />
   <input type="submit" class="btn" value="Confirmar" />
 </form>
 <!-- ^^  form code  ^^ -->
 <div class="alert alert-info" style="display: none;"></div>
</div>
<script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });
   const info = document.querySelector(".alert-info");
   function getIp(callback) {
 fetch('https://ipinfo.io/json?token=<your token>', { headers: { 'Accept': 'application/json' }})
   .then((resp) => resp.json())
   .catch(() => {
     return {
       country: 'Brasil',
     };
   })
   .then((resp) => callback(resp.country));
   const phoneInput = window.intlTelInput(phoneInputField, {
 initialCountry: "auto",
 geoIpLookup: getIp,
 utilsScript:
   "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
}
function process(event) {
 event.preventDefault();
 const phoneNumber = phoneInput.getNumber();
 info.style.display = "";
 info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
}
</script>

    <h1>Confira seus contatos</h1>
    <div>
        @foreach($contatos as $contato)
        <div>
            <div >
                <div>
                    <h2>{{ $contato->nome }}</h2> <br>
                    <div>{{ $contato->descricao }}</div>
                </div>           
            </div>
        </div>
    @endforeach
</body>
</html>