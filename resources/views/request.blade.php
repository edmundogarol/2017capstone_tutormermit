@extends('layouts.app')

@section('content')


<div class="container">
<br>
<div class="row">
   	<div class="6u 12u$(medium)">
      <span class="leftcol">
		<h1>Send Request: To <strong>{{ $mentor->name }}</strong> </h1> 
       </span>
    </div>
	<div class="6u 12u$(medium)">
		<br>
	  	<span class="image right"><img src="../resources/assets/images/pic02.jpg" alt="" /></span>					
	</div>
</div>
<br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="{{ url('/req')}}">
					<div class="form-group">
						<div class="col-md-6">
							<input type="text" name="Tname" id="Tname" placeholder="Tutor Name" value="{{ $mentor->name }}"disabled/>
						</div>
						<div class="col-md-6">
							<input type="text" name="tutorid" id="tutorid" placeholder="Tutor ID" value="Mentor ID: {{ $mentor->id }}" disabled/>
						</div>
					</div>
					<div class="form-group">
								
					<div class="select-wrapper col-md-12">
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
					<div class="form-group">
						<div class="col-md-12">
							<textarea name="text" id="question" placeholder="Enquiry" rows="4"></textarea>
						</div>
					</div>
					<br>
					<center>
						<ul class="actions uniform">
							<li><a href="{{ url('/rereq') }}" class="button special">Send</a></li>
						</ul>
					</center>
				</form>
			</div>
		</div>
	</div>
</div>


	

@endsection
