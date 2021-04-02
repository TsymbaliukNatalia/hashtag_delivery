@section('main_menu')
<div class="wrapper">
    <div id="main_menu" class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom">
        <a class="my-0 mr-md-auto font-weight-normal" href="{{ route('start') }}"><img src="/img/main_logo.png" alt="company_logo" class="main_logo"></a>

        <nav class="my-2 my-md-0 mr-md-3">
            <a class="btn btn-primary" href="{{ route('points') }}" role="button">Відділення</a>
            <a class="btn btn-primary" href="{{ route('calculate') }}" role="button">Розрахунок вартості</a>

            <a class="btn dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                </svg>
                Мій кабінет
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item text-center" href="/vendor/login">Увійти</a>
                <a class="dropdown-item text-center" href="/vendor/register">Зареєструватись</a>
            </div>


        </nav>
    </div>
    <div class="wrapper">