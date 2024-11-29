@php
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],$field,[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = \Illuminate\Support\Arr::get($fieldData,'value',old($field));
@endphp
<div class="form-group form-group-candidature {{$cssForm ?? ''}}" id="form-group-candidature-{{$field}}">
    <label for="{{$field}}">
        {{$label ?? $field}}{{in_array('required',$validation)?'*':''}}
    </label>
    <textarea class="form-control" id="{{$field}}" name="{{$field}}" rows="{{$rows ?? 5}}">
        {{$value}}
    </textarea>
</div>