@extends('ledger::layouts.app')

@section('content')
<div class="flex flex-col items-center">
    <div class="rounded bg-white p-4 w-full lg:w-2/3">
        <div class="text-green-500 mb-3">
            <a href="{{ route('ledger.entries.index') }}" class="text-blue-500 hover:underline flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                <span>Back to Entries</span>
            </a>
        </div>

        <h2 class="text-2xl text-gray-700 mb-3">Edit Entry</h2>

        <form class="flex flex-col" action="{{ route('ledger.entries.update', $entry->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Date</label>
            <input type="date" name="date" class="mb-3" value="{{ old('date', $entry->date) }}">

            <label>Description</label>
            <input type="text" name="description" class="mb-3" value="{{ old('description', $entry->description) }}">

            <label for="" class="mb-3">Debits</label>

            @php

            $debits = $entry->debits;
            $debitFields = [];

            for ($i = 0; $i < 3; $i++) {
                $debitFields[] = $debits[$i] ?? [];
            }

            @endphp

            @foreach ($debitFields as $index => $debit)

            <div class="mb-3">
                <select name="debits[{{ $index }}][account_id]">
                    <option value="">Select account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" @if( old('debits.'.$index.'.account_id', $debit->account_id ?? null ) == $account->id ) selected @endif >{{ $account->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="debits[{{ $index }}][amount]" step="0.01" min="0.01" value="{{ old('debits.'.$index.'.amount', isset($debit->amount) ? ($debit->amount / 100) : null) }}">
            </div>

            @endforeach

            <label for="" class="mb-3">Credits</label>

            @php

            $credits = $entry->credits;
            $creditFields = [];

            for ($i = 0; $i < 3; $i++) {
                $creditFields[] = $credits[$i] ?? [];
            }

            @endphp

            @foreach ($creditFields as $index => $credit)

            <div class="mb-3">
                <select name="credits[{{ $index }}][account_id]">
                    <option value="">Select account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" @if( old('credits.'.$index.'.account_id', $credit->account_id ?? null ) == $account->id ) selected @endif >{{ $account->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="credits[{{ $index }}][amount]" step="0.01" min="0.01" value="{{ old('credits.'.$index.'.amount', isset($credit->amount) ? ($credit->amount / 100) : null) }}">
            </div>

            @endforeach

            <button type="submit" class="p-2 rounded bg-green-500 text-white">Update Entry</button>

        </form>
        
    </div>
</div>
@endsection