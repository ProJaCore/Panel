{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.auth')

@section('title')
    Reset Password
@endsection

@section('content')
<div class="login-box-body">
    @if (count($errors) > 0)
        <div class="callout callout-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            @lang('auth.auth_error')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p class="login-box-msg">@lang('auth.reset_password_text')</p>
    <form id="resetForm" action="{{ route('auth.reset.post') }}" method="POST">
        <div class="form-group">
            <label for="email" class="control-label">@lang('strings.email')</label>
            <div>
                <input type="text" class="form-control" name="email" id="email" value="{{ $email or old('email') }}" required autofocus placeholder="@lang('strings.email')" />
                @if ($errors->has('email'))
                    <span class="help-block text-red small">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label">@lang('strings.password')</label>
            <div>
                <input type="password" class="form-control" name="password" id="password" required placeholder="@lang('strings.password')" />
                @if ($errors->has('password'))
                    <span class="help-block text-red small">
                        {{ $errors->first('password') }}
                    </span>
                @endif
                <p class="text-muted"><small>@lang('auth.password_requirements')</small></p>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label">@lang('strings.confirm_password')</label>
            <div>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required placeholder="@lang('strings.confirm_password')" />
                @if ($errors->has('password_confirmation'))
                    <span class="help-block text-red small">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <button type="submit" class="btn btn-primary btn-block btn-flat g-recaptcha" @if(config('recaptcha.enabled')) data-sitekey="{{ config('recaptcha.website_key') }}" data-callback='onSubmit' @endif>@lang('auth.reset_password')</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    @parent
    @if(config('recaptcha.enabled'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
        function onSubmit(token) {
            document.getElementById("resetForm").submit();
        }
        </script>
     @endif
@endsection
