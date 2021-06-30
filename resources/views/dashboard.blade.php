@extends('ledger::layouts.app')

@section('content')

<div class="grid grid-flow-row md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    @foreach ($cards as $card)
        <dashboard-card :card="{{ json_encode($card) }}"></dashboard-card>
    @endforeach
</div>
@endsection