@if($my_dialog_count != 0)
    @foreach($mess as $text)
        @if($text->sender == auth()->user()->id)
            <div class="col text-end mt-2">
                <div class="py-1 pe-3">
                    <span class="bg-mess1 border-mess1 text-white py-2 ps-3 pe-3">{{$text->text}}</span>
                    <div class="text-muted time-small mt-2">{{substr($text->created_at, 10, 6)}}</div>
                </div>
            </div>
        @elseif($text->sender == $users->id)
            <div class="col text-start mt-2">
                <div class="py-1 ps-3">
                    <span class="bg-mess2 border-mess2 text-dark py-2 ps-3 pe-3">{{$text->text}}</span>
                    <div class="text-muted time-small mt-2">{{substr($text->created_at, 10, 6)}}</div>
                </div>
            </div>
        @endif
    @endforeach
@endif