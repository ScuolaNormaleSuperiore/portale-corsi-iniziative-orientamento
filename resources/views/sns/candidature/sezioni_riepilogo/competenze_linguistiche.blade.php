<table class="table table-responsive ">
    <thead>
    <tr>
        <th scope="col">
            Lingua
        </th>
        <th scope="col">
            Competenza
        </th>
    </tr>
    </thead>
    <tbody id="">

    <tr>
        <th scope="row">
            <p>
                Inglese
            </p>
        </th>
        <th>
            @include('candidature.form.riepilogo-text',['value' => $candidatura->inglese->nome,'hr' => false])
        </th>
    </tr>

    <tr>
        <th scope="row">
            <p>
                Francese
            </p>
        </th>
        <th>
            @include('candidature.form.riepilogo-text',['value' => $candidatura->francese->nome,'hr' => false])
        </th>
    </tr>

    <tr>
        <th scope="row">
            <p>
                Tedesco
            </p>
        </th>
        <th>
            @include('candidature.form.riepilogo-text',['value' => $candidatura->tedesco->nome,'hr' => false])
        </th>
    </tr>

    <tr>
        <th scope="row">
            <p>
                Spagnolo
            </p>
        </th>
        <th>
            @include('candidature.form.riepilogo-text',['value' => $candidatura->spagnolo->nome,'hr' => false])
        </th>
    </tr>

    <tr>
        <th scope="row">
            <p>
                Cinese
            </p>
        </th>
        <th>
            @include('candidature.form.riepilogo-text',['value' => $candidatura->cinese->nome,'hr' => false])
        </th>
    </tr>

    <tr>
        <th scope="row">
            <p>
                Altro
            </p>
        </th>
        <th>
            @include('candidature.form.riepilogo-text',['value' => $candidatura->altre_competenze_linguistiche,'hr' => false])
        </th>
    </tr>
    </tbody>
</table>
