@extends('layouts.app')

@section('content')

@php
function multiexplode($delimiters,$string) {
            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch = explode($delimiters[0], $ready);
            return  $launch;
        }
@endphp

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

    var options = "";
    for(var i = 1; i<201; i++ ) {
        options += "<option value="+i+">"+i+"</option>";
    }

    function updateAgeOptions() {
        $('#min_age').html( options );
        $('#min_age').val(<?php echo $callback['min_age'] ?>);
        $('#max_age').html( options );
        $('#max_age').val(<?php echo $callback['max_age'] ?>);
    }   

    function deleteSubject(value) {
        $.ajax({
            type: "POST",
            url: window.location.pathname +'/subject/delete',
            data: {subject: value, _token: "{{ csrf_token() }}"},
            success: function( data ) {
                var subToDelete = "remove-subject."+data.subjectToDelete;
                // $("#debug").append("<h4>"+data.debug+"</h4>");
                document.getElementById(subToDelete).remove();
            }
        });
    }

    $(document).ready(function() {
        $('#subjects-select').on('change', function (e) {
            e.preventDefault();
            var subjectChosen = $('#subjects-select').val();
            $.ajax({
                type: "POST",
                url: window.location.pathname +'/subject/add',
                data: {subject: subjectChosen, _token: "{{ csrf_token() }}"},
                success: function( data ) {
                    if(data.status != 'Subject not added') {
                        $("#subjects").append("<tr id='remove-subject."+data.subjectId+"'><td>"+data.subjectToAdd+"<span onclick='deleteSubject("+data.subjectId+")' value="+data.subjectId+" class='button pull-right'>X</span></td></tr>");
                        // $("#debug").append("<h4>"+data.debug+"</h4>");
                    } else {
                        alert('Subject already exists.')
                    }
                }
            });
        });
    });

    window.onload = updateAgeOptions;
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
                            <p>Please enter the desired attributes of the mentor you would like to work with (with priority).</p>
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/preferences') }}">
                        {{ csrf_field() }}

                        <div class="label-priority-group">
                            <h4>Preferred Mentor Age</h4>
                            <label for="age_priority" class="col-md-4 control-label">(Priority)</label>
                            <div class="4u">
                                <select class="priority-picker" name="age_priority" placeholder="{{ $callback['max_age'] }}">
                                    <option value="1" {{ $pref_priorities->age_priority == 1 ? 'selected' : ''}}>1</option>
                                    <option value="2" {{ $pref_priorities->age_priority == 2 ? 'selected' : ''}}>2</option>
                                    <option value="3" {{ $pref_priorities->age_priority == 3 ? 'selected' : ''}}>3</option>
                                </select>
                            </div>
                        </div>
                        <center>
                            <div class="row mentor-age">
                                <div class="form-group">
                                    <label for="min_age" class="col-md-4 control-label">From</label>
                                    <div class="4u">
                                        <select class="age-picker" id="min_age" name="min_age" placeholder="{{ $callback['min_age'] }}">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="max_age" class="col-md-4 control-label">To</label>
                                    <div class="4u">
                                        <select class="age-picker" id="max_age" name="max_age" placeholder="{{ $callback['max_age'] }}">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </center>

                        <center>
                         <div class="label-priority-group">
                            <h4>Preferred Mentor Gender</h4>
                            <label for="gender_priority" class="col-md-4 control-label">(Priority)</label>
                            <div class="4u">
                                <select class="priority-picker" name="gender_priority" placeholder="{{ $callback['max_age'] }}">
                                    <option value="1" {{ $pref_priorities->gender_priority == 1 ? 'selected' : ''}}>1</option>
                                    <option value="2" {{ $pref_priorities->gender_priority == 2 ? 'selected' : ''}}>2</option>
                                    <option value="3" {{ $pref_priorities->gender_priority == 3 ? 'selected' : ''}}>3</option>
                                </select>
                            </div>
                        </div>
                    </center>
                    <center>
                         <div class="row gender-row">
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
                            <div class="label-priority-group">                           
                                <h4>Preferred Mentor Skills</h4>
                                <label for="subject_priority" class="col-md-4 control-label">(Priority)</label>
                                <div class="4u">
                                    <select class="priority-picker" name="subjects_priority" placeholder="{{ $callback['min_age'] }}">
                                        <option value="1" {{ $pref_priorities->subjects_priority == 1 ? 'selected' : ''}}>1</option>
                                        <option value="2" {{ $pref_priorities->subjects_priority == 2 ? 'selected' : ''}}>2</option>
                                        <option value="3" {{ $pref_priorities->subjects_priority == 3 ? 'selected' : ''}}>3</option>
                                    </select>
                                </div>
                            </div>
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
                                        <?php
                                        $finSubs = array_slice(multiexplode(array(",","[","]", "\""), $subjectList), 1, -1);
                                        for ($i = 0; $i < count($finSubs); $i++){
                                            $subject = DB::table('subjects')->select()->where('id', $finSubs[$i])->get();
                                            foreach ($subject as $sub){
                                                echo "<tr id='remove-subject.".$sub->id."'><td>".$sub->name."<span onclick='deleteSubject(".$sub->id.")' value=".$sub->id." class='button pull-right'>X</span></td></tr>";
                                            }                                
                                        }
                                        ?>
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
        .gender-row {
            display: flex;
            justify-content: center;
        }
        .age-picker {
            width: 100px;
        }
        .priority-picker {
            width: 50px;
        }
        .label-priority-group {
            padding: 20px;
            display: flex;
            flex-direction: row;
            width: max-content;
        }
        .required:after {
            content: '*';
            color: red;
            padding-left: 5px;
        }
        .mentor-age{
            display: grid;
        }
        h4 {
            white-space: nowrap;
        }
    </style>

@endsection
