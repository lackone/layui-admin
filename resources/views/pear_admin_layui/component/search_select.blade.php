<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <select name="{{ $name }}" lay-search="">
            @if($list)
                @foreach($list as $k => $v)
                    <option value="{{ $k }}" {{ $k == $value ? 'selected' : '' }}>{{ $v }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
