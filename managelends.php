<?php
require_once 'config.php';
// 驗證使用者
$authSystem = new AuthSystem();
$loginSystem = new LoginSystem();
$loginUserRank = $loginSystem->getLoginUserRank();
if (is_null($loginUserRank)) {
	$authSystem->redirectHome();
}
$authSystem->redirectHomeWhenBelowRank($loginUserRank, new UserRank(UserRank::ADMIN));

// 設定主版資料
$title = '出借管理';
$navContentPath = 'contents/nav_admin.php';
$contentPath = 'contents/history.php';
$addScripts = array();

// 設定頁面資料
$lendModel = new LendModel();
$instanceModel = new InstanceModel();
$modelModel = new ModelModel();
$categoryModel = new CategoryModel();
$userModel = new UserModel();

$caption = $title;
$postLendBackUrl = $config['BASE_PATH'] . 'lendback.php';
$getSearchUrl = $config['BASE_PATH'] . 'managelends.php';
$operators = array('lendBack' => True);
$navigateUrl = $config['BASE_PATH'] . 'managelends.php';
// 設定出借資料和分頁資料
$getData = filter_input_array(INPUT_GET, array('perpage' => FILTER_VALIDATE_INT,
											   'page' => FILTER_VALIDATE_INT));
$searchIdentifyData = filter_input(INPUT_GET, 'search_identify', FILTER_SANITIZE_STRING);
if ($searchIdentifyData) {
	$lendsModelData = $lendModel->getByInstanceIdentify($searchIdentifyData);
	print $lendModel->getStatementErrorMessage();
	$totalRows = count($lendsModelData);
} else {
	$totalRows = $lendModel->getCount();
}								 
$perpage = (int) $getData['perpage'];
$page = (int) $getData['page'];
$perpage = ($perpage > 0) ? $perpage : $config['DEFAULT_PERPAGE'];
$totalPages = ceil($totalRows / $perpage);
$page = ($page > 0 and $page <= $totalPages) ? $page : $config['DEFAULT_PAGE'];

if (!$searchIdentifyData) {
	$lendsModelData = $lendModel->get($perpage, ($page - 1) * $perpage);
} else {
	$lendsModelData = $lendsModelData;
}
$lends = array();
foreach ($lendsModelData as $lendModelData) {
	$lend = array();
	$lend['lend'] = $lendModelData;
	
	$lend['instance'] = $instanceModel->getById($lendModelData['instances_id']);
	
	$lend['model'] = $modelModel->getById($lend['instance']['model_id']);
	
	$lend['category'] = $categoryModel->getById($lend['model']['category_id']);
	
	$lend['user'] = $userModel->getByAccountName($lend['lend']['user_id']);
	
	$lend['lendbackuser'] = $userModel->getByAccountName($lend['lend']['lendbackuser_id']);
	
	$lends[] = $lend;
}

require_once 'templates/layout.php';
