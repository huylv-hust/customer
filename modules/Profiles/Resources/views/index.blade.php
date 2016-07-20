@extends('layouts.default')

@section('content')
	<script src="{{asset('js/customer.js')}}"></script>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				{{Form::open(array('url'=> route('update_profile', ['token' => $token]), 'class'=>'', 'method'=>'post'))}}
				<h2 style="text-align: center">Please Sign Up</h2>
				<hr class="colorgraph">
				<div class="form-group">
					<label>Card Number</label><span class="red"> * </span>
					{{Form::text('card_number', "" , array('class'=>'form-control', 'placeholder' => 'Card Number'))}}
					@if($errors->first('card_number'))
						<label class="text-danger">{{$errors->first('card_number')}}</label>
					@endif
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							<label>First Name</label><span class="red"> * </span>
							{{Form::text('firstname', "" , array('class'=>'form-control', 'placeholder' => 'First Name'))}}
							@if($errors->first('firstname'))
								<label class="text-danger">{{$errors->first('firstname')}}</label>
							@endif
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							<label>Last Name</label><span class="red"> * </span>
							{{Form::text('lastname', "" , array('class'=>'form-control', 'placeholder' => 'Last Name'))}}
							@if($errors->first('lastname'))
								<label class="text-danger">{{$errors->first('lastname')}}</label>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="form-group">
							<label>City</label><span class="red"> * </span>
							{{Form::select('address_1',$cities, "", array('class' => 'form-control', 'id' => 'address_1')) }}
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
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="form-group">
							<label>District</label>
							{{Form::select('address_2',[], "", array('class' => 'form-control', 'id' => 'address_2')) }}
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
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="form-group">
							<label>Town</label>
							{{Form::select('address_4',[], "", array('class' => 'form-control', 'id' => 'address_4')) }}
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
				</div>
				<div class="form-group">
					<label>Address</label>
					{{Form::text('address_3', "" , array('class'=>'form-control', 'placeholder' => 'Address'))}}
					@if($errors->first('address_3'))
						<label class="text-danger">{{$errors->first('address_3')}}</label>
					@endif
				</div>
				<div class="form-group">
					<label>Phone Number</label><span class="red"> * </span>
					{{Form::text('tel', "" , array('class'=>'form-control', 'placeholder' => 'Mobile'))}}
					@if($errors->first('tel'))
						<label class="text-danger">{{$errors->first('tel')}}</label>
					@endif
				</div>
				<div class="form-group">
					<label>Post Code</label>
					{{Form::text('postcode', "" , array('class'=>'form-control', 'placeholder' => 'Post Code'))}}
					@if($errors->first('postcode'))
						<label class="text-danger">{{$errors->first('postcode')}}</label>
					@endif
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-7 col-md-7">
						<label>Birthday</label>
						<div class="form-group">
							{{Form::text('birth', "" , array('class'=>'form-control', 'placeholder' => 'Birthday', 'id' => 'birthday'))}}
							<script>
								$('#birthday').datepicker({
									format: 'yyyy-mm-dd',
								});
							</script>
						</div>
					</div>
					<div class="col-xs-12 col-sm-5 col-md-5">
						<div class="form-group">
							<label>Gender</label>
							{{Form::select('gender',\App\Helpers\Constant::$gender, "", array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="form-group">
							<input name="submit" type="submit" value="Register" class="btn btn-primary btn-block btn-lg">
						</div>
					</div>
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
@endsection
