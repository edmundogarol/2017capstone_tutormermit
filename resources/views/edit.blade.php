@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../resources/assets/css/main.css" />
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-body">
            <center>
                   <header class="major">
                   
                            <h2><strong>Editing details</strong></h2>
                   
                    </header>
                     </center>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/edit') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="{{ Auth::user()->name }}" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="{{ Auth::user()->email }}" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">

                            <label for="name" class="col-md-4 control-label {{ Auth::user()->gender === '' ? 'required' : '' }}">Birthday</label>

                            <div class="col-md-6">
                            <input id="name" type="text" placeholder="{{ Auth::user()->birthday }}" class="required form-control" name="birthday" value="{{ old('birthday') }}" required autofocus>
                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <center>
                        <div class="row">
                                    <label for="gender" class="col-md-4 control-label {{ Auth::user()->birthday === '1900-01-01' ? 'required' : '' }}">Gender</label>
                                    <div class="gender-radio 3u 12u$(small)">
                                        <input type="radio" id="gender-male" name="gender" value="male" required>
                                        <label for="gender-male">Male</label>
                                    </div>
                                    <div class="gender-radio 3u$ 12u$(small)">
                                        <input type="radio" id="gender-female" name="gender" value="female" required>
                                        <label for="gender-female">Female</label>
                                    </div>
                        </div>
                        </center>

                        <center>                        
                        <div class="8u">
                            <h4>Subject List</h4>
                            <div class="select-wrapper">
                                <select name="demo-category" id="demo-category">
                                    <option value="">- Add Subject -</option>
                                    <option value="1">PHP</option>
                                    <option value="2">Java</option>
                                    <option value="3">C#</option>
                                    <option value="4">Python</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="8u">
                            <div class="table-wrapper">
                                <table class="alt">
                                    <tbody>
                                        <tr>
                                            <td>Subject list (No Subjects yet!)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </center>

                        <center>
                            <div class="form-group">
                                <button type="submit" class="button special">Update</button>

                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .required:after {
            content: '*';
            color: red;
            padding-left: 5px;
        }
    </style>

@endsection
