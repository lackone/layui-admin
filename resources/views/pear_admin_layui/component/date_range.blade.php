<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-inline" id="{{ getDomIdKey($name, 'laydate_range') }}">
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" name="start_{{ $name }}" value="{{ $value['start'] }}"
                   id="{{ getDomIdKey($name, 'start') }}" lay-affix="clear" class="layui-input" placeholder="开始日期">
        </div>
        <div class="layui-form-mid">-</div>
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" name="end_{{ $name }}" value="{{ $value['end'] }}"
                   id="{{ getDomIdKey($name, 'end') }}" lay-affix="clear" class="layui-input" placeholder="结束日期">
        </div>
    </div>
</div>
<script>
    layui.use(function () {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#{{ getDomIdKey($name, 'laydate_range') }}',
            range: ['#{{ getDomIdKey($name, 'start') }}', '#{{ getDomIdKey($name, 'end') }}']
        });
    });
</script>
