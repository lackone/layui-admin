<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-inline">
        <select name="{{ $name }}" lay-search="">
            <option value="">无</option>
            @if($list)
                @foreach($list as $k => $v)
                    <option value="{{ $v['id'] }}" {{ $v['id'] == $value ? 'selected' : '' }}>{{ $v[$title] }}</option>
                    @if($v['children'])
                        @foreach($v['children'] as $kk => $vv)
                            <option value="{{ $vv['id'] }}" {{ $vv['id'] == $value ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $vv[$title] }}</option>
                            @if($vv['children'])
                                @foreach($vv['children'] as $kkk => $vvv)
                                    <option value="{{ $vvv['id'] }}" {{ $vvv['id'] == $value ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $vvv[$title] }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif
        </select>
    </div>
</div>
