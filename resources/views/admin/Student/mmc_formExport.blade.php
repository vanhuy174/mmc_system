<h2>Danh sách sinh viên</h2>
<p><b>Chú thích: </b>Danh sách gồm tất cả các sinh viên thuộc khoa</p>
<table>
    <thead>
    <tr>
        <th><b>STT</b></th>
        <th><b>Mã sinh viên</b></th>
        <th><b>Họ và tên</b></th>
        <th><b>Tên lớp</b></th>
        <th><b>Khóa</b></th>
        <th><b>Ngày sinh</b></th>
        <th><b>Giới tính</b></th>
        <th><b>Email</b></th>
        <th><b>Số điện thoại</b></th>
        <th><b>Hộ khẩu thường trú</b></th>
        <th><b>Dân tộc</b></th>
        <th><b>Tôn giáo</b></th>
        <th><b>Khen thưởng</b></th>
        <th><b>Kỷ luật</b></th>
        <th><b>Số CMND</b></th>
        <th><b>Họ tên bố</b></th>
        <th><b>Quốc tịch bố</b></th>
        <th><b>Dân tộc bố</b></th>
        <th><b>Tôn giáo bố</b></th>
        <th><b>Hộ khẩu thường trú Bố</b></th>
        <th><b>Số điện thoại bố</b></th>
        <th><b>Email bố</b></th>
        <th><b>Nghề ngiệp bố</b></th>
        <th><b>Họ tên mẹ</b></th>
        <th><b>Quốc tịch mẹ</b></th>
        <th><b>Dân tộc mẹ</b></th>
        <th><b>Tôn giáo mẹ</b></th>
        <th><b>Hộ khẩu thường trú mẹ</b></th>
        <th><b>Số điện thoại mẹ</b></th>
        <th><b>Email mẹ</b></th>
        <th><b>Nghề ngiệp mẹ</b></th>
    </tr>
    </thead>
    <tbody>
    <?php $i= 1; ?>
    @foreach($datastudent as $data)
        <tr>
            <td>{{$i++}}</td>
            <td>{{ $data->mmc_studentid }}</td>
            <td>{{ $data->mmc_fullname }}</td>
            <td>
                @foreach($dataclass as $class)
                    @if($data->mmc_classid == $class->mmc_classid)
                    {{ $class->mmc_classname }}
                    @endif
                @endforeach
            </td>
            <td>{{ $data->mmc_course }}</td>
            <td>{{ date('d-m-Y', strtotime($data->mmc_dateofbirth)) }}</td>
            <td>
                @if($data->mmc_gender==1)
                    Nữ
                @else
                    Nam
                @endif
            </td>
            <td>{{ $data->mmc_email}}</td>
            <td>{{ $data->mmc_phone}}</td>
            <td>{{ $data->mmc_address }}</td>
            <td>{{ $data->mmc_ethnic }}</td>
            <td>{{ $data->mmc_religion }}</td>
            <td>{{ $data->mmc_reward }}</td>
            <td>{{ $data->mmc_descipline }}</td>
            <td>{{ $data->mmc_personalid }}</td>
            <td>{{ $data->mmc_father }}</td>
            <td>{{ $data->mmc_fathernationality }}</td>
            <td>{{ $data->mmc_fatherethnic }}</td>
            <td>{{ $data->mmc_fatherreligion }}</td>
            <td>{{ $data->mmc_fatheraddress }}</td>
            <td>{{ $data->mmc_fatherphone }}</td>
            <td>{{ $data->mmc_fatheremail }}</td>
            <td>{{ $data->mmc_fatherjob }}</td>
            <td>{{ $data->mmc_mother }}</td>
            <td>{{ $data->mmc_mothernationality }}</td>
            <td>{{ $data->mmc_motherethnic }}</td>
            <td>{{ $data->mmc_motherreligion }}</td>
            <td>{{ $data->mmc_motheraddress }}</td>
            <td>{{ $data->mmc_motherphone }}</td>
            <td>{{ $data->mmc_motheremail }}</td>
            <td>{{ $data->mmc_motherjob }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
