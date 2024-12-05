@php
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],$field,[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = old($field) ?: \Illuminate\Support\Arr::get($fieldData,'value');
    if (!isset($options)) {
        $options = \Illuminate\Support\Arr::get($fieldData,'options',[]);
    }
@endphp
<div class="select-wrapper form-group-candidature {{$cssForm ?? ''}}" id="form-group-candidature-{{$field}}">
    <label for="{{$field}}">
        {{$label ?? $field}}{{in_array('required',$validation)?'*':''}}
    </label>
    <select id="{{$field}}" name="{{$field}}">
        @if(isset($nullOption))
            <option selected="" value="">Scegli un'opzione</option>
        @endif
        @if (isset($options))
            @foreach($options as $option)
                <option value="{{\Illuminate\Support\Arr::get($option,'value')}}"
                        @if(\Illuminate\Support\Arr::get($option,'value') == $value)
                            selected
                        @endif
                >
                    {{\Illuminate\Support\Arr::get($option,'label')}}
                </option>
            @endforeach
        @endif
    </select>
</div>
