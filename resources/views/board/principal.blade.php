@extends ('blackboard')
@section ('contenido')

<div id="crud" class="" style="width:50%; position: absolute; display: block;">
	<div class="col-xs-12">
		<h1 class="page-head">LAUZAPAY CONTAINER</h1>
		
	</div>
	<div class="" style="">
		<a href="" class="btn btn-primary pull-left" style="margin:20px; " data-toggle="modal" data-target="#create">
		Nueva Tarea</a>
		
		



		<table class="table table-hover table-sprite">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tarea</th>
					<th colspan="2">&nbsp;</th>

				</tr>

			</thead>
			<tbody>
				<input type="text" placeholder="Buscar" v-model="keep" v-on:keyup.13="getKeeps">
				
				<tr v-for="item in searchKeep">
					<td width="10px">@{{item.id}} </td>
					<td>@{{item.keep}}</td>
					<td>@{{item.created_at}}</td>
					<td width="10px">
						<a href="" class="btn btn-warning btn-sm" v-on:click.prevent="editKeep(item)">Editar</a>
					</td>
					<td width="10px">
						<a href="" class="btn btn-danger btn-sm" v-on:click.prevent="deleteKeeps(item)">Eliminar</a>
					</td>

				</tr>

			</tbody>
		</table>

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




		@include('create')
		@include('edit')
		</div>
		<div class="" style="float:left; position: relative;">
			<pre>
				
			</pre>
		</div>
</div>
	<script src="{{asset('js/app.js')}}"></script>
	

@endsection 