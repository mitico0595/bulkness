<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oberlu Admin</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty-mobile.css')}} ">        
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/articulo.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
       <style type="text/css">
           #menum{
    position: absolute;
    height: 35vh;
    display: block;
    width: 320px;
    margin-left: -500px;
    color: #282828;
    transition: .5s;
    background: rgba(256,256,256,0.90);
    top: 60px;
    border-radius: 20px;
    padding: 20px;
}
#menum a{
    width: 100%;
    position: relative;
    display: block;
    padding: 10px;
}
.config h4{
    line-height: 40px;
}
.precioreal{
   top:65px; left:120px;
}
.stock{
    top:65px;
    left: 200px;
}
.codigo{
    left: 120px;
    top:95px;
}
#finder {
    background: none;
    width: 200px;
    margin-left: 60px;
    margin-top: 15px;
    
    
}
#finder:focus{
    background: white;
    width: 100%;
    margin-left: 0px;
    margin-top: 0px;
    padding: 18px;
}
#menum{
    padding-top: 150px;
}
#menum a{
    color: #fff;
    font-size: 20px;
    text-align: center;
}
.cerrar-sesion{
    position: relative;
    float:left;width: 130px;
     padding:5px;font-family:'Dosis';
     font-size: 18px;
     background: none; 
     text-align: center;
     color:#000;
     font-weight: bold;margin:0px;
     border-radius: 20px;border: 2px solid #000; 
}
.numbers{
	position: absolute;
    top: -20px;
}
.inputnumbers{
	width:100px;
	position: relative;
}
.form-control{
	width: 100px;
}
.addname{
	width: 100%;
}
.nombre{
    color: #000;
    font-family: 'Dosis';
    letter-spacing: 0;
    line-height: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-size: 16px;
}
       </style>
    </head>
<body>

	<div class="dashi">
		<div style="position: fixed;background: #fff;height: 60px;width: 100%;z-index: 999;top:0px">
        <div style="position: absolute;width:40px;top:10px ;left:10px;">            
                <svg class="h-6 w-6" stroke="#282828" fill="none" viewBox="0 0 24 24" onclick="force()">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />                                     
                </svg>            
        </div>
        <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 18px;" >Ingresos y solicitudes</div>
        <a href="" class="add_ad" style="background: none;font-size: 25px;color:#282828;line-height: 55px;z-index: 1000;position: fixed;top: 0px;" data-toggle="modal" data-target="#formarticulo" >
        +</a>
        </div>

		<div id="crudart" class="con_articulo" style="width:100%; display: block;padding:0px; box-sizing: border-box; ">
		<input type="text" v-model="name"  class="buscador" placeholder="" style="border-bottom: none;z-index: 1000;text-transform: lowercase;" id="finder" onclick="hid()" onkeyup="javascript:this.value=this.value.toLowerCase();">
			<span class="material-icons" style="z-index: 1001;font-size: 15px;margin-top: 22px;margin-left: -30px;position: absolute;">search</span>

			<div class="subcon_articulo" style="margin-top:50px;width: 98%">
				
				 <div v-for="item in searchSearch" class="grid_articulo" style="height: 140px;">
					<img :src="'/images/'+item.image" alt="image" / class="imagepub" style="width:105px;">
					<a :href="'finde/'+item.id"><h3 class="nombre" >@{{item.name}}</h3></a>
					<div class="categoria">
						<h3 class="">Categoria:  </h3>
						<span>@{{item.categoria}}</span>
					</div>
					<div class="precioreal"style="top:65px; left:120px;">
						
						<span>S/. @{{item.precio}}</span>
					</div>
					<div class="stock">
						
						<span>@{{item.stock}} u.</span>
					</div>
					<!-- <div class="costo">
						<h3 class="">Costo: S/. </h3>
						<span>@{{item.costo}}</span>
					</div>-->
					<h2 class="codigo">@{{item.codigo}}</h2>
					
					<!-- DATA SHOW -->
					<a data-toggle="modal" :data-target="'#applicantModal'+item.id" style="position: absolute;right: 10px; top:40px;font-size: 12px;">Ver</a>
					<div class="modal fade" :id="'applicantModal'+item.id" tabindex="-1" role="dialog" aria-labelledby="applicantModal">
        				<div class="modal-dialog" style="">
        					<div class="modal-content">
        						
        						<button type="button" class="close closenew" data-dismiss="modal" style="">
										<span>&times;</span>
									</button>
        							<div style="width: 100%;">
        								<img :src="'/images/'+item.image" alt="image" / class="imagepub1">
        								<div style="width:100%;position: relative;float:left">
											<h3 class="nombre1" >@{{item.name}}</h3>
											<div class="categoria1">
												<span>@{{item.categoria}}</span>
											</div>
										</div>
									</div>
									
									<div style="width:100%;position: relative;">
										<div class="principal_info">
											<h5 class="stock1">@{{item.stock}}</h5>
											<h5 class="codigo1">@{{item.codigo}}</h5>
											<h5 class="costo1"><span class="subcosto">COSTO</span><span class="simbol">PEN</span>@{{item.costo}}</h5>
											<h5 class="precio1"><span class="subprecio">PRECIO</span><span class="simbol">PEN</span>@{{item.precio}}</h5>
										</div>
										
        							</div>
        							<div style="width:100%;position: relative;">
        								<div class="descripcion">
        									<h2 style="font-size: 15px; margin: 20px 0px 7px; margin-left: 40px;">DESCRIPCION DEL ARTICULO</h2>
        									<div style="width: 60%;height: 1px;background: #dedede;margin-left: 40px;"></div>
        									<h5 class="desc_cont">
        										@{{item.description}}
        									</h5>
        								</div>
        							</div>
        							
        					</div>
						</div>
					</div>



					<a href=""  v-on:click.prevent="editSearch(item)" style="position: absolute;right: 10px;top:20px;font-size: 12px;">Editar</a>
					<a :href="'product-mobile/'+item.id+'/editMobile' "   style="position: absolute;right: 10px;top:80px;font-size: 12px;">Edit photo</a>
				<!-- <a href="" class="deleted" v-on:click.prevent="deleteSearches(item)"><span class="material-icons deletedspan">close</span></a> -->
					
				</div>

			
		

		<nav >
			<ul class="pagination pagination-sm justify-content-center">
				<li v-if="pagination.current_page >1" class="page-item" >
					<a href="" @click.prevent="changePage(pagination.current_page - 1) " class="page-link">
						<span>Atras</span>
					</a>
				</li>
				<li v-for="page in pagesNumber" v-bind:class="[page==isActived ? 'active':'' ] " class="page-item">
					<a href="" @click.prevent="changePage(page)" class="page-link" >
						<span>@{{page}} </span>
					</a>
				</li>
				<li v-if="pagination.current_page < pagination.last_page" class="page-item">
					<a href="" @click.prevent="changePage(pagination.current_page + 1) " class="page-link">
						<span>Siguiente</span>
					</a>
				</li>
			</ul>
		</nav>
		 

		
		 <form  action="{{url('articulo')}} " enctype="multipart/form-data" method="post" >
		 	<div class="modal fade" id="formarticulo">
				<div class="modal-dialog">
					<div class="modal-content" style="background: #fff;">
						<div class="modal-header" style="color:#000;text-transform: uppercase;font-weight: 500;border-bottom:1px solid #fff;">
							Ingrese articulo | Basic Data
							<button type="button" class="close" data-dismiss="modal">
							<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
	 						@csrf
	 						<label style="font-size: 15px;font-family: 'Kanit'; margin-right: 10px;color:#000;" >Seleccione Proveedor</label>
	 						<select name="idpersona" class="select-css"  style="border:none;margin-top:10px; border-radius:0px;padding:5px; background: none; border-bottom: 2px solid #282828;" >
                    			<option value="" style="">Seleccione proveedor</option>
                    			@foreach($personas as $per)
                    			<option value="{{$per->id}}">{{$per->name }} {{$per->lastname }}</option>
                    			@endforeach
                			</select>
	 						<label style="font-size: 15px;font-family:'Kanit'; width: 100%;color:#000; ">NOMBRE ARTICULO</label>
	 						<input type="text" name="name" class="form-control addname" autocomplete="off" style="background: none;color:#000;border:none;border-bottom:2px solid #282828;border-radius: 0; ">


	 						<label style="font-size: 15px;font-family: 'Kanit'; margin-right: 10px;color:#000;" >CATEGORIA </label>
	 						<select name="categoria" class="select-css"  style="border:none;margin-top:10px; border-radius:0px;padding:5px; background: none; border-bottom: 2px solid #282828;" >
                    			<option value="" style="">Seleccione una categoria</option>
                    			<option value="Computacion y ensamblaje">Computacion y ensamblaje</option>
                    			<option value="Celulares">Celulares</option>
                    			<option value="Salud y Belleza">Salud y Belleza</option>
                    			<option value="Electronica Smart">Electronica Smart</option>
                    			<option value="Casa y electro">Casa y electro</option>
                    			<option value="Productos Médicos">Productos Médicos</option>
                    			<option value="Pilas y Baterias">Pilas y Baterias</option>
                			</select>
                			
                			<div style="width:100%;">
                				<div style=" " class="contnumbers">
                					<label style="" class="numbers">CODIGO</label>
	 								<input type="text" name="codigo" class="form-control inputnumbers" autocomplete="off" style="" >
	 							</div>
	 							<div style=" " class="contnumbers">
                					<label style="" class="numbers">STOCK</label>
	 								<input type="text" name="stock" class="form-control inputnumbers" autocomplete="off" style="" >
	 							</div>
                				<div style=" " class="contnumbers">
                					<label style="" class="numbers">COSTO</label>
	 								<input type="text" name="costo" class="form-control inputnumbers" autocomplete="off" style="" >
	 							</div>
	 							<div style=" " class="contnumbers">
                					<label style="" class="numbers">PRECIO</label>
	 								<input type="text" name="precio" class="form-control inputnumbers" autocomplete="off" style="" >
	 							</div>
	 							<div style=" " class="contnumbers">
                					<label style="" class="numbers">PRECIO ANT.</label>
	 								<input type="text" name="preciof" class="form-control inputnumbers" autocomplete="off" style="" >
	 							</div>
	 						</div>
	 						<div class="contnumbers" style="width:93%;">
                					<label style="" class="numbers">DESCRIPCION</label>
	 								<textarea rows="6" cols="50" name="description" class="form-control textnumber" autocomplete="off" style="width: 100%;" ></textarea>
	 						</div>


	 						<div style="width:100%; position: relative; float: right;">
	 							<input type="file" name="image" style="font-size:12px;font-family:'Zcool'" hidden id="filer">
	 							<label style="font-size: 15px;font-family:'Kanit';margin-bottom: 0px;margin-top:5px; " class="archv"  for="filer" id="selector" >Seleccione portada</label>
	 						</div>
                            <div style="width:100%; position: relative; float: right;">
                                <input type="file" name="image1" style="font-size:12px;font-family:'Kanit'" hidden id="filer1">
                                <label style="font-size: 15px;font-family:'Kanit';margin-bottom: 0px;margin-top:5px; " class="archv"  for="filer1" id="selector1" >Foto D1</label>
                            </div>
                            <div style="width:100%; position: relative; float: right;">
                                <input type="file" name="image2" style="font-size:12px;font-family:'Kanit'" hidden id="filer2">
                                <label style="font-size: 15px;font-family:'Kanit';margin-bottom: 0px;margin-top:5px; " class="archv"  for="filer2" id="selector2" >Foto D2</label>
                            </div>
                            <div style="width:100%; position: relative; float: right;">
                                <input type="file" name="image3" style="font-size:12px;font-family:'Kanit'" hidden id="filer3">
                                <label style="font-size: 15px;font-family:'Kanit';margin-top:5px; " class="archv"  for="filer3" id="selector3" >Foto D3</label>
                            </div>
	 						<button type="submit" name="submit" class="btn btn-primary" style="width: 100%;border:none;background: #282828;"> Upload</button>
	 					</div>
	 				</div>
	 			</div>
	 		</div>
	 	</form>
		@include('createart')
		@include('editart')
		</div>
		<div class="" style="float:left; position: relative;">
			<pre>
				
			</pre>
		</div>


			</div>

		</div>

		 <div id="menum" style="position: fixed;top:0px;z-index: 9999999;height: 100vh;background:  linear-gradient(135deg, rgba(19,84,122,1) 0%,rgba(3,150,255,1) 100%);border-radius: 0px;width: 100%;color:white; ">
            <img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" onclick="leftclose()">
            <div id="menu-cont" style="position: absolute;width: 100%;transition: .5s;">
            <div style="position: relative;">
            <a href="{{url('admin-mobile')}} ">Home</a>
            <a onclick="detail_inv()" id="inv" style="font-weight: bold;">Inversion</a>

            <a onclick="detail_ven()">Ventas</a> 
            <a href="{{url('usuario-mobile')}}">Usuarios</a>                        
            <a >Configuracion</a>
            </div>
            </div>
            <div id="menu-sub1" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" href="{{url('compras-mobile')}} ">Compras</a>

            <a style="font-weight: bold;">Productos</a> 
            <a onclick="back1()" style="color:black">Back</a>
            </div>
            </div>
            <div id="menu-sub2" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" href="{{url('venta-mobile')}} ">Ventas</a>

            <a href="{{url('envio-mobile')}}">Envios</a> 
            <a onclick="back2()" style="color:black">Back</a>
            </div>
            </div>
            <div style="position: absolute;bottom:50px;left: 0px;width: 100%;">
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="width: 150px;position: relative;display: block;margin: auto;"> 
                <div style="" class="cerrar-sesion">Cerrar Sesion</div>
            </a>
            </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                        </form>
            
          
    </div>










<script src="{{asset('js/app.js')}}"></script>
	
	<script type="text/javascript">
		var loader= function(e){
			let file=e.target.files;
			let show = "<span> Selected file: </span> " + file[0].name;
            
			let output=document.getElementById("selector");
            
			output.innerHTML =show;
			output.classList.add("active");
			};
        var loader1= function(e){
            let file=e.target.files;
            let show = "<span> Selected file: </span> " + file[0].name;
            
            let output=document.getElementById("selector1");
            
            output.innerHTML =show;
            output.classList.add("active");
            };  
        var loader2= function(e){
            let file=e.target.files;
            let show = "<span> Selected file: </span> " + file[0].name;
            
            let output=document.getElementById("selector2");
            
            output.innerHTML =show;
            output.classList.add("active");
            };  
        var loader3= function(e){
            let file=e.target.files;
            let show = "<span> Selected file: </span> " + file[0].name;
            
            let output=document.getElementById("selector3");
            
            output.innerHTML =show;
            output.classList.add("active");
            };    
		let fileInput = document.getElementById("filer");        
		fileInput.addEventListener("change",loader);
        let fileInput1 = document.getElementById("filer1");        
        fileInput1.addEventListener("change",loader1);
         let fileInput2 = document.getElementById("filer2");        
        fileInput2.addEventListener("change",loader2);
         let fileInput3 = document.getElementById("filer3");        
        fileInput3.addEventListener("change",loader3);
	</script>
	<script type="text/javascript">
    function detail_inv(){
        document.getElementById("menu-cont").style.left = "-500px";
        document.getElementById("menu-sub1").style.right = "0px";
    }
    function back1(){
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub1").style.right = "-500px";
    }
    function detail_ven(){
        document.getElementById("menu-cont").style.left = "-500px";
        document.getElementById("menu-sub2").style.right = "0px";
    }
    function back2(){
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub2").style.right = "-500px";
    }
    function leftclose(){
        document.getElementById("menum").style.marginLeft = "-500px";
        document.getElementById("menu-sub1").style.right = "-1000px";
        document.getElementById("menu-sub2").style.right = "-1000px";
    }
    function force(){              
        document.getElementById("menum").style.marginLeft = "0px";  
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub2").style.right = "-500px";
        document.getElementById("menu-sub1").style.right = "-500px";         
            
    }
</script>

</body>
</html>




