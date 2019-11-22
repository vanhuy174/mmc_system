<div class="row">
    <div class="col-lg-6">
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Tên lớp: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            {!! Form::text('mmc_classname', null, ['class' => 'form-control', 'required' => 'required']) !!}

        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Ngành: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            {!! Form::select('mmc_major', $major, isset($class) ? $class->mmc_major : null, ['class' => 'form-control']) !!}
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
            {!! Form::text('mmc_headteacher', null, ['class' => 'form-control']) !!}

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

