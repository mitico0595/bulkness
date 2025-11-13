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
        img {
            max-width:  200px;
            max-height: 200px;
        }


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
.grid_articulo:hover {
    background: #f2f2f2;
    box-shadow: 1px 1px 4px #dedede;
    border-radius: 0px;
}
        .le{
            position: relative;width: 50%;box-sizing: border-box;float: left;
        }
        .le h5{
            font-size: 15px;
            padding-left: 20px;
        }
        .ri{
            position: relative;width: 50%;box-sizing: border-box;float: right;
        }
        .ri h5{
            font-size: 15px;
            
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
        <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 18px;" >Pendientes envio</div>
        
        </div>

        <div id="crudenvio" class="con_articulo" style="width:100%; display: block;padding:0px; box-sizing: border-box; ">

            <div class="subcon_articulo" style="margin-top:65px;width: 98%">
                
                 <div v-for="item in envios" class="grid_articulo" style="display: inline-block;height: auto;padding:10px;padding-top: 20px;padding-bottom: 25px;">

                    <a :href="'envio-mobile/'+item.idventa+'/editMobile' " style="position: absolute;right: 10px;top: 10px;"><img src="{{asset('image/svg/photo-file.svg')}} " style="width: 30px;"></a>
                    <div style="position: absolute;left: 10px;top:5px; font-size: 11px">@{{item.clock | formatDate}} </div>
                    <div style="position: relative;display: inline-block;float: left;width: 50%;box-sizing: border-box;">
                    <div v-for="items in detalles" style="position: relative;float: left;width: 100%;box-sizing: border-box;">
                       <div v-if="item.idventa == items.idventa" style="position: relative;display: inline-block;height: 60px;width: 100%;box-sizing: border-box;padding: 10px;float: left;">                      
                        <img :src="'/images/'+items.image" alt="image" / class="imagepub" style="width: 25%;position: relative;float: left;display: inline-block;box-sizing: border-box;">
                        <h5 style="position: relative;float: left;width: 70%;box-sizing: border-box;font-size: 12px;letter-spacing: 0;    line-height: 12px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;margin-top: 10px;">@{{items.articulo}}</h5>
                       </div>
                       
                    </div>
                    </div>
                    <div style="position: relative;display: inline-block;float: left;width: 50%;box-sizing: border-box;margin-top: 15px;">
                           <div style="position: relative;width: 100%;display: inline-block;">
                               <h6 style="width: 100%;font-size: 11px;margin:0px;color:#808080">CLIENTE</h6>
                               <h5 style="font-size: 13px;margin:0px;padding-left: 10px;">@{{item.lastname}}, @{{item.name}}</h5>
                           </div>
                           <div style="position: relative;width: 100%;display: inline-block;">
                               <h6 style="width: 100%;font-size: 11px;margin:0px;color:#808080">ESTADO</h6>
                               <h5 style="font-size: 13px;margin:0px;padding-left: 10px;" v-if="item.bverifi == 0 " >Verificando pago</h5>
                               <h5 style="font-size: 13px;margin:0px;padding-left: 10px;" v-if="item.bverifi == 1 && item.bembale == 0 && item.bcontra == 0 && item.bsend == 0 " >En proceso de embale</h5>
                               <h5 style="font-size: 13px;margin:0px;padding-left: 10px;" v-if="item.bembale==1 && item.bcontra==0 && item.bsend==0" >Embalado | Proceso envio</h5>
                               <h5 style="font-size: 13px;margin:0px;padding-left: 10px;" v-if="item.bcontra == 1 && item.bsend == 0 && item.bentrega == 0" >Proceso contraentrega</h5>
                               <h5 style="font-size: 13px;margin:0px;padding-left: 10px; " v-if="item.bcontra == 0 && item.bsend == 1 && item.bentrega == 0" >Proceso de envio</h5>
                               <h5 style="color:#57b168" v-if="item.bentrega == 1">Se realizo la entrega</h5>
                           </div>
                    </div>
                    <div style="position: relative;display: inline-block;width: 100%;height: auto;">
                        <div style="position: relative;display: inline-block;float: left;width: 100%;padding-top: 20px;">
                            <div style="position: relative;display: block;width: 70%;margin: auto;">
                                <a data-toggle="modal" :data-target="'#applicantModal'+item.idventa" class="" style="color: white" ><div style="position: relative;width: 48%;box-sizing: border-box;float: left;text-align: center;font-size: 15px;line-height: 15px;padding: 10px 5px;border-radius: 5px; background: #321E25;color:white">Ver
                                </div></a>  
                                <a href=""  v-on:click.prevent="editEnvios(item)" class=" " style="color:white"><div style="position: relative;width: 48%;box-sizing: border-box;float: right;text-align: center;font-size: 15px;line-height: 15px;padding: 10px 5px;border-radius: 5px; background: #8B4E5E;color:white">
                                    Editar 
                                </div></a>
                            </div>
                            
                        </div>
                        <div></div>

                    </div>
                    <div class="modal fade" :id="'applicantModal'+item.idventa" tabindex="-1" role="dialog" aria-labelledby="applicantModal">
                <div class="modal-dialog modal-lg" style="">
                    <div class="modal-content">
                            <div class="tope" style="position: absolute;top:0px;left: 0px;width: 100%;background: black;height: 50px;" >
                                <h5 style="color:white;line-height: 50px;font-size: 15px;padding-left: 20px;">Seguimiento de envios</h5>  
                                
                                <button type="button" class="close closenew" data-dismiss="modal" style="">
                                        <span>&times;</span>
                                </button>
                            </div>
                            <div style="position: relative;width: 90%;margin-top: 60px;border:1px solid #cecece;margin-left: 5%;">
                                <h4 style="font-size: 17px; padding: 10px; font-weight: bold">Tarjeta de envio</h4>
                                <h5 style="font-size: 15px;margin-left: 15px;">Nombre: @{{item.name}} @{{item.lastname}}</h5>
                                <h5 style="font-size: 15px;margin-left: 15px;">DNI: @{{item.dni}}</h5>
                                <h5 style="font-size: 15px;margin-left: 15px;">Celular: @{{item.celular}} </h5>
                                <h5 style="font-size: 15px;margin-left: 15px;">Domicilio: @{{item.domicilio}}</h5>
                                <h5 style="font-size: 15px;margin-left: 15px;">@{{item.distrito}} - @{{item.provincia}} - @{{item.departamento}}</h5>
                            </div>
                            <div class="detalle_envio" style="margin-top: 60px;">
                                <div class="partleft" style="position: relative;display: block;width: 100%;float: left;">
                                    <div class="leftdata" style="position: relative;font-size: 12px;width: 50%;float: left;box-sizing: border-box;">
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Fecha de compra:</h5>
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Numero de pedido:</h5>
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Estado:</h5>
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Tiempo Luzapay:</h5>
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Entregado en:</h5>
                                    </div>
                                    <div class="rightdata">
                                        <h5 style="font-size: 17px;text-align: left;padding-left: 10px;">@{{item.fecha_hora}}</h5>
                                        <h5 style="font-size: 17px;text-align: left;padding-left: 10px;">00@{{item.idventa}}</h5>
                                        <h5 v-if="item.bverifi == 1 && item.bembale == 0 && item.bcontra == 0 && item.bsend == 0 "  style="font-size: 17px;text-align: left;padding-left: 10px;color:#57b168" >En proceso de embale</h5>
                                        <h5 style="color:#57b168;font-size: 17px;text-align: left;padding-left: 10px;" v-if="item.bverifi == 1 && item.bembale == 1 && item.bcontra == 0 && item.bsend == 0 ">Embalado, en espera</h5>
                                        <h5 style="color:#57b168;font-size: 17px;text-align: left;padding-left: 10px;" v-if="item.bcontra == 1 && item.bsend == 0 && item.bentrega == 0">En proceso de contraentrega</h5>
                                        <h5 style="color:#57b168;font-size: 17px;text-align: left;padding-left: 10px;" v-if="item.bcontra == 0 && item.bsend == 1 && item.bentrega == 0">En proceso de envio</h5>
                                        <h5 style="color:#57b168;font-size: 17px;text-align: left;padding-left: 10px;" v-if="item.bentrega == 1">Se realizo la entrega</h5>

                                        <h5>7 días</h5>
                                        <h5 v-if="item.bentrega == 0" style="color:red;font-size: 17px;text-align: left;padding-left: 10px;">No entregado</h5>
                                        <h5 v-if="item.bentrega == 1" style="font-size: 17px;text-align: left;padding-left: 10px;">@{{ item.clock,item.fentrega | restDate}} horas <span style="color:#57b168">COMPLETADO</span></h5>
                                    </div>
                                </div>
                                <div class="partright">
                                    <div class="leftdata" style="position: relative;font-size: 12px;width: 50%;float: left;box-sizing: border-box;">
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Nombre:</h5>
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Modo entrega:</h5>
                                        <h5 style="margin-top: 10px; margin-bottom: 10px;font-size: 17px;text-align: right;padding-right: 10px;">Direccion de entrega:</h5>
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Pago:</h5>
                                        <h5 style="font-size: 17px;text-align: right;padding-right: 10px;">Garantia adquirida:</h5>
                                    </div>
                                    <div class="rightdata">
                                        <h5 style="font-size: 17px;text-align: left;padding-left: 10px;">@{{item.name}} @{{item.lastname}}</h5>
                                        <h5 v-if="item.bcontra ==0 && item.bsend ==0" style="color:red;font-size: 17px;text-align: left;padding-left: 10px;">Por determinar</h5>
                                        <h5 v-if="item.bcontra ==1 && item.bsend ==0" style="font-size: 17px;text-align: left;padding-left: 10px;">Contraentrega</h5>
                                        <h5 v-if="item.bcontra ==0 && item.bsend ==1" style="font-size: 17px;text-align: left;padding-left: 10px;">Envio tercerizado</h5>
                                        <h5 v-if="item.detalle == NULL " style="color:red;display: table-cell;vertical-align: middle;height: 30px;font-size: 17px;text-align: left;padding-left: 0px;">Aún no determinado</h5>
                                        <h5 v-if="item.detalle != NULL " style="display: table-cell;vertical-align: middle;height: 30px;font-size: 17px;text-align: left;padding-left: 10px;" >@{{item.domicilio}}</h5>
                                        <h5 style="font-size: 17px;text-align: left;padding-left: 10px;">S/. @{{item.total_venta}} </h5>
                                        <h5 style="font-size: 17px;text-align: left;padding-left: 10px;">6 meses de fabrica</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="proceso" style="margin-top: 20px;">
                                <div class="subproceso" style="width: 420px;">
                                    <div class="process" style="background: #e894A7;padding: 5px;position: relative;float: left;width: 80px;">
                                        <div class="circlesend circpur"></div>
                                        <img src="{{asset('image/svg/check.svg')}} " style="width: 50px;position: relative;margin: auto; display: block;">
                                    </div>
                                    <div class="process" style="background: #C06378;padding: 5px;position: relative;float: left;width: 100px;">
                                        
                                                                        <a data-toggle="modal" :data-target="'#img'+item.idventa"><img src="{{asset('image/svg/embalaje.svg')}} " style="cursor: pointer;width: 50px;position: relative;margin: auto; display: block; " class="svgembale"></a>
                                        
                                    </div>
                                    <div class="process" style="background: #8b4e5e;padding: 5px;position: relative;float: left;width: 100px;">
                                        
                                                                        <a data-toggle="modal" :data-target="'#imgs'+item.idventa"><img src="{{asset('image/svg/delivery.svg')}} " style="cursor: pointer;width: 50px;position: relative;margin: auto; display: block;" class="svgembale"></a>
                                        
                                    </div>
                                    <div class="process" style="background: #663845;padding: 5px;position: relative;float: left;width: 100px;">
                                        
                                                                        <a data-toggle="modal" :data-target="'#imgen'+item.idventa"><img src="{{asset('image/svg/paquete.svg')}} " style="cursor: pointer;width: 50px;position: relative;margin: auto; display: block;" class="svgembale"></a>
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="position: relative;width:100%;display: block;margin-top: 20px;">
                            <div class="fecha_hora" style="position: relative;float: left;width: 100%;">
                                <div class="subfecha_hora">
                                <div class="lane1" style="background: #663845;border-radius: 3px 3px 0px 0px;color: #fff;height: 30px;">
                                    <div class="le" style="position: relative;width: 50%;box-sizing: border-box;float: left;"><h5 style="margin-top: 5px;font-size: 15px;font-family: 'Kanit';width: 100%;text-align: center;">FECHA Y HORA</h5></div>
                                    <div class="ri" style="position: relative;width: 50%;box-sizing: border-box;float: right;"><h5 style="margin-top: 5px;font-size: 15px;font-family: 'Kanit';width: 100%;text-align: center;">DETALLE</h5></div>
                                </div>
                                <div class="lane1" style="margin-top: 10px;display: inline-block;width: 100%; ">
                                    <div class="le"><h5>@{{item.clock | formatDate}}</h5></div>
                                    <div class="ri"><h5>Procesado correctamente</h5></div>
                                </div>
                                <div class="lane1" style="display: inline-block;width: 100%; ">
                                    <div class="le" v-if="item.bembale==1 && item.bcontra==0 && item.bsend==0" ><h5>@{{item.fembale | formatDate}}</h5></div>
                                    <div class="ri" v-if="item.bembale==1 && item.bcontra==0 && item.bsend==0" ><h5>Embalado</h5></div>
                                    <div class="le" v-if="item.bcontra==1 || item.bsend==1" ><h5>@{{item.fembale | formatDate}}</h5></div>
                                    <div class="ri" v-if="item.bcontra==1 || item.bsend==1" ><h5>Embalado</h5></div>
                                    <div class="le" v-if="item.bembale==0" ><h5>No date</h5></div>
                                    <div class="ri" v-if="item.bembale==0" ><h5>En proceso de embale</h5></div>
                                    
                                </div>
                                <div class="lane1" style="display: inline-block;width: 100%; ">
                                    <div class="le" v-if="item.bembale==1 && item.bcontra ==1 && item.bsend==0"><h5>@{{item.fcontra | formatDate}}</h5></div>
                                    <div class="ri" v-if="item.bembale==1 && item.bcontra ==1 && item.bsend==0"><h5>Contraentrega acordada </h5></div>
                                                                <div class="le" v-if="item.bembale==1 && item.bsend ==1 && item.bcontra==0"><h5>@{{item.fsend | formatDate}}</h5></div>
                                        <div class="ri" v-if="item.bembale==1 && item.bsend ==1 && item.bcontra==0"><h5>Envio determinado</h5></div>
                                    <div class="le" v-if="item.bembale==1 && item.bsend ==0 && item.bcontra==0"><h5>No date</h5></div>
                                                                <div class="ri" v-if="item.bembale==1 && item.bsend ==0 && item.bcontra==0"><h5>En proceso de envio</h5></div>
                                                                    
                                </div>
                                                        <div class="lane1" style="border-bottom: 5px solid #663845;display: inline-block;width: 100%;">
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
                    <div style="position: absolute;width: 100%;bottom:0px;height: 15px;left: 0px;">
                        <h5 v-if="item.bverifi == 0" style="text-align: left;width: 100%;color:black;font-size: 15px;line-height: 15px;padding:2px 5px;">0%</h5> 
                        <div style="width: 25%;background: #663845;transition: .5s" v-if="item.bverifi == 1 && item.bembale == 0 && item.bcontra == 0 && item.bsend == 0 ">
                            <h5 style="text-align: center;width: 100%;color:white;font-size: 12px;line-height: 15px;">25%</h5>
                        </div>
                        <div style="width: 50%;background: #663845;transition: .5s" v-if="item.bembale==1 && item.bcontra==0 && item.bsend==0">
                            <h5 style="text-align: center;width: 100%;color:white;font-size: 12px;line-height: 15px;">50%</h5>
                        </div>
                        <div style="width: 75%;background: #663845;transition: .5s" v-if="item.bcontra == 1 && item.bsend == 0 && item.bentrega == 0" >
                            <h5 style="text-align: center;width: 100%;color:white;font-size: 12px;line-height: 15px;">75%</h5>
                        </div>
                        <div style="width: 75%;background: #663845;transition: .5s" v-if="item.bcontra == 0 && item.bsend == 1 && item.bentrega == 0" >
                            <h5 style="text-align: center;width: 100%;color:white;font-size: 12px;line-height: 15px;">75%</h5>
                        </div>
                    </div>

                 </div>

            </div>
            
            @include('editenvio')
        </div>         
      
</div>
<div id="menum" style="position: fixed;top:0px;z-index: 9999999;height: 100vh;background:  linear-gradient(135deg, rgba(19,84,122,1) 0%,rgba(3,150,255,1) 100%);border-radius: 0px;width: 100%;color:white; ">
            <img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" onclick="leftclose()">
            <div id="menu-cont" style="position: absolute;width: 100%;transition: .5s;">
            <div style="position: relative;">
            <a href="{{url('admin-mobile')}} ">Home</a>
            <a onclick="detail_inv()" id="inv" >Inversion</a>
            <a onclick="detail_ven()" style="font-weight: bold;">Ventas</a> 
            <a href="{{url('usuario-mobile')}}">Usuarios</a>                        
            <a >Configuracion</a>
            </div>
            </div>
            <div id="menu-sub1" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" href="{{url('compras-mobile')}} ">Compras</a>

            <a href="{{url('product-mobile')}}">Productos</a> 
            <a onclick="back1()" style="color:black">Back</a>
            </div>
            </div>
            <div id="menu-sub2" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a href="{{url('venta-mobile')}}" id="inv" s>Ventas</a>

            <a style="font-weight: bold;" >Envios</a> 
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
    function hid(){
                document.getElementById("soli").style.display = "none";
                document.getElementById("finder").placeholder = "Busque item";
            }
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