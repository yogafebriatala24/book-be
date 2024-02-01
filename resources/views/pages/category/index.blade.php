<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/categories">Kategori</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/books">Book</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
        
        @if (Session::get("success"))
            <div class="alert alert-success mt-3" role="alert">
                {{ Session::get("success") }}
            </div>
        @endif
        <div class="my-4">

            <h2>Tambah Kategori</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/categories" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">
                            Nama Kategori Baru
                        </label>
                        <input type="text" class="form-control" name="name" placeholder="Kategori baru">
                    </div>

                    <div class="col-12 mt-3">
                        <button class="btn btn-primary" type="submit">Tambah Data Baru</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Nama
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('editcategories', $item->id) }}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <form action="/categories/{{ $item->id }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger ms-3">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="text-center">
                                    Tidak ada data
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>