@extends('layout')
@section('main')
<body>        
    <div class="container-fluid px-0">
        <div class="d-flex flex-column pt-4 pb-5 bg-muted px-3" style="z-index: 100;">
            <div class="d-flex flex-column">
                <div class="d-flex">
                    @if($user_details_count == 0)
                        <img class="my-avatar rounded-pill me-2" src="/img/default.png" alt="...">
                    @else
                        @if($user_details->avatar != 'default.png')
                            <button type="button" class="btn px-0 py-0 me-2 rounded-pill" aria-current="true" data-bs-toggle="modal" data-bs-target="#open_avatar">
                                <img class="my-avatar rounded-pill me-2" src="/storage/avatar/{{$user->id}}/{{$user_details->avatar}}" alt="...">
                            </button>
                        @else
                            <img class="my-avatar rounded-pill me-2" src="/img/default.png" alt="...">
                        @endif
                    @endif
                    <div class="d-flex flex-column">
                        <div class="mt-1 text-dark-blue fs-4 fw-custom me-auto">@if($user->name == '') Не указано @else {{$user->surname}} {{$user->name}} @endif</div>
                        <span class="text-muted">
                            @if($user->isOnline())
                                online
                            @else
                                не в сети
                            @endif
                        </span>
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
                <div class="d-flex flex-column">
                    @if($my_friends == 0)
                        <div class="d-flex gap-2 mt-2">
                            <form action="/friends_profile/{{$user->id}}" method="POST" class="w-50">
                            @csrf
                                <button class="badge-profile w-100 px-2 py-2 text-center border-0">Добавить в друзья</button>
                            </form>
                            <a href="#" class="badge-profile text-decoration-none w-50 px-2 py-2 text-center">Подписаться</a>
                        </div>
                    @else
                        <div class="d-flex gap-2 mt-2">
                            <a href="/chat/{{$user->id}}" class="badge-profile text-decoration-none w-50 px-2 py-2 text-center">Написать</a>
                            <button href="#" class="badge-profile text-decoration-none w-50 px-2 py-2 text-center border-0" type="button" data-bs-toggle="collapse" data-bs-target="#delete_friends" aria-expanded="false" aria-controls="delete_friends">В друзьях</button>
                            <div class="collapse position_delete_friends" id="delete_friends">
                                <div class="card card-body px-0 py-1 delete_friends bg-light-blue border-0 shadow-sm">
                                    <div class="list-group">
                                        <form action="/delete_friends/{{$user->id}}" method="POST">
                                        @csrf
                                            <button class="list-group-item list-group-item-action border-0 bg-light-blue" aria-current="true"">Удалить из друзей</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="d-flex gap-2 mt-2">
                        <a href="#" class="badge-profile d-flex flex-column text-decoration-none w-50 px-2 py-2 text-center small">
                            <span>{{$my_friends_count}}</span>
                            <span>
                                @if($my_friends_count <= 4)
                                    друга
                                @else
                                    друзей
                                @endif
                            </span>
                        </a>
                        <a href="#" class="badge-profile d-flex flex-column text-decoration-none w-50 px-2 py-2 text-center small"><span>10</span><span>подписчиков</span></a>
                        <a href="#" class="badge-profile d-flex flex-column text-decoration-none w-50 px-2 py-2 text-center small"><span>0</span><span>публикаций</span></a>
                    </div>
                </div>

                <button id="details" class="btn btn-none text-dark-blue" type="button" data-bs-toggle="collapse" data-bs-target="#details_info" aria-expanded="false" aria-controls="details_info"><i id="icon_details" class="bi bi-chevron-down me-2 icon"></i>Подробная информация</button>
                
                <div class="collapse" id="details_info">
                    <div class="card card-body border-0 bg-collapse-none pt-0 px-0 pb-1">
                        @if($user_details_count == 0)
                            <div class="text-dark-blue text-center">Нет подробной информации о человеке</div>
                        @else
                            <div class="d-flex flex-column text-dark-blue">
                                <div class="d-flex mb-1">
                                    <span><i class="bi bi-house me-1"></i> Город: Дербент</span>
                                </div>
                                @if($user_details->day != '')
                                    <div class="d-flex mb-1">
                                        <span><i class="bi bi-gift me-1"></i> День рождения: {{$user_details->day}} {{$mounth}}</span>
                                    </div>
                                @endif
                                @if($user_details->gender != '')
                                    <div class="d-flex mb-1">
                                        <span><i class="bi bi-person me-1"></i> Пол: {{$user_details->gender}}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="profile h-other-profile bg-light-blue w-100">
            <div class="d-flex flex-column text-center pt-5 text-dark-blue">
                <i class="bi bi-card-text fs-icon"></i>
                <h4>Записей пока нет</h4>
            </div>
        </div>
    </div>

    <!-- Modal Open Avatar -->
    @if($user_details_count != 0)
        @if($user_details->avatar != 'default.png')
            <div class="modal fade" id="open_avatar" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen-sm-down">
                    <div class="modal-content border-0 shadow-sm bg-dark">
                        <div class="modal-body d-flex flex-column px-0 py-0" style="height: 100vh;">
                            <div class="d-flex fixed-top mt-1">
                                <button class="btn me-auto" data-bs-dismiss="modal"><i class="bi bi-arrow-left text-dark-blue fs-4 text-white"></i></button>
                                <div class="btn-group dropstart btn-setting-profile">
                                    <button type="button" class="btn px-1 py-1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical text-white fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu drop-position">
                                        <li><a href="/storage/avatar/{{$user->id}}/{{$user_details->avatar}}" download="" class="dropdown-item" type="button"><i class="bi bi-download me-2"></i>Скачать фотографию</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="my-auto">
                                <img class="w-100" src="/storage/avatar/{{$user->id}}/{{$user_details->avatar}}" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    <script>
        details.onclick = function() {
            let icon_details = document.getElementById('icon_details')
            if (details.getAttribute('aria-expanded', 'false') == 'true') {  
                icon_details.classList.add('down-animation')
            } else {
                icon_details.classList.remove('down-animation')
            }
        }
    </script>

</body>
</html>
@endsection