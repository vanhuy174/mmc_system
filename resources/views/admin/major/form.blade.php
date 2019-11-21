<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Tên ngành: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_majorname', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('state') ? ' has-error' : ''}}">
    {!! Form::label('mmc_deptid', 'Bộ môn: ', ['class' => 'control-label']) !!}
    <select name="mmc_deptid" class="custom-select">
        <option value="0">Không thuộc bộ môn nào</option>
        @foreach($department as $item)
            @if( isset($major) && $major->mmc_deptid==$item->mmc_deptid)
                <option value="{{$item->mmc_deptid}}" selected="selected">{{$item->mmc_deptname}}</option>
            @else
                <option value="{{$item->mmc_deptid}}">{{$item->mmc_deptname}}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
    {!! Form::label('description', 'Mô tả: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
