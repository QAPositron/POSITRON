<header>
  <nav class="navbar  navbar-expand-lg navbar-dark colorQA">
    <div class="container-fluid">
      <a class="navbar-brand ms-5" href="#"><img src="{{asset('imagenes/logo_positron.png')}}" width="170px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{request()->routeIs('home') ? 'active' : ''}}" href="{{route('home')}}">INICIO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{request()->routeIs('empresas.*') ? 'active' : ''}}"  href="{{route('empresas.search')}}">ADMINISTRACIÓN</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{request()->routeIs('holders.*') || request()->routeIs('dosimetros.*') || request()->routeIs('empresasdosi.*') || request()->routeIs('contratosdosi.*') || request()->routeIs('contratosdosisede.*') || request()->routeIs('contratosdosisededepto.*') || request()->routeIs('detallesedecont.*') || request()->routeIs('detallecontrato.*') || request()->routeIs('asignadosicontratom1.*') || request()->routeIs('asignadosicontratomn.*') || request()->routeIs('asignadosicontrato.*') || request()->routeIs('asigdosicont.*') || request()->routeIs('lecturadosi.*') || request()->routeIs('lecturadosicontrl.*') || request()->routeIs('lecturadosicontrol.*') || request()->routeIs('lecturadosiarea.*') ? 'active' : ''}}" 
            href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">DOSIMETRÍA</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{route('empresasdosi.create')}}">EMPRESAS</a></li>
              <li><a class="dropdown-item" href="{{route('dosimetros.search')}}">INVENTARIO</a></li>
              <li><a class="dropdown-item" href="{{route('revisiondosimetria.create')}}">REVISIÓN DE SALIDA</a></li>
              <li><a class="dropdown-item" href="{{route('revisiondosimetriaentrada.create')}}">REVISIÓN DE ENTRADA</a></li>
              <li><a class="dropdown-item" href="{{route('novedadesdosim.create')}}">NOVEDADES</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{request()->routeIs('personas.*') ? 'active' : ''}}" href="{{route('personas.search')}}">PERSONAS</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link {{request()->routeIs('contacto.*') ? 'active' : ''}}" href="{{route('contactos.search')}}">CONTACTOS</a>
          </li> --}}
        </ul>
        <span class="navbar-text me-5">
          MODULO DOSIMETRÍA
        </span>
      </div>
    </div>
  </nav>
</header>