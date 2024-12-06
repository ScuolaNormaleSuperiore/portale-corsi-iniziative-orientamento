@php
    $hr = $hr ?? true;
@endphp
<div class="">
    @if (isset($label) && $label)
        <p class="riepilogo-label">{{$label}}</p>
    @endif
    <p class="riepilogo-value">{{$value}}</p>
    @if($hr)
        <hr/>
    @endif
</div>
