<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <input type="checkbox" name="{{ $name }}" lay-skin="switch" lay-filter="switch" title="{{ $title }}" {{ $value ? 'checked' : '' }}>
    </div>
</div>
