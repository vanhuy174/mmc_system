<h4 style="text-align: center">Thêm mới danh mục</h4>
<div class="form-group">
    {!! Form::label('name', 'Danh mục: ', ['class' => 'control-label']) !!}
    {!! Form::select('mmc_missionid', $list, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Nhiệm vụ: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_missions', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Hệ số: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_coefficient', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Số giờ chuẩn: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_sogiochuan', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
