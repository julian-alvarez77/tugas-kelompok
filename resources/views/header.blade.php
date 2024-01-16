
@section('header')
 <div id="header">
     <!-- Left Side Of Navbar -->
     <div class="header-left">
       <div id="logo">
           <a href="./"><img src="/img/logo.png" alt="Bookshelf"></a>
       </div>
     </div>

     <!-- Right Side Of Navbar -->
   <ul class="header-right">
        <div class="header-item">
            <a href="./new"><img src="/img/icon_plus.png" alt="">Tambah Buku</a>
        </div>

        @guest
            <div class="header-item">
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
        @if (Route::has('register'))
            <div class="header-item">
                <a  href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        @endif

        @else
            <div class="header-item dropdown">
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
            </div>
        @endguest
        </ul>
    </div>

         <!-- Authentication Links -->

     </nav>
 </div>
@endsection
