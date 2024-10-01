@extends('layouts.sub')

@section('content')
    <div class="layui-card">
        <div class="layui-card-body">
            <table class="layui-hide" id="{{ getDomIdKey('', 'table') }}"
                   lay-filter="{{ getDomIdKey('', 'table') }}"></table>
        </div>
    </div>
@endsection

@section('myjs')
    <script type="text/html" id="{{ getDomIdKey('', 'toolbar') }}">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm" id="{{ getDomIdKey('', 'dropdownButton') }}">
                操作
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
            <button class="layui-btn layui-btn-sm" id="{{ getDomIdKey('', 'reload') }}">
                刷新数据
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
            <button class="layui-btn layui-btn-sm layui-btn-primary" id="{{ getDomIdKey('', 'rowMode') }}">
                <span><%= d.lineStyle ? '多行' : '单行' %>模式</span>
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
        </div>
    </script>
    <script type="text/html" id="{{ getDomIdKey('', 'bar') }}">
        <div class="layui-clear-space">
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="add_sub">添加子项</a>
            <a class="layui-btn layui-btn-xs" lay-event="more">
                更多
                <i class="layui-icon layui-icon-down"></i>
            </a>
        </div>
    </script>
    <script>
        layui.use(['treeTable', 'dropdown', 'laydate', 'form', 'util', 'jquery'], function () {
            var treeTable = layui.treeTable;
            var dropdown = layui.dropdown;
            var form = layui.form;
            var util = layui.util;
            var $ = layui.jquery;

            // 创建渲染实例
            treeTable.render({
                elem: '#{{ getDomIdKey('', 'table') }}',
                url: '{{ route('admin.article_category.list') }}',
                toolbar: '#{{ getDomIdKey('', 'toolbar') }}',
                tree: {
                    customName: {
                        children: 'children',
                        name: 'name',
                        id: 'id',
                        pid: 'pid'
                    },
                    view: {
                        expandAllDefault: true
                    }
                },
                cols: [[
                    {
                        type: 'checkbox',
                        fixed: 'left'
                    },
                    {
                        field: 'id',
                        fixed: 'left',
                        width: 80,
                        title: 'ID',
                        sort: true,
                        totalRowText: '合计：'
                    },
                    {
                        field: 'name',
                        title: '分类名',
                    },
                    {
                        field: 'code',
                        title: '编码',
                    },
                    {
                        field: 'status',
                        title: '状态',
                        templet: function (d) {
                            if (d.status == '{{ \App\Models\ArticleCategory::STATUS_ENABLE }}') {
                                return '<span class="layui-badge layui-bg-green">启用</span>';
                            } else {
                                return '<span class="layui-badge">禁用</span>';
                            }
                        }
                    },
                    {
                        field: 'sort',
                        title: '排序'
                    },
                    {
                        field: 'created',
                        title: '创建时间/更新时间',
                        templet: function (d) {
                            var str = util.toDateString(d.created * 1000, "yyyy-MM-dd HH:mm:ss") + '<br>';
                            str += util.toDateString(d.updated * 1000, "yyyy-MM-dd HH:mm:ss");
                            return str;
                        }
                    },
                    {
                        fixed: 'right',
                        title: '操作',
                        minWidth: 125,
                        toolbar: '#{{ getDomIdKey('', 'bar') }}'
                    }
                ]],
                done: function () {
                    var id = this.id;
                    dropdown.render({
                        elem: '#{{ getDomIdKey('', 'dropdownButton') }}',
                        data: [{
                            id: '{{ getDomIdKey('', 'add') }}',
                            title: '添加'
                        }, {
                            id: '{{ getDomIdKey('', 'update') }}',
                            title: '编辑'
                        }, {
                            id: '{{ getDomIdKey('', 'delete') }}',
                            title: '删除'
                        }],
                        click: function (obj) {
                            var checkStatus = treeTable.checkStatus(id)
                            var data = checkStatus.data; // 获取选中的数据
                            switch (obj.id) {
                                case '{{ getDomIdKey('', 'add') }}':
                                    layer.open({
                                        title: '添加',
                                        type: 2,
                                        area: ['80%', '80%'],
                                        content: '{{ route('admin.article_category.save') }}'
                                    });
                                    break;
                                case '{{ getDomIdKey('', 'update') }}':
                                    if (data.length !== 1) {
                                        return layer.msg('请选择一行');
                                    }
                                    layer.open({
                                        title: '编辑 - id:' + data[0].id,
                                        type: 2,
                                        area: ['80%', '80%'],
                                        content: '{{ route('admin.article_category.save') }}/' + data[0].id
                                    });
                                    break;
                                case '{{ getDomIdKey('', 'delete') }}':
                                    if (data.length === 0) {
                                        return layer.msg('请选择一行');
                                    }
                                    let ids = data.map(v => {
                                        return v.id
                                    })
                                    layer.confirm('真的删除么?', function (index) {
                                        $.post("{{ route('admin.article_category.delete') }}", {
                                            id: ids
                                        }, function (res) {
                                            if (res.code == 200) {
                                                layer.msg('成功', function () {
                                                    top.layui.admin.refresh();
                                                })
                                            } else {
                                                layer.msg(res.msg);
                                            }
                                        }, 'json');
                                        layer.close(index);
                                    })
                                    break;
                            }
                        }
                    });

                    // 重载
                    dropdown.render({
                        elem: '#{{ getDomIdKey('', 'reload') }}',
                        data: [{
                            id: '{{ getDomIdKey('', 'reloadData') }}',
                            title: '刷新数据'
                        }],
                        click: function (obj) {
                            var field = form.val('{{ getDomIdKey('', 'table_filter') }}');
                            switch (obj.id) {
                                case '{{ getDomIdKey('', 'reloadData') }}':
                                    // 数据重载 - 参数重置
                                    treeTable.reloadData('{{ getDomIdKey('', 'table') }}', {
                                        where: field,
                                        scrollPos: 'fixed',  // 保持滚动条位置不变 - v2.7.3 新增
                                    });
                                    break;
                            }
                        }
                    });

                    // 行模式
                    dropdown.render({
                        elem: '#{{ getDomIdKey('', 'rowMode') }}',
                        data: [{
                            id: '{{ getDomIdKey('', 'default_row') }}',
                            title: '单行模式'
                        }, {
                            id: '{{ getDomIdKey('', 'multi_row') }}',
                            title: '多行模式'
                        }],
                        click: function (obj) {
                            var checkStatus = treeTable.checkStatus(id)
                            var data = checkStatus.data; // 获取选中的数据
                            switch (obj.id) {
                                case '{{ getDomIdKey('', 'default_row') }}':
                                    treeTable.reload('{{ getDomIdKey('', 'table') }}', {
                                        lineStyle: null // 恢复单行
                                    });
                                    layer.msg('已设为单行');
                                    break;
                                case '{{ getDomIdKey('', 'multi_row') }}':
                                    treeTable.reload('{{ getDomIdKey('', 'table') }}', {
                                        lineStyle: 'height: 95px;'
                                    });
                                    layer.msg('已设为多行');
                                    break;
                            }
                        }
                    });
                },
                error: function (res, msg) {
                    console.log(res, msg)
                }
            });

            // 触发排序事件
            treeTable.on('sort({{ getDomIdKey('', 'table') }})', function (obj) {
                var field = form.val('{{ getDomIdKey('', 'table_filter') }}');
                field["order_field"] = obj.field;
                field["order"] = obj.type;
                treeTable.reload('{{ getDomIdKey('', 'table') }}', {
                    initSort: obj, // 记录初始排序，如果不设的话，将无法标记表头的排序状态。
                    where: field
                });
            });

            // 工具栏事件
            treeTable.on('toolbar({{ getDomIdKey('', 'table') }})', function (obj) {
                var id = obj.config.id;
                var checkStatus = treeTable.checkStatus(id);
                var othis = lay(this);
                switch (obj.event) {
                    case 'custom_export':
                        var field = form.val('{{ getDomIdKey('', 'table_filter') }}');
                        location.href = '{{ route('admin.article_category.list') }}?export=1&' + $.param(field);
                        break;
                }
            });

            // 表头自定义元素工具事件 --- 2.8.8+
            treeTable.on('colTool({{ getDomIdKey('', 'table') }})', function (obj) {
                var event = obj.event;
                if (event === 'email-tips') {
                    layer.alert(layui.util.escape(JSON.stringify(obj.col)), {
                        title: '当前列属性配置项'
                    });
                }
            });

            // 触发单元格工具事件
            treeTable.on('tool({{ getDomIdKey('', 'table') }})', function (obj) { // 双击 toolDouble
                var data = obj.data; // 获得当前行数据
                if (obj.event === 'edit') {
                    layer.open({
                        title: '编辑 - id:' + data.id,
                        type: 2,
                        area: ['80%', '80%'],
                        content: '{{ route('admin.article_category.save') }}/' + data.id
                    });
                } else if (obj.event === 'add_sub') {
                    layer.open({
                        title: '添加子项 :' + data.name,
                        type: 2,
                        area: ['80%', '80%'],
                        content: '{{ route('admin.article_category.save') }}' + '?pid=' + data.id
                    });
                } else if (obj.event === 'more') {
                    // 更多 - 下拉菜单
                    dropdown.render({
                        elem: this, // 触发事件的 DOM 对象
                        show: true, // 外部事件触发即显示
                        data: [{
                            title: '删除',
                            id: '{{ getDomIdKey('', 'del') }}'
                        }],
                        click: function (menudata) {
                            if (menudata.id === '{{ getDomIdKey('', 'del') }}') {
                                layer.confirm('真的删除行 [id: ' + data.id + '] 么', function (index) {
                                    $.post('{{ route('admin.article_category.delete') }}', {
                                        id: data.id
                                    }, function (res) {
                                        if (res.code == 200) {
                                            obj.del(); // 删除对应行（tr）的DOM结构
                                        } else {
                                            layer.msg(res.msg);
                                        }
                                        layer.close(index);
                                    }, "json");
                                });
                            }
                        },
                        align: 'right', // 右对齐弹出
                        style: 'box-shadow: 1px 1px 10px rgb(0 0 0 / 12%);' // 设置额外样式
                    })
                }
            });

            // 触发表格复选框选择
            treeTable.on('checkbox({{ getDomIdKey('', 'table') }})', function (obj) {
                console.log(obj)
            });

            // 触发表格单选框选择
            treeTable.on('radio({{ getDomIdKey('', 'table') }})', function (obj) {
                console.log(obj)
            });

            // 行单击事件
            treeTable.on('row({{ getDomIdKey('', 'table') }})', function (obj) {
                console.log(obj);
            });

            // 行双击事件
            treeTable.on('rowDouble({{ getDomIdKey('', 'table') }})', function (obj) {
                console.log(obj);
            });
        });
    </script>
@endsection
