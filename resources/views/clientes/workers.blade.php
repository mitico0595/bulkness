@extends ('blackboard')
@section ('contenido')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<h1>Busqueda de Clientes
                            {{ Form::open(['route' => 'user', 'method'=> 'GET', 'class' => 'form-inline pull-right' ])}}

                                <div class="form-group">
                                    {{ Form::text('name', null, ['class'=> 'form-control', 'placeholder' => 'Nombre' ])}}
                                    
                                </div>
                                <div class="form-group">
                                    {{ Form::text('email', null, ['class'=> 'form-control', 'placeholder' => 'Email' ])}}
                                    
                                </div>    
                                <div class="form-group">
                                    {{ Form::text('bio', null, ['class'=> 'form-control', 'placeholder' => 'Bio' ])}}
                                    
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>

                                </div>
                            {{ Form::close()}}
                       </h1>
hola worker
@endsection