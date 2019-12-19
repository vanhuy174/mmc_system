<div class="form-group">
    {!! Form::label('name', 'Mã học phần: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_subjectid', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Tên học phần: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_subjectname', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('tinchi', 'Số tín lý thuyết: ', ['class' => 'control-label']) !!}
    {!! Form::number('mmc_theory', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('tinchi', 'Số tín thực hành: ', ['class' => 'control-label']) !!}
    {!! Form::number('mmc_practice', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Mô tả: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
