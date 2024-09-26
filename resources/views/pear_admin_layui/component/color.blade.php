<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <div class="layui-input-inline" style="width: 120px;">
            <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="请选择颜色" lay-affix="clear" class="layui-input"
                   id="{{ getDomId() }}_{{ $name }}_colorpicker_color">
        </div>
        <div class="layui-inline" style="left: -11px;">
            <div id="{{ getDomId() }}_{{ $name }}_colorpicker_form"></div>
        </div>
    </div>
</div>
<script>
    layui.use(function () {
        var colorpicker = layui.colorpicker;
        var $ = layui.$;
        colorpicker.render({
            elem: '#{{ getDomId() }}_{{ $name }}_colorpicker_form',
            color: '#1c97f5',
            done: function (color) {
                $('#{{ getDomId() }}_{{ $name }}_colorpicker_color').val(color);
            }
        });
    });
</script>
