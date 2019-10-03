<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if(View::hasSection('title'))
            @yield('title') | {{ config('tabler.suffix') }}
        @else
            {{ config('tabler.suffix') }}
        @endif
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i&amp;subset=latin-ext">
    <link href="{{ asset('admin/assets/css/dashboard.css') }}" rel="stylesheet"/>
    @stack('styles')
</head>
<body>
    <div class="page" id="app">
        <div class="flex-fill">
            <div class="header py-4">
                <div class="container">
                    <div class="d-flex">
                        <a class="header-brand" href="{!! url(config('tabler.urls.homepage', '/')) !!}">
                            <img src="{!! config('tabler.logo') !!}" class="header-brand-img" alt="Logo">
                        </a>
                        <div class="d-flex order-lg-2 ml-auto">
                            @if(Auth::check())
                                @include('tabler._partials.user')
                            @endif
                        </div>
                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                        data-target="#headerMenuCollapse">
                            <span class="header-toggler-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
                <div class="container">
                    <div class="row align-items-center">
                        @if(config('tabler.support.search'))
                            <div class="col-lg-3 ml-auto">
                                <form class="input-icon my-3 my-lg-0" action="{!! config('tabler.urls.searchUrl') !!}"
                                    method="GET">
                                    <input type="search" class="form-control header-search" placeholder="Search&hellip;"
                                        tabindex="1" name="keywords">
                                    <div class="input-icon-addon">
                                        <i class="fe fe-search"></i>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="col-lg order-lg-first">
                            @if(Menu::exists('primary') && Menu::get('primary')->first())
                                @include('tabler._partials.primary-menu')
                            @else
                                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                    <li class="nav-item">
                                        <a href="{{ route('home') }}" class="nav-link">
                                            Home
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 my-md-5">
                <div class="container">
                    <div class="page-header d-flex w-100 justify-content-between">
                        <h1 class="page-title">
                            @yield('title')
                        </h1>

                        @if($options)
                            @include($options)
                        @endif
                    </div>

                    @if($sidebar)
                        <div class="row row-cards">
                            <div class="col-md-3">
                                @include($sidebar)
                            </div>
                            <div class="col-md-9">
                    @endif

                    @include('flash::message')

                    @yield('content')

                    @if($sidebar)
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if(config('tabler.support.footer-menu'))
            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                @if(Menu::exists('footer'))
                                    @include('tabler._partials.footer-menu')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(config('tabler.support.footer'))
            <footer class="footer">
                <div class="container">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                            {!! config('tabler.footer') !!}
                        </div>
                    </div>
                </div>
            </footer>
        @endif
    </div>
    <script src="{{ mix('admin/assets/js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '/admin'
        });
    </script>
    <script src="{{ mix('admin/assets/js/dashboard.js') }}"></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    @if(config('app.debug') && count($errors) > 0)
        <script>
            @foreach ($errors->all() as $error)
                console.error('{{ $error }}');
            @endforeach
        </script>
    @endif

    @stack('scripts')
</body>
</html>
