<div class="layui-form-item">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <select name="{{ $name }}">
            @if($list)
                @foreach($list as $v)
                    <optgroup label="{{ $v['label'] }}">
                        @if($v['children'])
                            @foreach($v['children'] as $kk => $vv)
                                <option value="{{ $kk }}" {{ $kk == $value ? 'selected' : '' }}>{{ $vv }}</option>
                            @endforeach
                        @endif
                    </optgroup>
                @endforeach
            @endif
        </select>
    </div>
</div>
