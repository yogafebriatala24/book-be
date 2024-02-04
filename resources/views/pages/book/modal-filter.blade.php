<div class="modal fade" id="modalFilterBuku" tabindex="-1" aria-labelledby="modalFilterBukuLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalFilterBukuLabel">Filter Data Buku Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">
                                Cari Title Buku
                            </label>
                            <input type="text" class="form-control" value="{{ request()->get('title') }}"
                                name="title" placeholder="cari">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">
                                Urutan Title
                            </label>
                            <div class="d-flex">
                                <div class="">
                                    <input class="form-check-input" type="radio" value="asc"
                                        {{ request()->get('sortByTitle') === 'asc' ? 'checked' : '' }}
                                        name="sortByTitle" id="sortByTitleAsc">
                                    <label class="form-check-label" for="sortByTitleAsc">
                                        ASCANDING
                                    </label>
                                </div>
                                <div class="ms-3">
                                    <input class="form-check-input" type="radio" value="desc"
                                        {{ request()->get('sortByTitle') === 'desc' ? 'checked' : '' }}
                                        name="sortByTitle" id="sortByTitleDesc">
                                    <label class="form-check-label" for="sortByTitleDesc">
                                        DESCANDING
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Minimal Tahun</label>
                            <input min="1980" max="2021" type="number" name="minYear"
                                value="{{ request()->get('minYear') }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Maksimal Tahun</label>
                            <input min="1980" max="2021" type="number" name="maxYear"
                                value="{{ request()->get('maxYear') }}" class="form-control">
                        </div>

                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary ">Filter Data</button>
                        @if (request()->get('maxYear') || request()->get('title') || request()->get('sortByTitle'))
                            <a href="/books" class="btn btn-secondary ms-3">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>