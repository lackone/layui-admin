<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <input type="text" lay-affix="clear" class="layui-input" name="{{ $name }}" value="{{ $value }}"
               id="{{ getDomId() }}_{{ $name }}_laydate_datetime"
               placeholder="yyyy-MM-dd HH:mm:ss">
    </div>
</div>
<script>
    layui.use(function () {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#{{ getDomId() }}_{{ $name }}_laydate_datetime',
            type: 'datetime'
        });
    });
</script>
