<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.header')

<body>
    @include('frontend.partials.menu')

    <main>
        @yield('content')
    </main>
    


    @include('frontend.partials.footer')
    @stack('scripts')
</body>

</html>