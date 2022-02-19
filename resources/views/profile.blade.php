@extends('layout')
@section('main')
<body>        
    <div class="container-fluid px-0">
        <div class="d-flex flex-column pt-4 pb-5 bg-muted px-3">
            <div class="d-flex flex-column">
                <div class="d-flex">
                    @if($user_details_count == 0)
                        <img class="my-avatar rounded-pill me-2" src="https://static.tildacdn.com/tild6361-3034-4333-b833-353964363837/pngwingcom_2.png" alt="...">
                    @else
                        @if($user_details->avatar != '')
                            <img class="my-avatar rounded-pill me-2" src="/storage/avatar/{{auth()->user()->id}}/{{$user_details->avatar}}" alt="...">
                        @else
                            <img class="my-avatar rounded-pill me-2" src="https://static.tildacdn.com/tild6361-3034-4333-b833-353964363837/pngwingcom_2.png" alt="...">
                        @endif
                    @endif
                    <div class="d-flex flex-column">
                        <div class="mt-1 text-dark-blue fs-4 fw-custom me-auto">@if(auth()->user()->name == '') Не указано @else {{auth()->user()->surname}} {{auth()->user()->name}} @endif</div>
                        <span class="text-muted">online</span>
                    </div>
                    <div class="btn-group dropstart btn-setting-profile">
                        <button type="button" class="btn px-1 py-1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical fs-5"></i>
                        </button>
                        <ul class="dropdown-menu drop-position">
                            <li><a href="/exit_personal" class="dropdown-item" type="button">Редактировать</a></li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-2">
                    <a href="#" class="badge-profile text-decoration-none w-50 px-2 py-2 text-center">{{$my_friends_count}} друзей</a>
                    <a href="#" class="badge-profile text-decoration-none w-50 px-2 py-2 text-center">500 подписчиков</a>
                </div>
                <button class="btn btn-none text-dark-blue"><i class="bi bi-chevron-down me-2"></i>Подробная информация</button>
            </div>
        </div>
        <div class="profile h-my-profile bg-light-blue w-100">
            <div class="d-flex flex-column text-center pt-5 text-dark-blue">
                <i class="bi bi-pencil-square fs-icon"></i>
                <h4>Создайте первую запись</h4>
                <span class="w-75 mx-auto">Поделитесь с друзьями чем-нибудь интересным</span>
                <a href="#" class="btn btn-dark-blue mt-2 w-50 mx-auto">Создать запись</a>
            </div>
        </div>
    </div>

    <script>
        profile.classList.remove('text-muted')
        profile.classList.add('text-dark-blue')
    </script>    
</body>
</html>
@endsection