<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="{{ getDomId() }}_{{ rtrim($name, '[]') }}_multiple_images_btn">
                <i class="layui-icon layui-icon-upload"></i> 多图上传
            </button>
            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top:11px;">
                预览图：
                <div class="layui-upload-list" id="{{ getDomId() }}_{{ rtrim($name, '[]') }}_multiple_images_preview"></div>
            </blockquote>
        </div>
        <div id="{{ getDomId() }}_{{ rtrim($name, '[]') }}_multiple_images_vals">
        </div>
    </div>
</div>
<script>
    layui.use(function () {
        var upload = layui.upload;
        var layer = layui.layer;
        var $ = layui.$;
        // 多图片上传
        upload.render({
            elem: '#{{ getDomId() }}_{{ rtrim($name, '[]') }}_multiple_images_btn',
            url: '{{ route('admin.upload') }}',
            field: 'file',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            multiple: true,
            before: function (obj) {
                $("#{{ getDomId() }}_{{ rtrim($name, '[]') }}_multiple_images_vals").empty();
                $('#{{ getDomId() }}_{{ rtrim($name, '[]') }}_multiple_images_preview').empty();
                // 预读本地文件示例，不支持ie8
                obj.preview(function (index, file, result) {
                    $('#{{ getDomId() }}_{{ rtrim($name, '[]') }}_multiple_images_preview').append('<img src="' + result + '" alt="' + file.name + '" style="width: 90px; height: 90px;">')
                });
            },
            done: function (res) {
                if (res.code == 500) {
                    return layer.msg('上传失败');
                }
                $("#{{ getDomId() }}_{{ rtrim($name, '[]') }}_multiple_images_vals").append('<input type="hidden" name="{{ rtrim($name, '[]') }}[]" value="' + res.data.path + '">');
            }
        });
    });
</script>
