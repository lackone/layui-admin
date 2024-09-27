<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <input type="text" name="{{ $name }}" value="{{ $value }}" id="{{ getDomIdKey($name, 'iconPicker') }}"
               lay-filter="{{ getDomIdKey($name, 'iconPicker_filter') }}" style="display:none;">
    </div>
</div>
<script>
    layui.use(['iconPicker'], function () {
        var iconPicker = layui.iconPicker;

        iconPicker.render({
            elem: '#{{ getDomIdKey($name, 'iconPicker') }}',
            type: 'fontClass',
            search: true,
            page: true,
            limit: 12,
            // 每个图标格子的宽度：'43px'或'20%'
            cellWidth: '43px',
            // 点击回调
            click: function (data) {
                console.log(data);
            },
            // 渲染成功后的回调
            success: function (d) {
                console.log(d);
            }
        });

        iconPicker.checkIcon('{{ getDomIdKey($name, 'iconPicker_filter') }}', '{{ str_replace('layui-icon ', '', $value) }}');
    });
</script>
