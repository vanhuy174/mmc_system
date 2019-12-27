<h4 style="text-align: center">Thêm mới danh mục gốc</h4>
<div class="form-group">
    {!! Form::label('name', 'Tên danh mục: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_mission', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
