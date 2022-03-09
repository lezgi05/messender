@extends('layout')
@section('main')
<div class="container px-0 py-1 bg-light-blue main-position w-100">
    <header class="fixed-top bg-light-blue d-flex align-items-center px-1" style="z-index: 1041;">
        <button class="btn btn-none" id="menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i id="close_menu" class="bi bi-list fs-1 text-dark-blue"></i></button>
        <a href="/home" class="my-auto text-decoration-none text-dark-blue"><h1 class="mb-0" style="font-weight: 600;">Друзья</h1>
        </a>
    </header>
    <div class="main-scroll px-4 pb-4 pt-2">
        @if($my_friends_count == 0)
            <div class="d-flex flex-column w-100 mt-auth text-center">
                <i class="bi bi-person-plus text-dark-blue fs-1"></i>
                <span class="text-dark-blue fw-custom fs-5">Находите друзей</span>
                <span class="text-light-blue">Здесь будут отображаться люди, которых вы добавите в друзья</span>
                <a href="/search_friends" class="btn bg-dark-blue text-white mt-2">Добавить друзей</a>
            </div>
        @else
            <input type="text" class="search-custom py-2 px-2">

            <div class="row row-cols-1 mt-2">
                @foreach($my_friends as $friends)
                    @foreach($users as $user)
                        @if($user->id == $friends->add_friends_id || $user->id == $friends->app_friends_id)
                            @if($user->id != auth()->user()->id)
                                <div class="col d-flex mt-3 pe-0">
                                    <a href="/other_profile/{{$user->id}}" class="text-decoration-none">
                                        @if($user_details->where('user_id', $user->id)->count() != 0)
                                            @if($user_details->where('user_id', $user->id)->first()->avatar  != 'default.png')
                                                <img class="chats-avatar rounded-pill" src="/storage/avatar/{{$user->id}}/{{$users_detailed = $user_details->where('user_id', $user->id)->first()->avatar}}" alt="...">
                                            @else
                                                <img class="chats-avatar rounded-pill" src="/img/default.png" alt="...">
                                            @endif
                                        @else
                                            <img class="chats-avatar rounded-pill" src="/img/default.png" alt="...">
                                        @endif
                                        @if($user->name == '')
                                            <span class="text-dark-blue fs-name ms-3 mt-2">{{$user->tel}}</span>
                                        @else
                                            <span class="text-dark-blue fs-name ms-3 mt-2">{{$user->surname}} {{$user->name}}</span>
                                        @endif
                                    </a>
                                    <div class="ms-auto">
                                        <a href="/chat/{{$user->id}}" class="btn btn-none"><i class="bi bi-chat-right-text text-dark-blue fs-5"></i></a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </div>
        @endif
    </div>
</div>
<script>
    friends.classList.remove('text-muted')
    friends.classList.add('text-dark-blue')
</script>
@endsection