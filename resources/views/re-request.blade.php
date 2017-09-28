@extends('layouts.app')

@section('content')

	<central>
	<div class="container">
	<br>
	<div class="row">
	   <div class="6u 12u$(medium)">
	      <span class="leftcol">
			<h1>Request ID: <strong> {{ $request['request_id'] }}</strong> </h1> 
			
	       </span>
	    </div>

		<div class="6u 12u$(medium)">
		<br>
		  <span class="image right"><img src="../resources/assets/images/pic02.jpg" alt="" />tutor photo</span>					
		</div>
	</div>
	<br>
	
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			
			
				<div class="panel-body">
				
						<form class="form-horizontal" method="POST" action="#">

							<div class="form-group">
								

								<div class="col-md-6">
									<h4>Tutor Name :</h4>
								</div>
								<div class="col-md-6">
								<h5>{{ $request['mentor_name'] }}</h5>
								</div>
							</div>

				        
				<div class="form-group">
					

					<div class="col-md-6">
						<h4>Tutor ID :</h4>
					</div>
					<div class="col-md-6">
					<h5>{{ $request['mentor_id'] }}</h5>
					</div>
				</div>
					<div class="form-group">
						

						<div class="col-md-6">
							<h4>Subject :</h4>
						</div>
						<div class="col-md-6">
						<h5>{{ $request['subject']}}</h5>
						</div>
					</div>							
							<div class="form-group">
								

								<div class="col-md-6">
									<h4>Question :</h4>
								</div>
								<div class="col-md-12">
								<h5>{{ $request['enquiry'] }}</h5>
								</div>
							</div>
							
						</div>
						<br>
						
						<div class ="row">
							<div class="6u 12u$(medium)">

							<ul class="actions uniform">
								<li><a href="{{ url('/studentview') }}" class="button special">Confirm</a></li>

							</ul>
							</div>
                           <div class="6u 12u$(medium)">

							<ul class="actions uniform">
								@if ($request['status'] == 'Declined')
									<li><a href="{{ url('/cancel/'.$request['request_id']) }}" class="button special">Delete</a></li>
								@else
									<li><a href="{{ url('/cancel/'.$request['request_id']) }}" class="button special">Cancel</a></li>
								@endif
							</ul>
							
							</div>
							
						</form>

					</div>
				</div>
			</div>

		</div>

</central>

@endsection
