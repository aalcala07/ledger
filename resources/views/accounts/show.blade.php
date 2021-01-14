@extends('ledger::layouts.app')

@section('content')

<div class="container-fluid p-3">
    <h1>{{ $account->name }}</h1>
    <p>{{ $account->account_type_human }}</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 100px;">Date</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
            </tr>
        </thead>
        <tbody>
            @if ($account->entries->count())
                @foreach ($account->entries as $entry)
                    <tr>
                        <td>{{ (new \Carbon\Carbon($entry->entry_date))->toDateString() }}</td>
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
        </tbody>
    </table>

    <div class="row">
        <form class="col-sm" action="{{ route('ledger.entries.create') }}" method="POST">
            @csrf
            <div class="card">
                <h5 class="card-header">Create Debit Entry</h5>
                <div class="card-body">
                    <p><small>Will @if ($account->is_debit) increase @else decrease @endif this account.</small></p>
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Description</label>
                        <div class="col-sm-9">
                            <input type="text" name="description" class="form-control" placeholder="Type a description for this transaction (optional)">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Date and Time</label>
                        <div class="col-sm-5">
                            <input type="date" name="entry_date" class="form-control" value="{{ \Carbon\Carbon::now('America/Chicago')->toDateString() }}">
                        </div>
                        <div class="col-sm-4">
                            <input type="time" name="entry_time" class="form-control" value="{{ \Carbon\Carbon::now('America/Chicago')->toTimeString() }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Account to Credit</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="credit_account_id">
                                @foreach ($accounts->except($account->id) as $creditAccount)
                                    <option value="{{ $creditAccount->id }}">{{ $creditAccount->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="decimal" name="amount" class="form-control" placeholder="Amount">
                        </div>
                    </div>
                    <input type="hidden" name="debit_account_id" value="{{ $account->id }}">
                    <button type="submit" class="btn btn-primary">Create Entry</button>
                </div>
            </div>
        </form>
        <form class="col-sm" action="{{ route('ledger.entries.create') }}" method="POST">
            @csrf
            <div class="card">
                <h5 class="card-header">Create Credit Entry</h5>
                <div class="card-body">
                    <p><small>Will @if ($account->is_debit) decrease @else increase @endif this account.</small></p>
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Description</label>
                        <div class="col-sm-9">
                            <input type="text" name="description" class="form-control" placeholder="Type a description for this transaction (optional)">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Entry Date and Time</label>
                        <div class="col-sm-5">
                            <input type="date" name="entry_date" class="form-control" value="{{ \Carbon\Carbon::now('America/Chicago')->toDateString() }}">
                        </div>
                        <div class="col-sm-4">
                            <input type="time" name="entry_time" class="form-control" value="{{ \Carbon\Carbon::now('America/Chicago')->toTimeString() }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-sm-3">Account to Debit</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="debit_account_id">
                                @foreach ($accounts->except($account->id) as $debitAccount)
                                    <option value="{{ $debitAccount->id }}">{{ $debitAccount->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="decimal" name="amount" class="form-control" placeholder="Amount">
                        </div>
                    </div>
                    <input type="hidden" name="credit_account_id" value="{{ $account->id }}">
                    <button type="submit" class="btn btn-primary">Create Entry</button>
                </div>
            </div>
        </form>
        
    </div>
</div>

@endsection