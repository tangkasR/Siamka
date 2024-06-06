@foreach ($rekaps as $data)
    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }} ">
        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
            {{ $data->tahun }}
        </td>
        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
            {{ $data->bulan }}
        </td>
        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
            {{ $data->total_kehadiran }}
        </td>
    </tr>
@endforeach
