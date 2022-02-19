@extends('layout')
@section('main')
<header class="header fixed-top d-flex align-items-center px-1" style="z-index: 1041;">
    <button class="btn btn-none me-auto" id="menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i id="close_menu" class="bi bi-list fs-5 text-dark-blue"></i></button>
    <a href="/home" class="me-auto my-auto text-decoration-none text-dark-blue"><h1 class="text-home my-auto">Messenger</h1></a>
    <a href="#" class="btn btn-none"><i class="bi bi-search text-dark-blue"></i></a>
</header>
<div class="container px-0 bg-light-blue main-position">
    <div class="main-scroll px-4 pt-1 pb-4">
    @if($dialog_count == 0)
        <div class="d-flex flex-column w-100 mt-auth">
            <span class="text-center text-dark-blue fw-custom fs-5">У вас пока нет чатов</span>
            <span class="text-center text-muted">Чтобы создать чат, нужно найти собеседника</span>
            <a href="/search_friends" class="text-center btn bg-dark-blue text-white mt-2">Найти собеседника</a>
        </div>
    @else
        <div class="row row-cols-1">
            @foreach($message->orderBy('id', 'desc')->get() as $mess)
                @foreach($dialog as $all)
                    @foreach($users as $user)
                        @if($user->id == $all->user_2 || $user->id == $all->user_1)
                            @if($user->id != auth()->user()->id)  
                                @if($mess->id == $message->where('location', $all->id)->latest()->first()->id)
                                    <a href="/chat/{{$user->id}}" class="col d-flex mt-4 text-decoration-none">
                                        @if($user_details->where('user_id', $user->id)->count() != 0)
                                            <img class="chats-avatar rounded-pill" src="/storage/avatar/{{$user->id}}/{{$users_detailed = $user_details->where('user_id', $user->id)->first()->avatar}}" alt="...">
                                        @else
                                            <img class="chats-avatar rounded-pill" src="https://static.tildacdn.com/tild6361-3034-4333-b833-353964363837/pngwingcom_2.png" alt="...">
                                        @endif
                                        <div class="d-flex flex-column w-100">
                                            <div class="d-flex ms-online">
                                                <div class="d-flex flex-column w-name">
                                                    @if($user->name == '')
                                                        <span class="text-dark-blue fs-name me-auto">{{$user->tel}}</span>
                                                    @else
                                                        <span class="text-dark-blue fs-name me-auto">{{$user->surname}} {{$user->name}}</span>
                                                    @endif  
                                                    @if($message->where('location', $all->id)->latest()->first()->sender == auth()->user()->id)       
                                                        <div class="d-flex">
                                                            <span class="small me-1 text-muted opacity-75">Вы:</span><span class="text-muted small">{{$message->where('location', $all->id)->latest()->first()->text}}</span>
                                                        </div>
                                                    @else
                                                        <span class="text-muted small">{{$message->where('location', $all->id)->latest()->first()->text}}</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column ms-auto w-time">
                                                    <span class="text-muted small mx-auto">
                                                        @if(substr($message->where('location', $all->id)->latest()->first()->created_at, 0, 7) == date('Y-m'))
                                                            @if(substr($message->where('location', $all->id)->latest()->first()->created_at, 0, 10) == date('Y-m-d'))
                                                                @if(substr($message->where('location', $all->id)->latest()->first()->created_at, 10, 3) == date('H'))
                                                                    @if(substr($message->where('location', $all->id)->latest()->first()->created_at, 14, 2) == date('i'))
                                                                    @else
                                                                        {{date('i')-substr($message->where('location', $all->id)->latest()->first()->created_at, 14, 2)}} м
                                                                    @endif
                                                                @else
                                                                    {{date('H')-substr($message->where('location', $all->id)->latest()->first()->created_at, 10, 3)}} ч
                                                                @endif
                                                            @else
                                                                {{date('d')-substr($message->where('location', $all->id)->latest()->first()->created_at, 8, 2)}} д
                                                            @endif
                                                        @else
                                                            {{date('m')-substr($message->where('location', $all->id)->latest()->first()->created_at, 5, 2)}}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        </div>
    @endif
    </div>
</div>
<script>
    home.classList.remove('text-muted')
    home.classList.add('text-dark-blue')
</script>
@endsection