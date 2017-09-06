@extends('layouts.app')

@section('content')
	
<central>
	<div class="container">
	<br>
	<div class="row">
	   <div class="6u 12u$(medium)">
	      <span class="leftcol">
			<h2><strong> Tutor Name</strong> </h2> 
			<h4>Tutor ID: <strong>number</strong></h4>
	       </span>
	    </div>

		<div class="6u 12u$(medium)">
		<br>
		  <span class="image right"><img src="../resources/assets/images/pic02.jpg" alt="" />tutor photo</span>					
		</div>
	</div>
	<hr>
	<br>
	
	
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			
			
				<div class="panel-body">
				
						<form class="form-horizontal">

							<div class="form-group">
								

								<div class="col-md-6">
									<h4>Course:</h4>
								</div>
								<div class="col-md-6">
								<h4>dsadjsal</h4>
								</div>
							</div>

				        
				<div class="form-group">
					

					<div class="col-md-6">
						<h4>Skill:</h4>
					</div>
					<div class="col-md-6">
					<h4>dsadjsal</h4>
					</div>
				</div>
				
				<div class="form-group">
					

					<div class="col-md-6">
						<h4>Gender:</h4>
					</div>
					<div class="col-md-6">
					<h4>dsadjsal</h4>
					</div>
				</div>
				
				<div class="form-group">
					

					<div class="col-md-6">
						<h4>balabala:</h4>
					</div>
					<div class="col-md-6">
					<h4>dsadjsal</h4>
					</div>
				</div>
		<br>
						
						<div class ="row">
							<div class="6u 12u$(medium)">

							<ul class="actions uniform">
								<li><a href="#" class="button special">Bakc</a></li>

							</ul>
							</div>
                           <div class="6u 12u$(medium)">

							<ul class="actions uniform">
								<li><a href="{{ url('/req') }}" class="button special">Request</a></li>

							</ul>
							
							</div>
							
						</form>

					</div>
				</div>
			</div>

		</div>
</div>
</central>


@endsection
