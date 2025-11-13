
<form method="POST" v-on:submit.prevent="createGasto" >
<div class="modal fade" id="create">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Añadir Inversion</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				
				
			</div>
			<div class="modal-body">				 

				 <label style="font-size: 15px; font-weight: bold; margin-right: 10px;" for="">Articulo: </label>
				 <input v-model="newIdarticulo" list="nombre" name="" type="text"  placeholder="Seleccione articulo" autocomplete="off" style="width: 300px;">
				 <datalist name='categoria' class="" id="nombre" width="300px" >
				 	<option v-for="int in articulos" class="" :value="int.id">@{{int.articulo}}</option>
                                   
                </datalist>
                <div style="width:100%">
                <div class="inputcreate">
				<span>Costo:</span>
                <input  v-model="newCosto" type="text" class="">
                </div>
                <div class="inputcreate">
                <span>Cambio Actual:</span>
				<input  v-model="newTipo" type="text" class="" >
				</div>
				<div class="inputcreate">
				<span>Cantidad:</span>
				<input  v-model="newCantidad" type="text" class=""  placeholder="">	
				</div>
				</div>			
				

				 <span v-for="error in errors" class="text-danger">@{{ error}} </span>
				
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" value="Guardar" name="">
			</div>
		</div>
	</div>
	 
</div>
</form>