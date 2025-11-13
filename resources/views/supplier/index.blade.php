
@extends ('layouts.supplier-app')
@section ('usuario')

 <link rel="stylesheet" href="{{asset('css/sty.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
        	padding-top:150px;
        	padding-left: 100px;
        }
        .mapi{
        	width: 150px;
        	transition: .5s;
        	border-radius: 150px 0px 0px 150px;        	
        	position: relative;
        	display: block;
        	float: right;
        	box-sizing: border-box;

        }

        .mapi:hover{
        	width: 100%;
        	border-radius: 0px 0px 0px 0px;
        }
</style>
<div class="dashi">
	<div style="position: relative;width:85%;display: block;margin:auto;background: white;">
		<div style="position: relative;width: 100%;margin:0;padding:20px;box-sizing: border-box;  ">
			<h4 style="text-transform: uppercase;font-family:'Kanit' ">{{Auth::user()->name}} {{Auth::user()->lastname}}</h4>
		</div>
		
		<div style="position: relative;width: 100%;display: inline-block;">
		<iframe class="mapi" style="filter: grayscale(100%);" src="{{Auth::user()->map}}" height="150" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
		<div style="position: relative;float:left;display: block; padding-left: 20px;padding-top: 20px">
			<div style="position: relative;float: left;width:100px;display: inline-block;">
				<h4 style="font-family:'Kanit';font-size: 15px; ">R.U.C. :</h4>
				<h4 style="font-family:'Kanit';font-size: 15px; ">Celular:</h4>
				<h4 style="font-family:'Kanit';font-size: 15px; ">E-mail:</h4>
				<h4 style="font-family:'Kanit';font-size: 15px; ">Distrito:</h4>
				<h4 style="font-family:'Kanit';font-size: 15px; ">Provincia:</h4>
				<h4 style="font-family:'Kanit';font-size: 15px; ">Ciudad:</h4>
				<h4 style="font-family:'Kanit';font-size: 15px; ">Direccion:</h4>
			</div>
			<div style="position: relative;float: left;width:100px;display: inline-block;">
				<h4 style="font-family:'Kanit';font-size: 15px;text-align: left; ">{{Auth::user()->dni}} </h4>
				<h4 style="font-family:'Kanit';font-size: 15px;text-align: left; ">{{Auth::user()->cell}} </h4>
				<h4 style="font-family:'Kanit';font-size: 15px;text-align: left; ">{{Auth::user()->email}} </h4>
				<h4 style="font-family:'Kanit';font-size: 15px;text-align: left; ">{{Auth::user()->distrito}} </h4>
				<h4 style="font-family:'Kanit';font-size: 15px;text-align: left; ">{{Auth::user()->provincia}} </h4>
				<h4 style="font-family:'Kanit';font-size: 15px;text-align: left; ">{{Auth::user()->ciudad}} </h4>
				<h4 style="font-family:'Kanit';font-size: 15px;text-align: left;width: 200px ">{{Auth::user()->direccion}} </h4>
			</div>
		</div>
		</div>

	</div>


</div>

 



@endsection