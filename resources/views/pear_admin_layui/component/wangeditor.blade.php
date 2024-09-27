<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <div id="{{ getDomIdKey($name, 'wangEditor') }}"></div>
        <textarea name="{{ $name }}" id="{{ getDomIdKey($name, 'wangEditor_textarea') }}"
                  style="display:none;"></textarea>
    </div>
</div>
<script>
    layui.use(['jquery'], function () {
        var $ = layui.jquery;

        const E = window.wangEditor
        const editor = new E(document.getElementById('{{ getDomIdKey($name, 'wangEditor') }}'))
        const $text = $("#{{ getDomIdKey($name, 'wangEditor_textarea') }}");
        editor.config.uploadImgServer = '{{ route('admin.upload') }}';
        editor.config.uploadFileName = 'file';
        editor.config.uploadImgMaxLength = 5;
        editor.config.uploadImgHeaders = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'wangEditor': 'wangEditor',
        }
        editor.config.onchange = function (html) {
            $text.val(html)
        }
        editor.create()
        editor.txt.html('{!! $value !!}')

        $text.val(editor.txt.html())
    })
</script>
