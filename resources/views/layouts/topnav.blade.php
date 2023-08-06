<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link border-0 bg-transparent" style="cursor: pointer;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{'Logout'}}<i class="fa fa-sign-out ml-2"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
  </ul>

</nav>