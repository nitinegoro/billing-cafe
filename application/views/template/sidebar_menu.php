<body class="no-skin">
		<div id="load-progress"></div>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state sidebar-fixed">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">

					<li class="<?php echo active_link_controller('main'); ?> hover">
						<a href="<?php echo site_url('main') ?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="<?php echo active_link_controller('transaction'); ?> hover">
						<a href="<?php echo site_url('transaction') ?>">
							<i class="menu-icon fa fa-exchange"></i>
							<span class="menu-text"> Transaction </span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="<?php echo active_link_multiple(array('product','tables')); ?> hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-database"></i>
							<span class="menu-text"> Data Management</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">

							<li class="hover <?php echo active_link_controller('product'); ?> ">
								<a href="<?php echo site_url('product') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Product Sales
								</a>
								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_controller('sell_category'); ?> ">
								<a href="<?php echo site_url('sell_category') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Product Category
								</a>
								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_controller('tables'); ?>">
								<a href="<?php echo site_url('tables') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tables
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="<?php echo active_link_controller('transaction'); ?> hover">
						<a href="<?php echo site_url('transaction') ?>">
							<i class="menu-icon fa fa-bar-chart"></i>
							<span class="menu-text"> Report Transaction </span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="hover <?php echo active_link_controller('user').active_link_controller('setting') ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-wrench"></i>
							<span class="menu-text"> Settings </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="hover <?php echo active_link_method('index', 'user'); ?>">
								<a href="<?php echo site_url('user') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Users Application
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('role'); ?>">
								<a href="<?php echo site_url('user/role') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									User Privileges
								</a>
								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('index', 'setting'); ?>">
								<a href="<?php echo site_url('setting') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Application Setting
								</a>
								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('account','user'); ?>">
								<a href="<?php echo site_url('user/account') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									<span class="menu-text"> Login Setting</span>
								</a>
								<b class="arrow"></b>
							</li>

						</ul>
					</li>


					<li class="hover">
						<a href="#" data-toggle="modal" data-target="#log-off-modal">
							<i class="menu-icon fa fa-power-off"></i>
							<span class="menu-text"> Sign Out </span>
						</a>
						<b class="arrow"></b>
					</li>

				</ul><!-- /.nav-list -->
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
<div class="page-header">
<?php  
/**
 * Generated Page Title
 *
 * @return string
 **/
	echo $page_title;
?>
<?php 
/**
 * Generate Breadcrumbs from library
 *
 * @var string
 **/
	if(isset($breadcrumb) != FALSE)
		echo $breadcrumb; 
?>
</div><!-- /.page-header -->
				

