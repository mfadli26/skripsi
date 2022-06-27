<div class="col-4 px-auto pb-5 card h-100">
    <div class="mx-auto">
        <h4 class="mt-5"><strong>ARTIKEL TERBARU</strong></h4>
        <div class="card">
            <ul class="list-group list-group-flush">
                @foreach ($data->artikel_terbaru AS $terbaru)
                <a href="/berita/detail/{{$terbaru->id}}" class="text-decoration-none list-group-item artikel-t">
                    <div class="row">
                        <div class="col-5">
                            <img src="{{url('/storage/gambar_artikel/'.$terbaru->gambar)}}" class="w-100">
                        </div>
                        <div class="col-7">
                            {{$terbaru->judul}}
                        </div>
                    </div>
                </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>