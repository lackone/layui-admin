<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <input type="text" name="{{ $name }}" value="{{ $value }}" lay-affix="clear" class="layui-input"
               id="{{ getDomIdKey($name, 'laydate') }}"
               placeholder="yyyy-MM-dd">
    </div>
</div>
<script>
    layui.use(function () {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#{{ getDomIdKey($name, 'laydate') }}'
        });
    });
</script>
