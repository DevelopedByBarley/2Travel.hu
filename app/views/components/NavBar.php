<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex m-auto">
                <button class="btn btn-outline-primary w-100 mt-2 mb-2" type="submit" onclick="searchActiveToggle(event)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>

            <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 4rem;">
                <?php if (!isset($params["isLoggedIn"])) : ?>
                    <a href="/user" class="btn btn-outline-dark">
                        Regisztráció
                    </a>
                    <a href="/user?isRegistered=1" class="btn btn-outline-dark">
                        Bejelentkezés
                    </a>
                <?php else : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/user/profile">Profil</a></li>
                            <li><a class="dropdown-item" href="/user/reservations">Foglalások</a></li>
                            <li><a class="dropdown-item" href="/user/homes">Lakásaim</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/user/logout">
                                    <button class="btn btn-outline-danger">Kijelentkezés</button>
                                </a></li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>
<?php include 'app/views/includes/SearchBox.php' ?>