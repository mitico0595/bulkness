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
				 <label for="item" style="font-size: 15px;font-family:'Kanit'; width: 100%;color:#000;">EDITE NOMBRE</label>
				 <input type="text" name="name" class="form-control addname" v-model="fillSearch.name" autocomplete="off" style="background: none;color:#000;border:none;border-bottom:2px solid #282828;border-radius: 0; ">
                
                <!-- PREVENTA -->
                    
                <label style="font-size: 15px;font-family:'Kanit'; width: 100%;color:#000; ">DIRECCION</label>
                 <input type="text" name="direccion" class="form-control addname" autocomplete="off"  v-model="fillSearch.direccion" style="background: none;color:#000;border:none;border-bottom:2px solid #282828;border-radius: 0; ">

                 <label style="margin-top:40px;font-size: 15px;font-family:'Kanit'; width: 100%;color:#000;border-top: 1px dashed #b10000;padding-top: 10px; ">PREVENTA</label>
                 <div style="position: relative;display:flex;justify-content:center;align-items:center;border-bottom: 1px dashed #b10000;padding-bottom: 30px;">
                <input type="date" name="fecha" class="form-control addname" autocomplete="off"  v-model="fillSearch.fecha" style="width:150px; background: none;color:#000;border:none;border-bottom:2px solid #282828;border-radius: 0; ">
                <div class="contnumbers" style="margin-top: -15px">
                    <label style="" class="numbers">STOCK</label>
                     <input type="number" name="preventa" class="form-control inputnumbers"  v-model="fillSearch.preventa" >
                 </div>
                 
                <input type="checkbox" name="preventab" value="1" class="form-control inputnumbers" autocomplete="off" v-model="fillSearch.preventab" style="position: relative;margin-left:50px" >
                </div>
                
                <!-- END POREVENTA ---->
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

                <input v-model="fillSearch.tienda" list="nom" name="tienda" type="text"  placeholder="Seleccione tienda" autocomplete="off" style="width:100px;border: none;            border-bottom: 2px solid;
                margin-left: 5px;">
				 <datalist name='categoria' class="" id="nom" width="300px" >
				 	<option v-for="tin in tiendas" class="" :value="tin.id">@{{tin.name}}</option>
                </datalist>

                <div style="width: 100%">
                	<div class="contnumbers">
               			<label class="numbers">Codigo: </label>
						<input type="text" name="codigo" class="form-control inputnumbers" v-model="fillSearch.codigo">
				 	</div>
                	<div class="contnumbers">
                		<label class="numbers">Stock: </label>
						<input type="text" name="stock" class="form-control inputnumbers" v-model="fillSearch.stock">
				 	</div>
				 	<div class="contnumbers">
               			<label class="numbers">Costo: </label>
						<input type="text" name="costo" class="form-control inputnumbers" v-model="fillSearch.costo">
				 	</div>
					<div class="contnumbers">
               			<label class="numbers">Precio: </label>
						<input type="text" name="precio" class="form-control inputnumbers" v-model="fillSearch.precio">
				 	</div>
				 	<div class="contnumbers">
               			<label class="numbers">Precio Ant.: </label>
						<input type="text" name="preciof" class="form-control inputnumbers" v-model="fillSearch.preciof">
				 	</div>
				 	<div class="contnumbers" style="width:93%;">
                		<label style="" class="numbers">Descripcion: </label>
	 					<textarea rows="6" cols="50" name="description" class="form-control textnumber" v-model="fillSearch.description" autocomplete="off" style="width: 100%;" ></textarea>
	 				</div>
				 	<div class="contnumbers">
               			<label class="numbers">Autorizar: </label>
						<input type="checkbox" name="soli" class="form-control" v-model="fillSearch.soli"style="position: relative;">

				 	</div>
                    <div class="contnumbers">
               			<label class="numbers">Oferta: </label>
						<input type="checkbox" name="oferta" class="form-control" v-model="fillSearch.oferta"style="position: relative;">

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
