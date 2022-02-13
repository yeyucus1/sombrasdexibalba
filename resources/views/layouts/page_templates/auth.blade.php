<div class="wrapper ">
  @include('layouts.navbars.sidebar')
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.page_templates.footers.auth')
  </div>
</div>
