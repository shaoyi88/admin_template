<header class="Hui-header cl"> 
	<a class="Hui-logo l" title="管理系统" href="javascript:;">管理系统</a> 
	<ul class="Hui-userbar">
		<li>{$userName}</li>
		<li><a class="changePassword" href="javascript:;" title="修改密码">修改密码</a></li>
		<li><a href="{formatUrl('home/logout')}" title="退出">退出</a></li>
	</ul> 
	<a aria-hidden="false" class="Hui-nav-toggle" href="#"></a> 
</header>


<aside class="Hui-aside">
  <input runat="server" id="divScrollValue" type="hidden" value="" />
  {foreach $menus as $item}
  {if checkRight($item['right'])}
  <div class="menu_dropdown bk_2">
    <dl>
      <dt>{$item['module']}<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
      <dd>
        <ul>
          {foreach $item['menu'] as $sItem}
          {if checkRight($sItem[2])}
          <li><a _href="{$sItem[1]}" data-title="{$item['module']}" href="javascript:void(0)">{$sItem[0]}</a></li>
          {/if}
          {/foreach}
        </ul>
      </dd>
    </dl>
  </div>
  {/if}
  {/foreach}
</aside>
<div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
  <div id="Hui-tabNav" class="Hui-tabNav">
    <div class="Hui-tabNav-wp">
      <ul id="min_title_list" class="acrossTab cl">
        <li class="active"><span title="我的桌面" data-href="{formatUrl('home/welcome')}">我的桌面</span><em></em></li>
      </ul>
    </div>
    <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
  </div>
  <div id="iframe_box" class="Hui-article">
    <div class="show_iframe">
      <div style="display:none" class="loading"></div>
      <iframe scrolling="yes" frameborder="0" src="{formatUrl('home/welcome')}"></iframe>
    </div>
  </div>
</section>
<div class="pd-20 text-c" style="display:none" id="changePasswordWindow">
	<form class="Huiform" action="{formatUrl('admin/changePassword')}" method="post">
		<input type="hidden" name="admin_id" value="{$admin_id}" />
		<table class="table table-bg table-border table-bordered">
			<tr>
      			<td>新密码：</td>
      			<td><input type="password" class="input-text" autocomplete="off" placeholder="密码" name="admin_password" id="admin_password" datatype="*6-18" nullmsg="请输入密码！"></td>
      		</tr>
      		<tr>
      			<td>确认密码：</td>
      			<td><input type="password" class="input-text" autocomplete="off" placeholder="密码" id="admin_password2" recheck="admin_password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！"></td>
      		</tr>
      		<tr>
      			<td colspan="2">
      				<button style="margin-top:10px" type="submit" class="btn btn-success" id="" name=""><i class="icon-plus"></i>提交</button>
      			</td>
      		</tr>
		</table>
	</form>
</div>
<script type="text/javascript" src="/public/admin/js/index.js"></script>