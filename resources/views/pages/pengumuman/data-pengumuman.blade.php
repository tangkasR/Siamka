@foreach ($pengumumans as $data)
    <div>
        <a href="{{ route('pengumuman.detail', ['pengumuman' => $data]) }}">
            <div
                class="p-3 pb-6 max-w-lg border border-violet-300 rounded-2xl hover:shadow-xl hover:shadow-violet-100 flex flex-col justify-start items-start">
                <img src="{{ $data->image != '-' ? asset('storage/' . $data->image) : asset('assets/img/attention-default.jpg') }}"
                    class="shadow rounded-lg overflow-hidden border">
                <div class="mt-4 text-left">
                    <h4 class="font-bold text-[18px] py-3">{{ $data->judul }}</h4>
                    <div class="mt-2 text-gray-600 line-clamp-2">
                        {!! $data->deskripsi !!}
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach
