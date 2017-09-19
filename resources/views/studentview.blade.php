@extends('layouts.app')

@section('content')

<section id="one" class="main style1 special">
	<div class="container">
		<ul class="actions">
			<li>
			<input type="text" name="search" id="search" placeholder="Search" />
			</li>
			<li>
			<a href="#" class="button special" value="Search">Search</a>

			<a href="{{ url('/preferences') }}" class="button special" value="Search">Preferences</a>
			</li>

		</ul>
	</div>
</section>

<div class="table-wrapper">
	<table>
		<thead>
			<tr>
				<th><h2>Active requests: </h2></th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="8u 12u$(small)">
						<ul class="alt">
							<li>
								<span class="image left">
									<img src="../resources/assets/images/pic02.jpg" alt="" />
								</span>
								<h5>Name: Rory</h5>
								<h5>Gender: Male</h5>
								<h5>Skill: java</h5>
								<h5>Program: Bachelor in Information Technology</h5>
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
				<th><h2>Tutors Lists: </h2></th>
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
								<form class="form-horizontal" role="form" method="POST" action="{{ url('/requesting') }}">
									<h5>Name: {{ $mentors->name }}</h5>
									<h5>Gender: {{ $mentors->gender}}</h5>
									<h5>E-mail: {{ $mentors->email}}</h5>
									<h5>Skill: Java</h5>
									<h5>Program: Bachelor in Information Technology</h5>
									<input type="radio" id="demo-priority-low" name="demo-priority" checked>
									<label for="demo-priority-low"><h5>Active</h5></label>
			                        <input type="hidden" id="mentor_id_input" name="mentor_id" value="{{ $mentors->id }}">
									<button type="submit" class="button special small">
										Request
									</button>
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