@extends('auth.layouts.app-login')
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-4 mb-0">
                        <div class="card-body">
                            <h1>Login</h1>
                            <form action="{{ route('login.post') }}" method="post">
                                @csrf
                                <p class="text-medium-emphasis">Sign In to your account</p>
                                <div class="input-group mb-2"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                        </svg></span>
                                    <input class="form-control" name="username" id="username" type="text" placeholder="Username">
                                </div>
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                                <div class="input-group mb-1"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg></span>
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Password">
                                </div>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="submit">Login</button>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="card col-md-5 text-white">
                    <div align="center" class="mt-5">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" width="150" height="150">
                        <div class="text-center text-black mx-2">
                            <h2>SISTEM AKADEMIK SMA Al Fusha</h2>
                        </div>
                    </div>
                    <div class="card-body text-center my-1">
                        <div>
                            <h2>SISTEM AKADEMIK SMA Al Fusha</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
