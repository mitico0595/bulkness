<form method="POST" v-on:submit.prevent="createSearch" >
<div class="modal fade" id="create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Add Article</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				
				
			</div>
			<div class="modal-body">
				
				 <label for="name" style="font-size: 20px;font-family:'Zcool' ">Ingrese articulo</label>

				 <input type="text" name="name" class="form-control" v-model="newSearch" autocomplete="off">

				 <label style="font-size: 15px; font-weight: bold; margin-right: 10px;" for="categoria">Categoria: </label><select name="categoria" class="select-css"  v-model="newCat" style="border:none;margin-top: 10px;">
                    <option value="" style="">Seleccione una categoria</option>
                    <option value="Computacion y ensamblaje">Computacion y ensamblaje</option>
                    <option value="Celulares">Celulares</option>
                    <option value="Salud y Belleza">Salud y Belleza</option>
                    <option value="Electronica Smart">Electronica Smart</option>
                    <option value="Casa y electro">Casa y electro</option>
                    <option value="Productos Médicos">Productos Médicos</option>
                </select>
                <div style="width: 40%;float: left;position: relative;">
                <label style="font-size: 15px; font-weight: bold; margin-right: 10px;" for="stock">Stock: </label>
				<input type="text" name="stock" class="form-control" v-model="newStock" style="border:none;width:110px;border:2px solid #808080;" autocomplete="off">
				 </div>
				<div style="width: 30%;float: left;position: relative;">
                	<label style="font-size: 15px; font-weight: bold; margin-right: 10px;" for="costo">Costo: </label>
					<input type="text" name="costo" class="form-control" v-model="newCosto" style="border:none;width:110px;border:2px solid #808080;" autocomplete="off">
				 </div>
				 <div style="width: 20%;float: left;position: relative;">
                	<label style="font-size: 15px; font-weight: bold; margin-right: 10px;" >Codigo: </label>
					<input type="text" class="form-control" v-model="newCodigo" style="border:none;width:110px;border:2px solid #808080;" autocomplete="off">
				 </div>
				 
				 	@include('imageupload')


				 






				 <span v-for="error in errors" class="text-danger">@{{ error}} </span>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" value="Guardar" name="">
			</div>
		</div>
	</div>
</div>
</form>