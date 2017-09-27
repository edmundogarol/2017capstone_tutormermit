@extends('layouts.app')

@section('content')

<!-- {{ $requests}} {{ $students }} -->

<head>
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
</head>
<p align="center"><h2 align="center">Welcome Mentor {{ Auth::user()->name }}!</h2></p>
<section id="one" class="main style1 special">
	<div class="container">
		<ul class="actions">
			<li>
				<a href="{{ url('/preferences') }}" class="button special" value="Search">Preferences</a>
			</li>

		</ul>
	</div>
</section>
<div class="table-wrapper">
	<table>
		<thead>
			<tr>
				<th>
					<h2>Scheduled Sessions:
					</h2>
				</th>
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
								<h5>Name: Prashay</h5>
								<h5>Gender: Male</h5>
								<h5>Email: p@n.com
									<h5>Subject: Programming Project 1</h5>
									<h5>Program: Bachelor in Information Technology</h5>
									<h5>Time: Wednesday 2:00PM</h5>
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
					<th><h2>Student Requests: </h2></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($requests as $requests)
				<tr>
					<td>
						<div class="8u 12u$(small)">
							<ul class="alt">
								<li>
									<span class="image left"><img src="../resources/assets/images/pic02.jpg" alt="" /></span>
									{{ csrf_field() }}
									<h5>Name: {{ $requests->name }}</h5>
									<h5>Gender: {{ $requests->gender }}</h5>
									<h5>E-mail: {{ $requests->email }}</h5>
									<h5>Subject: Java</h5>
									<h5>Program: Bachelor in Information Technology</h5>
									<input type="radio" id="demo-priority-low" name="demo-priority" @if ($requests->active == 1) ? checked : '' @endif disabled>
									<label for="demo-priority-low"><h5>Active</h5></label>

									<a class="button special" href="{{ url('rereq/'.$requests->id) }}" value="Request" class="button special small">View Request</a>
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
<br>
@endsection
