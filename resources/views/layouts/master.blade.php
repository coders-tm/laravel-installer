<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (trim($__env->yieldContent('template_title')))
            @yield('template_title') |
        @endif {{ trans('installer::messages.title') }}
    </title>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-96x96.png') }}"
        sizes="96x96" />
    <link href="{{ asset('installer/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('installer/css/style.min.css') }}" rel="stylesheet" />
    @yield('style')
</head>

<body>
    <div class="master">
        <div class="box">
            <div class="header">
                <h1 class="header__title">@yield('title')</h1>
            </div>
            <ul class="step">
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('LaravelInstaller::final') }}">
                    <i class="step__icon fa fa-server" aria-hidden="true"></i>
                </li>
                <li class="step__divider"></li>
                <li
                    class="step__item {{ isActive('LaravelInstaller::environment') }} {{ isActive('LaravelInstaller::environmentWizard') }}">
                    @if (Request::is('install/environment'))
                        <a href="{{ route('LaravelInstaller::environmentWizard') }}">
                            <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                        </a>
                    @else
                        <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('LaravelInstaller::permissions') }}">
                    @if (Request::is('install/permissions') || Request::is('install/environment'))
                        <a href="{{ route('LaravelInstaller::permissions') }}">
                            <i class="step__icon fa fa-key" aria-hidden="true"></i>
                        </a>
                    @else
                        <i class="step__icon fa fa-key" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('LaravelInstaller::requirements') }}">
                    @if (Request::is('install') ||
                            Request::is('install/requirements') ||
                            Request::is('install/permissions') ||
                            Request::is('install/environment'))
                        <a href="{{ route('LaravelInstaller::requirements') }}">
                            <i class="step__icon fa fa-list" aria-hidden="true"></i>
                        </a>
                    @else
                        <i class="step__icon fa fa-list" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('LaravelInstaller::welcome') }}">
                    @if (Request::is('install') ||
                            Request::is('install/requirements') ||
                            Request::is('install/permissions') ||
                            Request::is('install/environment'))
                        <a href="{{ route('LaravelInstaller::welcome') }}">
                            <i class="step__icon fa fa-home" aria-hidden="true"></i>
                        </a>
                    @else
                        <i class="step__icon fa fa-home" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
            </ul>
            <div class="main">
                @if (session('message'))
                    <p class="alert text-center">
                        <strong>
                            @if (is_array(session('message')))
                                {{ session('message')['message'] }}
                            @else
                                {{ session('message') }}
                            @endif
                        </strong>
                    </p>
                @endif

                @yield('container')
            </div>
        </div>
    </div>
    <script src="{{ asset('installer/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('installer/js/bootstrap.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
