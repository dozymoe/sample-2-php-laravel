<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">{{ $title }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @can('viewAny', 'App\Models\Sale')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard.purchase') }}">
            Purchase History
          </a>
        </li>
        @endcan

        @can('review', 'App\Models\Sale')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard.sale') }}">
            Sales
          </a>
        </li>
        @endcan

        @if (Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @endif

        {{ $slot }}
      </ul>
    </div>
  </div>
</nav>
