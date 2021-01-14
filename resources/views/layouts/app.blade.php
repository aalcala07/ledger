<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<style>

body {
    height: 100vh;
}

#sidenav {
    width: 320px;
    background: #15173d;
    color: #fff;
    padding: 30px;
}

#sidenav .nav-item,
#sidenav .nav-link {
    color: #fff;
}

</style>
<body>
    <div class="d-flex flex-row" style="height: 100%;">
        <div id="sidenav">
            <h3>Ledger</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">General Ledger</a>
                </li>
                @if ($accounts->count())
                    <hr>
                    @foreach ($accounts as $account)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ledger.accounts.show', $account->id ) }}">{{ $account->name }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <hr>
            <form action="{{ route('ledger.accounts.create') }}" method="POST">
                @csrf
                <h5 class="mb-3">Create Account</h5>
                <div class="form-group">
                    <input type="text" class="form-control form-control-sm mb-3" name="name" placeholder="Account name">
                    <select name="account_type" class="form-control form-control-sm mb-3">
                        <option value="revenue">Revenue</option>
                        <option value="asset">Asset</option>
                        <option value="expense">Expense</option>
                        <option value="liability">Liability</option>
                        <option value="dividend">Dividend</option>
                        <option value="owners_equity">Owner's Equity</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Create Account</button>
            </form>
        </div>
        <div id="main" class="flex-fill">
            @yield('content')
        </div>
    </div>
</body>
</html>