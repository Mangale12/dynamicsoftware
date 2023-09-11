@include('admin.includes.head')
@include('admin.includes.sidebar')
<section class="main_content dashboard_part large_header_bg">
@include('admin.includes.main')
 @yield('content')
 </section>

@include('admin.includes.footer')
@yield('script')
