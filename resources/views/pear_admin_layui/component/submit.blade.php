<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label"></label>
    <div class="layui-input-inline">
        <button type="submit" class="layui-btn" lay-submit
                lay-filter="{{ getDomIdKey('', $is_search ? 'search' : 'submit', $append) }}">{{ $is_search ? '搜索' : '提交' }}</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</div>
