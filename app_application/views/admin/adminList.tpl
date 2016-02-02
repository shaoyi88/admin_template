<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 系统管理<span class="c-gray en">&gt;</span> 系统用户管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('admin/index')}" method="get">
		<div class="text-c"> 
			<input type="text" value="{$keyword}" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="keyword">
			<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜管理员</button>
		</div>
	</form>
	{if checkRight('admin_add')}
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="{formatUrl('admin/add')}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
		</span>
	 </div>
	 {/if}
	 {if empty($adminList)}
	 	<div class="cl pd-5 bg-1 bk-gray"><h2 class="text-c">暂无管理员</h2></div>
	 {else}
	 	<table class="table table-border table-bg table-bordered table-hover">
			<thead>
        		<tr class="text-c">
          			<th>用户名</th>
          			<th>账户</th>
          			<th>操作</th>
        		</tr>
      		</thead>
      		<tbody>
			{foreach $adminList as $item}
				<tr class="text-c">
        			<td>{$item['admin_name']}</td>
        			<td>{$item['admin_account']}</td>
          			<td>
          				{if checkRight('admin_edit') && $item['admin_role'] != 0}<a class="btn btn-primary radius edit" title="编辑" href="{formatUrl('admin/add?id=')}{$item['admin_id']}" style="text-decoration:none">编辑</a>{/if}
          				{if checkRight('admin_del') && $item['admin_role'] != 0}<a class="btn btn-primary radius ml-5 del" did="{$item['admin_id']}" title="删除" href="javascript:;" style="text-decoration:none">删除</a>{/if}
          			</td>
          		</tr>
			{/foreach}
			</tbody>
		</table>
	 {/if}
</div>
<script type="text/javascript" src="/public/admin/js/admin.js"></script>
<input type="hidden" id="delUrl" value="{formatUrl('admin/doDel')}"></input>