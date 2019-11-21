<h3 style="text-align: center">Trường Đại Học Công Nghệ Thông Tin Và Truyền Thông</h3>
<table style="border-collapse:collapse">
    <thead>
    <tr>
        <th style="border:2px solid black;width: 20px;"><b>Tên Lớp</b></th>
        <th style="border:2px solid black;width: 20px;">Ngành</th>
        <th style="border:2px solid black;width: 20px;">Giáo Viên Chủ Nhiệm</th>
        <th style="border:2px solid black;width: 20px;">Số Sinh Viên</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($classes as $class)
        <tr>
            <td style="border:2px solid black">{{ $class->mmc_classname }}</td>
            <td style="border:2px solid black">{{ \App\Http\Controllers\Admin\ClassController::getmajor($class->mmc_major) }}</td>
            <td style="border:2px solid black">{{ $class->mmc_headteacher }}</td>
            <td style="border:2px solid black">{{ $class->mmc_numstudent }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table style="border-collapse:collapse">
    <thead>
    <tr>
        <th style="border:2px solid black;width: 20px;"><b>Tên Lớp</b></th>
        <th style="border:2px solid black;width: 20px;">Ngành</th>
        <th style="border:2px solid black;width: 20px;">Giáo Viên Chủ Nhiệm</th>
        <th style="border:2px solid black;width: 20px;">Số Sinh Viên</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($classes as $class)
        <tr>
            <td style="border:2px solid black">{{ $class->mmc_classname }}</td>
            <td style="border:2px solid black">{{ \App\Http\Controllers\Admin\ClassController::getmajor($class->mmc_major) }}</td>
            <td style="border:2px solid black">{{ $class->mmc_headteacher }}</td>
            <td style="border:2px solid black">{{ $class->mmc_numstudent }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table style="border-collapse:collapse">
    <thead>
    <tr>
        <th style="border:2px solid black;width: 20px;"><b>Tên Lớp</b></th>
        <th style="border:2px solid black;width: 20px;">Ngành</th>
        <th style="border:2px solid black;width: 20px;">Giáo Viên Chủ Nhiệm</th>
        <th style="border:2px solid black;width: 20px;">Số Sinh Viên</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($classes as $class)
        <tr>
            <td style="border:2px solid black">{{ $class->mmc_classname }}</td>
            <td style="border:2px solid black">{{ \App\Http\Controllers\Admin\ClassController::getmajor($class->mmc_major) }}</td>
            <td style="border:2px solid black">{{ $class->mmc_headteacher }}</td>
            <td style="border:2px solid black">{{ $class->mmc_numstudent }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
