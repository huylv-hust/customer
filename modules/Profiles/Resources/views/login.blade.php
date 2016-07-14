@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Administrator</h3>
					</div>
					<div class="panel-body">
						{{Form::open(array('url'=> route('admin_login'), 'class'=>'form-signin', 'method'=>'post'))}}
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="User Name" name="user" type="text" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="password" type="password">
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Remember Me
									</label>
								</div>
								<button class="btn btn-lg btn-primary btn-block" type="submit">Login Now</button>
							</fieldset>
						{{Form::close()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
