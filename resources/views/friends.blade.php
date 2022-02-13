@extends('layout')
@section('main')
<header class="header fixed-top d-flex align-items-center px-1" style="z-index: 1041;">
    <button class="btn btn-none me-auto" id="menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i id="close_menu" class="bi bi-list fs-5 text-dark-blue"></i></button>
    <a href="/home" class="me-auto my-auto text-decoration-none text-dark-blue"><h1 class="text-home my-auto">Messenger</h1></a>
    <a href="#" class="btn btn-none"><i class="bi bi-search text-dark-blue"></i></a>
</header>
<div class="container px-0 py-1 bg-light-blue main-position w-100">
    <div class="main-scroll px-4 pb-4 pt-1">
        <h1 class="me-auto fw-custom text-dark-blue">Друзья</h1>
        @if($my_friends_count == 0)
            <div class="d-flex flex-column w-100 mt-auth">
                <span class="text-center text-dark-blue fw-custom fs-5">У вас пока нет друзей</span>
                <a href="/search_friends" class="text-center btn bg-dark-blue text-white mt-2">Найти друзей</a>
            </div>
        @else
            <input type="text" class="search-custom py-2 px-2">
            <div class="row row-cols-1 mt-2">
                @foreach($my_friends as $friends)
                    @foreach($users as $user)
                        @if($user->id == $friends->add_friends_id || $user->id == $friends->app_friends_id)
                            @if($user->id != auth()->user()->id)
                                <div class="col d-flex mt-3 pe-0">
                                    @if($user_details->where('user_id', $user->id)->count() != 0)
                                        <img class="chats-avatar rounded-pill" src="/storage/avatar/{{$user->id}}/{{$users_detailed = $user_details->where('user_id', $user->id)->first()->avatar}}" alt="...">
                                    @else
                                        <img class="chats-avatar rounded-pill" src="https://static.tildacdn.com/tild6361-3034-4333-b833-353964363837/pngwingcom_2.png" alt="...">
                                    @endif
                                    @if($user->name == '')
                                        <span class="text-dark-blue fs-name ms-3 mt-2">{{$user->tel}}</span>
                                    @else
                                        <span class="text-dark-blue fs-name ms-3 mt-2">{{$user->surname}} {{$user->name}}</span>
                                    @endif
                                    <div class="ms-auto">
                                        <a href="/chat/{{$user->id}}" class="btn btn-none"><i class="bi bi-chat-right-text text-dark-blue fs-5"></i></a>
                                        <button class="btn btn-none"><i class="bi bi-telephone text-dark-blue fs-5"></i> </button>
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