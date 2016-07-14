@extends('layouts.app')

@section('content')
	<div class="container">
		<h2>List Customer</h2>
		<div style="float: right; margin-bottom: 20px">
			{{Form::open(array('url'=> route('list_customers'), 'class'=>'form-inline', 'method'=>'get'))}}
			<div class="form-group">
				<input style="height: 29px" class="form-control" name="card_number" id="card_number" placeholder="Card Number" value="{{isset($filter['card_number']) ? $filter['card_number'] : ''}}">
				<button type="submit" class="btn btn-sm btn-success glyphicon glyphicon-search"></button>
				<button type="button" class="btn btn-sm btn-success glyphicon glyphicon-download-alt"></button>
			</div>

			{{Form::close()}}
		</div>
		<table class="table table-bordered table-responsive table-hover table-striped">
			<thead>
			<tr>
				<th>ID</th>
				<th>Card Number</th>
				<th>Name</th>
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
					<td><a href="{{route('detail_customers', ['id' => $v->id])}}">{{ $v->id }}</a></td>
					<td>{{ $v->card_number }}</td>
					<td>{{ $v->firstname.$v->lastname }}</td>
					<td>{{ $v->email }}</td>
					<td>{{ $v->tel }}</td>
					<td>{{ $v->address_3.' '.$v->district_name.' '.$v->city_name }}</td>
					<td>{{ $v->birth }}</td>
					<td>{{ $v->gender ? \App\Helpers\Constant::$gender[$v->gender] : ''}}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{{ $profiles->appends($filter)->links() }}
	</div>
@endsection