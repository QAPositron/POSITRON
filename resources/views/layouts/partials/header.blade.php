<header>
  <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
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
            <a class="nav-link {{request()->routeIs('empresas.*') ? 'active' : ''}}"  href="{{route('empresas.search')}}">EMPRESAS</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{request()->routeIs('dosimetros.*') ? 'active' : ''}}" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">DOSIMETRÍA</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{route('empresasdosi.create')}}">EMPRESAS</a></li>
              <li><a class="dropdown-item" href="{{route('dosimetros.search')}}">BUSCAR</a></li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CONTROLES C.</a>
          </li>
        </ul>
        <span class="navbar-text me-5">
          MODULO DOSÍMETRIA
        </span>
      </div>
    </div>
  </nav>
</header>