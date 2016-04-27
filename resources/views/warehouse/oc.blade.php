@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Ordenes de Compra
				</div>
				<div class="panel-body">
					
						<table class="table table-striped task-table">
							<thread>
								<th>ID</th>
								<th>ITEM_ID</th>
								<th>USER_ID</th>
								<th>CANT</th>
								<th>COST</th>
								<th>&nbsp;</th>
							</thread>
							<tbody>
								@foreach ($ocs as $oc)
									@if ($oc->approved == false)
									<tr>
										<td>{{$oc->id}}</td>
										<td>{{$oc->item_id}}</td>
										<td>{{$oc->user_id}}</td>
										<td>{{$oc->cant}}</td>
										<td>{{$oc->cost}}</td>
										<td>										
											<form action="/admin/oc/{{$oc->id}}" method="POST">
												{{ csrf_field() }}
												<button type="submit" class="btn btn-primary">
													Aprobar
												</button>
											</form>
										
										</td>
									</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection