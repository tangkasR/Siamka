@foreach ($nilais as $nilai)
    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
        <td class="p-4 pr-8">
            {{ $loop->iteration }}</td>
        <td class="p-4 pr-8">
            {{ $nilai->nama }}</td>
        <td class="p-4 pr-8">
            {{ $nilai->nama_mata_pelajaran }}</td>
        <td class="p-4 pr-8">
            {{ $nilai->semester }}</td>
        <td class="p-4 pr-8">
            {{ $nilai->tipe_ujian }}</td>
        <td class="p-4 pr-8">
            {{ $nilai->nilai }}</td>
        <td class="p-4 pr-8 min-w-[150px] w-[150px]">
            <a href="" class="btn-edit" data-tw-toggle="modal"><i class='bx bxs-edit'></i> Ubah</a>
        </td>
    </tr>
@endforeach
