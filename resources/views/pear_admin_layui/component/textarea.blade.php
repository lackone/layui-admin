<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <textarea name="{{ $name }}" placeholder="多行文本框" lay-affix="clear" class="layui-textarea">{{ $value }}</textarea>
    </div>
</div>
