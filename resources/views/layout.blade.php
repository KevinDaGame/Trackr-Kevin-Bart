<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @yield('title')

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Trackr</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                    aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/packages">{{__('Packages')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/customers">{{__('Customers')}}</a>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">{{__('Login')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">{{__('Register')}}</a>
                        </li>
                    @endguest
                    @auth()
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">{{__('Logout')}}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</head>
<body>
<div class="container">
    @yield('body')
</div>
@if(session()->has('success'))
    <div class="alert alert-dismissible alert-success position-fixed bottom-0 end-0 m-3">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <p>{{__(session()->get('success'))}}</p>
    </div>
@endif
</body>
</html>
