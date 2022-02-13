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
    <h1 class="h3 fw-normal text-center">Укажите своё имя и фамилию</h1>
    <form action="/name_surname/{{auth()->user()->id}}" method="POST" class="w-75 d-flex flex-column mx-auto">
    @csrf

        <span class="mb-2 text-muted">В последующем вы сможете изменить эти данные</span>

        <div class="form-floating mb-2 mt-1">
            <input type="tel" name="name" class="form-control" id="floatingInput" placeholder="Имя">
            <label for="floatingInput">Имя</label>
            @if($errors -> has('name')) 
                <div class="text-danger">{{$errors -> first('name')}}</div>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="surname" class="form-control" id="floatingPassword" placeholder="Фамилия">
            <label for="floatingPassword">Фамилия</label>
            @if($errors -> has('surname')) 
                <div class="text-danger">{{$errors -> first('surname')}}</div>
            @endif
        </div>

        <button class="w-100 btn btn-lg bg-mess1 text-white" type="submit">Сохранить</button>
    </form>
</main>

<script src="/script.js"></script>
</body>
</html>