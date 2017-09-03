@extends('layouts.leftht')

@section('content')


	<span class="leftcol">
		<h1>Send Request: To <strong> tutor name</strong> </h1> 
		
    </span>

<section>
	<div class="table-wrapper">
		
			<form method="post" action="#">
				<div class="row uniform 50%">

                 <div class="6u 12u$(xsmall)">
					<input type="text" name="Tname" id="Tname" placeholder="Tutor Name" /></div>
					
					<div class="6u 12u$(xsmall)">
					<input type="text" name="tutorid" id="tutorid" placeholder="Tutor ID" /></div>
					<div class="12u$">
					<input type="text" name="subject" id="subject" placeholder="Subject" /></div>
					<div class="12u$">
					<input type="text" name="email" id="email" placeholder="Email" /></div>
					
					<div class="12u$"><textarea name="text" id="question" placeholder="question" rows="4"></textarea></div>
				</div>
			</form>
			<ul class="actions uniform">
				<li><a href="#" class="button special">Send</a></li>

			</ul>

</div>
</div>


	</section>

@endsection
