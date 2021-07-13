@extends('ledger::layouts.app')

@section('content')

<div class="flex flex-col items-center">
    <div class="rounded bg-white p-4 w-full lg:w-2/3">
        <div class="text-green-500 mb-6">
            {{ $account->name }} ({{ $account->account_type_human }})
        </div>

        <table class="">
            <thead>
                <tr>
                    <th style="width: 100px;">Date</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                </tr>
            </thead>
            <tbody>
                @php

                /*
                @if ($account->entries->count())
                    @foreach ($account->entries as $entry)
                        <tr>
                            <td>{{ (new \Carbon\Carbon($entry->date))->toDateString() }}</td>
                            <td>{{ $entry->description }}</td>
                            @if ($entry->debit_account_id === $account->id) 
                                <td>{{ $entry->amount }}</td>
                                <td></td>
                            @else
                                <td></td>
                                <td>{{ $entry->amount }}</td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="4">There are no entries.</td></tr>
                @endif

                */

                @endphp
            </tbody>
        </table>


    </div>
</div>

@endsection