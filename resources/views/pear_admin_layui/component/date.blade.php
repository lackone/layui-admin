<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <input type="text" name="{{ $name }}" value="{{ $value }}" class="layui-input" id="{{ $name }}_laydate"
               placeholder="yyyy-MM-dd">
    </div>
</div>
<script>
    layui.use(function () {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#{{ $name }}_laydate'
        });
    });
</script>
