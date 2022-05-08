<style>
    .page-break {
        page-break-after: always;
    }

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

<body>

    <div class="">
        <div class="row">
            <div class="float-leaft">
                {{-- <img src="{{ asset('assets/build/images/logomecanic.png') }}" with="30px" height="30px"> --}}
            </div>
            <div class="float-right">
                <h2>Lista de usuarios</h2>
            </div>
        </div>

        <table class="table table-dark table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id1</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_status->name }}</td>
                        <td>{{ $user->roles()->first()->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</body>
