@extends('ledger::layouts.app')

@section('content')

<div class="flex flex-col items-center">
    <div class="rounded bg-white p-4 w-full lg:w-2/3">
        <div class="text-green-500 mb-6">
            Create Entry
        </div>

        <form class="flex flex-col" action="{{ route('ledger.entries.store') }}" method="POST">
            @csrf

            <label>Date</label>
            <input type="date" name="date" class="mb-3" value="{{ old('date', \Carbon\Carbon::now()->toDateString() ) }}">

            <label>Description</label>
            <input type="text" name="description" class="mb-3" value="{{ old('description') }}">

            <label for="" class="mb-3">Debits</label>

            <div class="mb-3">
                <select name="debits[0][account_id]">
                    <option value="">Select account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" @if( old('debits.0.account_id') == $account->id ) selected @endif >{{ $account->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="debits[0][amount]" step="0.01" min="0.01" value="{{ old('debits.0.amount') }}">
            </div>

            <div class="mb-3">
                <select name="debits[1][account_id]">
                    <option value="">Select account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" @if( old('debits.1.account_id') == $account->id ) selected @endif>{{ $account->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="debits[1][amount]" step="0.01" min="0.01" value="{{ old('debits.1.amount') }}">
            </div>

            <div class="mb-3">
                <select name="debits[2][account_id]">
                    <option value="">Select account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" @if( old('debits.2.account_id') == $account->id ) selected @endif>{{ $account->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="debits[2][amount]" step="0.01" min="0.01" value="{{ old('debits.2.amount') }}">
            </div>

            <label for="" class="mb-3">Credits</label>

            <div class="mb-3">
                <select name="credits[0][account_id]">
                    <option value="">Select account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" @if( old('credits.0.account_id') == $account->id ) selected @endif >{{ $account->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="credits[0][amount]" step="0.01" min="0.01" value="{{ old('credits.0.amount') }}">
            </div>

            <div class="mb-3">
                <select name="credits[1][account_id]">
                    <option value="">Select account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" @if( old('credits.1.account_id') == $account->id ) selected @endif >{{ $account->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="credits[1][amount]" step="0.01" min="0.01" value="{{ old('credits.1.amount') }}">
            </div>

            <div class="mb-3">
                <select name="credits[2][account_id]">
                    <option value="">Select account</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" @if( old('credits.2.account_id') == $account->id ) selected @endif >{{ $account->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="credits[2][amount]" step="0.01" min="0.01" value="{{ old('credits.2.amount') }}">
            </div>

            <button type="submit" class="p-2 rounded bg-green-500 text-white">Create Entry</button>

        </form>
        
    </div>
</div>
@endsection