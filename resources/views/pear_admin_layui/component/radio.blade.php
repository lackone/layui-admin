<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-inline">
        @if($list)
            @foreach($list as $k => $v)
                <input type="radio" name="{{ $name }}" value="{{ $k }}" title="{{ $v }}" {{ $k == $value ? 'checked' : '' }}>
            @endforeach
        @endif
    </div>
</div>
