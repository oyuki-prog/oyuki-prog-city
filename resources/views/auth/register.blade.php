@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center pt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="d-flex col-md-5 align-items-center">
                                <label for="name" class="col-md-9 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-3 text-center required">必須</div>
                            </div>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="d-flex col-md-5 align-items-center">
                                <label for="email" class="col-md-9 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-3 text-center required">必須</div>
                            </div>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="d-flex col-md-5 align-items-center">
                                <label for="password" class="col-md-9 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-3 text-center required">必須</div>
                            </div>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="d-flex col-md-5 align-items-center">
                                <label for="password-confirm" class="col-md-9 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-3 text-center required">必須</div>
                            </div>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="d-flex col-md-5 align-items-center">
                                <label for="prefecture_id" class="col-md-9 col-form-label text-md-right">{{ __('Prefecture of origin') }}</label>
                            </div>
                            <div class="col-md-6">
                                <select name="prefecture_id" id="prefecture_id" class="form-control">
                                        <option value="">---</option>
                                    @foreach ($prefectures as $prefecture)
                                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                                    @endforeach
                                </select>

                                @error('prefecture_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary px-5">
                                    {{ __('Register') }}
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
