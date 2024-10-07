<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-{{ $block ? 'block' : 'inline' }}">
        <div class="layui-input-wrap">
            {{ $value }}
        </div>
    </div>
</div>
