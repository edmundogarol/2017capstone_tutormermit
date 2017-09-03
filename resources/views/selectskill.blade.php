@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../resources/assets/css/main.css" />
<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<br>
			<div class="panel-body">
			
			<center>
				   <header class="major">
				   
							<h2><strong>Select Skills</strong></h2>
				   
					</header>
					 </center>

						<center>
						<div class="row">
						<!-- 
						foreach
						<br>
						<div class="gender-radio 3u 12u$(small)">
							<input type="radio" id="" name="" value="" required>
							<label for="">skill name</label>
						</div> 
						
						
						
						
						-->
						
						<div class="6u 12u$(medium)">
														
									<br>				
									<div class="gender-radio 3u 12u$(small)">
										<input type="radio" id="" name="" value="" required>
										<label for="">JAVA</label>
									</div>
									<br>				
									<div class="gender-radio 3u 12u$(small)">
										<input type="radio" id="" name="" value="" required>
										<label for="">JAVA</label>
									</div>
									<br>				
									<div class="gender-radio 3u 12u$(small)">
										<input type="radio" id="" name="" value="" required>
										<label for="">JAVA</label>
									</div>
						</div>
						<div class="6u 12u$(medium)">
									<br>				
									<div class="gender-radio 3u 12u$(small)">
										<input type="radio" id="" name="" value="" required>
										<label for="">JAVA</label>
									</div>
									<br>				
									<div class="gender-radio 3u 12u$(small)">
										<input type="radio" id="" name="" value="" required>
										<label for="">JAVA</label>
									</div>
									<br>				
									<div class="gender-radio 3u 12u$(small)">
										<input type="radio" id="" name="" value="" required>
										<label for="">JAVA</label>
									</div>
									
								</div>
						</div>
						</center>
                      
				
						<center>
							<div class="form-group">
								<button type="submit" class="button special">Match!</button>

							</div>
						</center>
					</form>
				</div>
			</div>
		</div>
	</div>

	<style>
		.required:after {
			content: '*';
			color: red;
			padding-left: 5px;
		}
	</style>

@endsection
