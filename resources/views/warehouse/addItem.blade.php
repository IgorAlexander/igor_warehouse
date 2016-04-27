@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registrar Item
				</div>
				<div class="panel-body">
					<form action="/inventory/addItem" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="col-md-4 control-label">Categoria</label>
							<div class="col-md-6">							
								<select class="form-control col-md-6" name="id_cat">
									 @foreach ($categories as $cat)
									 	<option value="{{ $cat->id }}">{{ $cat->name}}</option>
									 @endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Metrica</label>
							<div class="col-md-6">
								<select class="form-control col-md-4" name="id_met">
									 @foreach ($metrics as $met)
									 	<option value="{{ $met->id }}">{{ $met->name}}</option>
									 @endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input class="form-control col-md-6" name="nombre">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Descripcion</label>
							<div class="col-md-6">
								<textarea class="form-control col-md-6" name="desc" rows="3"></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Registrar
								</button>
							</div>
						</div>
					</form>
					<form action="/inventory" method="GET" class="form-horizontal">
									<button type="submit" class="btn btn-default">
											Cancelar					
									</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
