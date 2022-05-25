@include('common.crud_header')

<div class="py-4 px-4">


    {{--  Modal para confirmar elemento --}}
    @if($confirm_delete)
        @include('common.confirm_delete')
    @endif

    {{--  Vista busquedas de items  --}}
    @if(isset($view_search))
        @include($view_search)
    @endif

    {{-- Detalle de registros --}}
    <div class="card has-table">
        @if(isset($record) && $record)
            <table class="table mb-5" id="mytable">
                @if(isset($view_table))
                    @include($view_table)
                @endif
            </table>
        @endif
    </div>

</div>
