
	 <form  action="{{url('createart')}} " enctype="multipart/form-data" method="post" >
	 	@csrf
	 	<label > choose file</label>
	 	<input type="file" name="image" v-model="newImage">
	 	<button type="submit" name="submit" > Upload</button>
	 </form>

