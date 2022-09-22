@extends('pages.app')

@section('content')

<x-wrapper>
    @if (session('error'))
    <x-alert type="danger" message="{{ session('error') }}" />
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="form-outline mb-3">
                            <label for="email" class="form-label">
                                <span>{{ __('Email') }}</span>
                                <span class="fw-bold text-danger">*</span>
                            </label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="your@email.xyz" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-outline mb-3">
                            <label for="password" class="form-label">
                                <span>{{ __('Password') }}</span>
                                <span class="fw-bold text-danger">*</span>
                            </label>
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Enter your password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @if (Route::has('password.request'))
                        <div class="mb-3">
                            <a class="app-link" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-wrapper>

@endsection

@section('page-scripts')

<script src="{{ mix('js/pages/login.js') }}" defer></script>

@endsection
