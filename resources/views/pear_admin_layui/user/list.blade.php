@extends('layouts.sub')

@section('content')
    <div class="layui-card">
        <div class="layui-card-body">
            <form class="layui-form layui-row layui-col-space16" lay-filter="table-filter">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">账号</label>
                        <div class="layui-input-block">
                            <input type="text" name="account" value="" placeholder="账号" class="layui-input"
                                   lay-affix="clear">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">手机号</label>
                        <div class="layui-input-block">
                            <input type="text" name="phone" placeholder="手机号" lay-affix="clear" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">日期范围</label>
                        <div class="layui-inline" id="laydate-rangeLinked">
                            <div class="layui-input-inline">
                                <input type="text" name="start_time" autocomplete="off" id="laydate-start-date"
                                       class="layui-input" placeholder="开始日期">
                            </div>
                            <div class="layui-form-mid">-</div>
                            <div class="layui-input-inline">
                                <input type="text" name="end_time" autocomplete="off" id="laydate-end-date"
                                       class="layui-input"
                                       placeholder="结束日期">
                            </div>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn" lay-submit lay-filter="table-search">搜索</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
            <table class="layui-hide" id="table" lay-filter="table"></table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/html" id="toolbar">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm" id="dropdownButton">
                操作
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
            <button class="layui-btn layui-btn-sm" id="reload">
                刷新数据
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
            <button class="layui-btn layui-btn-sm layui-btn-primary" id="rowMode">
                <span><%= d.lineStyle ? '多行' : '单行' %>模式</span>
                <i class="layui-icon layui-icon-down layui-font-12"></i>
            </button>
        </div>
    </script>
    <script type="text/html" id="bar">
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
            var laydate = layui.laydate;
            var form = layui.form;
            var util = layui.util;
            var $ = layui.jquery;

            // 日期
            laydate.render({
                elem: '#laydate-rangeLinked',
                type: "datetime",
                range: ['#laydate-start-date', '#laydate-end-date'],
                rangeLinked: true
            });

            // 搜索提交
            form.on('submit(table-search)', function (data) {
                var field = data.field; // 获得表单字段
                table.reload('table', {
                    page: {
                        curr: 1 // 重新从第 1 页开始
                    },
                    where: field // 搜索的字段
                });
                return false;
            });

            // 创建渲染实例
            table.render({
                elem: '#table',
                url: '{{ route('admin.user.list') }}',
                toolbar: '#toolbar',
                lineStyle: 'height: 98px;',
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
                        field: 'account',
                        title: '账号',
                    },
                    {
                        field: 'real_name',
                        title: '头像/昵称/姓名',
                        templet: '<img src="<%= d.avatar ? d.avatar : \'{{ adminAsset('admin/images/avatar.png') }}\'  %>" class="avatar"><br><%= d.nick_name %><br><%= d.real_name %>'
                    },
                    {
                        field: 'roles',
                        title: '所属角色',
                        templet: function (d) {
                            var str = '';
                            for (v of d.roles) {
                                str += v.name + '<br>';
                            }
                            return str;
                        }
                    },
                    {
                        field: 'phone',
                        title: '手机号',
                    },
                    {
                        field: 'email',
                        title: '邮箱',
                    },
                    {
                        field: 'status',
                        title: '状态',
                        templet: function (d) {
                            if (d.status == '{{ \App\Models\Admin::STATUS_ENABLE }}') {
                                return '<span class="layui-badge layui-bg-green">启用</span>';
                            } else {
                                return '<span class="layui-badge">禁用</span>';
                            }
                        }
                    },
                    {
                        field: 'is_super',
                        title: '超级管理员',
                        templet: function (d) {
                            if (d.is_super == '{{ \App\Models\Admin::IS_SUPER_YES }}') {
                                return '<span class="layui-badge layui-bg-green">是</span>';
                            } else {
                                return '<span class="layui-badge">否</span>';
                            }
                        }
                    },
                    {
                        field: 'remark',
                        title: '备注',
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
                        field: 'last_login_time',
                        title: '登录时间/IP',
                        templet: function (d) {
                            var str = util.toDateString(d.last_login_time * 1000, "yyyy-MM-dd HH:mm:ss") + '<br>';
                            str += d.last_login_ip;
                            return str;
                        }
                    },
                    {
                        fixed: 'right',
                        title: '操作',
                        width: 134,
                        minWidth: 125,
                        toolbar: '#bar'
                    }
                ]],
                done: function () {
                    var id = this.id;
                    dropdown.render({
                        elem: '#dropdownButton',
                        data: [{
                            id: 'add',
                            title: '添加'
                        }, {
                            id: 'update',
                            title: '编辑'
                        }, {
                            id: 'delete',
                            title: '删除'
                        }],
                        click: function (obj) {
                            var checkStatus = table.checkStatus(id)
                            var data = checkStatus.data; // 获取选中的数据
                            switch (obj.id) {
                                case 'add':
                                    layer.open({
                                        title: '添加',
                                        type: 2,
                                        area: ['80%', '80%'],
                                        content: '{{ route('admin.user.save') }}'
                                    });
                                    break;
                                case 'update':
                                    if (data.length !== 1) {
                                        return layer.msg('请选择一行');
                                    }
                                    layer.open({
                                        title: '编辑',
                                        type: 2,
                                        area: ['80%', '80%'],
                                        content: '{{ route('admin.user.save') }}/' + data[0].id
                                    });
                                    break;
                                case 'delete':
                                    if (data.length === 0) {
                                        return layer.msg('请选择一行');
                                    }
                                    let ids = data.map(v => {
                                        return v.id
                                    })
                                    $.post("{{ route('admin.user.delete') }}", {
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
                        elem: '#reload',
                        data: [{
                            id: 'reloadData',
                            title: '刷新数据'
                        }],
                        click: function (obj) {
                            var field = form.val('table-filter');
                            switch (obj.id) {
                                case 'reloadData':
                                    // 数据重载 - 参数重置
                                    table.reloadData('table', {
                                        where: field,
                                        scrollPos: 'fixed',  // 保持滚动条位置不变 - v2.7.3 新增
                                    });
                                    break;
                            }
                        }
                    });

                    // 行模式
                    dropdown.render({
                        elem: '#rowMode',
                        data: [{
                            id: 'default-row',
                            title: '单行模式'
                        }, {
                            id: 'multi-row',
                            title: '多行模式'
                        }],
                        click: function (obj) {
                            var checkStatus = table.checkStatus(id)
                            var data = checkStatus.data; // 获取选中的数据
                            switch (obj.id) {
                                case 'default-row':
                                    table.reload('table', {
                                        lineStyle: null // 恢复单行
                                    });
                                    layer.msg('已设为单行');
                                    break;
                                case 'multi-row':
                                    table.reload('table', {
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
            table.on('sort(table)', function (obj) {
                var field = form.val('table-filter');
                field["order_field"] = obj.field;
                field["order"] = obj.type;
                table.reload('table', {
                    initSort: obj, // 记录初始排序，如果不设的话，将无法标记表头的排序状态。
                    where: field
                });
            });

            // 工具栏事件
            table.on('toolbar(table)', function (obj) {
                var id = obj.config.id;
                var checkStatus = table.checkStatus(id);
                var othis = lay(this);
                switch (obj.event) {
                    case 'custom_export':
                        var field = form.val('table-filter');
                        location.href = '{{ route('admin.user.list') }}?export=1&' + $.param(field);
                        break;
                }
            });

            // 表头自定义元素工具事件 --- 2.8.8+
            table.on('colTool(table)', function (obj) {
                var event = obj.event;
                if (event === 'email-tips') {
                    layer.alert(layui.util.escape(JSON.stringify(obj.col)), {
                        title: '当前列属性配置项'
                    });
                }
            });

            // 触发单元格工具事件
            table.on('tool(table)', function (obj) { // 双击 toolDouble
                var data = obj.data; // 获得当前行数据
                if (obj.event === 'edit') {
                    layer.open({
                        title: '编辑 - id:' + data.id,
                        type: 2,
                        area: ['80%', '80%'],
                        content: '{{ route('admin.user.save') }}/' + data.id
                    });
                } else if (obj.event === 'more') {
                    // 更多 - 下拉菜单
                    dropdown.render({
                        elem: this, // 触发事件的 DOM 对象
                        show: true, // 外部事件触发即显示
                        data: [{
                            title: '删除',
                            id: 'del'
                        }],
                        click: function (menudata) {
                            if (menudata.id === 'del') {
                                layer.confirm('真的删除行 [id: ' + data.id + '] 么', function (index) {
                                    $.post('{{ route('admin.user.delete') }}', {
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
            table.on('checkbox(table)', function (obj) {
                console.log(obj)
            });

            // 触发表格单选框选择
            table.on('radio(table)', function (obj) {
                console.log(obj)
            });

            // 行单击事件
            table.on('row(table)', function (obj) {
                console.log(obj);
            });

            // 行双击事件
            table.on('rowDouble(table)', function (obj) {
                console.log(obj);
            });
        });
    </script>
@endsection
