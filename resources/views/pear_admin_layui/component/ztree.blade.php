<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <div id="{{ getDomIdKey($name, 'ztree') }}" class="ztree"></div>
    </div>
    <input type="hidden" name="{{ $name }}" value="">
</div>
<script>
    var trees = {};
    trees['{{ getDomIdKey($name, 'ztree') }}'] = $.fn.zTree.init($("#{{ getDomIdKey($name, 'ztree') }}"), {
        view: {
            showIcon: true,
        },
        check: {
            //是否开启选择框
            enable: true,
            chkStyle: 'checkbox',
            chkboxType: {"Y": "ps", "N": "ps"}
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "pid",
            },
            key: {
                name: "title"
            },
            render: {
                name: function (name, treeNode) {
                    return name;
                },
                title: function (title, treeNode) {
                    return title;
                }
            }
        },
        callback: {
            onCheck: onNodeCheck
        }
    }, JSON.parse('{!! jsonEncode($list) !!}'));

    function onNodeCheck(event, treeId, treeNode) {
        let nodes = trees['{{ getDomIdKey($name, 'ztree') }}'].getCheckedNodes(true);
        let ids = nodes.map(function (node) {
            return node.id;
        });
        $("input[name='{{ $name }}']").val(ids.join(','));
    }

    trees['{{ getDomIdKey($name, 'ztree') }}'].expandAll(true);

    onNodeCheck();
</script>
