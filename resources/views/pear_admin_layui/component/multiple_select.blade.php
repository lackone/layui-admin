<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline" style="width:360px;">
        <select name="{{ $name }}" id="{{ getDomId() }}_{{ rtrim($name, '[]') }}_select2" multiple="multiple">
            @if($list)
                @foreach($list as $k => $v)
                    <option value="{{ $k }}" {{ in_array($k, (array)$value) ? 'selected' : '' }}>{{ $v }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<script>
    $("#{{ getDomId() }}_{{ rtrim($name, '[]') }}_select2").select2({
        multiple: true,
        width: '360px',
        allowClear: true,
        placeholder: '请选择'
    });

    var timer = setInterval(function () {
        if ($("#{{ getDomId() }}_{{ rtrim($name, '[]') }}_select2").nextAll(".layui-form-select").length > 0) {
            $("#{{ getDomId() }}_{{ rtrim($name, '[]') }}_select2").nextAll(".layui-form-select").remove();
            clearInterval(timer);
        }
    }, 100);
</script>
