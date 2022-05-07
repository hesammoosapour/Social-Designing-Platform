<x-app-layout>
    <x-slot name="header">
        @if(isset($user))
            <div class="row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight col-10" style="direction: rtl">
                    {{ __('پنل').' '.($user->name) }}
                </h2>
            </div>
        @endif
    </x-slot>

    <nav class="navbar navbar-expand-sm bg-primary navbar-dark " >
        <div class="container-fluid">
            <div class="justify-content-center">
                <i class="fas fa-user fa-2x"></i>
            </div>
            <!--            <div class="justify-content-start">-->
            <!--                <i class="fas fa-bars"></i>-->
            <!--            </div>-->
            <!--            <a class="navbar-brand" href="#">Logo</a>-->
            <div class="collapse navbar-collapse " id="collapsibleNavbar" dir="rtl">
                <!--                <ul class="navbar-nav">-->
                <!--                    <li class="nav-item">-->
                <!--                        <a class="nav-link text-white" href="#">تیجی لینک</a>-->
                <!--                    </li>-->
                <!--                </ul>-->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">آموزش ها </a>
                        <ul class="dropdown-menu text-end" >
                            <li><a class="dropdown-item" href="#">معماری</a></li>
                            <li><a class="dropdown-item" href="#">کامپیوتر</a></li>
                            <li><a class="dropdown-item" href="#">عمران</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">خدمات</a>
                        <ul class="dropdown-menu text-end">
                            <li><a class="dropdown-item" href="#">هاست</a></li>
                            <li><a class="dropdown-item" href="#">سرور</a></li>
                            <li><a class="dropdown-item" href="#">وب سرویس</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">درباره ما</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">تماس با ما</a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span > گزینه ها
                    <!--                    class="navbar-toggler-icon"-->
                </span>
            </button>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white " href="#">تیجی لینک</a>
                </li>
            </ul>

            <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                <i class="bi bi-arrow-right-square-fill fs-3 fas fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
            </button>
        </div>
    </nav>

</x-app-layout>
