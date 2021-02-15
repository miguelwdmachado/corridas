<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Corridas') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<!-- header e section da página home -->
@yield('header')
<!-- Header -->
<header>  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light bg-light shadow-sm" style="background-color: #343a40; transition: margin-left .5s;">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars" style="color:  #d5d8dc; border: 2px solid; border-radius: 6px; padding: 6px;"></i>
      </a>
    </li>
  </ul>
  <!--<button id="idopenbtn" class="openbtn btn-dark" type="button" onclick="open_close()" style="margin-left: 250px;">☰</button>-->
</nav>

  <!-- Main Sidebar Container -->
  <aside id="msidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost:8000" class="brand-link">
      <img src="{{asset('images/logo_desafio.png')}}" alt="DESAFIO" width="60" height="auto">
      <span class="brand-text text-center" style="font-size: 1rem">Desafio Desenvolvedor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clientes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/listaClientes')}}" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Lista Clientes</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  </header>

  @yield('section1')

  @yield('footer')

@yield('script')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="dataTables/datatables.min.js"></script>
<script type="text/javascript" src="dist/js/adminlte.min.js"></script>
<script>

  document.addEventListener("DOMContentLoaded", function(event) {
    var table = $('#example').DataTable({
    processing: true, //utilizado para atualizar a tabela
    destroy: true, //utilizado para atualizar a tabela
    responsive: true,
    colReorder: true,
    columnDefs: [
    { orderable: false, "targets": 0 }
    ],
    order: [1, 'asc'], //coluna que será ordenada inicialmente
    language: {
    decimal: ",",
    emptytable: "Não foi encontrado nenhum registo",
    loadingrecords: "A carregar...",
    processing: "A processar...",
    lengthMenu: "Mostrar _MENU_ registos",
    zerorecords:  "Não foram encontrados resultados",
    info: "Mostrando de _START_ até _END_ de _TOTAL_ registos",
    infoempty:  "Mostrando de 0 até 0 de 0 registos",
    infofiltered: "(filtrado de _MAX_ registos no total)",
    infopostfix:  "",
    search: "Procurar:",
    url:  "",
    paginate: {
    first:  "Primeiro",
    previous: "Anterior",
    next: "Seguinte",
    last: "Último"
    },
    aria: {
    sortascending:  ": Ordenar colunas de forma ascendente",
    sortdescending: ": Ordenar colunas de forma descendente"
    }
    }
    });

  });

  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }

</script>

</body>
</html>
