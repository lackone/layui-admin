<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-inline">
        <button type="button" class="layui-btn" id="{{ getDomIdKey($name, 'single_image_btn') }}">
            <i class="layui-icon layui-icon-upload"></i> 图片上传
        </button>
        <div style="width:132px;">
            <div class="layui-upload-list">
                <img class="layui-upload-img" id="{{ getDomIdKey($name, 'single_image') }}"
                     src="{{ $value ?: adminAsset('admin/images/avatar.png') }}" style="width:100px;">
                <div id="{{ getDomIdKey($name, 'single_image_text') }}"></div>
            </div>
            <div class="layui-progress layui-progress-big" lay-showPercent="yes"
                 lay-filter="{{ getDomIdKey($name, 'single_image_filter') }}">
                <div class="layui-progress-bar" lay-percent=""></div>
            </div>
        </div>
        <div id="{{ getDomIdKey($name, 'single_image_vals') }}">
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        </div>
    </div>
</div>
<script>
    layui.use(function () {
        var upload = layui.upload;
        var layer = layui.layer;
        var element = layui.element;
        var $ = layui.$;

        var uploadInst = upload.render({
            elem: '#{{ getDomIdKey($name, 'single_image_btn') }}',
            url: '{{ route('admin.upload') }}',
            field: 'file',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            before: function (obj) {
                obj.preview(function (index, file, result) {
                    $('#{{ getDomIdKey($name, 'single_image') }}').attr('src', result); // 图片链接（base64）
                });
                element.progress('{{ getDomIdKey($name, 'single_image_filter') }}', '0%'); // 进度条复位
                layer.msg('上传中', {icon: 16, time: 0});
            },
            done: function (res) {
                if (res.code == 500) {
                    return layer.msg('上传失败');
                }
                $('#{{ getDomIdKey($name, 'single_image_text') }}').html(''); // 置空上传失败的状态
                $("input[name='{{ $name }}']").val(res.data.path);
            },
            error: function () {
                // 演示失败状态，并实现重传
                var demoText = $('#{{ getDomIdKey($name, 'single_image_text') }}');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs upload-reload">重试</a>');
                demoText.find('.upload-reload').on('click', function () {
                    uploadInst.upload();
                });
            },
            progress: function (n, elem, e) {
                element.progress('{{ getDomIdKey($name, 'single_image_filter') }}', n + '%'); // 可配合 layui 进度条元素使用
                if (n == 100) {
                    layer.msg('上传完毕', {icon: 1});
                }
            }
        });
    });
</script>
