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
    <tbody id="voti_body">

        <tr>
            <th scope="row">
                <div class="pt-3">
                Inglese
                </div>
            </th>
            <th>
                @include('candidature.form.select',['field' => 'inglese_livello_linguistico_id','cssForm' => 'inTable'])

            </th>
        </tr>

        <tr>
            <th scope="row">
                <div class="pt-3">
                Francese
                </div>
            </th>
            <th>
                @include('candidature.form.select',['field' => 'francese_livello_linguistico_id','cssForm' => 'inTable'])
            </th>
        </tr>

        <tr>
            <th scope="row">
                <div class="pt-3">
                Tedesco
                </div>
            </th>
            <th>
                @include('candidature.form.select',['field' => 'tedesco_livello_linguistico_id','cssForm' => 'inTable'])
            </th>
        </tr>

        <tr>
            <th scope="row">
                <div class="pt-3">
                Spagnolo
                </div>
            </th>
            <th>
                @include('candidature.form.select',['field' => 'spagnolo_livello_linguistico_id','cssForm' => 'inTable'])
            </th>
        </tr>

        <tr>
            <th scope="row">
                <div class="pt-3">
                Cinese
                </div>
            </th>
            <th>
                @include('candidature.form.select',['field' => 'cinese_livello_linguistico_id','cssForm' => 'inTable'])
            </th>
        </tr>

        <tr>
            <th scope="row">
                <div class="pt-3">
                Altro
                </div>
            </th>
            <th>
                @include('candidature.form.input-icon',['field' => 'altre_competenze_linguistiche','cssForm' => 'inTable last'])
            </th>
        </tr>
    </tbody>
</table>
