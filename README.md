#角色访问控制在后台管理系统中是不可缺少的一部分，它高层次的抽象主体灵活的支撑着整个系统安全的访问。它通常使用5张表来实现，即用户表、角色表、路由表、主体指派表(用户-角色)、权限指派表(角色-路由)。在此还设计一个菜单表，它与路由存在一对多的关系。下面将会给出表的设计。
#a-quickly-rbac目前已支持的特性：<br/>菜单管理：无限级菜单分配、前台菜单配置、菜单排序、通知设置。<br/>路由管理：CRUD<br/>权限管理：CRUD<br/>用户管理：CRUD<br/>用户管理：CRUD

<h3>#表设计</h3>
<h5>用户表</h5>
<table>
    <tbody>
        <tr >
            <td >
                字段
            </td>
            <td >
                数据类型
            </td>
            <td >
                释义
            </td>
            <td >
                说明
            </td>
        </tr>
        <tr >
            <td >
                id
            </td>
            <td >
                int(12)
            </td>
            <td >
                自增id
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                username
            </td>
            <td >
                varchar(32)
            </td>
            <td >
                用户名
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                password
            </td>
            <td >
                char(32)
            </td>
            <td >
                登录密码
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                operator
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                操作人
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                create_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                创建时间
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                update_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                更新时间
            </td>
            <td >
                　
            </td>
        </tr>
    </tbody>
</table>
<h5>角色表</h5>
<table border="0" >
    <colgroup>
        <col />
        <col />
        <col />
        <col />
    </colgroup>
    <tbody>
        <tr >
            <td >
                字段
            </td>
            <td >
                数据类型
            </td>
            <td >
                释义
            </td>
            <td >
                说明
            </td>
        </tr>
        <tr >
            <td >
                id
            </td>
            <td >
                int(12)
            </td>
            <td >
                自增id
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                name
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                角色名称
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                operator
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                操作人
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                create_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                创建时间
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                update_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                更新时间
            </td>
            <td >
                　
            </td>
        </tr>
    </tbody>
</table>
<h5>路由表</h5>
<table border="0" >
    <colgroup>
        <col span="4" />
    </colgroup>
    <tbody>
        <tr >
            <td >
                字段
            </td>
            <td >
                数据类型
            </td>
            <td >
                释义
            </td>
            <td >
                说明
            </td>
        </tr>
        <tr >
            <td >
                id
            </td>
            <td >
                int(12)
            </td>
            <td >
                自增id
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                name
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                路由名称
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                route
            </td>
            <td >
                varchar(255）
            </td>
            <td >
                路由名称
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                mid_1
            </td>
            <td >
                int(12)
            </td>
            <td >
                菜单名
            </td>
            <td >
                fk
            </td>
        </tr>
        <tr >
            <td >
                mid_2
            </td>
            <td >
                int(12)
            </td>
            <td >
                菜单名
            </td>
            <td >
                fk
            </td>
        </tr>
        <tr >
            <td >
                mid_3
            </td>
            <td >
                int(12)
            </td>
            <td >
                菜单名
            </td>
            <td >
                fk
            </td>
        </tr>
        <tr >
            <td >
                is_default
            </td>
            <td >
                tinyint(1）
            </td>
            <td >
                是否默认
            </td>
            <td >
                0:否1:是
            </td>
        </tr>
        <tr >
            <td >
                operator
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                操作人
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                create_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                创建时间
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                update_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                更新时间
            </td>
            <td >
                　
            </td>
        </tr>
    </tbody>
</table>
<h5>用户-角色表</h5>
<table border="0" >
    <colgroup>
        <col />
        <col />
        <col />
        <col />
    </colgroup>
    <tbody>
        <tr >
            <td >
                字段
            </td>
            <td >
                数据类型
            </td>
            <td >
                释义
            </td>
            <td >
                说明
            </td>
        </tr>
        <tr >
            <td >
                id
            </td>
            <td >
                int(12)
            </td>
            <td >
                自增id
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                username
            </td>
            <td >
                varchar(32)
            </td>
            <td >
                用户名
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                role_id
            </td>
            <td >
                int(12)
            </td>
            <td >
                角色id
            </td>
            <td >
                fk
            </td>
        </tr>
        <tr >
            <td >
                operator
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                操作人
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                create_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                创建时间
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                update_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                更新时间
            </td>
            <td >
                　
            </td>
        </tr>
    </tbody>
</table>
<h5>角色-路由表</h5>
<table border="0" >
    <colgroup>
        <col />
        <col />
        <col />
        <col />
    </colgroup>
    <tbody>
        <tr >
            <td >
                字段
            </td>
            <td >
                数据类型
            </td>
            <td >
                释义
            </td>
            <td >
                说明
            </td>
        </tr>
        <tr >
            <td >
                id
            </td>
            <td >
                int(12)
            </td>
            <td >
                自增id
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                role_id
            </td>
            <td >
                int(12)
            </td>
            <td >
                角色id
            </td>
            <td >
                fk
            </td>
        </tr>
        <tr >
            <td >
                has_route
            </td>
            <td >
                varchar(32)
            </td>
            <td >
                路由
            </td>
            <td >
                fk
            </td>
        </tr>
        <tr >
            <td >
                operator
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                操作人
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                create_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                创建时间
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                update_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                更新时间
            </td>
            <td >
                　
            </td>
        </tr>
    </tbody>
</table>
<h5>菜单表</h5>
<table border="0" >
    <colgroup>
        <col />
        <col />
        <col />
        <col />
    </colgroup>
    <tbody>
        <tr >
            <td >
                字段
            </td>
            <td >
                数据类型
            </td>
            <td >
                释义
            </td>
            <td >
                说明
            </td>
        </tr>
        <tr >
            <td >
                id
            </td>
            <td >
                int(12)
            </td>
            <td >
                自增id
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                pid
            </td>
            <td >
                int(12)
            </td>
            <td >
                父id
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                name
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                菜单名称
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                icon
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                icon样式
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                badge
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                badge样式
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                sortnum
            </td>
            <td >
                tinyint(12)
            </td>
            <td >
                排列顺序
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                operator
            </td>
            <td >
                varchar(32）
            </td>
            <td >
                操作人
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                create_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                创建时间
            </td>
            <td >
                　
            </td>
        </tr>
        <tr >
            <td >
                update_time
            </td>
            <td >
                timestamp
            </td>
            <td >
                更新时间
            </td>
            <td >
                　
            </td>
        </tr>
    </tbody>
</table>
