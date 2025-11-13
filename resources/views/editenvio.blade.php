
<form method="POST" v-on:submit.prevent="updateEnvios(fillEnvio.idventa)" >
<div class="modal fade" id="edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="color:#000;text-transform: uppercase;font-weight: 500;border-bottom:1px solid #fff;" >
				Plataforma de envio 
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				 
				
			</div>
			<div class="modal-body">
				<div style="position: relative;width: 100%;display: inline-block;">
					<h4 style="font-size: 15px;position: relative;float: left;width: 150px;">¿Pago verificado?</h4>
					<input type="checkbox" name="bverifi" v-model="fillEnvio.bverifi" value="" id="bverifi" onchange="comprobar(this)" style="position: relative;float: left;" >
				</div>
				<div class="section1">
				 <label for="item" style="" class="sectionone " style="width: 100%;">Fecha Embale</label>
				 	<div class="sectionbool" style="position: relative;width: 100%;display: inline-block;">
				 	<input type="datetime-local" name="name" class="form-control " v-model="fillEnvio.fembale" autocomplete="off" style="position: relative;width: 210px;float: left;display: inline-block;">
				 	
				 	<input type="checkbox" name="bembale" v-model="fillEnvio.bembale" value="" id="bembale" onchange="compro(this)" style="position: relative;float: left;width: 20px;height: 40px;margin-left: 20px;" >
         			</div>
				</div>
				<div class="section1">
				 <label for="item" style="" class="sectionone " style="width: 100%;">Fecha Contraentrega</label>
				 	<div class="sectionbool" style="position: relative;width: 100%;display: inline-block;">
				 	<input type="datetime-local" name="name" class="form-control " v-model="fillEnvio.fcontra" autocomplete="off" style="position: relative;width: 210px;float: left;display: inline-block;">
				 	
				 	<input type="checkbox" name="bcontra" v-model="fillEnvio.bcontra" value="" id="bcontra" onchange="contra(this)" style="position: relative;float: left;width: 20px;height: 40px;margin-left: 20px;" >
         			</div>
				</div>
				<div class="section1">
				 <label for="item" style="" class="sectionone " style="width: 100%;">Fecha Envio</label>
				 	<div class="sectionbool" style="position: relative;width: 100%;display: inline-block;">
				 	<input type="datetime-local" name="name" class="form-control " v-model="fillEnvio.fsend" autocomplete="off" style="position: relative;width: 210px;float: left;display: inline-block;">
				 	
				 	<input type="checkbox" name="bsend" v-model="fillEnvio.bsend" value="" id="bsend" onchange="send(this)" style="position: relative;float: left;width: 20px;height: 40px;margin-left: 20px;" >
         			</div>
				</div> 
				
				<div class="section1" style="border-radius: 5px; border: 1px solid #cacaca; padding: 20px;">
					<label style="">Numero de seguimiento:</label>
				<input type="text" name="name" class="form-control " v-model="fillEnvio.nseg" autocomplete="off" style="width: 100px; color:#282828;background: none;border:none:border-bottom:1px solid #282828;width: 250px;" >
				</div>
				<div class="section1">
				 <label for="item" style="" class="sectionone " style="width: 100%;">Fecha Entrega</label>
				 	<div class="sectionbool" style="position: relative;width: 100%;display: inline-block;">
				 	<input type="datetime-local" name="name" class="form-control " v-model="fillEnvio.fentrega" autocomplete="off" style="position: relative;width: 210px;float: left;display: inline-block;">
				 	
				 	<input type="checkbox" name="bentrega" v-model="fillEnvio.bentrega" value="" id="bentrega" onchange="entrega(this)" style="position: relative;float: left;width: 20px;height: 40px;margin-left: 20px;" >
         			</div>
				</div> 
				
				 <div class="section1">
				 <label for="item" style="" class="sectionone ">Dirección de entrega</label>
				 <input type="text" name="name" class="form-control " v-model="fillEnvio.domicilio" autocomplete="off" style="width: 100% ">
				 
				</div>
				 <span v-for="error in errors" class="text-danger">@{{ error}} </span>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" value="Actualizar" name="">
			</div>
		</div>
	</div>	
	
</div>
<script type="text/javascript">
	function comprobar(obj)
{   
    if (obj.checked){
      
			document.getElementById('bverifi').value ="1";
    }
        
    else{
     document.getElementById('bverifi').value ="0";
    }
        
}
function compro(obj)
{   
    if (obj.checked){
      
			document.getElementById('bembale').value ="1";
    }
        
    else{
     document.getElementById('bembale').value ="0";
    }
        
}
function contra(obj)
{   
    if (obj.checked){
      
			document.getElementById('bcontra').value ="1";
    }
        
    else{
     document.getElementById('bcontra').value ="0";
    }
        
}
function send(obj){   
    if (obj.checked){     
			document.getElementById('bsend').value ="1";
    }        
    else{
     document.getElementById('bsend').value ="0";
    }        
}
function entrega(obj){   
    if (obj.checked){     
			document.getElementById('bentrega').value ="1";
    }        
    else{
     document.getElementById('bentrega').value ="0";
    }        
}
</script>
</form>