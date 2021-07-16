@extends('ledger::layouts.app')

@section('content')

<div class="flex flex-col items-center">
    <div class="rounded bg-white p-4 w-full lg:w-2/3">
        <div class="text-green-500 mb-3">
            <a href="{{ route('ledger.accounts.index') }}" class="text-blue-500 hover:underline flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                <span>Back to Accounts</span>
            </a>
        </div>

        <h2 class="text-2xl text-gray-700 mb-3">Edit Account</h2>

        <form action="{{ route('ledger.accounts.update', $account->id) }}" method="POST">
            @csrf
            @method('put')

            <input type="text" name="name" placeholder="Account Name" value="{{ old('name', $account->name) }}">

            <select name="account_type">
                @foreach ($accountTypes as $accountType)
                    <option value="{{ $accountType }}" @if ($accountType === old('account_type', $account->account_type)) selected @endif >{{ $accountType }}</option>
                @endforeach
            </select>

            <button type="submit" class="p-2 rounded bg-green-500 text-white">Update Account</button>
        </form>
    </div>
</div>
@endsection