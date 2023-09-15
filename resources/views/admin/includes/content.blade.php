<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('titleheader')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@yield('titleheader1')</a></li>
              <li class="breadcrumb-item active">@yield('titleheader2')</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="row">

    </div>

    <div class="content">
      <div class="container-fluid">
        @if (Session::has('error'))
        <div class="alert alert-danger text-center" role="alert">
            {{ Session::get('error') }}

        </div>

        @endif
        @if (Session::has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ Session::get('success') }}

        </div>

        @endif
        @yield('content')

      </div>
    </div>

  </div>
