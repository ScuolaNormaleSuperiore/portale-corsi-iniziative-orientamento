@php
    if (!isset($options)) {
        $options = \Illuminate\Support\Arr::get($sectionData['fields'][$field],'options',[]);
    }
@endphp
<div class="select-wrapper form-group-candidature {{$cssForm ?? ''}}" id="form-group-candidature-{{$field}}">
    <label for="{{$field}}">{{$label ?? $field}}</label>
    <select id="{{$field}}" name="{{$field}}">
        @if(isset($nullOption))
            <option selected="" value="">Scegli un'opzione</option>
        @endif
        @if (isset($options))
            @foreach($options as $option)
                <option value="{{\Illuminate\Support\Arr::get($option,'value')}}">
                    {{\Illuminate\Support\Arr::get($option,'label')}}
                </option>
            @endforeach
        @endif
    </select>
</div>