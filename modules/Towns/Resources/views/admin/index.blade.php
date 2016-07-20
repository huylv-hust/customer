@extends('layouts.app')

@section('content')
	<script src="{{asset('js/modules/town.js')}}"></script>
	<div class="container">
		<div class="row">
			<h2>List Town</h2>
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
			{{Form::open(array('url'=> route('list_town'), 'class'=>'form-inline', 'id' => 'form_manage', 'method'=>'post'))}}
			<div style="margin-bottom: 20px">

				<div class="form-group">
					<input type="hidden" id="district_hidden" value="{{isset($filter['district_id'])? $filter['district_id'] : ''}}">
					{{Form::select('city_id',$cities, isset($filter['city_id'])? $filter['city_id'] : '',array('class'=>'form-control', 'id' => 'city_id'))}}
					{{Form::select('district_id',isset($districts) ? $districts : [],isset($filter['district_id'])? $filter['district_id'] : '',array('class'=>'form-control', 'id' => 'district_id'))}}
					<input style="height: 32px" class="form-control" name="name" placeholder="Name" value="{{isset($filter['name']) ? $filter['name'] : ''}}">
				</div>
				<script>
					$('#city_id').select2();
					$('#district_id').select2();
				</script>
				<button type="button" class="btn btn-sm btn-success" id="btn_search">
					<i class="glyphicon glyphicon-search"></i> Search
				</button>
				<a class="btn btn-sm btn-success" href="{{route('create_town')}}">
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
				<th>Town</th>
				<th>City</th>
				<th>District</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($towns as $town)
			<tr>
				<td style="text-align: center">{{Form::checkbox('id[]',$town->id,false,array('class'=>'row-check'))}}</td>
				<td><a href="{{route('edit_town', ['id' => $town->id])}}">{{ $town->name }}</a></td>
				<td>{{ $town->city_name }}</td>
				<td>{{ $town->district_name }}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{{Form::close()}}
		{{ $towns->appends($filter)->links() }}
		</div>
	</div>
@endsection