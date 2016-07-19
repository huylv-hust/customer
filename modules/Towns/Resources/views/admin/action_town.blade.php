@extends('layouts.app')

@section('content')
    <script src="{{asset('js/modules/town.js')}}"></script>
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
                        {{Form::select('city_id',$cities,isset($obj)? $obj->city_id : '',array('class'=>'form-control', 'id' => 'city_id'))}}
                        @if ($errors->has('city_id'))
                            <label class="label label-danger">
                                {{ $errors->first('city_id') }}
                            </label>
                        @endif
                    </div>
                </div>
                <script>
                    $('#city_id').select2({
                        placeholder: "Select a City",
                    });
                </script>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">District Name</label>
                    <input type="hidden" id="district_hidden" value="{{isset($obj)? $obj->district_id : ''}}">
                    <div class="col-sm-9">
                        {{Form::select('district_id', $districts, isset($obj)? $obj->district_id : '',array('class'=>'form-control', 'id' => 'district_id'))}}
                        @if ($errors->has('name'))
                            <label class="label label-danger">
                                {{ $errors->first('name') }}
                            </label>
                        @endif
                    </div>
                </div>
                <script>
                    $('#district_id').select2({
                        placeholder: "Select a District",
                    });
                </script>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Town Name</label>
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