@php
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],$field,[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = old($field) ?: \Illuminate\Support\Arr::get($fieldData,'value');
    $maxLength = \Illuminate\Support\Arr::get($fieldData,'maxLength',env('MAX_TEXTAREA_LENGTH',500));
@endphp
<div class="form-group form-group-candidature {{$cssForm ?? ''}}" id="form-group-candidature-{{$field}}">
    <label for="{{$field}}">
        {{$label ?? $field}}{{in_array('required',$validation)?'*':''}}
    </label>
    <textarea class="form-control" id="{{$field}}" name="{{$field}}" rows="{{$rows ?? 5}}"
        placeholder="{{$placeholder ?? ' '}}"
    >
        {{$value}}
    </textarea>
    <div class="text-end">
        <span class="label label-default" id="count_message_{{$field}}"></span>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {



        var text_max = {{$maxLength}};
        var text_counter = document.getElementById('count_message_{{$field}}');
        var text = document.getElementById('{{$field}}');


        console.log("TEXTTTT::::",text.value.length,"A+"+text.value+"+B");
        text.value = text.value.trim();
        text_counter.innerText = text.value.length + ' / ' + text_max;

        text.addEventListener('keyup',function () {
            text_counter.innerText = text.value.length + ' / ' + text_max;
        })
    })
</script>
