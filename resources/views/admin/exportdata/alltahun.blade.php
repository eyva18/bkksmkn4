<table>
    <thead>
        <tr>
            <th><strong>No</strong></th>
            <th><strong>Nama Alumni</strong></th>
            <th><strong>Bekerja</strong></th>
            <th><strong>Melanjutkan Pendidikan</strong></th>
            <th><strong>Nama Universitas</strong></th>
            <th><strong>Nama Perusahaan</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataalumni as $no => $alumni)
        <tr>
            <th>{{ ++$no }}</th> 
            <td>{{ $alumni->nama ?? '-'}}</td>
            <td>{{ ($statusalumni[$alumni->id]->bekerja ?? '-') == "bekerja" ? '✓' : 'X' }}</td>
            <td>{{ ($statusalumni[$alumni->id]->pendidikan ?? '-') == "melanjutkan pendidikan" ? '✓' : 'X' ?? 'X'}}</td>
            <td>{{ $statusalumni[$alumni->id]->universitas ?? '-'}}</td>
            <td>{{ $statusalumni[$alumni->id]->perusahaan ?? '-'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>