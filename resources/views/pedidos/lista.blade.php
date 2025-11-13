@extends('blackboard')
@section('contenido')
<link rel="stylesheet" type="text/css" href="{{asset('css/envio.css')}} ">
<link rel="stylesheet" type="text/css" href="{{asset('css/viewer.css')}} ">

<div class="">
		<div class="contenedor">
		<h1>LUZAPAY</h1>
		<div class="titulo">
			<h1>Registros de Envio</h1>
		</div>
		
		
		</div>
	</div>
	<div class="tabla_envios" id="crudenvio">	

		<div class="detalleSale" style="background:none;" v-for="item in envios" >
            <div style="position: absolute;top: 25px;left: 10px; color: purple;font-family: 'Dosis';"> @{{item.idventa}} </div>
			<div class="fecha"> @{{item.fecha_hora}}</div>	

			<div class="checkenvio">
                
				<div v-if="item.bverifi == 1"> 
					<div class="circle_on"></div>
				</div>
				<!-- circle 2-->
				<div v-if="item.bembale == 1"> 
					<div class="rect_1"></div>
					<div class="circle_on_1"></div>
				</div>
				<div v-if="item.bembale == 0"> 
					<div class="rect_11"></div>
					<div class="circle_on_11"></div>
				</div>
				<!-- circle 3 contra-->
				<div v-if="item.bcontra == 1"> 
					<div class="rect_3"></div>
					<div class="circle_on_3"></div>
				</div>
				<div v-if="item.bcontra == 0 && item.bsend == 0"> 
					<div class="rect_33"></div>
					<div class="circle_on_33"></div>
				</div>
				<!-- circle 3 envio-->
				<div v-if="item.bsend == 1"> 
					<div class="rect3"></div>
					<div class="circle_on3"></div>
				</div>
				<!-- circle 4 entregado-->
				<div v-if="item.bentrega == 1"> 
					<div class="rect4"></div>
					<div class="circle_on4"></div>
				</div>
				<div v-if="item.bentrega == 0"> 
					<div class="rect44"></div>
					<div class="circle_on44"></div>
				</div>

			</div>		
			<div class="seccion">
				<a :href="'/personas/'+item.idpersona "><div class="namedet"><h1>@{{item.name}} @{{item.lastname}}</h1></div></a>
				<div class="eleccion" v-if="item.bcontra == 0 && item.bsend == 0" >
					<h1>No determinado</h1>
				</div>
				<div class="eleccion" v-if="item.bcontra ==1" >
					<h1>Contraentrega en proceso</h1>
				</div>
				<div class="eleccion" v-if="item.bsend ==1" >
					<h1>Seguimiento: @{{item.nseg}}</h1>
				</div>
				<div class="entregado" v-if="item.bentrega == 1" >
					<h1>@{{item.centrega}}</h1>
				</div>
				<div class="entregado" v-if="item.bentrega == 0" >
					<h1>En proceso de entrega</h1>
				</div>
                                <a data-toggle="modal" :data-target="'#applicantModal'+item.idventa" class="observar"><span class="material-icons">visibility</span></a>
			</div>
			
			
			
			<div class="modal fade" :id="'applicantModal'+item.idventa" tabindex="-1" role="dialog" aria-labelledby="applicantModal">
        		<div class="modal-dialog modal-lg" style="">
        			<div class="modal-content">
        					<div class="tope" >
        						<h5>Seguimiento de envios</h5>	
        						<div style="height: 7px;width:50px; border-radius: 15px;background: #930591;position: absolute;top: 50px;left: 35px"></div>
        						<button type="button" class="close closenew" data-dismiss="modal" style="">
										<span>&times;</span>
								</button>
        					</div>
        					<div class="detalle_envio">
        						<div class="partleft">
        							<div class="leftdata">
        								<h5>Fecha de compra:</h5>
        								<h5>Numero de pedido:</h5>
        								<h5>Estado:</h5>
        								<h5>Tiempo Luzapay:</h5>
        								<h5>Entregado en:</h5>
        							</div>
        							<div class="rightdata">
        								<h5>@{{item.fecha_hora}}</h5>
        								<h5>00@{{item.idventa}}</h5>
        								<h5 v-if="item.bverifi == 1 && item.bembale == 0 && item.bcontra == 0 && item.bsend == 0 " style="color:#57b168">En proceso de embale</h5>
        								<h5 style="color:#57b168" v-if="item.bverifi == 1 && item.bembale == 1 && item.bcontra == 0 && item.bsend == 0 ">Embalado, en espera</h5>
        								<h5 style="color:#57b168" v-if="item.bcontra == 1 && item.bsend == 0 && item.bentrega == 0">En proceso de contraentrega</h5>
        								<h5 style="color:#57b168" v-if="item.bcontra == 0 && item.bsend == 1 && item.bentrega == 0">En proceso de envio</h5>
        								<h5 style="color:#57b168" v-if="item.bentrega == 1">Se realizo la entrega</h5>

        								<h5>7 días</h5>
        								<h5 v-if="item.bentrega == 0" style="color:red;">No entregado</h5>
        								<h5 v-if="item.bentrega == 1">@{{ item.clock,item.fentrega | restDate}} horas <span style="color:#57b168">COMPLETADO</span></h5>
        							</div>
        						</div>
        						<div class="partright">
        							<div class="leftdata">
        								<h5>Nombre:</h5>
        								<h5>Modo entrega:</h5>
        								<h5 style="margin-top: 10px; margin-bottom: 10px;">Direccion de entrega:</h5>
        								<h5>Pago:</h5>
        								<h5>Garantia adquirida:</h5>
        							</div>
        							<div class="rightdata">
        								<h5>@{{item.name}} @{{item.lastname}}</h5>
        								<h5 v-if="item.bcontra ==0 && item.bsend ==0" style="color:red;">Por determinar</h5>
        								<h5 v-if="item.bcontra ==1 && item.bsend ==0">Contraentrega</h5>
        								<h5 v-if="item.bcontra ==0 && item.bsend ==1">Envio tercerizado</h5>
        								<h5 v-if="item.detalle == NULL " style="color:red;display: table-cell;vertical-align: middle;height: 30px;">Aún no determinado</h5>
        								<h5 v-if="item.detalle != NULL " style="display: table-cell;vertical-align: middle;height: 30px;" >@{{item.detalle}}</h5>
        								<h5>S/. @{{item.total_venta}} </h5>
        								<h5>6 meses de fabrica</h5>
        							</div>
        						</div>
        					</div>
        					<div class="proceso">
        						<div class="subproceso">
        							<div class="process">
        								<div class="circlesend circpur"></div>
        								<img src="{{asset('image/svg/check.svg')}} ">
        							</div>
        							<div class="process" >
        								<div class="circlesend" v-if="item.bembale == 0 "></div>
        								<div class="rectangulo" v-if="item.bembale == 0 "></div >
        								<div class="circlesend circpur" v-if="item.bembale == 1 " ></div>
        								<div class="rectangulo circpur" v-if="item.bembale == 1 " ></div>
                                                                        <a data-toggle="modal" :data-target="'#img'+item.idventa"><img src="{{asset('image/svg/embalaje.svg')}} " style="cursor: pointer;" class="svgembale"></a>
        								
        							</div>
        							<div class="process">
        								<div class="circlesend" v-if="item.bcontra ==0 && item.bsend ==0" ></div>
        								<div class="rectangulo" v-if="item.bcontra ==0 && item.bsend ==0" ></div>
        								<div class="circlesend circpur" v-if="item.bcontra == 1 || item.bsend == 1"></div>
        								<div class="rectangulo circpur" v-if="item.bcontra == 1 || item.bsend == 1"></div>
                                                                        <a data-toggle="modal" :data-target="'#imgs'+item.idventa"><img src="{{asset('image/svg/delivery.svg')}} " style="cursor: pointer;" class="svgembale"></a>
        								
        							</div>
        							<div class="process">
        								<div class="circlesend" v-if="item.bentrega==0"></div>
        								<div class="rectangulo" v-if="item.bentrega==0"></div>
        								<div class="circlesend circpur" v-if="item.bentrega==1"></div>
        								<div class="rectangulo circpur" v-if="item.bentrega==1"></div>
                                                                        <a data-toggle="modal" :data-target="'#imgen'+item.idventa"><img src="{{asset('image/svg/paquete.svg')}} " style="cursor: pointer;" class="svgembale"></a>
        								
        							</div>
        						</div>
        					</div>
                                                <div style="position: relative;width:100%;display: block;">
        					<div class="fecha_hora" style="position: relative;float: left;">
        						<div class="subfecha_hora">
        						<div class="lane1" style="background: #930591;border-radius: 10px 10px 0px 0px;color: #fff;">
        							<div class="le"><h5 style="margin-top: 5px;">FECHA Y HORA</h5></div>
        							<div class="ri"><h5 style="margin-top: 5px;">DETALLE</h5></div>
        						</div>
        						<div class="lane1">
        							<div class="le"><h5>@{{item.clock | formatDate}}</h5></div>
        							<div class="ri"><h5>Procesado correctamente</h5></div>
        						</div>
        						<div class="lane1">
        							<div class="le" v-if="item.bembale==1 && item.bcontra==0 && item.bsend==0" ><h5>@{{item.fembale | formatDate}}</h5></div>
        							<div class="ri" v-if="item.bembale==1 && item.bcontra==0 && item.bsend==0" ><h5>Embalado</h5></div>
        							<div class="le" v-if="item.bcontra==1 || item.bsend==1" ><h5>@{{item.fembale | formatDate}}</h5></div>
        							<div class="ri" v-if="item.bcontra==1 || item.bsend==1" ><h5>Embalado</h5></div>
        							<div class="le" v-if="item.bembale==0" ><h5>No date</h5></div>
        							<div class="ri" v-if="item.bembale==0" ><h5>En proceso de embale</h5></div>
        							
        						</div>
        						<div class="lane1">
        							<div class="le" v-if="item.bembale==1 && item.bcontra ==1 && item.bsend==0"><h5>@{{item.fcontra | formatDate}}</h5></div>
        							<div class="ri" v-if="item.bembale==1 && item.bcontra ==1 && item.bsend==0"><h5>Contraentrega acordada </h5></div>
                                                                <div class="le" v-if="item.bembale==1 && item.bsend ==1 && item.bcontra==0"><h5>@{{item.fsend | formatDate}}</h5></div>
        						        <div class="ri" v-if="item.bembale==1 && item.bsend ==1 && item.bcontra==0"><h5>Envio determinado</h5></div>
        							<div class="le" v-if="item.bembale==1 && item.bsend ==0 && item.bcontra==0"><h5>No date</h5></div>
                                                                <div class="ri" v-if="item.bembale==1 && item.bsend ==0 && item.bcontra==0"><h5>En proceso de envio</h5></div>
        							    							
        						</div>
                                                        <div class="lane1">
                                                                <div class="le" v-if="item.bentrega==1"><h5>@{{item.fentrega | formatDate}}</h5></div>
                                                                <div class="ri" v-if="item.bentrega==1"><h5>Entrega exitosa</h5></div>
                                                                <div class="le" v-if="item.bentrega==0"><h5>No date</h5></div>
                                                                <div class="ri" v-if="item.bentrega==0"><h5>No entregado</h5></div>
                                                                                                                        
                                                        </div>

        						</div>
        					</div>
                                                <div class="documentos" >
                                                        <h5 style="font-size: 13px;padding: 20px;font-size:'Arial'; ">Verificacion de documentos</h5>
                                                        <div style="display: block;width: 200px;position: relative;margin: auto;">
                                                                
                                                                <a data-toggle="modal" :data-target="'#img'+item.idventa"><img :src="'images/envios/'+item.idventa+'/'+item.cembale" class="cemb"></a>
                                                                <div class="modal fade" :id="'img'+item.idventa" tabindex="1" role="dialog" style="z-index: 999999;">
                                                                        <div class="modal-dialog " style="">
                                                                                <div class="modal-content" >
                                                                                        <div class="tope" >
                                                                                        <h5 style="color:#000;">Documento Embale</h5>  
                                                                                        
                                                                                        <button type="button" class="close" data-dismiss="modal" style="">
                                                                                        <span>&times;</span>
                                                                                        </button>
                                                                                        <img :src="'images/envios/'+item.idventa+'/'+item.cembale" class="cembUp">
                                                                                        </div>
                                                                        
                                                                                </div>
                                                                        </div>
                                                                 </div>
                                                                 <a data-toggle="modal" :data-target="'#imgs'+item.idventa"><img :src="'images/envios/'+item.idventa+'/'+item.csend" class="cemb"></a>
                                                                <div class="modal fade" :id="'imgs'+item.idventa" tabindex="1" role="dialog" style="z-index: 999999;">
                                                                        <div class="modal-dialog " style="">
                                                                                <div class="modal-content">
                                                                                        <div class="tope" >
                                                                                        <h5>Documento Envio</h5>  
                                                                                        
                                                                                        <button type="button" class="close" data-dismiss="modal" style="">
                                                                                        <span>&times;</span>
                                                                                        </button>
                                                                                        <img :src="'images/envios/'+item.idventa+'/'+item.csend" class="cembUp" >
                                                                                        </div>
                                                                        
                                                                                </div>
                                                                        </div>
                                                                 </div>
                                                                 <a data-toggle="modal" :data-target="'#imgen'+item.idventa"><img :src="'images/envios/'+item.idventa+'/'+item.centrega" class="cemb"></a>
                                                                <div class="modal fade" :id="'imgen'+item.idventa" tabindex="1" role="dialog" style="z-index: 999999;">
                                                                        <div class="modal-dialog " style="">
                                                                                <div class="modal-content">
                                                                                        <div class="tope" >
                                                                                        <h5>Documento Recibido</h5>  
                                                                                        <button type="button" class="close" data-dismiss="modal" style="">
                                                                                        <span>&times;</span>
                                                                                        </button>
                                                                                        <img :src="'images/envios/'+item.idventa+'/'+item.centrega" class="cembUp" >
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                 </div>
                                                                

                                                        </div>

                                                </div>
						</div>			
									
        							
        			</div>

                                
				</div>
			</div>

		 	
		<div class="editando">
			<a href=""  v-on:click.prevent="editEnvios(item)" class="edit "><img src="{{asset ('image/svg/editando.svg')}}"></a>
		</div>
                <div class="photo">
                <a :href="'/envios/'+item.idventa+'/edit'" ><img src="{{asset ('image/svg/photo-file.svg')}}"></a>
                </div>
	</div>

@include('editenvio')

</div>



<script src="{{asset('js/app.js')}}"></script>

@endsection


