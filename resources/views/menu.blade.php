@extends('layout')
@section('main')
<div class="container px-4 py-3">
    <h1 class="me-auto fw-custom text-dark-blue">Меню</h1>
    <div class="d-flex flex-column mt-3">
        <a href="/personal" class="w-100 d-flex bg-messlight rounded-3 shadow-sm py-3 px-3 text-decoration-none">
            <img class="profile-avatar rounded-pill" src="https://static.tildacdn.com/tild6361-3034-4333-b833-353964363837/pngwingcom_2.png" alt="...">
            <span class="fs-4 fw-bold text-dark-blue ms-3 my-auto">Мой профиль</span>
            <i class="bi bi-chevron-right text-dark-blue fs-5 my-auto ms-auto"></i>
        </a>
        <a href="/search_friends" class="w-100 d-flex bg-messlight rounded-3 shadow-sm py-3 px-3 mt-2 text-decoration-none">
            <i class="bi bi-person-plus text-dark-blue fs-1"></i>
            <span class="fs-4 fw-bold text-dark-blue ms-3 my-auto">Поиск друзей</span>
            <i class="bi bi-chevron-right text-dark-blue fs-5 my-auto ms-auto"></i>
        </a>
        <a href="/settings" class="w-100 d-flex bg-messlight rounded-3 shadow-sm py-3 px-3 mt-2 text-decoration-none">
            <i class="bi bi-gear text-dark-blue fs-1"></i>
            <span class="fs-4 fw-bold text-dark-blue ms-3 my-auto">Настройки</span>
            <i class="bi bi-chevron-right text-dark-blue fs-5 my-auto ms-auto"></i>
        </a>
    </div>
</div>
<script>
    menu.classList.remove('text-muted')
    menu.classList.add('text-dark-blue')
</script>
@endsection