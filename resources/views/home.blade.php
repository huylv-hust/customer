@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				{{Form::open(array('url'=> '', 'class'=>'', 'method'=>'post'))}}
					<h2 style="text-align: center">Please Sign Up</h2>
					<hr class="colorgraph">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								{{Form::text('firstname', "" , array('class'=>'form-control', 'placeholder' => 'First Name'))}}
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								{{Form::text('lastname', "" , array('class'=>'form-control', 'placeholder' => 'Last Name'))}}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								{{Form::select('address_1',\App\Helpers\Constant::$city, "", array('class' => 'form-control', 'id' => 'address_1')) }}
							</div>
							<script>
								$('#address_1').select2({});
							</script>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								{{Form::text('address_2', "" , array('class'=>'form-control', 'placeholder' => 'District'))}}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{Form::text('address_3', "" , array('class'=>'form-control', 'placeholder' => 'Address'))}}
					</div>
					<div class="form-group">
						{{Form::text('tel', "" , array('class'=>'form-control', 'placeholder' => 'Mobile'))}}
					</div>
					<div class="form-group">
						{{Form::text('postcode', "" , array('class'=>'form-control', 'placeholder' => 'Post Code'))}}
					</div>
					<div class="form-group">
						{{Form::text('card_number', "" , array('class'=>'form-control', 'placeholder' => 'Card Number'))}}
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-7 col-md-7">
							<div class="form-group">
								{{Form::text('birth', "" , array('class'=>'form-control', 'placeholder' => 'Birthday', 'id' => 'birthday'))}}
								<script>
									$('#birthday').datepicker({});
								</script>
							</div>
						</div>
						<div class="col-xs-12 col-sm-5 col-md-5">
							<div class="form-group">
								{{Form::select('gender',\App\Helpers\Constant::$gender, "", array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<div class="form-group">
								<input type="submit" value="Register" class="btn btn-primary btn-block btn-lg">
							</div>
						</div>
					</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
@endsection
