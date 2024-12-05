@php
    $field = 'voti';
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],$field,[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = old($field) ?: \Illuminate\Support\Arr::get($fieldData,'value');
    if (!isset($options)) {
        $options = \Illuminate\Support\Arr::get($fieldData,'options',[]);
    }
    if (!is_array($value)) {
        $value = [];
    }
    if (count($value) == 0) {
        $value[] = [
            'id' => null,
            'materia_id' => null,
            'voto_anno_2' => null,
            'voto_anno_1' => null,
            'voto_primo_quadrimestre' => null,
        ];
    }

@endphp

{{--@dump($fieldData)--}}


<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th scope="col">

        </th>
        <th scope="col">
            Materia
        </th>
        <th scope="col">
            Voto finale 22/23
        </th>
        <th scope="col">
            Voto finale 23/24
        </th>
        <th scope="col">
            Voto 1° Quad. 24/25
        </th>
    </tr>
    </thead>
    <tbody id="voti_body">

    @foreach($value as $votoKey => $voto)
        <tr @if($loop->first) id="voto-row-first" @endif>
            <th scope="row">
                <button type="button" class="btn remove-voto">
                    <svg class="icon icon-danger" aria-hidden="true">
                        <use href="{{Theme::url('svg/sprites.svg')}}#it-close-circle"></use>
                    </svg>
                </button>
            </th>
            <td class="select-wrapper form-group-candidature-voti vertical-align-middle pt-2">
                <input type="hidden" name="voti-id[]" value="{{$voto['id']}}"/>
                <select name="voti-materia_id[]" class="mt-2">
                    @foreach($options as $option)
                        <option value="{{\Illuminate\Support\Arr::get($option,'value')}}"
                                @if(\Illuminate\Support\Arr::get($option,'value') == $voto['materia_id'])
                                    selected
                                @endif
                        >
                            {{\Illuminate\Support\Arr::get($option,'label')}}
                        </option>
                    @endforeach
                </select>
            </td>
            <td class="form-group form-group-candidature-voti vertical-align-middle">
                <div class="input-group input-group-candidature-voti pt-2">
                    <input type="number" class="form-control" name="voti-voto_anno_2[]"
                           value="{{$voto['voto_anno_2']}}"
                    >
                </div>
            </td>
            <td class="form-group form-group-candidature-voti vertical-align-middle">
                <div class="input-group input-group-candidature-voti pt-2">
                    <input type="number" class="form-control" name="voti-voto_anno_1[]"
                           value="{{$voto['voto_anno_1']}}"
                    >
                </div>
            </td>
            <td class="form-group form-group-candidature-voti vertical-align-middle">
                <div class="input-group input-group-candidature-voti pt-2">
                    <input type="number" class="form-control" name="voti-voto_primo_quadrimestre[]"
                           value="{{$voto['voto_primo_quadrimestre']}}"
                    >
                </div>
            </td>
        </tr>
    @endforeach


    </tbody>
    <tfoot>
    <tr>

        <th scope="col" colspan="5" class="text-center">
            <button type="button" class="btn add-voto" id="add_voto">
                <svg class="icon icon-success" aria-hidden="true">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-plus-circle"></use>
                </svg>
            </button>
        </th>
    </tr>
    <tr id="voto-row-tpl" class="d-none">
        <th scope="row">
            <button type="button" class="btn remove-voto">
                <svg class="icon icon-danger" aria-hidden="true">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-close-circle"></use>
                </svg>
            </button>
        </th>
        <td class="select-wrapper form-group-candidature-voti vertical-align-middle pt-2">
            <input class="voti-tpl" type="hidden" name="tpl-voti-id[]" value=""/>
            <select name="tpl-voti-materia_id[]" class="mt-2 voti-tpl">
                @foreach($options as $option)
                    <option value="{{\Illuminate\Support\Arr::get($option,'value')}}"
                            @if(\Illuminate\Support\Arr::get($option,'value') == $value)
                                selected
                            @endif
                    >
                        {{\Illuminate\Support\Arr::get($option,'label')}}
                    </option>
                @endforeach
            </select>
        </td>
        <td class="form-group form-group-candidature-voti vertical-align-middle">
            <div class="input-group input-group-candidature-voti pt-2">
                <input type="number" class="form-control voti-tpl" name="tpl-voti-voto_anno_2[]"
                       value=""
                >
            </div>
        </td>
        <td class="form-group form-group-candidature-voti vertical-align-middle">
            <div class="input-group input-group-candidature-voti pt-2">
                <input type="number" class="form-control voti-tpl" name="tpl-voti-voto_anno_1[]"
                       value=""
                >
            </div>
        </td>
        <td class="form-group form-group-candidature-voti vertical-align-middle">
            <div class="input-group input-group-candidature-voti pt-2">
                <input type="number" class="form-control voti-tpl" name="tpl-voti-voto_primo_quadrimestre[]"
                       value=""
                >
            </div>
        </td>
    </tr>
    </tfoot>
</table>

<script>

    document.addEventListener("DOMContentLoaded", function () {

        var removeButtons = document.querySelectorAll('.remove-voto');
        if (removeButtons.length > 0) {
            for (var i in removeButtons) {
                (removeButtons.item(i)).addEventListener('click', function (e) {
                    removeVoto(e.target)
                });
            }
        }

        var addButton = document.getElementById('add_voto');

        addButton.addEventListener('click', function (e) {
            var votiBody = document.getElementById('voti_body');
            var tplVotoRow = document.getElementById('voto-row-tpl').cloneNode(true);
            tplVotoRow.classList.remove('d-none');
            var inputEls = tplVotoRow.getElementsByClassName('voti-tpl');
            console.log("ELSS::::",inputEls);
            for (var i in inputEls) {
                var el = inputEls.item(i);
                if (!el) {
                    continue;
                }
                console.log("EL::::",inputEls.item(i));
                var name = el.getAttribute('name');
                el.setAttribute('name',name.substring(4,name.length));
                el.classList.remove('voti-tpl');
            }
            tplVotoRow.id = '';
            var rButton = tplVotoRow.getElementsByClassName('remove-voto').item(0);
            rButton.addEventListener('click', function (e) {
                removeVoto(e.target)
            });
            votiBody.appendChild(tplVotoRow);
        });

        function removeVoto(el) {
            var tr = el.closest('tr');
            tr.remove();
        }
    })
</script>
