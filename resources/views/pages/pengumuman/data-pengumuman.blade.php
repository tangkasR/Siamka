@foreach ($pengumumans as $data)
    <div>
        <a href="{{ route('pengumuman.detail', ['id' => $data->id]) }}">
            <div
                class="p-6 min-h-[420px] max-w-lg border border-violet-300 rounded-2xl hover:shadow-xl hover:shadow-violet-100 flex flex-col justify-start items-start">
                <img src="{{ $data->image != '-' ? asset('storage/' . $data->image) : asset('assets/img/attention-default.jpg') }}"
                    class="shadow rounded-lg overflow-hidden border">
                <div class="mt-4 text-left">
                    <h4 class="font-bold text-[25px] line-clamp-2 py-3">{{ $data->judul }}</h4>
                    <div class="mt-2 text-gray-600 line-clamp-2">
                        {!! $data->deskripsi !!}
                    </div>
                </div>
                <div class="mt-5">
                    <button type="button"
                        class="inline-flex w-fit items-center rounded-md border border-violet-500 bg-violet-500 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-gray-900">
                        Detail Pengumuman
                    </button>
                </div>
            </div>
        </a>
    </div>
@endforeach
