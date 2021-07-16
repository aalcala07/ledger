@extends('ledger::layouts.app')

@section('content')

<div class="flex flex-col items-center">
    <div class="rounded bg-white p-4 w-full lg:w-2/3">
        <div class="text-green-500 mb-6">
            Entries
        </div>

        <table class="w-full mb-6">
            @foreach ($entries as $entry)
                <tr class="bg-green-200 pt-8">
                    <td class="p-2"><strong>{{ $entry->date_short }}</strong> &ndash; {{ $entry->description }}</td>
                    <td class="p-2" colspan="2">
                        <div class="flex flex-row space-x-3 justify-end items-center">
                            <a href="{{ route('ledger.entries.edit', $entry->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                            <form action="{{ route('ledger.entries.destroy', $entry->id) }}" method="POST" class="flex justify-center">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @foreach ($entry->debits as $debit)
                <tr class="text-sm">
                    <td class="p-2">{{ $debit->account->name }}</td>
                    <td class="p-2 w-32 border-r border-l border-gray-300">{{ $debit->amount / 100 }}</td>
                    <td class="p-2 w-32"></td>
                </tr>
                @endforeach

                @foreach ($entry->credits as $credits)
                <tr class="text-sm">
                    <td class="p-2 pl-4">{{ $credits->account->name }}</td>
                    <td class="p-2 w-32 border-r border-l border-gray-300"></td>
                    <td class="p-2 w-32">{{ $credits->amount / 100 }}</td>
                </tr>
                @endforeach
            @endforeach
        </table>
        
        <div><a href="{{ route('ledger.entries.create') }}" class="p-2 rounded bg-green-500 text-white inline-block">Create Entry</a></div>
        
    </div>
</div>
@endsection