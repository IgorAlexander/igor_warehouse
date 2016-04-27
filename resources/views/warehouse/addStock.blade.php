@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Orden de Compra
				</div>
				<div class="panel-body">
					<form action="/inventory/{{$item->id}}/buy" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="col-md-4 control-label">Codigo</label>
							<div class="col-md-1">
								<p class="form-control-static">{{$item->id}}</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-4">
								<p class="form-control-static">{{$item->name}}</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Cant.</label>
							<div class="col-md-2">
								<input class="form-control" name="cant">
							</div>
							<label class="col-md-2 control-label">Costo</label>
							<div class="col-md-2">
								<input class="form-control" name="costo">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Solicitar					
								</button>
							</div>
						</div>
					</form>
					<form action="/inventory" method="GET" class="form-horizontal">
						<button type="submit" class="btn btn-default col-md-2">
								Cancelar					
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection