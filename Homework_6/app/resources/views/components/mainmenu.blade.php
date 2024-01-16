<nav class="navbar navbar-expand-lg bg-light" style="margin:20px 0; border-radius: 20px; padding: 5px 10px;">
    <div class="container-fluid" style="font-weight: 700;">
        <span class="navbar-brand">My Personal Page</span>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('page.about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('page.contact') }}">Contacts</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

