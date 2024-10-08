<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline" style="width:360px;">
        <select name="{{ $name }}" id="{{ getDomIdKey($name, 'select2') }}" multiple="multiple">
            @if($list)
                @foreach($list as $k => $v)
                    <option value="{{ $k }}" {{ in_array($k, (array)$value) ? 'selected' : '' }}>{{ $v }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<script>
    $("#{{ getDomIdKey($name, 'select2') }}").select2({
        multiple: true,
        width: '360px',
        allowClear: true,
        placeholder: '请选择'
    });

    var timer = setInterval(function () {
        if ($("#{{ getDomIdKey($name, 'select2') }}").nextAll(".layui-form-select").length > 0) {
            $("#{{ getDomIdKey($name, 'select2') }}").nextAll(".layui-form-select").remove();
            clearInterval(timer);
        }
    }, 100);
</script>
