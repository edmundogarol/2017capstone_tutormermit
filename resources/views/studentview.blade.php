@extends('layouts.app')

@section('content')

{{ $mentors }}

<section id="one" class="main style1 special">

<div class="container">
							<ul class="actions">
								<li>
								<input type="text" name="search" id="search" placeholder="Search" />
								</li>
								<li>
								<a href="#" class="button special" value="Search">Search</a>
								</li>

							</ul>
							</div>
							</section>




<div class="table-wrapper">



							<table>
								<thead>
									<tr>
										<th><h2>Tutors Lists: </h2></th>
										
									</tr>
								</thead>
								<tbody>

							
									<tr>
									<td>
	
										<div class="8u 12u$(small)">
										<ul class="alt">
										<li>
											<span class="image left"><img src="../resources/assets/images/pic02.jpg" alt="" /></span>

											<h5>Rory</h5>
													<h5>Skill: java...</h5>
													<h5>Program: Bachelor in Information Technology</h5>
													<a href="{{ url('/request') }}" class="button special small" value="request">Request</a>

										</li>
										</td>
										
										</ul>
										</div>
										</td>

									</tr>
						
									<tr>
									<td>
	
										<div class="8u 12u$(small)">
										<ul class="alt">
										<li>
											<span class="image left"><img src="../resources/assets/images/pic02.jpg" alt="" /></span>

											<h5>Yung</h5>
													<h5>Skill: java...</h5>
													<h5>Program: Bachelor in Information Technology</h5>
												<a href="{{ url('/request') }}" class="button special small" value="request">Request</a>

										</li>
										</td>
										
										</ul>
										</div>
										</td>

									</tr>
									
									<tr>
									<td>
	
										<div class="8u 12u$(small)">
										<ul class="alt">
										<li>
											<span class="image left"><img src="../resources/assets/images/pic02.jpg" alt="" /></span>

											<h5>Prashay</h5>
													<h5>Skill: java...</h5>
													<h5>Program: Bachelor in Information Technology</h5>
													<a href="{{ url('/req') }}" class="button special small" value="request">Request</a>
										</li>
										</td>
										
										</ul>
										</div>
										</td>
									</tr>

								
								
									

									<tr>
									<td>
	
										<div class="8u 12u$(small)">
										<ul class="alt">
										<li>
											<span class="image left"><img src="../resources/assets/images/pic02.jpg" alt="" /></span>

											<h5>Ken</h5>
													<h5>Skill: java...</h5>
													<h5>Program: Bachelor in Information Technology</h5>
													<a href="{{ url('/request') }}" class="button special small" value="request">Request</a>

										</li>
										</td>
										
										</ul>
										</div>

										</td>

									</tr>


							
									
							
						
							</tbody>
													
						
							</table>


	</div>

					




@endsection