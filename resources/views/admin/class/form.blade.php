<div class="row">
    <div class="col-lg-6">
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Tên lớp: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            {!! Form::text('mmc_classname', null, ['class' => 'form-control']) !!}

        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Ngành: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            {!! Form::select('mmc_major', $major, isset($class) ? $class->mmc_major : null, ['class' => 'form-control','id'=>'mmc_major']) !!}
        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Chương trình đạo tạo <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            <select name="mmc_ctdt" id="mmc_ctdt" class="form-control">
                @foreach($education as $item)
                    @if(isset($class) && $class->mmc_ctdt==$item->mmc_course)
                        <option selected>{{$item->mmc_course}}</option>
                    @else
<<<<<<< HEAD
                        <option selected>{{$item->mmc_course}}</option>
=======
                        <option >{{$item->mmc_course}}</option>
>>>>>>> 9ebf5f8656a348f20c1c0344f8436ce209bb5cf6
                    @endif
                @endforeach
            </select>
        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Số sinh viên: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            {!! Form::text('mmc_numstudent', null, ['class' => 'form-control']) !!}

        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Giáo viên chủ nhiệm: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            <select name="mmc_headteacher" class="form-control">
                @foreach($department as $item)
                    <optgroup label="{{$item->mmc_deptname}}">
                        @foreach($employee as $employeeitem)
                            @if($employeeitem->mmc_deptid == $item->mmc_deptid)
                                @if(isset($class) && $employeeitem->mmc_employeeid == $class->mmc_headteacher)
                                  <option value="{{$employeeitem->mmc_employeeid}}" selected>{{$employeeitem->mmc_name}}</option>
                                @else
                                    <option value="{{$employeeitem->mmc_employeeid}}">{{$employeeitem->mmc_name}}</option>
                                @endif
                            @endif
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Mô tả: </span>
            </div>
            {!! Form::text('mmc_description', null, ['class' => 'form-control']) !!}

        </div>
    </div>
    <div class="col-lg-6">
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Lớp trưởng: </span>
            </div>
            {!! Form::text('mmc_monitor', null, ['class' => 'form-control']) !!}

        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Bí thư: </span>
            </div>
            {!! Form::text('mmc_secretary', null, ['class' => 'form-control']) !!}

        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Lớp phó: </span>
            </div>
            {!! Form::text('mmc_vicemonitor', null, ['class' => 'form-control']) !!}

        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Ủy viên: </span>
            </div>
            {!! Form::text('mmc_vicesecretary1', null, ['class' => 'form-control']) !!}

        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Ủy viên 2: </span>
            </div>
            {!! Form::text('mmc_vicesecretary2', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="input-group mb-3 input-group-sm">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#mmc_major').on('change', function () {
                var selectVal = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "{{route('ajax')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#mmc_ctdt').html(data);
                    }
                })
            });
        });
    </script>
@endsection

