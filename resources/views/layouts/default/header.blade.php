<ul id="locale" class="dropdown-content">
    <li><a href="{{ route('locale', 'pt-br') }}">Português</a></li>
    <li><a href="{{ route('locale', 'en') }}">English</a></li>
</ul>
<ul id="user" class="dropdown-content">
    <li><a href="{{ route('profile') }}">{{__('Profile')}}</a></li>
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
            @csrf
        </form>
    </li>
</ul>
<div class="parallax-container">
    <nav>
        <div class="nav-wrapper">
            <div class="container">
                <a href="{{ url('/') }}" class="brand-logo">
                    {{ __('My Heroes - Forum') }}
                </a>

                <ul class="right">
                    <li>
                        <a href="#!" data-activates="locale" class="dropdown-button">
                            {{__('Language')}}
                        </a>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('login') }}">
                                {{__('Login')}}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                {{__('Sign Up')}}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="#!" data-activates="user" class="dropdown-button">
                                {{\Auth::user()->name}}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="parallax">
        <img src="/img/help.jpg" alt="{{ __('My Heroes - Forum') }}">
    </div>
</div>
