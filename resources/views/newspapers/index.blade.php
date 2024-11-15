<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Newspapers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Daftar Newspaper</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('newspapers.create') }}" class="btn btn-md btn-success mb-3">ADD NEWSPAPER</a>
                        <a href="{{ Auth::user()->usertype == 'admin' ? url('admin/dashboard') : url('librarian/dashboard') }}" class="btn btn-md btn-secondary mb-3">BACK TO DASHBOARD</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">TITLE</th>
                                    <th scope="col">PUBLISHER</th>
                                    <th scope="col">PUBLICATION DATE</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($newspapers as $newspaper)
                                    <tr>
                                        <td>{{ $newspaper->title }}</td>
                                        <td>{{ $newspaper->publisher }}</td>
                                        <td>{{ $newspaper->publication_date }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('newspapers.destroy', $newspaper->id) }}" method="POST">
                                                <a href="{{ route('newspapers.show', $newspaper->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('newspapers.edit', $newspaper->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Newspapers belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $newspapers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

</body>
</html>
