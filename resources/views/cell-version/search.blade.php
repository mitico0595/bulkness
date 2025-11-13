<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include ('global.icon')

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty-mobile.css')}} ">        
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <style type="text/css">
        .logo{
            position: relative;
            float: left;
            width:20%;
            box-sizing: border-box;
            display: inline-block;

        }
        .logo1{
            position: absolute;
            width:80px;
            top:12px;
        }
    </style>
    </head>
    <body style="display:none;" id="body">
      <div class="top">
          <div class="subtop">
              <div class="logo">
                <a href="javascript: history.go(-1)">
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;"></a>
              </div>
              
                    <div class="subsearch">
                        {{ Form::open(['route' => 'subitem', 'method'=> 'GET' ])}}
                        <div class="input-field">
                            <input type="text" class="" id="searchid" placeholder="Buscar Producto" name="name" value="" autocomplete="off" style="width: 300px;">
                        </div>
                        
                        <!--CREAR INFORMACION en el descuadre----------------------------------------------------------->

                        <div class="button">
                            <button type="submit" class="btn" style="cursor:pointer;">
                                <span class="material-icons" style="color:#b10000;">search</span>
                            </button>
                            
                        </div>
                        
                         
                        {{ Form::close()}}
                    </div>

               
          </div>
        </div>
        
        @yield('cont')
        
        
        <script src="{{asset('js/jquery.min.js')}} "></script>
        <script src="{{asset('js/glider.min.js')}} "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('busca')!!}',
                    success:function(response){
                    //material.css
                    //convert to object
                    var custArray = response;
                    var dataCust ={};
                    var dataCust2 ={};
                    for (var i=0; i< custArray.length;i++){
                        dataCust[custArray[i].name] = null;
                        dataCust2[custArray[i].name] = custArray[i];
                    }
                    $('input#searchid').autocomplete({
                        data: dataCust,
                        onAutocomplete:function(reqdata){
                        }
                    });
                    }
                })
            });
            
            function firstly() {
                document.getElementById("fc").style.opacity= "1";
                document.getElementById("fc").style.left= "60px";
            }
            function firstlyout(){
                
                document.getElementById("fc").style.opacity= "0";
                document.getElementById("fc").style.left= "-260px";
            }
            function secondly() {
                document.getElementById("sc").style.opacity= "1";
                document.getElementById("sc").style.left= "60px";
            }
            function secondlyout(){
                
                document.getElementById("sc").style.opacity= "0";
                document.getElementById("sc").style.left= "-260px";
            }
            function thirdly() {
                document.getElementById("tc").style.opacity= "1";
                document.getElementById("tc").style.left= "60px";
            }
            function thirdlyout(){
                
                document.getElementById("tc").style.opacity= "0";
                document.getElementById("tc").style.left= "-260px";
            }
            function fourthly() {
                document.getElementById("fhc").style.opacity= "1";
                document.getElementById("fhc").style.left= "60px";
            }
            function fourthlyout(){
                
                document.getElementById("fhc").style.opacity= "0";
                document.getElementById("fhc").style.left= "-260px";
            }
            function fifly() {
                document.getElementById("ffc").style.opacity= "1";
                document.getElementById("ffc").style.left= "60px";
            }
            function fiflyout(){
                
                document.getElementById("ffc").style.opacity= "0";
                document.getElementById("ffc").style.left= "-260px";
            }
            function sixly() {
                document.getElementById("sxc").style.opacity= "1";
                document.getElementById("sxc").style.left= "60px";
            }
            function sixlyout(){
                
                document.getElementById("sxc").style.opacity= "0";
                document.getElementById("sxc").style.left= "-260px";
            }
            function sevenly() {
                document.getElementById("svc").style.opacity= "1";
                document.getElementById("svc").style.left= "60px";
            }
            function sevenlyout(){
                
                document.getElementById("svc").style.opacity= "0";
                document.getElementById("svc").style.left= "-260px";
            }

        </script>
        

    </body>
</html>