<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-inline" id="{{ $name }}_laydate_datetime_range">
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" name="{{ $name }}_start" value="{{ $value['start'] }}" id="{{ $name }}_start" class="layui-input" placeholder="开始时间">
        </div>
        <div class="layui-form-mid">-</div>
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" name="{{ $name }}_end" value="{{ $value['end'] }}" id="{{ $name }}_end" class="layui-input" placeholder="结束时间">
        </div>
    </div>
</div>
<script>
    layui.use(function () {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#{{ $name }}_laydate_datetime_range',
            range: ['#{{ $name }}_start', '#{{ $name }}_end'],
            type: 'datetime'
        });
    });
</script>
