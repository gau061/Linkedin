<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <title>@yield('title')</title>
    
  @include('AdminTheme.css')
  @yield('page-level-css')

</head>
<body class="hold-transition skin-blue sidebar-mini" onbeforeunload="HandleBackFunctionality()">
  
<div class="wrapper">
  <header class="main-header">
    @include('AdminTheme.header')
  </header>

  <aside class="main-sidebar">
    @include('AdminTheme.sidebar')
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      @yield('content-header')
    </section>
    <section class="content">
      @yield('content')
    </section>
  </div>

  <footer class="main-footer">
    @include('AdminTheme.footer')
  </footer>
</div>
  @include('AdminTheme.script')
  @yield('page-level-script')
</body>
</html>
