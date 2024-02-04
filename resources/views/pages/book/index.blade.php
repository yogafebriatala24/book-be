<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
            <div class="container-fluid">
                <button data-mdb-collapse-init class="navbar-toggler" type="button"
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-bold" href="/books">Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/categories">Kategori</a>
                        </li>
                    </ul>
                </div>
                @if (!Auth::guest())
                    <div class="d-flex align-items-center">
                        <a class="text-reset me-3" href="#">
                            <i class="fas fa-shopping-cart">Selamat Datang {{ auth()->user()->name }}</i>
                        </a>
                        <div class="div">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-danger" value="Logout">
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="btn btn-primary">Login</a>
                @endif
            </div>
        </nav>

        @if (Session::get('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="my-4">


            @if (!Auth::guest())
                <h2>Tambah Buku</h2>
            @else
                <h2>List Buku</h2>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (!Auth::guest())
                <div class="modal fade" id="modalAddBuku" tabindex="-1" aria-labelledby="modalAddBukuLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalAddBukuLabel">Form Tambah Buku Baru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/books" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">
                                                Judul
                                            </label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Judul Buku">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">
                                                Dekripsi Buku
                                            </label>
                                            <input type="text" class="form-control" name="description"
                                                placeholder="Deksripsi Buku">
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label for="" class="form-label">
                                                Gambar
                                            </label>
                                            <input type="file" class="form-control" name="image_url">
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label for="" class="form-label">
                                                Tahun Rilis
                                            </label>
                                            <input type="number" min="1980" max="2021" class="form-control"
                                                name="release_year">
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label for="" class="form-label">
                                                Harga
                                            </label>
                                            <input type="number" class="form-control" name="price">
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label for="" class="form-label">
                                                Total Halaman
                                            </label>
                                            <input type="number" class="form-control" name="total_page">
                                        </div>
                                        <div class="col-md mt-4">
                                            <label for="" class="form-label">
                                                Kategori
                                            </label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="category_id">
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-12 mt-3">
                                            <button class="btn btn-primary" type="submit">Simpan Buku Baru</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalAddBuku">
                    Tambah Buku Baru
                </button>
            @endif

            @include('pages.book.modal-filter')

            <button type="button" class="btn btn-warning ms-3" data-bs-toggle="modal"
                data-bs-target="#modalFilterBuku">
                Filter
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Judul
                        </th>
                        <th>
                            Deskripsi
                        </th>
                        <th>
                            Gambar
                        </th>
                        <th>
                            Tahun Rilis
                        </th>
                        <th>
                            Harga
                        </th>
                        <th>
                            Total Halaman
                        </th>
                        <th>
                            Ketebalan
                        </th>
                        <th>
                            Kategori
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
                                {{ $item->title }}
                            </td>
                            <td>
                                {{ $item->description }}
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $item->image_url) }}"
                                    style= "width: 50px; height: 50px; object-fit: 'cover'">
                            </td>
                            <td>
                                {{ $item->release_year }}
                            </td>
                            <td>
                                {{ $item->price }}
                            </td>
                            <td>
                                {{ $item->total_page }}
                            </td>
                            <td>
                                {{ $item->thickness }}
                            </td>
                            <td>
                                {{ $item->category->name }}
                            </td>
                            <td>
                                @if (!Auth::guest())
                                    <div class="d-flex">
                                        <a href="{{ route('edit', $item->id) }}" class="btn btn-primary">
                                            Edit
                                        </a>
                                        <form action="/book/{{ $item->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger ms-3">Hapus</button>
                                        </form>
                                    </div>
                                @else
                                    <a href="/login" class="btn btn-primary">Login</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>


</body>

</html>