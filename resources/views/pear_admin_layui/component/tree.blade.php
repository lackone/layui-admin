<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <div id="{{ getDomIdKey($name, 'tree') }}"></div>
    </div>
    <input type="hidden" name="{{ $name }}" value="">
</div>
<script>
    layui.use(['tree', 'jquery'], function () {
        var tree = layui.tree;
        var data = JSON.parse('{!! json_encode($list) !!}');
        var ids = [];
        var $ = layui.jquery;
        var trees = {};

        function isArray(value) {
            return Array.isArray(value);
        }

        function addIfNotExists(arr, num) {
            if (!arr.includes(num)) {
                arr.push(num);
            }
        }

        function removeNumberFromArray(arr, num) {
            return arr.filter(item => item !== num);
        }

        function getCheckId(obj) {
            if (isArray(obj)) {
                for (let ix in obj) {
                    if (obj[ix].checked) {
                        addIfNotExists(ids, obj[ix].id)
                    } else {
                        ids = removeNumberFromArray(ids, obj[ix].id)
                    }
                    if (obj[ix].children) {
                        getCheckId(obj[ix].children);
                    }
                }
            } else {
                if (obj.checked) {
                    addIfNotExists(ids, obj.id)
                } else {
                    ids = removeNumberFromArray(ids, obj.id)
                }
                if (obj.children) {
                    getCheckId(obj.children);
                }
            }
            return ids;
        }

        trees['{{ getDomIdKey($name, 'tree') }}'] = tree.render({
            elem: '#{{ getDomIdKey($name, 'tree') }}',
            id: '{{ getDomIdKey($name, 'tree') }}',
            data: data,
            showCheckbox: true,  // 是否显示复选框
            onlyIconControl: true,  // 是否仅允许节点左侧图标控制展开收缩
            showLine: true,
            click: function (obj) {
                flushData();
            },
            oncheck: function (obj) {
                flushData();
            },
            operate: function (obj) {

            }
        });

        function flushData() {
            let role_tree = trees['{{ getDomIdKey($name, 'tree') }}'];
            if (role_tree &&
                role_tree.hasOwnProperty('getChecked')
            ) {
                ids = [];
                var checkedData = role_tree.getChecked()
                ids = getCheckId(checkedData);
                $("input[name='{{ $name }}']").val(ids.join(','));
            }
        }

        flushData();
    });
</script>
