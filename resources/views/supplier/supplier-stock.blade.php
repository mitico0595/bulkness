@extends ('layouts.supplier-app')
@section ('usuario')

    <link rel="stylesheet" href="{{asset('css/sty.css')}} ">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset ('css/articulo.css')}}" >
<style type="text/css">
    *{
        margin: 0;
        padding:0;
    }
.logo{
            position: relative;
            float: left;
            width:20%;
            box-sizing: border-box;
            display: inline-block;
        }
        .logo1{
            position: absolute;
            width:80px;
            top:12px;
        }
        body{ 
      background: #ededed;
        }
        .search{
            margin-left: 150px;
        }.button{
            line-height: 42px;
        }
        .input-field{
            top:22px;
        }
        a{
            text-decoration: none;
        }
        .dashi{
        	padding-top:200px;
        	padding-left: 100px;
        }
        
</style>

<div class="dashi">
    <div style="position: relative;width:85%;display: block;margin:auto;background: white;box-shadow: 5px 5px 25px #dbdbdb;">

       

<div id="supplier" class="con_articulo" style="width:100%; display: block;padding:40px; box-sizing: border-box; ">
    
    <div class="titulo"><h1 class="page-head">Stock y solicitud</h1></div>
    <a href="" class="add_ad" style="" data-toggle="modal" data-target="#formarticulo">
        Solicitar +</a>

        <!-- <a href="" class="add_ad" style="" data-toggle="modal" data-target="#create">
        Add item</a>
        ITEM CON VUE ---->

        <input type="text" v-model="name"  class="buscador" placeholder="Buscar" >
        
        <span class="material-icons" style="margin-left: -30px;z-index: 9;position: relative;font-size: 15px;">search</span>
    <div class="subcon_articulo" style="margin-top:50px;">
                
                <div v-for="item in searchSearch" class="grid_articulo" v-if="item.soli == 0" style="border-left: 2px solid red">
                    <img :src="'/images/'+item.image" alt="image" / class="imagepub">
                    <h3 class="nombre" >@{{item.name}}</h3>
                    <div class="categoria">
                        <h3 class="">Categoria:  </h3>
                        <span>@{{item.categoria}}</span>
                    </div>
                    <div class="precioreal">                        
                        <span>S/. @{{item.costo}}</span>
                    </div>
                    <div class="stock">
                        
                        <span>@{{item.stock}} u.</span>
                    </div>
                    <!-- <div class="costo">
                        <h3 class="">Costo: S/. </h3>
                        <span>@{{item.costo}}</span>
                    </div>-->
                    <h2 class="codigo" v-if="item.codigo == NULL" style="color: rgb(128, 128, 128);font-size: 13px;    font-weight: 100; width: 100px; text-align: center;">Solicitud en proceso</h2>
                    <h2 class="codigo" v-if="item.codigo != NULL">@{{item.codigo}} </h2>
                    <!-- DATA SHOW 
                    <a data-toggle="modal" :data-target="'#applicantModal'+item.id" > </a>-->
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



                    <a href=""  v-on:click.prevent="editSearch(item)" style="color:#000;position: absolute;top:10px;right: 10px">Editar</a>
                    
                    <div style="position: absolute;top:0px;right: 10px;">
                            <div style="position: relative;display: block;width: 20px;cursor: pointer;width: 15px;height: 80px;" :onmouseover ="'getElementById(cont'+item.id ">

                                <div style="position: absolute;width:3px;height: 3px;background: #cecece;top:10px;right: 0px; border-radius: 5px;"></div>
                                <div style="position: absolute;width:3px;height: 3px;background: #cecece;top:18px;right: 0px; border-radius: 5px;"></div>
                                <div style="position: absolute;width:3px;height: 3px;background: #cecece;top:26px;right: 0px; border-radius: 5px;"></div>
                                <div style="border-radius: 4px;box-shadow: 0 0.1875em 0.25em 0 rgba(0,0,0,.1), 0 0 0.0625em 0 rgba(0,0,0,.25); min-width: 100px; width: max-content;position: absolute;right: 0;top: 40px;background: #fff;display: none;" :id="'cont'+item.id" >
                                    <a href="" style="padding: 5px 10px; font-family: 'Kanit'; font-size: 15px;width: 100%;position: relative;display: block;" class="ahover">Ver</a>
                                    <a href="" style="padding: 5px 10px; font-family: 'Kanit'; font-size: 15px;width: 100%;position: relative;display: block;" class="ahover">Editar</a>
                                </div>

                            </div>
                       </div>
                </div>
                <div v-for="item in searchSearch" class="grid_articulo" v-if="item.soli == 1">
                    <img :src="'/images/'+item.image" alt="image" / class="imagepub">
                    <h3 class="nombre" >@{{item.name}}</h3>
                    <div class="categoria">
                        <h3 class="">Categoria:  </h3>
                        <span>@{{item.categoria}}</span>
                    </div>
                    <div class="precioreal">                        
                        <span>S/. @{{item.costo}}</span>
                    </div>
                    <div class="stock">
                        
                        <span>@{{item.stock}} u.</span>
                    </div>
                    <!-- <div class="costo">
                        <h3 class="">Costo: S/. </h3>
                        <span>@{{item.costo}}</span>
                    </div>-->
                    <h2 class="codigo" v-if="item.codigo == NULL" style="color: rgb(128, 128, 128);font-size: 13px;    font-weight: 100; width: 100px; text-align: center;">Solicitud en proceso</h2>
                    <h2 class="codigo" v-if="item.codigo != NULL">@{{item.codigo}} </h2>
                    <!-- DATA SHOW 
                    <a data-toggle="modal" :data-target="'#applicantModal'+item.id" > </a>-->
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



                    <a href=""  v-on:click.prevent="editSearch(item)" style="color:#000;position: absolute;top:10px;right: 10px">Editar</a>
                    
                    <div style="position: absolute;top:0px;right: 10px;">
                            <div style="position: relative;display: block;width: 20px;cursor: pointer;width: 15px;height: 80px;" :onmouseover ="'getElementById(cont'+item.id ">

                                <div style="position: absolute;width:3px;height: 3px;background: #cecece;top:10px;right: 0px; border-radius: 5px;"></div>
                                <div style="position: absolute;width:3px;height: 3px;background: #cecece;top:18px;right: 0px; border-radius: 5px;"></div>
                                <div style="position: absolute;width:3px;height: 3px;background: #cecece;top:26px;right: 0px; border-radius: 5px;"></div>
                                <div style="border-radius: 4px;box-shadow: 0 0.1875em 0.25em 0 rgba(0,0,0,.1), 0 0 0.0625em 0 rgba(0,0,0,.25); min-width: 100px; width: max-content;position: absolute;right: 0;top: 40px;background: #fff;display: none;" :id="'cont'+item.id" >
                                    <a href="" style="padding: 5px 10px; font-family: 'Kanit'; font-size: 15px;width: 100%;position: relative;display: block;" class="ahover">Ver</a>
                                    <a href="" style="padding: 5px 10px; font-family: 'Kanit'; font-size: 15px;width: 100%;position: relative;display: block;" class="ahover">Editar</a>
                                </div>

                            </div>
                       </div>
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
         

        
         <form  action="{{url('suppli')}} " enctype="multipart/form-data" method="post" >
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
                            <input type="number" name="idpersona" value="{{Auth::user()->id}}" style="display: none;">
                            <input type="number" name="impropio" value="1" style="display: none;">
                            <input type="number" name="soli" value="0" style="display: none;">
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
                                    <label style="" class="numbers">STOCK</label>
                                    <input type="text" name="stock" class="form-control inputnumbers" autocomplete="off" style="" >
                                </div>
                                <div style=" " class="contnumbers">
                                    <label style="" class="numbers">Precio</label>
                                    <input type="text" name="costo" class="form-control inputnumbers" autocomplete="off" style="" >
                                </div>
                                
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
        
        @include('supplier.edit')
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

</div>




@endsection