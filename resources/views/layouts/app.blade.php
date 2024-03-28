@include('layouts.components.head')

<body>
    <div id="app">
        
        <header>
            @include('layouts.components.header')
        </header>

        <main class="container">
            @yield('content')
        </main>

        @yield('scripts')

    </div>
</body>

</html>
