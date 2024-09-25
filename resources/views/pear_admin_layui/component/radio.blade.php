<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        @if($list)
            @foreach($list as $k => $v)
                <input type="radio" name="{{ $name }}" value="{{ $k }}" title="{{ $v }}" {{ $k == $value ? 'checked' : '' }}>
            @endforeach
        @endif
    </div>
</div>
