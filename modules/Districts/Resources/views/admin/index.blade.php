@extends('layouts.app')

@section('content')
	<script src="{{asset('js/modules/district.js')}}"></script>
	<div class="container">
		<div class="row">
			<h2>List District</h2>
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
			{{Form::open(array('url'=> route('list_district'), 'class'=>'form-inline', 'id' => 'form_manage', 'method'=>'post'))}}
			<div style="margin-bottom: 20px">

				<div class="form-group">
					<label class="sr-only" for="city_id"></label>
					{{Form::select('city_id',$cities, isset($filter['city_id'])? $filter['city_id'] : '',array('class'=>'form-control', 'id' => 'city_id'))}}
				</div>
				<div class="form-group">
					<label class="sr-only" for="district"></label>
					<input style="height: 32px" class="form-control" id="district" name="name" placeholder="Name" value="{{isset($filter['name']) ? $filter['name'] : ''}}">
				</div>
				<script>
					$('#city_id').select2();
				</script>
				<button type="button" class="btn btn-sm btn-success" id="btn_search">
					<i class="hidden-sm glyphicon glyphicon-search"></i> Search
				</button>
				<a class="btn btn-sm btn-success" href="{{route('create_district')}}">
					<i class="hidden-sm glyphicon glyphicon-plus"></i> Create
				</a>
				<button type="button" class="btn btn-sm btn-success" id="btn_delete">
					<i class="hidden-sm glyphicon glyphicon-trash"></i> Delete
				</button>

			</div>
		<table class="table table-bordered table-responsive table-hover table-striped">
			<thead>
			<tr>
				<th style="text-align: center"><input type="checkbox" class="checkall"></th>
				<th>City</th>
				<th>District</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($districts as $district)
			<tr>
				<td style="text-align: center">{{Form::checkbox('id[]',$district->id,false,array('class'=>'row-check'))}}</td>
				<td>{{$district->city_name}}</td>
				<td><a href="{{route('edit_district', ['id' => $district->id])}}">{{ $district->name }}</a></td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{{Form::close()}}
		{{ $districts->appends($filter)->links() }}
		</div>
	</div>
@endsection