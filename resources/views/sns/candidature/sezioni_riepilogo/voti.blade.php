<table class="table table-striped table-responsive">
    <thead>
    <tr>
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

    @foreach($candidatura->voti as $votoKey => $voto)
        <tr>
            <td class="select-wrapper form-group-candidature-voti vertical-align-middle pt-2">
                {{$voto->materia->nome}}
            </td>
            <td class="form-group form-group-candidature-voti vertical-align-middle">
                {{$voto->voto_anno_2}}
            </td>
            <td class="form-group form-group-candidature-voti vertical-align-middle">
                {{$voto->voto_anno_1}}
            </td>
            <td class="form-group form-group-candidature-voti vertical-align-middle">
                {{$voto->voto_primo_quadrimestre}}
            </td>
        </tr>
    @endforeach


    </tbody>
</table>

