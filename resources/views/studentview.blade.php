@extends('layouts.app')

@section('content')
			

<section id="one" class="main style1 special">

					<div class="container">
						<header class="major">
							<h2>CURRENT PREFERENCES: </h2>
						</header>
						<ul class="alt">
							<li>
								
								<h5>Age range: {{ $preferences->min_age}} to {{ $preferences->max_age}}</h5>
								 @if ($preferences->gender == null)
                                   <h5>Gender: Not set</h5>
                                  
                                @else
                                	<h5>Gender: {{$preferences->gender}}</h5>

                                @endif
                                <h5>Subjects: {{ $preferences->subjects}}</h5>

								<a href="{{ url('/preferences') }}" class="button special" value="preferences">Update preference</a>
								
							</li>						
						</ul>
						@if ($errors->any())
							@if (str_contains($errors->first(), 'cancelled'))
								<div class="alert alert-info">
									<strong>Info:</strong> {{ $errors->first() }}
								</div>
							@endif
						@endif
			
					</div>
					<br>
				</section>
		
<div class="table-wrapper">
	<table>
		<thead>
			<tr>
			
				<th><h4>ACTIVE REQUEST: </h4></th>
					@if ($errors->any())
						<div class="alert alert-danger">
	  						<strong>Error!</strong> {{ $errors->first() }}
						</div>
					@endif

		
			</tr>
		</thead>
		<tbody>
		
         @foreach ($requests as $requests)

			<tr>
				<td>
					<div class="8u 12u$(small)">
						<ul class="alt">
							<li>
								<span class="image left">
									<img src="../resources/assets/images/pic02.jpg" alt="" />
								</span>
								<h5>Request ID: {{ $requests->req_id }}</h5>
								<h5>Mentor: {{ $requests->name}}</h5>
								<h5>Subject: {{ $requests->subject }}</h5>
								<h5>Status: {{ $requests->status }}</h5>
								<a class="button special" href="{{ url('rereq/'.$requests->req_id) }}" value="Request" class="button special small">View</a>

							</li>						
						</ul>
					</div>
				</td>
			</tr>

		   	@endforeach

<div class="table-wrapper">
	<table>
		<thead>
			<tr>
			
				<th><h4>ACTIVE SESSIONS</h4></th>
		
			</tr>
		</thead>
		<tbody>
		
        
 @foreach ($mentorsessions as $mentorsessions)

			<tr>
				<td>
					<div class="8u 12u$(small)">
						<ul class="alt">
							<li>
								<span class="image left">
									<img src="../resources/assets/images/pic02.jpg" alt="" />
								</span>
								<h5>Session ID: {{$mentorsessions->session_id}}</h5>
								<h5>Mentor's name: {{$mentorsessions->name}}</h5>
								<h5>E-mail: {{$mentorsessions->email}}</h5>
							

							</li>						
						</ul>
					</div>
				</td>
			</tr>

	
@endforeach
     

		
		</tbody>
	</table>
</div>

<div class="table-wrapper">
	<table>
		<thead>
			<tr>
				<th><h4>ACTIVE MENTORS: </h4></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($mentors as $mentors)
			<tr>
				
				<td>

				<span class="image left"><img src="../resources/assets/images/pic02.jpg" alt="" /></span>
                        		{{ csrf_field() }}
									<h5>Name: {{ $mentors->name }}</h5>
									<h5>Gender: {{ $mentors->gender }}</h5>
									<h5>E-mail: {{ $mentors->email }}</h5>
									<h5>Skill: Java</h5>
									<h5>Program: Bachelor in Information Technology</h5>
									<input type="radio" id="demo-priority-low" name="demo-priority" @if ($mentors->active == 1) ? checked : '' @endif disabled>
									<label for="demo-priority-low"><h5>Active</h5></label>
									<a class="button special" href="{{ url('req/'.$mentors->id) }}" value="Request" class="button special small">Request</a>
									
								</form>
						
					
				</td>
				<td>
				
				
				</td>
			</tr>
		   	@endforeach
		</tbody>					
	</table>
</div>

@endsection