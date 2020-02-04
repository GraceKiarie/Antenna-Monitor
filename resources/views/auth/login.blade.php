<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Login | {{ config('app.name')}} </title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="atonga">

    <link href="./assets/css/login.css" rel="stylesheet">

</head>

<body>

    <div class="login">
        <h1>antennae monitor</h1>
        <form action="{{url('login')}}" method="post">
            {{ csrf_field() }}

            @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
            <input type="text" name="email" placeholder="Email" required="required" />

            @if ($errors->has('password'))
                <span class="error">{{ $errors->first('password') }}</span>
            @endif
            <input type="password" name="password" placeholder="Password" required="required" autocomplete="off" />
            <button type="submit" class="btn btn-primary btn-block btn-large">LOGIN</button>
        </form>
    </div>

</body>

</html>