@extends('layouts.app')
@section('content')
<!--bootstrap rating src
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>-->

<!-- js star rating-->

<script src="assets/js/star.js"></script>

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

	<section id="one" class="main style1 special">
	<div class="container">
    <header class="major">
								<h2>Rate your previous session</h2>
							</header>


      <div class="star-rating">
        <span class="fa fa-star-o" data-rating="1"></span>
        <span class="fa fa-star-o" data-rating="2"></span>
        <span class="fa fa-star-o" data-rating="3"></span>
        <span class="fa fa-star-o" data-rating="4"></span>
        <span class="fa fa-star-o" data-rating="5"></span>
        <input type="hidden" name="whatever1" class="rating-value" value="2.56">
 
   
  </div><ul class="actions uniform">
								<li><a href="home" class="button special">Submit</a></li>

							</ul>
  </div>

</div>
<!-- bootstrap rating
</section>
<section id="one" class="main style1 special">
	<div class="container">
    <header class="major">
								<h2>Rate your previous session</h2>
							</header>


    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2">

  
  </div><ul class="actions uniform">
								<li><a href="home" class="button special">Submit</a></li>

							</ul>
  </div>

</div>
</section>-->

<style type="text/css">
	.star-rating {
  line-height:32px;
  font-size:1.25em;
}

.star-rating .fa-star{
	color: yellow;}
</style>


@endsection
