@extends('layouts.sub')

@section('content')
    <div class="layui-card">
        <div class="layui-card-body">
            <form class="layui-form layui-row layui-col-space16" lay-filter="{{ getDomId() }}_filter">
                <div class="layui-form-item">
                    @include('component.text', ['label' => '角色名', 'name' => 'name', 'is_search' => 1])

                    @include('component.datetime_range', ['label' => '日期范围', 'name' => 'time', 'is_search' => 1])

                    @include('component.submit', ['is_search' => 1])
                </div>
            </form>
            <table class="layui-hide" id="{{ getDomId() }}" lay-filter="{{ getDomId() }}"></table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/html" id="{{ getDomId() }}_toolbar">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm" id="{{ getDomId() }}_dropdownButton">
                操作
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
            <button class="layui-btn layui-btn-sm" id="{{ getDomId() }}_reload">
                刷新数据
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
            <button class="layui-btn layui-btn-sm layui-btn-primary" id="{{ getDomId() }}_rowMode">
                <span><%= d.lineStyle ? '多行' : '单行' %>模式</span>
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
        </div>
    </script>
    <script type="text/html" id="{{ getDomId() }}_bar">
        <div class="layui-clear-space">
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs" lay-event="more">
                更多
                <i class="layui-icon layui-icon-down"></i>
            </a>
        </div>
    </script>
    <script>
        layui.use(['table', 'dropdown', 'laydate', 'form', 'util', 'jquery'], function () {
            var table = layui.table;
            var dropdown = layui.dropdown;
            var form = layui.form;
            var util = layui.util;
            var $ = layui.jquery;

            // 搜索提交
            form.on('submit({{ getDomId() }}_search)', function (data) {
                var field = data.field; // 获得表单字段
                table.reload('{{ getDomId() }}', {
                    page: {
                        curr: 1 // 重新从第 1 页开始
                    },
                    where: field // 搜索的字段
                });
                return false;
            });

            // 创建渲染实例
            table.render({
                elem: '#{{ getDomId() }}',
                url: '{{ route('admin.role.list') }}',
                toolbar: '#{{ getDomId() }}_toolbar',
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
                        title: '角色名',
                    },
                    {
                        field: 'status',
                        title: '状态',
                        templet: function (d) {
                            if (d.status == '{{ \App\Models\AdminRole::STATUS_ENABLE }}') {
                                return '<span class="layui-badge layui-bg-green">启用</span>';
                            } else {
                                return '<span class="layui-badge">禁用</span>';
                            }
                        }
                    },
                    {
                        field: 'remark',
                        title: '备注',
                    },
                    {
                        field: 'created',
                        title: '创建时间',
                        templet: function (d) {
                            var str = util.toDateString(d.created * 1000, "yyyy-MM-dd HH:mm:ss");
                            return str;
                        }
                    },
                    {
                        field: 'updated',
                        title: '更新时间',
                        templet: function (d) {
                            var str = util.toDateString(d.updated * 1000, "yyyy-MM-dd HH:mm:ss");
                            return str;
                        }
                    },
                    {
                        fixed: 'right',
                        title: '操作',
                        width: 134,
                        minWidth: 125,
                        toolbar: '#{{ getDomId() }}_bar'
                    }
                ]],
                done: function () {
                    var id = this.id;
                    dropdown.render({
                        elem: '#{{ getDomId() }}_dropdownButton',
                        data: [{
                            id: '{{ getDomId() }}_add',
                            title: '添加'
                        }, {
                            id: '{{ getDomId() }}_update',
                            title: '编辑'
                        }, {
                            id: '{{ getDomId() }}_delete',
                            title: '删除'
                        }],
                        click: function (obj) {
                            var checkStatus = table.checkStatus(id)
                            var data = checkStatus.data; // 获取选中的数据
                            switch (obj.id) {
                                case '{{ getDomId() }}_add':
                                    layer.open({
                                        title: '添加',
                                        type: 2,
                                        area: ['80%', '80%'],
                                        content: '{{ route('admin.role.save') }}'
                                    });
                                    break;
                                case '{{ getDomId() }}_update':
                                    if (data.length !== 1) {
                                        return layer.msg('请选择一行');
                                    }
                                    layer.open({
                                        title: '编辑 - id:' + data[0].id,
                                        type: 2,
                                        area: ['80%', '80%'],
                                        content: '{{ route('admin.role.save') }}/' + data[0].id
                                    });
                                    break;
                                case '{{ getDomId() }}_delete':
                                    if (data.length === 0) {
                                        return layer.msg('请选择一行');
                                    }
                                    let ids = data.map(v => {
                                        return v.id
                                    })
                                    $.post("{{ route('admin.role.delete') }}", {
                                        id: ids
                                    }, function (res) {
                                        if (res.code == 200) {
                                            layer.msg('成功', function () {
                                                layui.admin.refresh();
                                            })
                                        } else {
                                            layer.msg(res.msg);
                                        }
                                    }, 'json');
                                    break;
                            }
                        }
                    });

                    // 重载
                    dropdown.render({
                        elem: '#{{ getDomId() }}_reload',
                        data: [{
                            id: '{{ getDomId() }}_reloadData',
                            title: '刷新数据'
                        }],
                        click: function (obj) {
                            var field = form.val('{{ getDomId() }}_filter');
                            switch (obj.id) {
                                case '{{ getDomId() }}_reloadData':
                                    // 数据重载 - 参数重置
                                    table.reloadData('{{ getDomId() }}', {
                                        where: field,
                                        scrollPos: 'fixed',  // 保持滚动条位置不变 - v2.7.3 新增
                                    });
                                    break;
                            }
                        }
                    });

                    // 行模式
                    dropdown.render({
                        elem: '#{{ getDomId() }}_rowMode',
                        data: [{
                            id: '{{ getDomId() }}_default_row',
                            title: '单行模式'
                        }, {
                            id: '{{ getDomId() }}_multi_row',
                            title: '多行模式'
                        }],
                        click: function (obj) {
                            var checkStatus = table.checkStatus(id)
                            var data = checkStatus.data; // 获取选中的数据
                            switch (obj.id) {
                                case '{{ getDomId() }}_default_row':
                                    table.reload('{{ getDomId() }}', {
                                        lineStyle: null // 恢复单行
                                    });
                                    layer.msg('已设为单行');
                                    break;
                                case '{{ getDomId() }}_multi_row':
                                    table.reload('{{ getDomId() }}', {
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
            table.on('sort({{ getDomId() }})', function (obj) {
                var field = form.val('{{ getDomId() }}_filter');
                field["order_field"] = obj.field;
                field["order"] = obj.type;
                table.reload('{{ getDomId() }}', {
                    initSort: obj, // 记录初始排序，如果不设的话，将无法标记表头的排序状态。
                    where: field
                });
            });

            // 工具栏事件
            table.on('toolbar({{ getDomId() }})', function (obj) {
                var id = obj.config.id;
                var checkStatus = table.checkStatus(id);
                var othis = lay(this);
                switch (obj.event) {
                    case 'custom_export':
                        var field = form.val('{{ getDomId() }}_filter');
                        location.href = '{{ route('admin.role.list') }}?export=1&' + $.param(field);
                        break;
                }
            });

            // 表头自定义元素工具事件 --- 2.8.8+
            table.on('colTool({{ getDomId() }})', function (obj) {
                var event = obj.event;
                if (event === 'email-tips') {
                    layer.alert(layui.util.escape(JSON.stringify(obj.col)), {
                        title: '当前列属性配置项'
                    });
                }
            });

            // 触发单元格工具事件
            table.on('tool({{ getDomId() }})', function (obj) { // 双击 toolDouble
                var data = obj.data; // 获得当前行数据
                if (obj.event === 'edit') {
                    layer.open({
                        title: '编辑 - id:' + data.id,
                        type: 2,
                        area: ['80%', '80%'],
                        content: '{{ route('admin.role.save') }}/' + data.id
                    });
                } else if (obj.event === 'more') {
                    // 更多 - 下拉菜单
                    dropdown.render({
                        elem: this, // 触发事件的 DOM 对象
                        show: true, // 外部事件触发即显示
                        data: [{
                            title: '删除',
                            id: '{{ getDomId() }}_del'
                        }],
                        click: function (menudata) {
                            if (menudata.id === '{{ getDomId() }}_del') {
                                layer.confirm('真的删除行 [id: ' + data.id + '] 么', function (index) {
                                    $.post('{{ route('admin.role.delete') }}', {
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
            table.on('checkbox({{ getDomId() }})', function (obj) {
                console.log(obj)
            });

            // 触发表格单选框选择
            table.on('radio({{ getDomId() }})', function (obj) {
                console.log(obj)
            });

            // 行单击事件
            table.on('row({{ getDomId() }})', function (obj) {
                console.log(obj);
            });

            // 行双击事件
            table.on('rowDouble({{ getDomId() }})', function (obj) {
                console.log(obj);
            });
        });
    </script>
@endsection
