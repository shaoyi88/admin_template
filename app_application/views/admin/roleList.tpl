<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 系统管理<span class="c-gray en">&gt;</span> 分组权限管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('role/index')}" method="get">
		<div class="text-c"> 
			<input type="text" value="{$keyword}" class="input-text" style="width:250px" placeholder="输入分组名称" id="" name="keyword">
			<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜分组</button>
		</div>
	</form>
	{if checkRight('role_add')}
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="{formatUrl('role/add')}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分组</a>
		</span>
	 </div>
	 {/if}
	 {if empty($roleList)}
	 	<div class="cl pd-5 bg-1 bk-gray"><h2 class="text-c">暂无分组</h2></div>
	 {else}
	 	<table class="table table-border table-bg table-bordered table-hover">
			<thead>
        		<tr class="text-c">
          			<th>分组名</th>
          			<th>操作</th>
        		</tr>
      		</thead>
      		<tbody>
			{foreach $roleList as $item}
				<tr class="text-c">
        			<td>{$item['role_name']}</td>
          			<td>
          				{if checkRight('role_edit')}<a class="btn btn-primary radius edit" title="编辑" href="{formatUrl('role/add?id=')}{$item['id']}" style="text-decoration:none">编辑</a>{/if}
          				{if checkRight('role_del')}<a class="btn btn-primary radius ml-5 del" did="{$item['id']}" title="删除" href="javascript:;" style="text-decoration:none">删除</a>{/if}
          			</td>
          		</tr>
			{/foreach}
			</tbody>
		</table>
	 {/if}
</div>
<script type="text/javascript" src="/public/admin/js/role.js"></script>
<input type="hidden" id="delUrl" value="{formatUrl('role/doDel')}"></input>