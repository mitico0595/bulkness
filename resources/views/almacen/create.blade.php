{!!Form::open(array('url'=>'tiendas','method'=>'POST','autocomplete'=>'off','id'=>'create','class'=>'modal fade'))!!}
			{{Form::token()}}


        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Añadir Inversion</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>


                </div>
                <div class="modal-body">

                     <label style="font-size: 15px; font-weight: bold; margin-right: 10px;" for="">Tienda: </label>
                    <div style="width:100%">
                        <div class="inputcreate" style="width: 100%">
                            <span style="width: 80%;font-size:25px">Nombre de la tienda:</span>
                            <input name="name" id="name" type="text" class="" style="width: 80%;font-size:25px;margin-top:25px;">
                        </div>

                    </div>


                     <span v-for="error in errors" class="text-danger">@{{ error}} </span>

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar" name="">
                </div>
            </div>
        </div>
{!!Form::close()!!}
