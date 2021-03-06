<?php
	require_once 'config.php';
	
    // 驗證使用者
    $authSystem = new AuthSystem();
	$loginSystem = new LoginSystem();
	$loginUserRank = $loginSystem->getLoginUserRank();
	if (is_null($loginUserRank)) {
		$authSystem->redirectHome();
	}
	$adminUserRank = new UserRank(UserRank::ADMIN);
	$authSystem->redirectHomeWhenBelowRank($loginUserRank, $adminUserRank);
    
    // 設定主版
    $title = '設備分類管理';
	$navContentPath = 'contents/nav_admin.php';
	$contentPath = 'contents/categories.php';
	$addScripts = array();
    
    // 設定頁面內容
    $caption = $title;
	$navigateUrl = $config['BASE_PATH'] . 'managecategories.php';
	$postEditUrl = $config['BASE_PATH'] . 'editcategory.php';
	$postDeleteUrl = $config['BASE_PATH'] . 'deletecategory.php';
	$pagination = new Pagination();
	$pagination->setNavigateUrl($navigateUrl);
	$operators = array('delete' => True,
					   'edit' => True);
	if (isset($_GET['perpage'])) {
		$perpage = (int) $_GET['perpage'];
		$perpage = $perpage > 0 ? $perpage : $config['DEFAULT_PERPAGE'];
	} else {
		$perpage = $config['DEFAULT_PERPAGE'];
	}
	if (isset($_GET['page'])) {
		$page = (int) $_GET['page'];
		$page = $page > 0 ? $page : $config['DEFAULT_PAGE'];
	} else {
		$page = $config['DEFAULT_PAGE'];
	}
	$categoryModel = new CategoryModel();
	$categories = $categoryModel->get($perpage, ($page - 1) * $perpage); // page is 1-based
    $totalItems = $categoryModel->getCount();
	$totalPages = ceil($totalItems / $perpage);
	$pagination->setCurrentPage($page);
	$pagination->setPerpage($perpage);
	$pagination->setTotalPages($totalPages);
	
    require_once 'templates/layout.php'; // May use two-nav layout
?>