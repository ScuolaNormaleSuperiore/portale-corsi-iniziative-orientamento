@php
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],$field,[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = \Illuminate\Support\Arr::get($fieldData,'value',old($field));
    if (!isset($options)) {
        $options = \Illuminate\Support\Arr::get($fieldData,'options',[]);
    }
@endphp

<fieldset class="form-group-candidature {{$cssForm ?? ''}}" id="form-group-candidature-{{$field}}">
    <legend>{{$label ?? $field}}</legend>
@if (isset($options))
    @foreach($options as $optionIndex => $option)
        <div class="form-check form-check-group">
            <input id="{{$field}}[{{$optionIndex}}]" name="{{$field}}[]"
                   type="checkbox"
                   value="{{\Illuminate\Support\Arr::get($option,'value')}}"
                   @if(in_array(\Illuminate\Support\Arr::get($option,'value'),$value))
                       checked="checked"
                   @endif
            >
            <label for="{{$field}}[{{$optionIndex}}]">
                {{\Illuminate\Support\Arr::get($option,'label')}}
            </label>
        </div>
{{--        <option value="{{\Illuminate\Support\Arr::get($option,'value')}}"--}}
{{--        >--}}
{{--            {{\Illuminate\Support\Arr::get($option,'label')}}--}}
{{--        </option>--}}
    @endforeach
@endif
</fieldset>

{{--<div class="form-group form-group-candidature {{$cssForm ?? ''}}" id="form-group-candidature-{{$field}}">--}}
{{--    <label for="{{$field}}">--}}
{{--        {{$label ?? $field}}{{in_array('required',$validation)?'*':''}}--}}
{{--    </label>--}}
{{--    <textarea class="form-control" id="{{$field}}" name="{{$field}}" rows="{{$rows ?? 5}}">--}}
{{--        {{$value}}--}}
{{--    </textarea>--}}
{{--</div>--}}
