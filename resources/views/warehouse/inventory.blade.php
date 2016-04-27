@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Inventario
				</div>
				<div class="panel-body">
					<form action="/inventory" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="col-md-4 control-label">Categoria</label>
							<div class="col-md-6">
								<select class="form-control" name="id_cat">
								 @foreach ($categories as $cat)
								 	<option value="{{ $cat->id }}">{{ $cat->name}}</option>
								 @endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Ver						
								</button>
							</div>
						</div>
					</form>
						<table class="table table-striped task-table">
							<thread>
								<th>Cod</th>
								<th>Nombre</th>
								<th>Stock</th>
								<th>Med</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</thread>
							<tbody>
								@foreach ($items as $item)
									<tr>
										<td>{{$item->id}}</td>
										<td>{{$item->name}}</td>
										<td>{{$item->getTotalStock()}}</td>
										<td>{{$item->getMetricSymbol()}}</td>
										<td>
											<form action="/inventory/addStock/{{$item->id}}" method="POST">
												{{ csrf_field() }}
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-btn fa-plus"></i>
												</button>
											</form>
										</td>
										<td>
											<form action="/inventory/takeStock/{{$item->id}}" method="POST">
												{{ csrf_field() }}
												<button type="submit" class="btn btn-danger">
													<i class="fa fa-btn fa-minus"></i>
												</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<form action="inventory/addItem" method="GET">
							{{ csrf_field() }}
							<div class="form-group">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-plus"></i>Agregar Item
								</button>
							</div>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
