@extends('layouts.app')

@section('content')
	<script src="{{asset('js/modules/city.js')}}"></script>
	<style>
		.fileUpload {
			position: relative;
			overflow: hidden;
			margin: 10px;
		}
		.fileUpload input.upload {
			position: absolute;
			top: 0;
			right: 0;
			margin: 0;
			padding: 0;
			font-size: 20px;
			cursor: pointer;
			opacity: 0;
			filter: alpha(opacity=0);
		}
	</style>
	<div class="container">
		<div class="row">
			<h2>Import Data</h2>
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
			{{Form::open(array('url'=> route('import_data'), 'class'=>'form-inline', 'method'=>'post', 'files' => true))}}
			<div style="margin-bottom: 20px">
				<input style="height: 35px" class="form-control" name="" placeholder="Choose File" value="" disabled id="uploadFile">
				<div class="fileUpload btn btn-primary">
					<span>Upload</span>
					<input id="uploadBtn" type="file" class="upload" name="csv">
				</div>
				<script>
					$(function(){
						$("#uploadBtn").change(function(){
							$("#uploadFile").val($(this).val());
						});
					})
				</script>
				<div>
					@if ($errors->has('csv'))
						<label class="label label-danger">
							{{ $errors->first('csv') }}
						</label>
					@endif
				</div>
			</div>
			<button type="submit" class="btn btn-md btn-success">
				<i class="glyphicon glyphicon-ok"></i> IMPORT
			</button>
			{{Form::close()}}
		</div>
	</div>
@endsection