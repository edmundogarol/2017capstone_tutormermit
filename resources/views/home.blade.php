@extends('layouts.app')

@section('content')
<section id="one" class="main style1 special">
                <div class="container">
                <ul class="actions uniform">
                <li><a class="button-route" href="{{ url('/studentview') }}">
                        <button type="button" class="button special">
                            I need a mentor now!
                        </button>
                        </a>
                </li>
                </ul>

                <h2>OR</h2>

                 <ul class="actions uniform">
                    <li><a class="button-route" href="{{ url('/tutor') }}">
                            <button type="button" class="button special">
                                I want to mentor!  
                            </button>
                        </a> 
                    </li>
                </ul>
            
            </div>
</section>

<style>

    .btn-secondary{
        width: 45%;
        padding: 100px;
        margin: 17px;
    }   

    .button-route{
        border-bottom: none;
    }

    .choice-box{
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

</style>
@endsection
