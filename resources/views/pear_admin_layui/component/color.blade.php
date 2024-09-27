<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <div class="layui-input-inline" style="width: 120px;">
            <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="请选择颜色" lay-affix="clear"
                   class="layui-input"
                   id="{{ getDomIdKey($name, 'colorpicker_color') }}">
        </div>
        <div class="layui-inline" style="left: -11px;">
            <div id="{{ getDomIdKey($name, 'colorpicker_form') }}"></div>
        </div>
    </div>
</div>
<script>
    layui.use(function () {
        var colorpicker = layui.colorpicker;
        var $ = layui.$;
        colorpicker.render({
            elem: '#{{ getDomIdKey($name, 'colorpicker_form') }}',
            color: '#1c97f5',
            done: function (color) {
                $('#{{ getDomIdKey($name, 'colorpicker_color') }}').val(color);
            }
        });
    });
</script>
