<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../js/ie-emulation-modes-warning.js"></script>
    <script src="../../js/vue.js"></script>
    <script src="../../js/vue-resource.js"></script>

    @yield('customScripts')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
@inject('prjName', 'App\HTTP\controllers\AdminController')

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">{{$prjName->getProjectName()}}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="{{ Request::path() ==  'admin/projects' ? 'active' : ''}}"><a href="{{ url('admin/projects') }}">Projects</a></li>
            <li class="{{ Request::path() ==  'admin/header' ? 'active' : ''}}"><a href="{{ url('admin/header') }}">Header</a></li>
            <li class="{{ Request::path() ==  'admin/about' ? 'active' : ''}}"><a href="{{ url('admin/about') }}">About</a></li>
            <li class="{{ Request::path() ==  'admin/footer' ? 'active' : ''}}"><a href="{{ url('admin/footer') }}">Footer</a></li>
            <li class="{{ Request::path() ==  'admin/pview' ? 'active' : ''}}"><a href="{{ url('admin/pview') }}">Project Template</a></li>
            <li class="{{ Request::path() ==  'admin/contacts' ? 'active' : ''}}"><a href="{{ url('admin/contacts') }}">Contacts</a></li>
            <li class="{{ Request::path() ==  'admin/settings' ? 'active' : ''}}"><a href="{{ url('admin/settings') }}">Settings</a></li>
            <li class="{{ Request::path() ==  'admin/map' ? 'active' : ''}}"><a href="{{ url('admin/map') }}">Map</a></li>
            <li class="{{ Request::path() ==  '/auth/logout' ? 'active' : ''}}"><a href="{{ url('/auth/logout') }}" ><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
          </ul>
          
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
          <li class="{{ Request::path() ==  'admin/settings' ? 'active' : ''}}"><a href="{{ url('admin/settings') }}">Settings</a></li>
          <Label>Sections</Label>
          <li class="{{ Request::path() ==  'admin/projects' ? 'active' : ''}}"><a href="{{ url('admin/projects') }}">Projects</a></li>
            <li class="{{ Request::path() ==  'admin/header' ? 'active' : ''}}"><a href="{{ url('admin/header') }}">Header</a></li>
            <li class="{{ Request::path() ==  'admin/about' ? 'active' : ''}}"><a href="{{ url('admin/about') }}">About</a></li>
            <li class="{{ Request::path() ==  'admin/footer' ? 'active' : ''}}"><a href="{{ url('admin/footer') }}">Footer</a></li>
            <li class="{{ Request::path() ==  'admin/pview' ? 'active' : ''}}"><a href="{{ url('admin/pview') }}">Project Template</a></li>
            <li class="{{ Request::path() ==  'admin/contacts' ? 'active' : ''}}"><a href="{{ url('admin/contacts') }}">Contacts</a></li>
            <li class="{{ Request::path() ==  'admin/map' ? 'active' : ''}}"><a href="{{ url('admin/map') }}">Map</a></li>
          </ul>
          <hr>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          <div id="app">

          <div class="row">
            @yield('sectionName')
          </div>
          <hr>
          <div >
            @yield('edit')
          </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../js/ie10-viewport-bug-workaround.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    @yield('scripts')

    @yield('modals')


  </body>
</html>