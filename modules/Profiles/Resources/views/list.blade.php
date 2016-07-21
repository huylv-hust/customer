@extends('layouts.app')

@section('content')
	<script src="{{asset('js/customer.js')}}"></script>
	<div class="container">
		<div class="row">
			<h2>List Customer</h2>
			<hr class="colorgraph">
			@if(Session::has('success'))
				<div class="alert alert-danger message-success">
					<a data-dismiss="alert" class="close">×</a>
					<p> {{ Session::get('success') }}</p>
				</div>
			@endif
			@if(Session::has('error'))
				<div class="alert alert-danger message-error">
					<a data-dismiss="alert" class="close">×</a>
					<p> {{ Session::get('error') }}</p>
				</div>
			@endif
			{{Form::open(array('url'=> route('list_customers'), 'class'=>'form-inline', 'method'=>'get'))}}
				<div  style=" margin-bottom: 20px">
					<input style="height: 29px" class="form-control" name="start_date" id="start_date" placeholder="Start Date" value="{{isset($filter['start_date']) ? $filter['start_date'] : ''}}">
					<script>
						$('#start_date').datepicker({
							format: 'yyyy-mm-dd',
						});
					</script>
					~
					<input style="height: 29px" class="form-control" name="end_date" id="end_date" placeholder="End Date" value="{{isset($filter['end_date']) ? $filter['end_date'] : ''}}">
					<script>
						$('#end_date').datepicker({
							format: 'yyyy-mm-dd',
						});
					</script>
					<input style="height: 29px" class="form-control" name="card_number" id="card_number" placeholder="Card Number" value="{{isset($filter['card_number']) ? $filter['card_number'] : ''}}">
					<button type="submit" class="btn btn-sm btn-success">
						<i class="glyphicon glyphicon-search"></i> Search
					</button>
					<button name="export" value="1" type="submit" class="btn btn-sm btn-success" id="export">
						<i class=" glyphicon glyphicon-download-alt"></i> Export
					</button>
				</div>
			{{Form::close()}}
			<table class="table table-bordered table-responsive table-hover table-striped">
				<thead>
				<tr>
					<th>Name Customer</th>
					<th>Card Number</th>
					<th>Email</th>
					<th>Number Phone</th>
					<th>Address</th>
					<th>Birthday</th>
					<th>Gender</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($profiles as $v)
					<tr>
						<td><a href="{{route('detail_customers', ['id' => $v->id])}}">{{ $v->firstname.$v->lastname }}</a></td>
						<td>{{ $v->card_number }}</td>
						<td>{{ $v->email }}</td>
						<td>{{ $v->tel }}</td>
						<td>{{ $v->address_3.', '.$v->town_name.', '.$v->district_name.', '.$v->city_name }}</td>
						<td>{{ $v->birth }}</td>
						<td>{{ $v->gender ? \App\Helpers\Constant::$gender[$v->gender] : ''}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			{{ $profiles->appends($filter)->links() }}
		</div>
	</div>
@endsection