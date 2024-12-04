@foreach($candidatura->corsi as $optionIndex => $corso)
    <div class="form-check form-check-group">
{{--        <input id="{{$field}}[{{$optionIndex}}]" name="{{$field}}[]"--}}
{{--               type="checkbox"--}}
{{--               value="{{\Illuminate\Support\Arr::get($option,'value')}}"--}}
{{--               @if(in_array(\Illuminate\Support\Arr::get($option,'value'),$value))--}}
{{--                   checked="checked"--}}
{{--            @endif--}}
{{--        >--}}
        <label for="corsi[{{$optionIndex}}]">
            {{$corso->getCorsoFE()}}
        </label>
    </div>
    {{--        <option value="{{\Illuminate\Support\Arr::get($option,'value')}}"--}}
    {{--        >--}}
    {{--            {{\Illuminate\Support\Arr::get($option,'label')}}--}}
    {{--        </option>--}}
@endforeach
