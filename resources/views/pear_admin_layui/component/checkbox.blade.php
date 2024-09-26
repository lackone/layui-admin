<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        @if($list)
            @foreach($list as $k => $v)
                <input type="checkbox" name="{{ $name }}" value="{{ $k }}"
                       title="{{ $v }}" {{ in_array($k, (array)$value) ? 'checked' : '' }}>
            @endforeach
        @endif
    </div>
</div>
