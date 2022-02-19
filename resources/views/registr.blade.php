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
<main class="form-signin mx-auto mt-auth">
  <form action="/reg" method="POST" class="w-75 d-flex flex-column mx-auto">
      @csrf
    <h1 class="h3 mb-3 fw-normal text-center">Регистрация</h1>

    <div class="form-floating mb-2 mt-1">
      <input type="tel" name="tel" data-tel-input class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Телефон</label>
      @error('tel')<div class="text-danger">{{$message}}</div>@enderror
    </div>
    <div class="form-floating mb-2">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Пароль</label>
      @error('password')<div class="text-danger">{{$message}}</div>@enderror
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="password_confirmation" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Повторите пароль</label>
      @error('password_confirmation')<div class="text-danger">{{$message}}</div>@enderror
    </div>

    <button class="w-100 btn btn-lg bg-mess1 text-white" type="submit">Зарегистрироваться</button>
  </form>
  <a href="/" class="d-block text-center mt-2 text-decoration-none text-dark-blue">Уже зарегистрированы? Войдите на сайт</a>
</main>

<script src="/script.js"></script>
</body>
</html>