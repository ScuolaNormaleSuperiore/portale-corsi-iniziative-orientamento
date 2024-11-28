@php
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],$field,[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = \Illuminate\Support\Arr::get($fieldData,'value',old($field));
@endphp
<div class="form-group form-group-candidature {{$cssForm ?? ''}}" id="form-group-candidature-{{$field}}">
    <div class="input-group input-group-candidature">
        <span class="input-group-text">
            <svg class="icon icon-sm"><use href="{{Theme::url('svg/sprites.svg')}}#it-{{$icon ?? 'pencil'}}"></use></svg></span>
        <label class="{{(isset($type) && $type == 'date') ? 'active' : ''}}" for="{{$field}}">
            {{$label ?? $field}}{{in_array('required',$validation)?'*':''}}
        </label>
        <input type="{{$type ?? 'text'}}" class="form-control" id="{{$field}}" name="{{$field}}"
                value="{{$value}}"
        >
    </div>
</div>