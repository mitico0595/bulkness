@extends ('blackboard')
@section ('contenido')

<link rel="stylesheet" href="{{asset ('css/articulo.css')}}" >
<div style="position: relative;width: 100%;display: inline-block;">
<div id="crudart" class="con_articulo" style="width:85%; position: absolute; display: block;box-shadow: 5px 5px 25px #dbdbdb; padding: 50px;box-sizing: border-box;margin: auto;">
	<h1>Adler Emergency</h1>
	<div class="titulo"><h1 class="page-head">Registro de articulos</h1></div>
	<a href="" class="add_ad" style="" data-toggle="modal" data-target="#formarticulo">
		Add item</a>

		<!-- <a href="" class="add_ad" style="" data-toggle="modal" data-target="#create">
		Add item</a>
		ITEM CON VUE ---->

		<input type="text" v-model="name"  class="buscador" placeholder="Buscar" >
		
		<span class="material-icons" style="margin-left: -30px;z-index: 9;position: relative;font-size: 15px;">search</span>
	<div class="subcon_articulo" style="margin-top:50px;">
				
				<div v-for="item in searchSearch" class="grid_articulo" >
					<img :src="'/images/'+item.image" alt="image" / class="imagepub">
					<a :href="'busco/'+item.id" style="text-decoration: none"><h3 class="nombre" style="color:#b1000;">@{{item.name}} </h3></a>
					<div class="categoria">
						<h3 class="">Categoria:  </h3>
						<span> @{{ item.tipo == 1 ? 'Mochila de emergencia' : (item.tipo == 2 ? 'Kit de emergencia' : 'Articulos adicionales') }}</span>
					</div>
					<div class="precioreal">
						
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
					<a href="" class="deleted" v-on:click.prevent="deleteSearches(item)"><span class="material-icons deletedspan">close</span></a>
					<a :href="'out-stock/'+item.id" style="position: absolute;right:0px;bottom:2px;font-size:12px;">Vaciar stock</a>
					
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
                             
                              <label style="margin-top:40px;font-size: 15px;font-family:'Kanit'; width: 100%;color:#000;border-top: 1px dashed #b10000;padding-top: 10px; ">PREVENTA</label>
	 						<div style="position: relative;display:flex;justify-content:center;align-items:center;border-bottom: 1px dashed #b10000;padding-bottom: 30px;">
                            <input type="date" name="fecha" class="form-control addname" autocomplete="off" style="width:150px; background: none;color:#000;border:none;border-bottom:2px solid #282828;border-radius: 0; ">
                            <div class="contnumbers" style="margin-top: -15px">
                                <label style="" class="numbers">STOCK</label>
                                 <input type="text" name="preventa" class="form-control inputnumbers" autocomplete="off" style="" >
                             </div>
                            <input type="checkbox" name="preventab" value="1" class="form-control inputnumbers" autocomplete="off" style="position: relative;margin-left:50px" >
                            </div>   

	 						<label style="font-size: 15px;font-family: 'Kanit'; margin-right: 10px;color:#000;" >CATEGORIA </label>
	 						<select name="tipo" class="select-css"  style="border:none;margin-top:10px; border-radius:0px;padding:5px; background: none; border-bottom: 2px solid #282828;" >
                    			<option value="" style="">Seleccione una categoria</option>
                    			<option value="1">Bag Pack</option>
                    			<option value="2">Kit</option>
                    			<option value="3">Articulos</option>
                    			
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
	 							<label style="font-size: 15px;font-family:'Zcool' " class="archv"  for="filer" id="selector" >Seleccione archivo</label>
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
	<script src="{{asset('js/app.js')}}"></script>
	
	<script type="text/javascript">
		var loader= function(e){
			let file=e.target.files;
			let show = "<span> Selected file: </span> " + file[0].name;
			let output=document.getElementById("selector");
			output.innerHTML =show;
			output.classList.add("active");

			};
		let fileInput = document.getElementById("filer");
		fileInput.addEventListener("change",loader);
	</script>
</div>	
@endsection 