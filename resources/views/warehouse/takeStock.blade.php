@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Retirar Stock
				</div>
				<div class="panel-body">
					<form action="/inventory/{{$item->id}}/take" method="POST" class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">Codigo</label>
							<label class="col-md-4 col-md-offset-2">{{$item->id}}</label>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<label class="col-md-4 col-md-offset-2">{{$item->name}}</label>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Cant.</label>
							<input class="col-md-2 col-md-offset-1" name="cant">
							<label class="col-md-2 control-label col-md-offset-2">Costo</label>
							<input class="col-md-2 col-md-offset-1" name="costo">
						</div>
						<div>
							<button type="submit" class="btn btn-primary col-md-2">
								Solicitar					
							</button>
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