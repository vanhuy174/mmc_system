<h2>Danh sách điểm sinh viên</h2>
<p><b>Chú thích: </b></p>
<table>
    <thead>
    <tr>
        <th><b>STT</b></th>
        <th><b>Mã sinh viên</b></th>
        <th><b>Họ và tên</b></th>
        <th><b>Tên lớp</b></th>
        <th><b>Khóa</b></th>
        <th><b>Điểm hệ số 4</b></th>
        <th><b>Điểm hệ số 10</b></th>
        <th><b>Xếp loại học lực</b></th>
    </tr>
    </thead>
    <tbody>
    <?php $i= 1; ?>
    @foreach($data as $key)
        <tr>
            <td>{{$i++}}</td>
            <td>{{ $key->mmc_studentid }}</td>
            <td>{{ $key->mmc_fullname }}</td>
            <td>
                @foreach($dataclass as $class)
                    @if($key->mmc_classid == $class->mmc_classid)
                        {{ $class->mmc_classname }}
                    @endif
                @endforeach
            </td>
            <td>{{ $key->mmc_course }}</td>
            <td>{{ $key->pointdetail->mmc_4grade }}</td>
            <td>{{ $key->pointdetail->mmc_10grade }}</td>
            <td>{{ hocluc($key->pointdetail->mmc_4grade) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
