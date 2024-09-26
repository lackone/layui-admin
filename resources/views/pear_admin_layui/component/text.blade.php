<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <input type="text" name="{{ $name }}" value="{{ $value }}" lay-affix="clear" lay-verify="{{ $verify }}"
               placeholder="请输入" autocomplete="off"
               class="layui-input">
    </div>
</div>
