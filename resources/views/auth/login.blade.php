@extends('layouts.app')

@section('content')


<div class="container">


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-body">
            <center>
                   <header class="major">
                   
                            <h2><strong>Login</strong></h2>
                   
                    </header>
                     </center>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" >E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="username/e-mail">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <center>

                        <!--checkbox not working-->
                        <div class="form-group">
                                   <input type="checkbox" name="remember" class="checkbox" value=" {{ old('remember') ? 'checked' : ''}}" > Remember Me
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password? </a><br>
                                    <br>
                                    <br>
                                    <button type="submit" class="button special"> Login</button>
                        </div>
                        </center>
                    </form>
                    <center>
                   <header class="major">
                        <h2><strong>OR</strong></h2>                                         
                    </header>
                    </center>
                    <center>
                        <a href="{{ url('/register') }}">
                            <button type="submit" class="button special register-login"> Register</button>
                        </a>
                    </center>
                </div>
        </div>
    </div>
</div>
 @endsection
