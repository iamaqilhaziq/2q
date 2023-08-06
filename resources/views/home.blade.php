@extends('layouts.master')

@section('content')
<div id="register-customer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 ml-auto mr-auto">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Sign In</h3>
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <div class="row ">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Email:</label>
                                        <input type="email" class="form-control form-input  @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Email Address">
                                        @if($errors->has('email'))
                                        <div class="error text-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                        @if(session('email_message'))
                                        <div class="error text-danger">{{ session('email_message') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Password: </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                            <div class="input-group-append ">
                                                <span class="input-group-text bg-white toggle-password reveal" id="toggle-pw">
                                                    <i class="fa fa-eye icon"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @if($errors->has('password'))
                                        <div class="error text-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                        @if(session('password_message'))
                                        <div class="error text-danger">{{ session('password_message') }}</div>
                                        @endif
                                        <small class="text-secondary">Password should contain at minimum 8 characters</small>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="w-100 form-submit">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection