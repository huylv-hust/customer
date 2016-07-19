@extends('layouts.app')

@section('content')
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
                        <label for="inputEmail3" class="col-sm-3 control-label">City Name</label>
                        <div class="col-sm-9">
                            {{Form::text('name', isset($obj) ? $obj->name : "" , array('class'=>'form-control'))}}
                            @if ($errors->has('name'))
                                <label class="label label-danger">
                                    {{ $errors->first('name') }}
                                </label>
                            @endif
                        </div>
                    </div>
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