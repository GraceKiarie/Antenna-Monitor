<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Login | {{ config('app.name')}} </title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="adc">

    <link href="./assets/css/login.css" rel="stylesheet">

</head>

<body>

<div class="login">
    <h1>antenna monitor</h1>
    <form action="{{url('login')}}" method="post" autocomplete="off">
        {{ csrf_field() }}

        @if ($errors->has('email'))
            <span class="error">{{ $errors->first('email') }}</span>
        @endif
        <input type="text" name="email" placeholder="Email" required="required"/>

        @if ($errors->has('password'))
            <span class="error">{{ $errors->first('password') }}</span>
        @endif
        <input type="password" name="password" placeholder="Password" required="required" autocomplete="off"/>

        <button type="submit" class="btn btn-primary btn-block btn-large">LOGIN</button>
    </form>
    <br>
    <a href="{{url('password/reset')}}">Forgot Password?</a>
</div>

</body>

</html>