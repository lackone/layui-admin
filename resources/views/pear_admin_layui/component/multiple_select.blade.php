<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <div class="layui-input-inline" style="width:180px;">
            <select name="{{ $name }}" id="{{ rtrim($name, '[]') }}_select2" multiple="multiple">
                @if($list)
                    @foreach($list as $k => $v)
                        <option value="{{ $k }}" {{ in_array($k, (array)$value) ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
<script>
    $("#{{ rtrim($name, '[]') }}_select2").select2({
        multiple: true,
        width: '360px',
        allowClear: true,
        placeholder: '请选择'
    });

    var timer = setInterval(function () {
        if ($("#{{ rtrim($name, '[]') }}_select2").nextAll(".layui-form-select").length > 0) {
            $("#{{ rtrim($name, '[]') }}_select2").nextAll(".layui-form-select").remove();
            clearInterval(timer);
        }
    }, 100);
</script>
