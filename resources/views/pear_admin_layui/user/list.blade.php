@extends('layouts.sub')

@section('content')
    <div class="layui-card">
        <div class="layui-card-body">
            <form class="layui-form layui-row layui-col-space16" lay-filter="{{ getDomIdKey('', 'table_filter') }}">
                <div class="layui-form-item">
                    @include('component.text', ['label' => 'sn', 'name' => 'sn', 'is_search' => 1])

                    @include('component.text', ['label' => '账号', 'name' => 'account', 'is_search' => 1])

                    @include('component.datetime_range', ['label' => '日期范围', 'name' => 'time', 'is_search' => 1])

                    @include('component.submit', ['is_search' => 1])
                </div>
            </form>
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
            <a class="layui-btn layui-btn-xs" lay-event="show">查看</a>
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
            form.on('submit({{ getDomIdKey('', 'search') }})', function (data) {
                var field = data.field; // 获得表单字段
                table.reload('{{ getDomIdKey('', 'table') }}', {
                    page: {
                        curr: 1 // 重新从第 1 页开始
                    },
                    where: field // 搜索的字段
                });
                return false;
            });

            // 创建渲染实例
            table.render({
                elem: '#{{ getDomIdKey('', 'table') }}',
                url: '{{ route('admin.user.list') }}',
                toolbar: '#{{ getDomIdKey('', 'toolbar') }}',
                lineStyle: 'height: 180px;',
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
                        templet: function (d) {
                            var deviceTypeList = JSON.parse('{!! json_encode(\App\Models\User::$deviceTypeList) !!}')
                            var str = 'SN: ' + d.sn + '<br>';
                            str += '账号: ' + d.account + '<br>';
                            str += '真实姓名: ' + d.real_name + '<br>';
                            str += '昵称: ' + d.nick_name + '<br>';
                            str += '设备类型: ' + (deviceTypeList[d.device_type] ? deviceTypeList[d.device_type] : '') + '<br>';
                            return str;
                        }
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
                        toolbar: '#{{ getDomIdKey('', 'bar') }}'
                    }
                ]],
                done: function () {
                    var id = this.id;
                    dropdown.render({
                        elem: '#{{ getDomIdKey('', 'dropdownButton') }}',
                        data: [],
                        click: function (obj) {
                            var checkStatus = table.checkStatus(id)
                            var data = checkStatus.data; // 获取选中的数据
                            switch (obj.id) {
                                case '{{ getDomIdKey('', 'add') }}':

                                    break;
                                case '{{ getDomIdKey('', 'update') }}':

                                    break;
                                case '{{ getDomIdKey('', 'delete') }}':

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
                                    table.reloadData('{{ getDomIdKey('', 'table') }}', {
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
                            var checkStatus = table.checkStatus(id)
                            var data = checkStatus.data; // 获取选中的数据
                            switch (obj.id) {
                                case '{{ getDomIdKey('', 'default_row') }}':
                                    table.reload('{{ getDomIdKey('', 'table') }}', {
                                        lineStyle: null // 恢复单行
                                    });
                                    layer.msg('已设为单行');
                                    break;
                                case '{{ getDomIdKey('', 'multi_row') }}':
                                    table.reload('{{ getDomIdKey('', 'table') }}', {
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
            table.on('sort({{ getDomIdKey('', 'table') }})', function (obj) {
                var field = form.val('{{ getDomIdKey('', 'table_filter') }}');
                field["order_field"] = obj.field;
                field["order"] = obj.type;
                table.reload('{{ getDomIdKey('', 'table') }}', {
                    initSort: obj, // 记录初始排序，如果不设的话，将无法标记表头的排序状态。
                    where: field
                });
            });

            // 工具栏事件
            table.on('toolbar({{ getDomIdKey('', 'table') }})', function (obj) {
                var id = obj.config.id;
                var checkStatus = table.checkStatus(id);
                var othis = lay(this);
                switch (obj.event) {
                    case 'custom_export':
                        var field = form.val('{{ getDomIdKey('', 'table_filter') }}');
                        location.href = '{{ route('admin.user.list') }}?export=1&' + $.param(field);
                        break;
                }
            });

            // 表头自定义元素工具事件 --- 2.8.8+
            table.on('colTool({{ getDomIdKey('', 'table') }})', function (obj) {
                var event = obj.event;
                if (event === 'email-tips') {
                    layer.alert(layui.util.escape(JSON.stringify(obj.col)), {
                        title: '当前列属性配置项'
                    });
                }
            });

            // 触发单元格工具事件
            table.on('tool({{ getDomIdKey('', 'table') }})', function (obj) { // 双击 toolDouble
                var data = obj.data; // 获得当前行数据
                if (obj.event === 'show') {
                    layer.open({
                        title: '查看 - id:' + data.id,
                        type: 2,
                        area: ['80%', '80%'],
                        content: '{{ route('admin.user.show') }}/' + data.id
                    });
                } else if (obj.event === 'more') {
                    // 更多 - 下拉菜单
                    dropdown.render({
                        elem: this, // 触发事件的 DOM 对象
                        show: true, // 外部事件触发即显示
                        data: [],
                        click: function (menudata) {

                        },
                        align: 'right', // 右对齐弹出
                        style: 'box-shadow: 1px 1px 10px rgb(0 0 0 / 12%);' // 设置额外样式
                    })
                }
            });

            // 触发表格复选框选择
            table.on('checkbox({{ getDomIdKey('', 'table') }})', function (obj) {
                console.log(obj)
            });

            // 触发表格单选框选择
            table.on('radio({{ getDomIdKey('', 'table') }})', function (obj) {
                console.log(obj)
            });

            // 行单击事件
            table.on('row({{ getDomIdKey('', 'table') }})', function (obj) {
                console.log(obj);
            });

            // 行双击事件
            table.on('rowDouble({{ getDomIdKey('', 'table') }})', function (obj) {
                console.log(obj);
            });
        });
    </script>
@endsection
