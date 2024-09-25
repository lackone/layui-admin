<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="{{ $name }}_min" value="{{ $value['min'] }}" placeholder="" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid">-</div>
        <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="{{ $name }}_max" value="{{ $value['max'] }}" placeholder="" autocomplete="off" class="layui-input">
        </div>
    </div>
</div>
