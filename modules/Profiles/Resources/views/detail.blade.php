@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2">Email</label>
                <div class="col-sm-10">
                    {{$email->email}}
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2">Name</label>
                <div class="col-sm-10">
                    {{$profile->name}}
                </div>
            </div>
            @if($profile->birth)
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2">Birthday</label>
                    <div class="col-sm-10">
                        {{$profile->birth}}
                    </div>
                </div>
            @endif
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2">Address</label>
                <div class="col-sm-10">
                    {{$profile->address}}
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2">Telephone</label>
                <div class="col-sm-10">
                    {{$profile->tel}}
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2">Card Number</label>
                <div class="col-sm-10">
                    {{$profile->card_number}}
                </div>
            </div>
            @if($profile->postcode)
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2">PostCode</label>
                <div class="col-sm-10">
                    {{$profile->postcode}}
                </div>
            </div>
            @endif
            @if($profile->gender)
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2">Gender</label>
                    <div class="col-sm-10">
                        {{\App\Helpers\Constant::$gender[$profile->gender]}}
                    </div>
                </div>
            @endif
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2">Created at</label>
                <div class="col-sm-10">
                    {{$profile->created_at}}
                </div>
            </div>
        </form>
	    <div>
		    <a href="{{ URL::previous() }}" class="btn btn-success btn-sm">
			    <span class="glyphicon glyphicon-arrow-left"></span> Back
		    </a>
	    </div>
    </div>
@endsection