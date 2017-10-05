@extends('layouts.app')
@section('content')

<html>	
<head>
	<link rel="stylesheet" type="text/css" href="../assets/css/ratings.css">
</head>
<body>
	<h1>Submit feedback for (name)</h1>
	<form>
	<div>
		<fieldset class="rating">
    	<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Excellent"></label>
    	<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Above Average"></label>
    	<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Average"></label>
    	<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Below Average"></label>
    	<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Poor"></label>
		</fieldset>
	</div>
	<button style="clear:left;">Submit Feedback</button>
	</form>
</body>
</html>

@endsection