<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
@include('components.head')

<body>

    <div class="container">
        @include('components.navigation')
        @include('components.status')
        @include('components.errors')

        <main class="mt-5 mb-5">
            @yield('content')
        </main>

        @include('components.footer')
    </div>

</body>

</html>