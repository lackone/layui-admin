<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-inline" id="{{ getDomId() }}_{{ $name }}_laydate_range">
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" name="start_{{ $name }}" value="{{ $value['start'] }}"
                   id="{{ getDomId() }}_{{ $name }}_start" lay-affix="clear" class="layui-input" placeholder="开始日期">
        </div>
        <div class="layui-form-mid">-</div>
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" name="end_{{ $name }}" value="{{ $value['end'] }}"
                   id="{{ getDomId() }}_{{ $name }}_end" lay-affix="clear" class="layui-input" placeholder="结束日期">
        </div>
    </div>
</div>
<script>
    layui.use(function () {
        var laydate = layui.laydate;
        laydate.render({
            elem: '#{{ getDomId() }}_{{ $name }}_laydate_range',
            range: ['#{{ getDomId() }}_{{ $name }}_start', '#{{ getDomId() }}_{{ $name }}_end']
        });
    });
</script>
