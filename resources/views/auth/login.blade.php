@extends('layouts.app')

@section('content')
    <div class="section"></div>
    <main>
        <div class="container">
            <div class="z-depth-1 grey lighten-4 row"
                 style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                <form class="col s12" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col s12'>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' value='{{ old('email') }}'
                                   type='email'
                                   name='email'
                                   id='email'/>
                            <label for='email'>Enter your email</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='password' name='password' id='password'/>
                            <label for='password'>Enter your password</label>
                        </div>
                    </div>

                    <br/>

                    <div class='row'>
                        <button type='submit' name='btn_login'
                                class='col s12 btn btn-large waves-effect indigo'>Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
