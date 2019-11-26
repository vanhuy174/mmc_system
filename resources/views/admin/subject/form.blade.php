<div class="form-group">
    {!! Form::label('name', 'Tên môn học: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_subjectname', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('tinchi', 'Số tín chỉ: ', ['class' => 'control-label']) !!}
    {!! Form::number('mmc_tinchi', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Mô tả: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
