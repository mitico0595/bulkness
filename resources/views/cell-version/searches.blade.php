@extends ('cell-version.search')
@section ('cont')



      <div class="computacion" style="float: left;margin-left: 2.5%" id="anon">
            
               @include('cell-version.pagination')
                
                
                        
    </div> 
    
         <div class="allforall">
            <div class="suball">
                <div class="subbase">
                <a href="{{url('/')}}"><img class="usuario" src="{{asset('image/svg/hogar.svg')}} "></a>
                <h6 >Home</h6>
                </div>
                <div class="subbase">
                <img class="usuario" src="{{asset('image/svg/barmenu.svg')}} " style="width:25px;">
                <h6>Categorias</h6>
                </div>
                <div class="subbase">
                <a href="{{url('cart-mobile')}} "><img class="usuario" src="{{asset('image/svg/carro.svg')}} "></a>
                <h6>Cart</h6>
                </div>
                <div class="subbase">
                    @if (Auth::check())
                    <a ><img class="usuario" src="{{asset('image/svg/usuariopurple.svg')}} " ></a>
                
                @else
                <a href="{{url('login')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                @endif
                <h6 style="color:black;">Mi cuenta</h6>
                </div >
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script>
            window.addEventListener('load', function(){
            var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            if (isMobile) {
                console.log("Es un mobil");
                document.getElementById("body").style.display= "block";

            }
            else {
                window.location.replace("https://www.oberlu.com/buscando");

            }
            })
        </script>
        <script >
            let page = 1;
            window.onscroll = function (){
        if ((window.innerHeight + window.pageYOffset) >= document.getElementById('anon').offsetHeight){
           page+=1;
          const section = document.getElementById('anon');          
          fetch('articulos/pagination?page='+page,{
           method:'get'
          }).then(function(response){

            return response.text();

          }).then(function (htmlContent){
            section.innerHTML += htmlContent;
            
          }).catch( function (err){
             console.log(err);
          })          
        
        } 
      };
        </script>
        
@endsection 