<div class="layui-header">
    <!-- 菜 单 顶 部 -->
    <div class="layui-logo">
        <!-- 图 标 -->
        <img class="logo">
        <!-- 标 题 -->
        <span class="title"></span>
    </div>
    <!-- 顶 部 左 侧 功 能 -->
    <ul class="layui-nav layui-layout-left">
        <li class="collapse layui-nav-item"><a href="#" class="layui-icon layui-icon-shrink-right"></a></li>
        <li class="refresh layui-nav-item"><a href="#" class="layui-icon layui-icon-refresh-1" loading=600></a></li>
    </ul>
    <!-- 多 系 统 菜 单 -->
    <div id="control" class="layui-layout-control"></div>
    <!-- 顶 部 右 侧 菜 单 -->
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item layui-hide-xs"><a href="#" class="menuSearch layui-icon layui-icon-search"></a>
        </li>
        <li class="layui-nav-item layui-hide-xs message"></li>
        <li class="layui-nav-item layui-hide-xs"><a href="#"
                                                    class="fullScreen layui-icon layui-icon-screen-full"></a></li>
        <li class="layui-nav-item user">
            <!-- 头 像 -->
            <a class="layui-icon layui-icon-username" href="javascript:;"></a>
            <!-- 功 能 菜 单 -->
            <dl class="layui-nav-child">
                <dd><a lay-on="basic-info" style="cursor:pointer">基本资料</a></dd>
                <dd><a href="javascript:void(0);" class="logout">注销登录</a></dd>
            </dl>
        </li>
        <!-- 主 题 配 置 -->
        <li class="layui-nav-item setting"><a href="#" class="layui-icon layui-icon-more-vertical"></a></li>
    </ul>
</div>
