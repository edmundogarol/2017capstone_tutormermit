@extends('layouts.app')

@section('content')


<div class="container">
<br>
<div class="row">
   <div class="6u 12u$(medium)">
      <span class="leftcol">
		<h1>Send Request: To <strong> tutor name</strong> </h1> 
		
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
			
					<form class="form-horizontal" method="POST" action="#">

						<div class="form-group">
							

							<div class="col-md-6">
								<input type="text" name="Tname" id="Tname" placeholder="Tutor Name" />
							</div>
							<div class="col-md-6">
								<input type="text" name="tutorid" id="tutorid" placeholder="Tutor ID" />
							</div>
						</div>

						
		
						<div class="form-group">
							
							<div class="col-md-12">
								<input type="text" name="subject" id="subject" placeholder="Subject" />

							</div>
						</div>

						<div class="form-group">
							
							<div class="col-md-12">
								<input type="text" name="email" id="email" placeholder="Email" />
							</div>
						</div>
						<div class="form-group">

							<div class="col-md-12">
						<textarea name="text" id="question" placeholder="Question" rows="4"></textarea>
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
