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

        // 上传图片的函数
        function uploadImage(url) {
            return new Promise(function (resolve, reject) {
                // 得到图片后缀
                let suffix = url.substring(url.lastIndexOf(".") + 1);
                // 设置图片名称及后缀
                const key = new Date().getTime() + Math.random().toString().substr(2, 5) + "." + suffix;
                // 创建图片对象
                let image = new Image();
                // 允许跨域
                image.setAttribute("crossOrigin", "anonymous");
                image.src = url;
                image.onload = () => {
                    let canvas = document.createElement("canvas");
                    canvas.width = image.width;
                    canvas.height = image.height;
                    let ctx = canvas.getContext("2d");
                    ctx.drawImage(image, 0, 0, image.width, image.height);
                    canvas.toBlob((blob) => {
                        let formdata = new FormData()
                        formdata.append('file', blob)

                        fetch('{{ route('admin.upload') }}', {
                            method: 'POST',
                            body: formdata,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'wangEditor': 'wangEditor',
                            },
                        })
                            .then(response => response.json())
                            .then(res => {
                                resolve(res.data[0].url);
                            })
                            .catch(error => {
                                reject(error);
                            });
                    });
                };
            });
        }

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
        editor.config.customUploadImg = function (resultFiles, insertImgFn) {
            resultFiles.forEach((file) => {
                console.log(file)
                let formdata = new FormData()
                formdata.append('file', file)
                $.ajax({
                    url: "{{ route('admin.upload') }}",
                    type: "POST",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        insertImgFn(res.data.url)
                    }
                })
            })
        }
        editor.config.pasteTextHandle = function (content) {
            // 使用正则匹配所有<img>标签，并处理图片上传
            const imgReg = /<img[^>]*src=\"([^"]*)\"[^>]*>/gi;
            let match, imgs = [];

            while ((match = imgReg.exec(content))) {
                imgs.push(match[1]);
            }

            imgs.forEach((imgSrc) => {
                uploadImage(imgSrc).then(uploadedUrl => {
                    content = content.replace(imgSrc, uploadedUrl);
                    editor.txt.html(content);
                });
            });

            return content;
        }
        editor.create()
        editor.txt.html('{!! $value !!}')

        $text.val(editor.txt.html())
    })
</script>
