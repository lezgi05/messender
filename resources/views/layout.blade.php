<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="\style.css">
</head>
<body>

    <header class="d-flex header-bottom justify-content-evenly fixed-bottom py-3">
        <a href="/home" class="px-2"><i id="home" class="bi bi-chat-left text-muted fs-4"></i></a>
        <a href="/friends" class="px-2"><i id="friends" class="bi bi-people text-muted fs-4"></i></a>
        <a href="/profile" class="px-2"><i id="profile" class="bi bi-person text-muted fs-4"></i></a>
    </header>

    @yield('main')    

    <!-- Начало меню -->
    <div class="offcanvas offcanvas-start w-75" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-body bg-light-blue pb-0 px-0">
            <div class="d-flex flex-column h-100">
                <div class="px-3">
                    <div class="row row-cols-1">
                        <a href="/personal" class="col cart-menu-active d-flex align-items-center rounded-3 mb-2">
                            <i class="bi bi-person-circle text-white fs-5 me-2"></i>
                            <span class="text-white">Мой профиль</span>
                        </a>
                        <a href="/search_friends" class="col cart-menu d-flex align-items-center rounded-3 mb-2">
                            <i class="bi bi-person-plus text-dark-blue fs-5 me-2"></i>
                            <span class="text-dark-blue">Поиск друзей</span>
                        </a>
                    </div>
                </div>
                <a href="/settings" class="cart-setting d-flex align-items-center px-3 mt-auto">
                    <i class="bi bi-gear text-white fs-5 me-2"></i>
                    <span class="text-white">Основные настройки</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Конец меню -->
</body>
</html>