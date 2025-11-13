<form method="POST" v-on:submit.prevent="updateSearch(fillSearch.id)" >
<div class="modal fade" id="edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="color:#000;text-transform: uppercase;font-weight: 500;border-bottom:1px solid #fff;" >
				Edite Articulo | Basic Data 
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				 
				
			</div>
			<div class="modal-body">
				 <label for="item" style="font-size: 15px;font-family:'Kanit'; width: 100%;color:#000;">Nombre</label>
				 <input type="text" name="name" class="form-control addname" v-model="fillSearch.name" autocomplete="off" style="background: none;color:#000;border:none;border-radius: 0; " disabled>

				 <label style="font-size: 15px;font-family: 'Kanit'; margin-right: 10px;color:#000;">CATEGORIA: </label>
				 <select name="categoria" class="select-css" v-model="fillSearch.categoria" style="border:none;margin-top:10px; border-radius:0px;padding:5px; background: none; border-bottom: 2px solid #282828;">
                    <option value="" style="">Seleccione una categoria</option>
                    <option value="Computacion y ensamblaje">Computacion y ensamblaje</option>
                    <option value="Celulares">Celulares</option>
                    <option value="Salud y Belleza">Salud y Belleza</option>
                    <option value="Electronica Smart">Electronica Smart</option>
                    <option value="Casa y electro">Casa y electro</option>
                    <option value="Productos Médicos">Productos Médicos</option>
                    <option value="Pilas y Baterias">Pilas y Baterias</option>
                </select>

                <div style="width: 100%">
                	<div class="contnumbers">
               			<label class="numbers">Codigo: </label>
						<input type="text" name="codigo" class="form-control inputnumbers" v-model="fillSearch.codigo" disabled>
				 	</div>
                	<div class="contnumbers">
                		<label class="numbers">Stock: </label>
						<input type="text" name="stock" class="form-control inputnumbers" v-model="fillSearch.stock">
				 	</div>
				 	<div class="contnumbers">
               			<label class="numbers">Precio: </label>
						<input type="text" name="costo" class="form-control inputnumbers" v-model="fillSearch.costo">
				 	</div>
					
				 	
				 	
				 	
				 	
				 </div>

				 <span v-for="error in errors" class="text-danger">@{{ error}} </span>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" value="Actualizar" name="">
			</div>
		</div>
	</div>
</div>
</form>