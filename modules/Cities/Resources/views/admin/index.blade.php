@extends('layouts.app')

@section('content')
	<script src="{{asset('js/modules/city.js')}}"></script>
	<div class="container">
		<div class="row">
			<h2>List City</h2>
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
			{{Form::open(array('url'=> route('list_city'), 'class'=>'form-inline', 'id' => 'form_manage', 'method'=>'post'))}}
			<div style="margin-bottom: 20px">

				<div class="form-group">
					<input style="height: 29px" class="form-control" name="name" placeholder="Name" value="{{isset($filter['name']) ? $filter['name'] : ''}}">
				</div>
				<button type="button" class="btn btn-sm btn-success" id="btn_search">
					<i class="glyphicon glyphicon-search"></i> Search
				</button>
				<a class="btn btn-sm btn-success" href="{{route('create_city')}}">
					<i class="glyphicon glyphicon-plus"></i> Create
				</a>
				<button type="button" class="btn btn-sm btn-success" id="btn_delete">
					<i class="glyphicon glyphicon-trash"></i> Delete
				</button>

			</div>
		<table class="table table-bordered table-responsive table-hover table-striped">
			<thead>
			<tr>
				<th style="text-align: center"><input type="checkbox" class="checkall"></th>
				<th>ID</th>
				<th>Name</th>
				<th>Created_at</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($cities as $city)
			<tr>
				<td style="text-align: center">{{Form::checkbox('id[]',$city->id,false,array('class'=>'row-check'))}}</td>
				<td><a href="{{route('edit_city', ['id' => $city->id])}}">{{ $city->id }}</a></td>
				<td>{{ $city->name }}</td>
				<td>{{ $city->created_at }}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{{Form::close()}}
		{{ $cities->appends($filter)->links() }}
		</div>
	</div>
@endsection