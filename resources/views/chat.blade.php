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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>        
    <div class="container-fluid px-0">
        <div class="d-flex pb-5 fixed-top bg-muted" style="z-index: 200; padding-top: 11px;">
            <a href="/home" class="mx-3 my-auto"><i class="bi bi-arrow-left text-dark-blue fs-4"></i></a>
            <a href="/other_profile/{{$users->id}}" class="text-decoration-none d-flex">
                @if($user_details_count == 0)
                    <img class="chats-avatar rounded-pill me-2" src="/img/default.png" alt="...">
                @else
                    @if($user_details->avatar != 'default.png')
                        <img class="chats-avatar rounded-pill me-2" src="/storage/avatar/{{$users->id}}/{{$user_details->avatar}}" alt="...">
                    @else
                        <img class="chats-avatar rounded-pill me-2" src="/img/default.png" alt="...">
                    @endif
                @endif
                <div class="d-flex flex-column my-auto ms-2">
                    <span class="text-dark-blue fs-name">@if($users->name == '') Не указано @else {{$users->surname}} {{$users->name}} @endif</span>
                    <span class="text-muted small">
                        @if($users->isOnline())
                            online
                        @else
                            не в сети
                        @endif
                    </span>
                </div>
            </a>
            <button id="go" class="btn btn-none py-0 ms-auto me-2"><i class="bi bi-three-dots-vertical text-dark-blue fs-5"></i></button>
        </div>
        <div class="bg-light-blue w-100 mes_custom">
    
            <div class="correspondence">
                <div class="row row-cols-1 h-100"> 
                
                    @if($my_dialog_count != 0)
                    <script>

                        function settest(){
                            $.ajax({    
                                type: "GET", 
                                url: '/message/{{$my_dialog->id}}',
                                /* Куда пойдет запрос */
                                method: 'get',
                                /* Метод передачи (post или get) */
                                dataType: 'html',
                                /* Тип данных в ответе (xml, json, script, html). */
                                data: {
                                    text: 'Текст'
                                },
                                /* Параметры передаваемые в запросе. */
                                success: function(data) { /* функция которая будет выполнена после успешного запроса.  */
                                    document.getElementById('goma').innerHTML = data                                    
                                    var div = $("#goma");
                                    div.scrollTop(div.prop('scrollHeight'));
                                        
                                }
                            })
                        }

                        settest();

                        
                        function setnotest(){
                            $.ajax({    
                                type: "GET", 
                                url: '/message/{{$my_dialog->id}}',
                                /* Куда пойдет запрос */
                                method: 'get',
                                /* Метод передачи (post или get) */
                                dataType: 'html',
                                /* Тип данных в ответе (xml, json, script, html). */
                                data: {
                                    text: 'Текст'
                                },
                                /* Параметры передаваемые в запросе. */
                                success: function(data) { /* функция которая будет выполнена после успешного запроса.  */
                                    document.getElementById('goma').innerHTML = data  
                                    var div = $("#goma");
                                    div.scrollTop(div.prop('scrollHeight'));
                                }
                            })
                        }
  
                        setInterval("setnotest()", 100)
                    </script>
                    @endif

                    <div id="goma" class="pt-5 pb-2 w-100 mes_correspondence"></div>

                </div>
            </div>

            <div class="bg-light-blue pt-1 pb-2 w-100" style="z-index: 200; position: fixed; bottom: 0px; height: 60px;">
                <div class="d-flex bg-light-blue mx-auto px-2">
                @if(Route::currentRouteName() == 'chat')
                    <div class="bg-muted plus-mess d-flex ps-2 ms-auto">
                        <button id="file" class="btn circle-plus-mess my-auto py-0 px-1">
                            <i class="bi bi-plus-lg text-white"></i>
                        </button>
                    </div>
                    <form id="form" class="d-flex w-100">
                        @csrf
                        <input type="text" name="text" id="text" class="input-mess py-2 px-2 w-100">
                        <button id="send_mes" class="btn btn-bone send-mess d-flex bg-muted pe-3">
                            <i class="bi bi-send-fill text-mess position-send fs-5"></i>
                        </button>   
                    </form>
                @elseif(Route::currentRouteName() == 'exit_mess')
                    <div class="bg-muted plus-mess d-flex ps-2 ms-auto">
                        <button id="file" class="btn circle-plus-mess my-auto py-0 px-1">
                            <i class="bi bi-plus-lg text-white"></i>
                        </button>
                    </div>
                    <form id="form_exit" class="d-flex w-100">
                        @csrf
                        <input type="text" name="text" value="{{$exit_mess->text}}"  id="exit_text" class="input-mess py-2 px-2 w-100">
                        <button id="exit_mess" class="btn btn-bone send-mess d-flex bg-muted pe-3">
                            <i class="bi bi-send-fill text-mess position-send fs-5"></i>
                        </button>   
                    </form>

                    <div class="fixed-exit d-flex">
                        <a href="/chat/{{$users->id}}" id="close_edit_mess" class="btn pt-1 ms-2">
                            <i class="bi bi-x-lg text-white"></i>
                        </a>
                        <span class="fs-5 ms-1">Редактирование</span>
                    </div>

                    <script>
                        $(document).ready(function(){
                            $("#form_exit").submit(function(event) { //устанавливаем событие отправки для формы с id=form
                            event.preventDefault(); //Отключаем обновление страницы

                            var form_exit_data = $(this).serialize(); //собераем все данные из формы

                            $.ajax({
                                type: "POST", //Метод отправки
                                url: "/exit_mess/{{$users->id}}/{{$exit_mess->id}}", //путь до php фаила отправителя
                                data: form_exit_data,
                                success: function() {
                                    document.getElementById('goma').scrollTop =  document.getElementById('goma').scrollHeight
                                    settest();
                                    close_edit_mess.click()
                                }
                            });   
                            
                            document.getElementById('exit_text').value = ''         
                        });
                        });
                    </script>

                @endif
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $("#form").submit(function(event) { //устанавливаем событие отправки для формы с id=form
                    event.preventDefault(); //Отключаем обновление страницы

                    var form_data = $(this).serialize(); //собераем все данные из формы

                    $.ajax({
                        type: "POST", //Метод отправки
                        url: "/message/{{$users->id}}", //путь до php фаила отправителя
                        data: form_data,
                        success: function() {
                            settest();
                        }
                    });   
                    
                    document.getElementById('text').value = ''    
                });
                });
                
                file.onclick = function() {
                    alert('Данная функция временно не доступна')
                }
            </script>
        </div>
    </div>
</body>
</html>
