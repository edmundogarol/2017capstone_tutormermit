@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Choose an option!</div>
                <div class="panel-body tutorme-buttons btn-toolbar" role="toolbar">
                        <button type="button" class="btn-secondary student-button">
                            I need a tutor!
                        </button>
                        <button type="button" class="btn-secondary tutor-button">
                            I want to teach!
                        </button>
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

</style>
@endsection
