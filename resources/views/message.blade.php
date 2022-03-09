@if($my_dialog_count != 0)
    @foreach($mess as $text)
        @if($text->sender == auth()->user()->id)
            <div class="col text-end mt-2 pe-2 ms-5">
                @if($text->read == false)
                    <span class="read me-3"></span>
                @endif
                <div class="btn-group">
                    <button type="button" class="btn py-0 px-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <div class="bg-mess1 text-start d-inline-block border-mess1 text-white pt-2 pb-1 ps-3 pe-2">
                            <span class="pe-2 text-start text-custom" style="overflow-wrap: anywhere;">{{$text->text}}</span>
                            <span style="float: right;" class="text-transparent-white time-small d-inline-block mt-2">{{substr($text->created_at, 10, 6)}}</span>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" style="position: absolute; right: 60%; top: -120%;">
                        <li><a href="/exit_mess/{{$users->id}}/{{$text->id}}" class="dropdown-item" type="button">Редактировать</a></li>
                        <li><a href="/delete_mess/{{$users->id}}/{{$text->id}}" class="dropdown-item" type="button">Удалить</a></li>
                    </ul>
                </div>
            </div>  
        @elseif($text->sender == $users->id)
            <div class="col text-start mt-2 ps-2 me-5">
                <div class="bg-mess2 text-start d-inline-block border-mess2 text-dark pt-2 pb-1 ps-3 pe-3">
                    <span class="pe-2 text-start text-custom" style="overflow-wrap: anywhere;">{{$text->text}}</span>
                    <span style="float: right;" class="text-transparent-black time-small d-inline-block mt-2">{{substr($text->created_at, 10, 6)}}</span>
                </div>
            </div>
        @endif
    @endforeach
@endif