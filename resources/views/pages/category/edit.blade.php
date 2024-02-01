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
        @if (Session::get("success"))
            <div class="alert alert-success mt-3" role="alert">
                {{ Session::get("success") }}
            </div>
        @endif
        <div class="my-4">
            <form action="{{ route('update', $item->id) }}" method="POST">
               
                @csrf
                 @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">
                            Nama Kategori Baru
                        </label>
                        <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                    </div>

                    <div class="col-12 mt-3">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>