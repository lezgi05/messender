@extends('layout')
@section('main')
<div class="container px-4 py-3">
    <div class="d-flex">
        <a href="/home" class="me-3"><i class="bi bi-arrow-left text-dark-blue fs-4"></i></a>
        <h1 class="me-auto fw-custom text-dark-blue">Настройки</h1>
    </div>
    <div class="row row-cols-1 mt-2">
        <a href="/personal" class="col cart-menu-active d-flex align-items-center rounded-3 mb-2">
            <i class="bi bi-person text-white fs-1"></i>
            <span class="text-white ms-3 fs-4 fw-custom">Аккаунт</span>
            <i class="bi bi-chevron-right text-white fs-5 my-auto ms-auto"></i>
        </a>
        <a href="/exit" class="col cart-settings-danger d-flex align-items-center rounded-3 mb-2">
            <span class="text-danger fs-4 mx-auto">Выход</span>
        </a>
    </div>
</div>
@endsection