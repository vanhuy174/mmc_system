<div class="form-group">
    {!! Form::label('name', 'Danh mục: ', ['class' => 'control-label']) !!}
    {!! Form::select('mmc_missionid', $list,null,['class' => 'form-control','id'=>'mmc_missionid']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Nhiệm vụ: ', ['class' => 'control-label']) !!}
    {!! Form::select('mmc_mission', $item,null , ['class' => 'form-control','id'=>'mmc_mission']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Link bài viết: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_link', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'File PDF: ', ['class' => 'control-label']) !!}
    {!! Form::file('mmc_file', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#mmc_missionid').on('change', function () {
                var selectVal = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "{{route('ajaxmission')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#mmc_mission').html(data);
                    }
                })
            });
        });
    </script>
@endsection
