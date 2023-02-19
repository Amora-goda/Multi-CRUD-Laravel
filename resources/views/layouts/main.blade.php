<!doctype html>
<html lang="en" class="minimal-theme">

<head>
  @include('layouts.head')
</head>

<body>


  <!--start wrapper-->

 @include('layouts.main-headerbar')

 @include('layouts.main-sidebar')

       <!--start content-->
       <main class="page-content">
                @include('partial.flash')
                @yield('content')


       </main>
  <!--end wrapper-->



  @include('layouts.footer-scripts')


</body>

</html>
