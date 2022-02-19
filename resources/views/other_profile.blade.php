@extends('layout')
@section('main')
<body>        
    <div class="container-fluid px-0">
        <div class="d-flex flex-column pt-4 pb-5 bg-muted px-3" style="z-index: 100;">
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
                        <div class="mt-1 text-dark-blue fs-4 fw-custom me-auto">@if($user->name == '') Не указано @else {{$user->surname}} {{$user->name}} @endif</div>
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
                            <button href="#" class="badge-profile text-decoration-none w-50 px-2 py-2 text-center border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">В друзьях</button>
                            <div class="collapse position_delete_friends" id="collapseExample">
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
                        <a href="#" class="badge-profile d-flex flex-column text-decoration-none w-50 px-2 py-2 text-center small"><span>{{$my_friends_count}}</span><span>друзей</span></a>
                        <a href="#" class="badge-profile d-flex flex-column text-decoration-none w-50 px-2 py-2 text-center small"><span>10</span><span>подписчиков</span></a>
                        <a href="#" class="badge-profile d-flex flex-column text-decoration-none w-50 px-2 py-2 text-center small"><span>0</span><span>публикаций</span></a>
                    </div>
                </div>
                <button class="btn btn-none text-dark-blue"><i class="bi bi-chevron-down me-2"></i>Подробная информация</button>
            </div>
        </div>
        <div class="profile h-other-profile bg-light-blue w-100">
            <div class="d-flex flex-column text-center pt-5 text-dark-blue">
                <i class="bi bi-card-text fs-icon"></i>
                <h4>Записей пока нет</h4>
            </div>
        </div>
    </div>

</body>
</html>
@endsection