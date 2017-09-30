@extends('layouts.app')

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    var subjects = [];
    function changeGender (e) {
        if (e === 'male') {
            $('#gender-male').prop('checked', true);
            $('#gender-female').prop('checked', false);
            $('#gender-both').prop('checked', false);
        } else if (e === 'female') {
            $('#gender-female').prop('checked', true);
            $('#gender-male').prop('checked', false);
            $('#gender-both').prop('checked', false);
        } else {
            $('#gender-female').prop('checked', false);
            $('#gender-male').prop('checked', false);
            $('#gender-both').prop('checked', true);
        }
    }

    $(document).ready(function($) {
        $('#subjects-select').on('change',function(e){
            subjects.push(e.target.value);
            console.log(subjects);
        });
    });

    var options = "";
    for(var i = 1; i<201; i++ ) {
        options += "<option value="+i+">"+i+"</option>";
    }

    function updateAgeOptions() {
        $('#min_age').html( options );
        $('#min_age').val(1);
        $('#max_age').html( options );
        $('#max_age').val(200);
    }   

    window.onload = updateAgeOptions;
</script>

{{ $preferences }}

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

                        <h5>Preferred Mentor Age</h5>
                        <center>
                            <div class="row mentor-age">
                                <div class="form-group">
                                    <label for="min_age" class="col-md-4 control-label">From</label>
                                    <div class="4u">
                                        <select id="min_age" placeholder="1">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="max_age" class="col-md-4 control-label">To</label>
                                    <div class="4u">
                                        <select id="max_age" placeholder="200">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </center>

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
                            <h4>Preferred Mentor Skills</h4>
                            <div class="select-wrapper">    
                                <select id="subjects-select" >
                                    <option value="">- Add Subject -</option>
                                    <option value="1">Building IT Systems</option>
                                    <option value="2">Introduction to Information Technology</option>
                                    <option value="3">Introduction to Programming</option>
                                    <option value="4">User-centred Design</option>
                                    <option value="5">Introduction to Computer Systems and Platform Technologies</option>
                                    <option value="6">Programming 1</option>
                                    <option value="7">Data Communication and Net-Centric Computing</option>
                                    <option value="8">Web Programming</option>
                                    <option value="9">Software Engineering Fundamentals</option>
                                    <option value="10">Database Concepts</option>
                                    <option value="11">Professional Computing Practice</option>
                                    <option value="12">Security in Computing and Information Technology</option>
                                    <option value="13">Software Engineering Project Management</option>
                                    <option value="14">Programming Project 1</option>
                                    <option value="15">Advanced Programming Techniques</option>
                                    <option value="16">Agent-Oriented Programming and Design</option>
                                    <option value="17">Algorithms and Analysis</option>
                                    <option value="18">Artificial Intelligence</option>
                                    <option value="19">Broadcast Networks and Applications</option>
                                    <option value="20">Cloud Computing</option>
                                    <option value="21">Database Administration</option>
                                    <option value="22">Database Systems</option>
                                    <option value="23">Digital Media Computing</option>
                                    <option value="24">Distributed Systems</option>
                                    <option value="25">Document Markup Languages</option>
                                    <option value="26">Electronic Commerce and Enterprise Systems</option>
                                    <option value="27">Interactive 3D Graphics and Animation</option>
                                    <option value="28">iPhone Software Engineering</option>
                                    <option value="29">Information Technology Entrepreneurship</option>
                                    <option value="30">Machine Learning</option>
                                    <option value="31">Knowledge and Data Warehousing</option>
                                    <option value="32">Mobile Application Development</option>
                                    <option value="33">Network Programming</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="8u">
                            <div class="table-wrapper">
                                <table class="alt" name="subject" id="subjects">
                                    <tbody>
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
        .mentor-age{
            display: grid;
        }
    </style>

@endsection
