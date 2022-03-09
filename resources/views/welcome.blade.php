@extends('layout')
@section('main')
<header class="fixed-top bg-light-blue d-flex align-items-center px-1">
    <button class="btn btn-none me-auto" id="menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i id="close_menu" class="bi bi-list fs-1 text-dark-blue"></i></button>
    <a href="/home" class="me-auto my-auto text-decoration-none text-dark-blue"><h1 class="mb-0" style="font-weight: 600;">Messenger</h1></a>
    <a href="#" class="btn btn-none"><i class="bi bi-search text-dark-blue fs-4"></i></a>
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
                                            @if($user_details->where('user_id', $user->id)->first()->avatar != 'default.png')
                                                <img class="chats-avatar rounded-pill" src="/storage/avatar/{{$user->id}}/{{$users_detailed = $user_details->where('user_id', $user->id)->first()->avatar}}" alt="...">
                                            @else
                                                <img class="chats-avatar rounded-pill" src="/img/default.png" alt="...">
                                            @endif
                                        @else
                                            <img class="chats-avatar rounded-pill" src="/img/default.png" alt="...">
                                        @endif
                                    @if($user->isOnline())
                                        <div class="online bg-light-blue rounded-pill">
                                            <span class="online-item rounded-pill"></span>
                                        </div>
                                        <div class="d-flex ms-1 flex-column w-name">
                                    @else
                                        <div class="d-flex ms-online flex-column w-name">
                                    @endif
                                            <div class="d-flex">
                                                @if($user->name == '')
                                                    <span class="text-dark-blue fs-name me-auto">{{$user->tel}}</span>
                                                @else
                                                    <span class="text-dark-blue fs-name me-auto">{{$user->surname}} {{$user->name}}</span>
                                                @endif  
                                                <span class="text-muted small ms-auto">
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
                                                    @elseif(substr($message->where('location', $all->id)->latest()->first()->created_at, 0, 4) == date('Y') && substr($message->where('location', $all->id)->latest()->first()->created_at, 5, 2) == date('m')-1)
                                                        @if(date('t', mktime (0, 0, 0, substr($message->where('location', $all->id)->latest()->first()->created_at, 5, 2), 1, substr($message->where('location', $all->id)->latest()->first()->created_at, 0, 4)))-substr($message->where('location', $all->id)->latest()->first()->created_at, 8, 2)+date('d')  <= date('t'))
                                                            {{date('t', mktime (0, 0, 0, substr($message->where('location', $all->id)->latest()->first()->created_at, 5, 2), 1, substr($message->where('location', $all->id)->latest()->first()->created_at, 0, 4)))-substr($message->where('location', $all->id)->latest()->first()->created_at, 8, 2)+date('d')}} д
                                                        @endif
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="d-flex">
                                                @if($message->where('location', $all->id)->latest()->first()->sender == auth()->user()->id)       
                                                    <div class="d-flex">
                                                        <span class="small me-1 text-muted opacity-75">Вы:</span><span class="text-muted small d-inline-block text-truncate" style="max-width: 55vw;">{{$message->where('location', $all->id)->latest()->first()->text}}</span>
                                                    </div>
                                                @else
                                                    <span class="text-muted small d-inline-block text-truncate" style="max-width: 45vw;">{{$message->where('location', $all->id)->latest()->first()->text}}</span>
                                                @endif
                                                @if($message->where('location', $all->id)->latest()->first()->read == false)  
                                                    @if($message->where([['location', $all->id]])->latest()->first()->sender == auth()->user()->id)
                                                        <div class="ms-auto">
                                                            <span class="read"></span>
                                                        </div>
                                                    @elseif($message->where([['location', $all->id]])->latest()->first()->sender == $user->id)
                                                        <div class="ms-auto">
                                                            <span class="news_mess">{{$message->where([['location', $all->id], ['read', false]])->count()}}</span>
                                                        </div>
                                                    @endif
                                                @endif
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