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
        <div class="d-flex justify-content-around pt-4 pb-5 fixed-top bg-muted" style="z-index: 200;">
            <a href="/home"><i class="bi bi-arrow-left text-dark-blue fs-5"></i></a>
            <span class="text-dark-blue fs-name">{{$users->tel}}</span>
            <button id="go" class="btn btn-none py-0"><i class="bi bi-three-dots-vertical text-dark-blue fs-5"></i></button>
        </div>
        <div class="bg-light-blue w-100 mes_custom">
    
            <div class="correspondence">
                <div class="row row-cols-1 h-100">                

                    <script>
                        function settest(){
                            $.ajax({
                                url: '/message/{{$users->id}}',
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
                                    document.getElementById('goma').scrollTop = document.getElementById('goma').scrollHeight

                                }
                            })
                        }

                        settest();  

                        $(document).ready(function(){
                            $("#form").submit(function(event) { //устанавливаем событие отправки для формы с id=form
                                event.preventDefault(); //Отключаем обновление страницы
                                settest();                   
                            });
                        });
                    </script>

                    <div id="goma" class="pt-5 pb-1 w-100 mes_correspondence"></div>
                </div>
            </div>

            <form id="form" class="bg-light-blue pt-1 pb-2 w-100" style="z-index: 200; position: fixed; bottom: 0px; height: 60px;">
                @csrf
                <div class="d-flex bg-light-blue mx-auto">
                    <div class="bg-muted plus-mess d-flex ps-2 ms-auto">
                        <div class="circle-plus-mess my-auto">
                            <i class="bi bi-plus fs-5 wh-item"></i>
                        </div>
                    </div>
                    <input type="text" name="user_2" value="{{$users->id}}" hidden>
                    <input type="text" name="text" id="text" class="input-mess py-2 px-2 w-75">
                    <button id="send_mes" class="btn btn-bone send-mess d-flex bg-muted me-auto pe-3">
                        <i class="bi bi-send-fill text-mess position-send fs-5"></i>
                    </button>
                </div>
            </form>

            <script>
                $(document).ready(function(){
                    $("#form").submit(function(event) { //устанавливаем событие отправки для формы с id=form
                    event.preventDefault(); //Отключаем обновление страницы

                    var form_data = $(this).serialize(); //собераем все данные из формы

                    $.ajax({
                        type: "POST", //Метод отправки
                        url: "/message", //путь до php фаила отправителя
                        data: form_data,
                        success: function() {
                            document.getElementById('goma').scrollTop =  document.getElementById('goma').scrollHeight
                            send_mes.click();
                        }
                    });   
                    
                    document.getElementById('text').value = ''    
                });
                });
                
            </script>
        </div>
    </div>
</body>
</html>