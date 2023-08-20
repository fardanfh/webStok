<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | IMS</title>
    <!-- Log on to codeastro.com for more projects! -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon.png')}}">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <!-- <div class="logo text-center"><img src="{{asset('assets/img/logo-dark.png')}}" alt="IMS Logo"></div> -->
                                <p class="lead">Login to your account</p>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="form-auth-small" method="POST" action="{{ route('reseller.login.post') }}">
                                @csrf
                            
                                <div class="form-group">
                                    <label for="email" class="control-label sr-only">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                                </div>
                            
                                <div class="form-group">
                                    <label for="password" class="control-label sr-only">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                                </div>
                        
                            
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>
</html>
