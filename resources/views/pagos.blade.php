<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$detallePago}} </title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

    <br>

    <div class="container">
        <h1 class="text-center">Pago con Visa</h1>
        <hr>
        <h3>Información del pago</h3>
        <b style="padding-left:20px;">Importe a pagar: </b> S/. {{$amount}} <br>
        <b style="padding-left:20px;">Número de pedido: </b> {{$purchaseNumber}} <br>
        <b style="padding-left:20px;">Concepto: </b> {{$detallePago}} <br>
        <b style="padding-left:20px;">Fecha: </b>  <br>
        <hr>
        <!-- <h3>Realiza el pago</h3> -->
        <input type="checkbox" name="ckbTerms" id="ckbTerms" onclick="visaNetEc3()"> <label for="ckbTerms">Acepto los <a href="#" target="_blank">Términos y condiciones</a></label>
        <form id="frmVisaNet" action="http://localhost:8080/finalizar?amount={{$amount}}&purchaseNumber={{$purchaseNumber}}>">
            <script src=" {{Niubiz::VISA_URL_JS}}"
                data-sessiontoken="{{$sesion}}"
                data-channel="web"
                data-merchantid="{{Niubiz::VISA_MERCHANT_ID}}"
                data-merchantlogo="http://localhost:8082/PagoWebPhp/assets/img/logo.png"
                data-purchasenumber="{{$purchaseNumber}} "
                data-amount="{{$amount}}"
                data-expirationminutes="5"
                data-timeouturl="http://localhost:8082/PagoWebPhp/"
            ></script>
        </form>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script>
    var frmVisa = document.getElementById('frmVisaNet');

if (document.body.contains(frmVisa)) {
    document.getElementById('frmVisaNet').setAttribute("style", "display:none");
}
function visaNetEc3() {
    if (document.getElementById('ckbTerms').checked) {
        document.getElementById('frmVisaNet').setAttribute("style", "display:auto");
    } else {
        document.getElementById('frmVisaNet').setAttribute("style", "display:none");
    }
}
</script>
<script>
    $.ajax({
    type: "POST",
    url: {{Niubiz::VISA_URL_SESSION}},
    data: '[{ "name": "John", "location": "Lancaster" }, { "name": "Dave", "location": "Lancaster" }]',
    contentType: "json",
    processData: false,
    success:function(data) {
        console.log('suces'));
    }
});

</script>
</html>
