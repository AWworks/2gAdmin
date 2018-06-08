@extends('auth.masterAuth')

@section('content')
    <form id="forms" class="uk-form forms" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <h4>Forgot Password</h4>

        @if ($errors->has('email'))
            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif

        <div class="form-group">
            <div class="uk-form-icon uk-width-1">
                <i class="uk-icon-envelope"></i>
                <input class="uk-width-1" placeholder="Email address" type="email"
                       name="email" value="{{ old('email') }}" required autofocus/></div>
        </div>

        <div class="form-group">
            <button class="uk-button uk-width-1" type="submit">Submit <i
                        class="uk-icon-chevron-circle-right"></i></button>
        </div>

    </form>
@endsection
{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}
