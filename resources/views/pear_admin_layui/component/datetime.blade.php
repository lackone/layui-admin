<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <input type="text" class="layui-input" name="{{ $name }}" value="{{ $value }}" id="{{ $name }}_laydate_datetime"
               placeholder="yyyy-MM-dd HH:mm:ss">
    </div>
</div>
<script>
    layui.use(function () {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#{{ $name }}_laydate_datetime',
            type: 'datetime'
        });
    });
</script>
