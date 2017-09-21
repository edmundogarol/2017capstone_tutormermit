@extends('layouts.app')

@section('content')

{{ $requests }}
{{ $preferences }}

<div class="table-wrapper">
	<table>
		<thead>
			<tr>
				<th><h4>Preferences: </h4></th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="8u 12u$(small)">
						<ul class="alt">
							<li>
								<a href="{{ url('/preferences') }}" class="button special" value="Search">Preferences</a>
							</li>						
						</ul>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>


<div class="table-wrapper">
	<table>
		<thead>
			<tr>
				<th><h4>Active requests: </h4></th>
				
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
								<h5>Request ID: {{ $requests->id }}</h5>
								<h5>Mentor's ID: {{ $requests->tutor_id }}</h5>
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
				<th><h4>Tutors Lists: </h4></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($mentors as $mentors)
			<tr>
				<td>
					<div class="8u 12u$(small)">
						<ul class="alt">
							<li>
								<span class="image left"><img src="../resources/assets/images/pic02.jpg" alt="" /></span>
                        		{{ csrf_field() }}
									<h5>Name: {{ $mentors->name }}</h5>
									<h5>Gender: {{ $mentors->gender }}</h5>
									<h5>E-mail: {{ $mentors->email }}</h5>
									<h5>Point: </h5>
									<h5>Skill: Java</h5>
									<h5>Program: Bachelor in Information Technology</h5>
									<input type="radio" id="demo-priority-low" name="demo-priority" @if ($mentors->active == 1) ? checked : '' @endif disabled>
									<label for="demo-priority-low"><h5>Active</h5></label>

									<a class="button special" href="{{ url('req/'.$mentors->id) }}" value="Request" class="button special small">Request</a>
								</form>
							</li>					
						</ul>
					</div>
				</td>
			</tr>
		   	@endforeach
		</tbody>					
	</table>
</div>

@endsection