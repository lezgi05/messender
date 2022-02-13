@extends('layout')
@section('main')
<div class="container fixed-top pb-2 mb-2 bg-light-blue">
    <div class="d-flex mt-2">
        <a href="/home" class="me-3 mt-1"><i class="bi bi-arrow-left text-dark-blue fs-5"></i></a>
        <input type="text" class="w-100 search-custom py-2 px-2">
    </div>
</div>
<div class="container px-0 main-position bg-light-blue">
        <div class="main-scroll px-3 pb-4">
            <div class="row row-cols-1 mt-2 px-2">
                @foreach($users as $all)
                    @if($all->id != auth()->user()->id)
                        <div class="col d-flex mt-3 pe-0">
                            @if($user_details->where('user_id', $all->id)->count() != 0)
                                <img class="chats-avatar rounded-pill" src="/storage/avatar/{{$all->id}}/{{$user = $user_details->where('user_id', $all->id)->first()->avatar}}" alt="...">
                            @else
                                <img class="chats-avatar rounded-pill" src="https://static.tildacdn.com/tild6361-3034-4333-b833-353964363837/pngwingcom_2.png" alt="...">
                            @endif
                            @if($all->name == '')
                                <span class="text-dark-blue fs-name ms-3 mt-2">{{$all->tel}}</span>
                            @else
                                <span class="text-dark-blue fs-name ms-3 mt-2">{{$all->surname}} {{$all->name}}</span>
                            @endif
                            @if($f->where([['app_friends_id', $all->id],['add_friends_id', auth()->user()->id]])->first())
                                <div class="d-flex my-auto ms-auto">
                                    <a href="/chat/{{$all->id}}"><i class="bi bi-chat-right-text text-dark-blue fs-5 me-3"></i></a>
                                </div>
                            @else
                                <div class="d-flex my-auto ms-auto">
                                    <form action="/friends/{{$all->id}}" method="POST">
                                    @csrf
                                        <button class="btn btn-none py-0"><i class="bi bi-person-plus text-dark-blue fs-5"></i></button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
</div>
@endsection