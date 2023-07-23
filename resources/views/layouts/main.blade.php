@include('layouts/header')
    <body>
        @include('layouts/navbar')
        @include('layouts/sidebar')
        @yield('content')
        @include('layouts/footer')
    </body>