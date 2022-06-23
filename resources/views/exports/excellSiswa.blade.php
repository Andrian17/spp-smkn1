<table>
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Nis</th>
            <th scope="col">Jenis Kelamain</th>
            <th scope="col">No HP</th>
            <th scope="col">Semester</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Agama</th>
            <th scope="col">Angkatan</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Alamat</th>
            <th scope="col">Mid-semester</th>
            <th scope="col">Akhir-Semester</th>
            <th scope="col">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswa as $s)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->nis }}</td>
                <td>{{ $s->jenis_kelamin }}</td>
                <td>{{ $s->no_hp }}</td>
                <td>{{ $s->semester }}</td>
                <td>{{ $s->tanggal_lahir }}</td>
                <td>{{ $s->agama }}</td>
                <td>{{ $s->angkatan }}</td>
                <td>{{ $s->kelas->kelas }}</td>
                <td>{{ $s->jurusan->jurusan }}</td>
                <td>{{ $s->alamat->alamat }}</td>
                <td>
                    @if ($s->utsPayments[0]->status_pembayaran == "success")
                        lunas
                    @else
                        belum
                    @endif
                </td>
                <td>
                    @if ($s->uasPayments[0]->status_pembayaran == "success")
                        lunas
                    @else
                        belum
                    @endif
                </td>
                <td>{{ $s->utsPayments[0]->nominal_pembayaran }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
