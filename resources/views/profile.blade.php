@extends('layout')
@section('main')
<body>        
    <div class="container-fluid px-0">
        <div class="d-flex flex-column pt-4 pb-5 bg-muted px-3">
            <div class="d-flex flex-column">
                <div class="d-flex">
                    @if($user_details_count == 0)
                        <button type="button" class="btn px-0 py-0 me-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#avatar">
                            <img class="my-avatar rounded-pill" src="/img/default.png" alt="...">
                        </button>
                    @else
                        @if($user_details->avatar != 'default.png')
                            <button type="button" class="btn px-0 py-0 me-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#exit_avatar">
                                <img class="my-avatar rounded-pill me-2" src="/storage/avatar/{{auth()->user()->id}}/{{$user_details->avatar}}" alt="...">
                            </button>
                        @else
                        <button type="button" class="btn px-0 py-0 me-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#avatar">
                            <img class="my-avatar rounded-pill" src="/img/default.png" alt="...">
                        </button>
                        @endif
                    @endif
                    <div class="d-flex flex-column">
                        <div class="mt-1 text-dark-blue fs-4 fw-custom me-auto">@if(auth()->user()->name == '') Не указано @else {{auth()->user()->surname}} {{auth()->user()->name}} @endif</div>
                        <span class="text-muted">
                            @if(auth()->user()->isOnline())
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
                            <li><a href="/exit" class="dropdown-item" type="button">Выйти</a></li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-2">
                    <a href="#" class="badge-profile text-decoration-none w-50 px-2 py-2 text-center">
                        Друзей 
                        {{$my_friends_count}}
                    </a>
                    <a href="#" class="badge-profile text-decoration-none w-50 px-2 py-2 text-center">Подписчиков 500</a>
                </div>

                <button id="details" class="btn btn-none text-dark-blue" type="button" data-bs-backdrop="false" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i id="icon_details" class="bi bi-chevron-down me-2 icon"></i>Подробная информация</button>
                
                <div class="collapse" id="collapseExample">
                    <div class="card card-body border-0 bg-collapse-none pt-0 px-0 pb-1">
                        @if($user_details_count == 0)
                            <div class="text-dark-blue text-center">Вы не вводили подробную информацию</div>
                            <a href="/exit_personal" class="btn-sm btn-dark-blue text-center mb-2 mt-1 text-decoration-none">Ввести подробную информацию</a>
                        @else
                            <div class="d-flex flex-column text-dark-blue">
                                @if($user_details->city != '')
                                    <div class="d-flex mb-1">
                                        <span><i class="bi bi-house me-1"></i> Город: {{$user_details->city}}</span>
                                    </div>
                                @endif
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
        <div class="profile h-my-profile bg-light-blue w-100">
            <div class="d-flex flex-column text-center pt-5 text-dark-blue">
                <i class="bi bi-pencil-square fs-icon"></i>
                <h4>Создайте первую запись</h4>
                <span class="w-75 mx-auto">Поделитесь с друзьями чем-нибудь интересным</span>
                <a href="#" class="btn btn-dark-blue mt-2 w-50 mx-auto">Создать запись</a>
            </div>
        </div>
    </div>


    <!-- Modal Avatar -->
    <div class="modal fade px-2" id="avatar" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-body px-0">
                    <div class="list-group">
                        <button class="list-group-item list-group-item-action border-0" aria-current="true" data-bs-toggle="modal" data-bs-target="#add_avatar">Добавить фотографию</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Exit Avatar -->
    <div class="modal fade px-2" id="exit_avatar" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-body px-0">
                    <div class="list-group">
                        <button class="list-group-item list-group-item-action border-0" aria-current="true" data-bs-toggle="modal" data-bs-target="#open_avatar">Открыть фотографию</button>
                        <button class="list-group-item list-group-item-action border-0" aria-current="true" data-bs-toggle="modal" data-bs-target="#add_avatar">Сменить фотографию</button>
                        <button class="list-group-item list-group-item-action border-0" aria-current="true" data-bs-toggle="modal" data-bs-target="#delete_avatar">Удалить фотографию</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Avatar -->
    <div class="modal fade px-2" id="add_avatar" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-body">
                    <div class="list-group">
                        <form method="POST" enctype="multipart/form-data" action="/avatar_exit_personal/@if($user_details_count == 0){{auth()->user()->id}}@else{{$user_details->user_id}}@endif">
                        @csrf
                            <label class="text-muted mb-1">Сменить аватарку</label>
                            <input type="file" name="avatar" class="form-control mb-2">
                            <button class="btn btn-dark-blue w-100">Сохранить</button>
                        <form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Avatar -->
    <div class="modal fade px-2" id="delete_avatar"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-body">
                    <h3>Подтверждение</h3>
                    <div>Вы действительно хотите удалить фотографию?</div>
                    <div class="d-flex justify-content-center">
                        <a href="/delete_avatar" class="btn me-5">Да</a><button class="btn" data-bs-dismiss="modal" aria-label="Close">Нет</button>
                    </div>
                </div>
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
                                        <li><a href="/storage/avatar/{{auth()->user()->id}}/{{$user_details->avatar}}" download="" class="dropdown-item" type="button"><i class="bi bi-download me-2"></i>Скачать фотографию</a></li>
                                        <li><button class="dropdown-item" type="button"  aria-current="true" data-bs-toggle="modal" data-bs-target="#delete_avatar"><i class="bi bi-trash me-2"></i>Удалить фотографию</button></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="my-auto">
                                <img class="w-100" src="/storage/avatar/{{auth()->user()->id}}/{{$user_details->avatar}}" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

<script>
    profile.classList.remove('text-muted')
    profile.classList.add('text-dark-blue')

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