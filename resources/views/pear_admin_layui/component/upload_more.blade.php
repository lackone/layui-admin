<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <div id="{{ getDomIdKey($name, 'uploadMore') }}"></div>
        <div id="{{ getDomIdKey($name, 'uploadMore_vals') }}">
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        </div>
    </div>
</div>
<script>
    layui.use(['uploadMore', 'sortable'], function () {
        var uploadMore = layui.uploadMore;
        var $ = layui.jquery;
        // 多图片
        uploadMore.render({
            //容器对象
            elem: '#{{ getDomIdKey($name, 'uploadMore') }}',
            // 限制数量 0 无限制
            maxNum: 10,
            // 上传配置
            upload: {
                field: 'file',
                data: {
                    type: 'files',
                },
                acceptMime: 'image/*', //限制类型
                url: '{{ route('admin.upload') }}', //上传地址
                size: 20000, // 限制文件大小
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'uploadMore': 'uploadMore',
                },
            },
            uploadBtnStatus: 1, // 1.一直显示(默认)  2.没有成员时显示 3.隐藏
            style: {
                size: 120, // 成员尺寸
                theme: 'default',
            },
            // 拖拽排序能力配置, false 关闭排序
            sortable: {
            },
            // 初始化数据(支持对象方式/字符串)
            initValue: JSON.parse('{!! $value !!}'),
            // 成员操作按钮配置 (默认都有)
            operation: {
                update: true, // 编辑
                preview: true, // 预览
                delete: true, // 删除
            },
            // 事件监听
            on: {
                // 添加成员
                add: function (itemInfo, obj) {
                    console.log('添加');

                    if (obj) {
                        $("#{{ getDomIdKey($name, 'uploadMore_vals') }} input[name='{{ $name }}']").val(JSON.stringify(obj.getFileInfos()));
                    }
                },
                // 删除成员
                del: function (itemInfo, obj) {
                    console.log('删除');

                    if (obj) {
                        $("#{{ getDomIdKey($name, 'uploadMore_vals') }} input[name='{{ $name }}']").val(JSON.stringify(obj.getFileInfos()));
                    }
                },
                // 上传成功回调
                success: function (itemInfo, obj) {
                    console.log('成功');

                    if (obj) {
                        $("#{{ getDomIdKey($name, 'uploadMore_vals') }} input[name='{{ $name }}']").val(JSON.stringify(obj.getFileInfos()));
                    }
                },
                // 排序成功回调
                sort: function (obj) {
                    if (obj) {
                        $("#{{ getDomIdKey($name, 'uploadMore_vals') }} input[name='{{ $name }}']").val(JSON.stringify(obj.getFileInfos()));
                    }
                },
                // 上传失败回调
                error: function (itemInfo, obj, errorMsg) {
                    console.log('失败:' + errorMsg);
                },
            },
            // 数据解析
            parseData: function (res) {
                return {
                    code: res.code, // 状态码（此处按0成功）
                    message: res.msg || '', // 返回信息
                    fileInfo: res.data, // 文件完整信息
                    url: res.data && res.data.url ? res.data.url : '', // 文件地址
                    mimeType: res.data && res.data.mime_type ? res.data.mime_type : '', // 文件mime类型
                };
            },
        });
    });
</script>
