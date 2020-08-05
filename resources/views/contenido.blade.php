@extends('index')
@section('contenido')

    <template v-if="menu==0">
        <jugar-sudoku></jugar-sudoku> 
    </template>

    <template v-if="menu==1">
        <jugadores-historial></jugadores-historial>
    </template>

@endsection
