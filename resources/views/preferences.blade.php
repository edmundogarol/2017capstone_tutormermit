@extends('layouts.app')

@section('content')

<script>
    function changeGender (e) {
        if (e === 'male') {
            $('#gender-male').prop('checked', true);
            $('#gender-female').prop('checked', false);
            $('#gender-both').prop('checked', false);
        } else if {
            $('#gender-female').prop('checked', true);
            $('#gender-male').prop('checked', false);
            $('#gender-both').prop('checked', false);
        } else {
            $('#gender-female').prop('checked', false);
            $('#gender-male').prop('checked', false);
            $('#gender-both').prop('checked', true);
        }

    }
</script>

<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../resources/assets/css/main.css" />
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-body">
            <center>
                    <header class="major">
                   
                            <h2><strong>Editing preferences</strong></h2>
                    </header>
                            <p>Please enter the desired attributes of the mentor you would like to work with.</p>
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/preferences') }}">
                        {{ csrf_field() }}

                        {{--
                        <div class="form-group{{ $errors->has('agemin') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">From</label>

                            <div class="col-md-6">
                                <input id="agemin" type="agemin" placeholder="{{ $callback['agemin'] }}" class="form-control" name="agemin" value="{{ old('agemin') }}">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('agemin') ? ' has-error' : '' }}">
                            <label for="agemax" class="col-md-4 control-label">To</label>

                            <div class="col-md-6">
                                <input id="agemax" type="agemax" placeholder="{{ $callback['agemax'] }}" class="form-control" name="agemax" value="{{ old('agemax') }}">
                            </div>
                        </div>
                        --}}

                        <center>
                        {{ old('gender') }}
                        <div class="row">
                                    <label for="gender" class="col-md-4 control-label {{ Auth::user()->gender === '' ? ( $callback['gender'] === '' ? 'required' : '') : '' }}">Gender</label>
                                    <div class="gender-radio 2u 10u$(small)">
                                    @if ( $callback['gender'] === 'male')
                                        <input type="radio" onClick=changeGender('male') id="gender-male" name="gender" value="male" required checked> 
                                    @else
                                        <input type="radio" onClick=changeGender('male') id="gender-male" name="gender" value="male" required> 
                                    @endif
                                        <label for="gender-male">Male</label>
                                    </div>
                                    <div class="gender-radio 2u 10u$(small)">
                                    @if ( $callback['gender'] === 'female')
                                        <input type="radio" onClick=changeGender('female') id="gender-female" name="gender" value="female" required checked> 
                                    @else
                                        <input type="radio" onClick=changeGender('female') id="gender-female" name="gender" value="female" required> 
                                    @endif
                                        <label for="gender-female">Female</label>
                                    </div>
                                    <div class="gender-radio 2u$ 10u$(small)">
                                    @if ( $callback['gender'] === 'both')
                                        <input type="radio" onClick=changeGender('both') id="gender-both" name="gender" value="both" required checked> 
                                    @else
                                        <input type="radio" onClick=changeGender('both') id="gender-both" name="gender" value="both" required> 
                                    @endif
                                        <label for="gender-both">Both</label>
                                    </div>
                        </div>
                        </center>

                        <center>                        
                        <div class="8u">
                            <h4>Preferred Tutor Skills</h4>
                            <div class="select-wrapper">
                                <select>
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
                                <table class="alt" name="subject" id="subjects">
                                    <tbody>
                                        <tr>
                                            <td>Subject list (No Subjects yet!)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" id="subject-input" name="subjects" value="" required>
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
