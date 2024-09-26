<div class="{{ $is_search ? 'layui-inline' : 'layui-form-item' }}">
    <label class="layui-form-label">{{ $label }}</label>
    <div class="layui-input-block">
        <div id="{{ getDomId() }}_{{ $name }}_tree" class="ztree"></div>
    </div>
    <input type="hidden" name="{{ $name }}" value="">
</div>
<script>
    var trees = {};
    trees['{{ getDomId() }}_{{ $name }}_tree'] = $.fn.zTree.init($("#{{ getDomId() }}_{{ $name }}_tree"), {
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
        let nodes = trees['{{ getDomId() }}_{{ $name }}_tree'].getCheckedNodes(true);
        let ids = nodes.map(function (node) {
            return node.id;
        });
        $("input[name='{{ $name }}']").val(ids.join(','));
    }

    trees['{{ getDomId() }}_{{ $name }}_tree'].expandAll(true);

    onNodeCheck();
</script>
