
		new Vue({
			el: '#crudart',
			created: function (){
				this.getSearches();
			},
			data: {
				searches:[],
				pagination: {
					'total':0,
            		'current_page':0,
            		'per_page':0,
            		'last_page':0,
            		'from':0,
            		'to':0

				},
				newSearch: '',
				fillSearch: {'id':'','name':'','categoria':'','description':'','precio':'','codigo':'','image':'','stock':'','precio':'','preciof':'','costo':'','puntos':'','image1':'','image2':'' },
				errors: [],
				offset: 3
			},
			computed: {
				isActived: function(){
					return this.pagination.current_page;
				},
				pagesNumber: function(){
					if (!this.pagination.to) {
						return [ ];
					}
					var from = this.pagination.current_page - this.offset;
					if (from<1) {
						from=1;
					}
					var to = from + (this.offset*2);
					if (to>=this.pagination.last_page) {
						to= this.pagination.last_page;
					}
					var pagesArray =[];
					while (from<=to){
						pagesArray.push(from);
						from++;
					}
					return pagesArray;
				},
				searchSearch: function(){
					return this.searches.filter((item) =>item.name.includes(this.name) || item.categoria.includes(this.name)  
					);
				}

			},
			methods: {
				getSearches: function (page){
					var urlSearches= 'searches?page='+page;
					axios.get(urlSearches).then(response => {
						this.searches = response.data.searches.data,
						this.pagination = response.data.pagination
					});
				},
				editSearch: function(item){
					this.fillSearch.id = item.id;
					this.fillSearch.name = item.name;
					this.fillSearch.categoria = item.categoria;
					this.fillSearch.description = item.description;
					this.fillSearch.codigo = item.codigo;
					this.fillSearch.image = item.image;
					this.fillSearch.stock = item.stock;
					this.fillSearch.precio = item.precio;
					this.fillSearch.preciof = item.preciof;
					this.fillSearch.puntos = item.puntos;
					this.fillSearch.costo = item.costo;
					this.fillSearch.image1 = item.image1;
					this.fillSearch.image2 =  item.image2;
					$('#edit').modal('show');

				},
				updateSearch: function(id) {
					var url = 'searches/' + id;
					axios.put(url, this.fillSearch).then(response=> {
					this.getSearches();
					this.fillSearch = {'id':'','name':'','categoria':'','description':'','precio':'','codigo':'','image':'','stock':'','precio':'','preciof':'','costo':'','puntos':'','image1':'','image2':'' };
					this.errors = [];
					$('#edit').modal('hide');
					toastr.success('Actualizado con exito'); 
					}).catch(error => {
						this.errors= error.response.data
					});

				},
				deleteSearches: function (item){
					var url= 'searches/'+ item.id;
					axios.delete(url).then(responde => { //elimina
						this.getSearches(); //actualiza
						toastr.success('Eliminado correctamente'); //notifica
					});
				},
				
				createSearch: function (){
					var url = 'searches';
					axios.post(url, {
					name: this.newSearch
					}).then(response => { // Lo que sigue es la actualizacion de la tabla a vacio
						this.getSearches();
						this.newSearch = '';
						this.errors =[];
						$('#create').modal('hide');
						toastr.success('Nueva tarea creada');
					}).catch(error=> {
						this.errors = error.response.data

					});
				},
				changePage: function(page) {
					this.pagination.current_page = page;
					this.getSearches(page);

				}
			}

			
		});