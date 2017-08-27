@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 choice-box">
            <div class="panel panel-default">
                <div class="panel-heading">Choose an option!</div>
                <div class="panel-body tutorme-buttons btn-toolbar" role="toolbar">
                        <button type="button" class="btn-secondary student-button">
                            I need a tutor NOW!
                        </button>
                        <a class="button-route" href="{{ url('/tutor') }}">
                            <button type="button" class="btn-secondary tutor-button">
                                I want to tutor  
                            </button>
                        </a> 
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .btn-secondary{
        width: 45%;
        padding: 100px;
        margin: 17px;
    }   

    .button-route{
        border-bottom: none;
    }

    .choice-box{
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

</style>
@endsection
