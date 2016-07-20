@extends('layouts.app')

@section('content')
	<script src="{{asset('js/modules/profile.js')}}"></script>
	<div class="container">
		<h2>{{$title}}</h2>
		<hr class="colorgraph">
		@if(Session::has('error'))
			<div class="alert alert-danger message-error">
				<a data-dismiss="alert" class="close">×</a>
				<p> {{ Session::get('error') }}</p>
			</div>
		@endif
		<div class="row">
			<div class="col-md-6">
				{{Form::open(array('url'=> $url, 'class'=>'form-horizontal', 'method'=>'post'))}}
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Card Number</label>
					<div class="col-sm-9">
						{{Form::text('card_number', isset($profile) ? $profile->card_number : "" , array('class'=>'form-control'))}}
						@if ($errors->has('card_number'))
							<label class="label label-danger">
								{{ $errors->first('card_number') }}
							</label>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">First Name</label>
					<div class="col-sm-9">
						{{Form::text('firstname', isset($profile) ? $profile->firstname : "" , array('class'=>'form-control'))}}
						@if ($errors->has('firstname'))
							<label class="label label-danger">
								{{ $errors->first('firstname') }}
							</label>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Last Name</label>
					<div class="col-sm-9">
						{{Form::text('lastname', isset($profile) ? $profile->lastname : "" , array('class'=>'form-control'))}}
						@if ($errors->has('lastname'))
							<label class="label label-danger">
								{{ $errors->first('lastname') }}
							</label>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">City</label>
					<div class="col-sm-9">
						{{Form::select('address_1',$cities, $profile->address_1, array('class' => 'form-control', 'id' => 'address_1')) }}
						@if($errors->first('address_1'))
							<label class="text-danger">{{$errors->first('address_1')}}</label>
						@endif
					</div>
					<script>
						$('#address_1').select2({
							placeholder: "Select a City",
						});
					</script>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">District</label>
					<input type="hidden" value="{{$profile->address_2}}" id="address2">
					<div class="col-sm-9">
						{{Form::select('address_2',$districts, $profile->address_2, array('class' => 'form-control', 'id' => 'address_2')) }}
						@if($errors->first('address_2'))
							<label class="text-danger">{{$errors->first('address_2')}}</label>
						@endif
					</div>
					<script>
						$('#address_2').select2({
							placeholder: "Select a District",
						});
					</script>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Town</label>
					<input type="hidden" value="{{$profile->address_4}}" id="address4">
					<div class="col-sm-9">
						{{Form::select('address_4',$towns, $profile->address_4, array('class' => 'form-control', 'id' => 'address_4')) }}
						@if($errors->first('address_4'))
							<label class="text-danger">{{$errors->first('address_4')}}</label>
						@endif
					</div>
					<script>
						$('#address_4').select2({
							placeholder: "Select a Town",
						});
					</script>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Address</label>
					<div class="col-sm-9">
						{{Form::text('address_3', isset($profile) ? $profile->address_3 : "" , array('class'=>'form-control'))}}
						@if ($errors->has('address_3'))
							<label class="label label-danger">
								{{ $errors->first('address_3') }}
							</label>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Phone Number</label>
					<div class="col-sm-9">
						{{Form::text('tel', isset($profile) ? $profile->tel : "" , array('class'=>'form-control'))}}
						@if ($errors->has('tel'))
							<label class="label label-danger">
								{{ $errors->first('tel') }}
							</label>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Postcode</label>
					<div class="col-sm-9">
						{{Form::text('postcode', isset($profile) ? $profile->postcode : "" , array('class'=>'form-control'))}}
						@if ($errors->has('postcode'))
							<label class="label label-danger">
								{{ $errors->first('postcode') }}
							</label>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Birthday</label>
					<div class="col-sm-9">
						{{Form::text('birth', isset($profile) ? $profile->birth : "", array('class'=>'form-control', 'placeholder' => 'Birthday', 'id' => 'birthday'))}}
						<script>
							$('#birthday').datepicker({
								format: 'yyyy-mm-dd',
							});
						</script>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-3 control-label">Gender</label>
					<div class="col-sm-9">
						{{Form::select('gender',\App\Helpers\Constant::$gender, isset($profile) ? $profile->gender : "" , array('class' => 'form-control')) }}
						@if ($errors->has('gender'))
							<label class="label label-danger">
								{{ $errors->first('gender') }}
							</label>
						@endif
					</div>
				</div>
				<input type="hidden" name="email_id" value="{{$profile->email_id}}">
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<a href="{{ URL::previous() }}" class="btn btn-success">
							<i class="glyphicon glyphicon-arrow-left"></i> Back
						</a>
						<button type="submit" class="btn btn-success">
							<i class="glyphicon glyphicon-ok"></i> Save
						</button>
					</div>
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
@endsection