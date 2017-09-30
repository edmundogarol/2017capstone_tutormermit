	@extends('layouts.app')

	@section('content')

	<!-- {{ $requests}} {{ $students }} 

	{{ $mentorsessions }} -->

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
			@if ($errors->any())
				@if (str_contains($errors->first(), 'accepted'))
					<div class="alert alert-success">
						<strong>Success:</strong> {{ $errors->first() }}
					</div>
				@else
					<div class="alert alert-info">
						<strong>Info:</strong> {{ $errors->first() }}
					</div>
				@endif
			@endif
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
				@foreach ($mentorsessions as $sessions)
				<tr>
					<td>
						<div class="8u 12u$(small)">
							<ul class="alt">
								<li>
									<span class="image left">
										<img src="../resources/assets/images/pic02.jpg" alt="" />
									</span>
									<h5>Name: {{ $sessions->name }}</h5>
									<h5>Email: {{ $sessions->email }}</h5>
									<!-- <a href="{{ url('/preferences') }}" class="button special" value="Search">Preferences</a> !-->
									<a href="{{ url('/') }}" class="button special" value="Search">End Session</a>
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
										<h5>Match: {{ $requests->match_perc }}%</h5>
										<h5>Gender: {{ $requests->gender }}</h5>
										<h5>Subject: {{ $requests->subject }}</h5>
										<h5>Enquiry: {{ $requests->enquiry }}</h5>
										<!-- <a class="button special" href="{{ url('req/'.$requests->id) }}" value="Request" class="button special small">View Request</a> -->
										<br>
										<a href="{{ url('/accept/'.$requests->id) }}" class="button special" value="Search">Accept</a>
										<a href="{{ url('/decline/'.$requests->id) }}" class="button special" value="Search">Decline</a>
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
