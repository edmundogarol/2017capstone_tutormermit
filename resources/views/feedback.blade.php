@extends('layouts.app')
@section('content')

<section id="one" class="main style1 special">
<div class="container">
	<header class="major">
	<h2>Submit feedback for (name)</h2>
	</header>
	<form>

		<fieldset class="rating">
    	<input type="radio" id="star5" name="rating" value="5" /><h5 class = "full" for="star5" title="Excellent"></h5>
    	<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Above Average"></label>
    	<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Average"></label>
    	<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Below Average"></label>
    	<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Poor"></label>
		</fieldset>
	
	<button class="special button">Submit Feedback</button>
	</form>
	</div>
</section>

@endsection