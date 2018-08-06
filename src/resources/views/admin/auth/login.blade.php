@extends('laravel-blog::layouts.auth')

@section('content')
      <form method="POST" action="{{ route('admin.blog.login') }}" aria-label="{{ __('Login') }}">
          @csrf
          <div>
              <label for="email">{{ __('E-Mail Address') }}</label>
              <div>
                  <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                      <span>
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div>
              <label for="password">{{ __('Password') }}</label>
              <div>
                  <input id="password" type="password" name="password" required>
                  @if ($errors->has('password'))
                      <span>
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div>
              <div>
                  <div>
                      <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                      <label for="remember">
                          {{ __('Remember Me') }}
                      </label>
                  </div>
              </div>
          </div>

          <div>
              <div>
                  <button type="submit">
                      {{ __('Login') }}
                  </button>
              </div>
          </div>
      </form>
@endsection
