<div class="row">
<div class="col-lg-6">
<div class="input-group mb-3 input-group-sm">
    <div class="input-group-prepend">
        <span class="input-group-text">Ngành: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
    </div>
    {!! Form::select('mmc_majorid', $major, null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="col-lg-6">
    <div class="input-group mb-3 input-group-sm">
        <div class="input-group-prepend">
            <span class="input-group-text">Bắt đầu áp dụng khóa: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
        </div>
        <input type="text" name="mmc_course" class="form-control" required oninvalid="this.setCustomValidity('Không được bỏ trống')" oninput="this.setCustomValidity('')" value="{{ old('mmc_course') }}">
    </div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
    <h4 class="b-color-red">Khối kiến thức giáo dục đại cương</h4>
        <div id="divgddc">
            <div class="input-group mb-3 input-group-sm">
                {!! Form::select('gddc[]', $subject,null,['class' => 'select-custom width-80']) !!}
                {!! Form::number('gddcky[]',1, ['class' => 'form-control','title'=>'Kỳ']) !!}
            </div>
        </div>
        <span id="btngddc" class="btn btn-success" style="float: right">+</span><br>
    <h4>Khối kiến thức cơ sở ngành môn tự chọn</h4>
        <div id="divgddctc">
        </div>
        <span id="btngddctc" class="btn btn-success" style="float: right">+</span><br>
</div>
<div class="col-lg-6">
    <h4 class="b-color-red">Khối kiến thức cơ sở ngành</h4>
        <div id="divcsn">
            <div class="input-group mb-3 input-group-sm" >
                {!! Form::select('csn[]', $subject,null,['class' => 'select-custom width-80']) !!}
                {!! Form::number('csnky[]', 1, ['class' => 'form-control','title'=>'Kỳ']) !!}
            </div>
        </div>
        <span id="btncsn" class="btn btn-success" style="float: right">+</span><br>
    <h4>Khối kiến thức cơ sở ngành môn tự chọn</h4>
        <div id="divcsntc">
        </div>
        <span id="btncsntc" class="btn btn-success" style="float: right">+</span><br>
</div>
<div class="col-lg-6">
    <h4 class="b-color-red">Khối kiến thức chuyên ngành</h4>
        <div id="divcn">
            <div class="input-group mb-3 input-group-sm">
                {!! Form::select('cn[]', $subject,null,['class' => 'select-custom width-80']) !!}
                {!! Form::number('cnky[]', 1, ['class' => 'form-control','title'=>'Kỳ']) !!}
            </div>
        </div>
        <span id="btncn" class="btn btn-success" style="float: right">+</span><br>
    <h4>Khối kiến thức cơ sở ngành môn tự chọn</h4>
        <div id="divcntc">
        </div>
        <span id="btncntc" class="btn btn-success" style="float: right">+</span>
</div>
<div class="col-lg-6">
    <h4 class="b-color-red">Thực tập khóa luận tốt nghiệp</h4>
    <div id="divtn">
        <div class="input-group mb-3 input-group-sm" >
            {!! Form::select('tn[]', $subject,null,['class' => 'select-custom width-80']) !!}
            {!! Form::number('tnky[]', 1, ['class' => 'form-control','title'=>'Kỳ']) !!}
        </div>
    </div>
    <span id="btntn" class="btn btn-success" style="float: right">+</span><br>
    <h4>Khối kiến thức cơ sở ngành môn tự chọn</h4>
    <div id="divtntc">
    </div>
    <span id="btntntc" class="btn btn-success" style="float: right">+</span>
</div>
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
@section('scripts')
<script>
    $(document).ready(function(){
        var sum1=1;
        var sum2=1;
        var sum3=1;
        var sum4=1;
        $("#btngddc").click(function(){
            var div = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select = $("<select/>",
                { name:'gddc[]',class:'select-custom width-80' }
            );
            @foreach($subject as $key=>$item)
            select.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div.append(select);
            div.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'gddcky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            $("#divgddc").append(div);
        });
        $("#btncsn").click(function(){
            var div = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select = $("<select/>",
                { name:'csn[]',class:'select-custom width-80' }
            );
            @foreach($subject as $key=>$item)
            select.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div.append(select);
            div.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'csnky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            $("#divcsn").append(div);
        });$("#btncn").click(function(){
            var div = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select = $("<select/>",
                { name:'cn[]',class:'select-custom width-80' }
            );
            @foreach($subject as $key=>$item)
            select.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div.append(select);
            div.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'cnky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            $("#divcn").append(div);
        });$("#btntn").click(function(){
            var div = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select = $("<select/>",
                { name:'tn[]',class:'select-custom width-80' }
            );
            @foreach($subject as $key=>$item)
            select.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div.append(select);
            div.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'tnky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            $("#divtn").append(div);
        });
        $("#btngddctc").click(function(){
            var div = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select = $("<select/>",
                { name:'gddctc[]',class:'select-custom width-60' }
            );
            @foreach($subject as $key=>$item)
            select.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div.append(select);
            div.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'gddctcky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            div.append(
                $("<input>",
                    { type:'number',
                        readonly:true,
                        class:'form-control',
                        name:'gddcnhom[]',
                        value: sum1}
                )
            );
            var div2 = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select2 = $("<select/>",
                { name:'gddctc[]',class:'select-custom width-60' }
            );
            @foreach($subject as $key=>$item)
            select2.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div2.append(select2);
            div2.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'gddctcky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            div2.append(
                $("<input>",
                    { type:'text',
                        readonly:true,
                        class:'form-control',
                        name:'gddcnhom[]',
                        value: sum1}
                )
            );
            sum1++;
            $("#divgddctc").append(div,div2);
        });
        $("#btncsntc").click(function(){
            var div = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select = $("<select/>",
                { name:'csntc[]',class:'select-custom width-60' }
            );
            @foreach($subject as $key=>$item)
            select.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div.append(select);
            div.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'csntcky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            div.append(
                $("<input>",
                    { type:'number',
                        readonly:true,
                        class:'form-control',
                        name:'csnnhom[]',
                        value: sum2}
                )
            );
            var div2 = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select2 = $("<select/>",
                { name:'csntc[]',class:'select-custom width-60' }
            );
            @foreach($subject as $key=>$item)
            select2.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div2.append(select2);
            div2.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'csntcky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            div2.append(
                $("<input>",
                    { type:'text',
                        readonly:true,
                        class:'form-control',
                        name:'csnnhom[]',
                        value: sum2}
                )
            );
            sum2++;
            $("#divcsntc").append(div,div2);
        });
        $("#btncntc").click(function(){
            var div = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select = $("<select/>",
                { name:'cntc[]',class:'select-custom width-60' }
            );
            @foreach($subject as $key=>$item)
            select.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div.append(select);
            div.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'cntcky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            div.append(
                $("<input>",
                    { type:'number',
                        readonly:true,
                        class:'form-control',
                        name:'cnnhom[]',
                        value :sum3}
                )
            );
            var div2 = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select2 = $("<select/>",
                { name:'cntc[]',class:'select-custom width-60' }
            );
            @foreach($subject as $key=>$item)
            select2.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div2.append(select2);
            div2.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'cntcky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            div2.append(
                $("<input>",
                    { type:'text',
                        readonly:true,
                        class:'form-control',
                        name:'cnnhom[]',
                        value: sum3}
                )
            );
            sum3++;
            $("#divcntc").append(div,div2);
        });
        $("#btntntc").click(function(){
            var div = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select = $("<select/>",
                { name:'tntc[]',class:'select-custom width-60' }
            );
            @foreach($subject as $key=>$item)
            select.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div.append(select);
            div.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'tntcky[]',
                        title:'Kỳ',
                        value:1}
                )
            );
            div.append(
                $("<input>",
                    { type:'number',
                        readonly:true,
                        class:'form-control',
                        name:'tnnhom[]',
                        value:sum4}
                )
            );
            var div2 = $("<div/>",
                { class:'input-group mb-3 input-group-sm' }
            );

            var select2 = $("<select/>",
                { name:'tntc[]',class:'select-custom width-60' }
            );
            @foreach($subject as $key=>$item)
            select2.append(
                $("<option>",
                    {   value:'{{$key}}',
                        text:'{{$item}}' }
                )
            );
            @endforeach
            div2.append(select2);
            div2.append(
                $("<input>",
                    { type:'number',
                        class:'form-control',
                        name:'tntcky[]',
                        value:1,
                        title:'Kỳ'
                    }
                )
            );
            div2.append(
                $("<input>",
                    { type:'text',
                        readonly:true,
                        class:'form-control',
                        name:'tnnhom[]',
                        value: sum4}
                )
            );
            sum4++;
            $("#divtntc").append(div,div2);
        });
    });
</script>
@endsection

