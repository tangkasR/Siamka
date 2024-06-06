@foreach ($listBulan as $bulan)
    @foreach ($kehadirans as $data)
        @if ($bulan['i'] == $data->month)
            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                    {{ $data->year }}</td>
                <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                    {{ $bulan['bulan'] }}</td>
                <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                    {{ $data->hadir }}</td>
                <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                    {{ $data->sakit }}</td>
                <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                    {{ $data->izin }}</td>
                <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                    {{ $data->alpa }}</td>
            </tr>
        @endif
    @endforeach
@endforeach
