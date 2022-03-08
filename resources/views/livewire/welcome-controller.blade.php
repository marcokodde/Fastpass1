<div>
    AQUI SE DEBE DE PONER LA PÁGINA DE BIENVENIDA!!!
    <hr>
    Cliente: {{ $this->client_id}} <br>
    Token: {{ $this->token}} <br>

    @if(isset($records))
        Total de registros sugeridos: {{ $records->count()}}
    @endif


</div>
