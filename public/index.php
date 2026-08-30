<?php
require_once __DIR__ . '/../config/auth.php';

$page = $_GET['page'] ?? (isset($_SESSION['admin_id']) ? 'dashboard' : 'login');

switch ($page) {

    case 'admin':
    require_once __DIR__ . '/../app/controllers/AdminController.php';
    (new AdminController())->index();
    break;

    case 'admin-create':
    require_once __DIR__ . '/../app/controllers/AdminController.php';
    (new AdminController())->create();
    break;

    case 'admin-store':
    require_once __DIR__ . '/../app/controllers/AdminController.php';
    (new AdminController())->store();
    break;

    case 'admin-edit':
    require_once __DIR__ . '/../app/controllers/AdminController.php';
    (new AdminController())->edit();
    break;

    case 'admin-update':
    require_once __DIR__ . '/../app/controllers/AdminController.php';
    (new AdminController())->update();
    break;

    case 'admin-update-field':
    require_once __DIR__ . '/../app/controllers/AdminController.php';
    (new AdminController())->updateField();
    break;

    case 'admin-delete':
    require_once __DIR__ . '/../app/controllers/AdminController.php';
    (new AdminController())->delete();
    break;

    case 'login':
        require_once __DIR__ . '/../app/controllers/AuthController.php';
        (new AuthController())->showLogin();
        break;

    case 'login-process':
        require_once __DIR__ . '/../app/controllers/AuthController.php';
        (new AuthController())->login();
        break;

    case 'logout':
        require_once __DIR__ . '/../app/controllers/AuthController.php';
        (new AuthController())->logout();
        break;

    case 'dashboard':
        require_once __DIR__ . '/../app/controllers/DashboardController.php';
        (new DashboardController())->index();
        break;

    case 'search':
        require_once __DIR__ . '/../app/controllers/SearchController.php';
        (new SearchController())->index();
        break;

    case 'inventory':
        require_once __DIR__ . '/../app/controllers/InventoryController.php';
        (new InventoryController())->index();
        break;

    case 'inventory-create':
        require_once __DIR__ . '/../app/controllers/InventoryController.php';
        (new InventoryController())->create();
        break;

    case 'inventory-store':
        require_once __DIR__ . '/../app/controllers/InventoryController.php';
        (new InventoryController())->store();
        break;

    case 'inventory-edit':
        require_once __DIR__ . '/../app/controllers/InventoryController.php';
        (new InventoryController())->edit();
        break;

    case 'inventory-update':
        require_once __DIR__ . '/../app/controllers/InventoryController.php';
        (new InventoryController())->update();
        break;

    case 'inventory-detail':
        require_once __DIR__ . '/../app/controllers/InventoryController.php';
        (new InventoryController())->detail();
        break;

    case 'inventory-delete':
        require_once __DIR__ . '/../app/controllers/InventoryController.php';
        (new InventoryController())->delete();
        break;

    case 'warehouse':
        require_once __DIR__ . '/../app/controllers/WarehouseController.php';
        (new WarehouseController())->index();
        break;

    case 'warehouse-create':
        require_once __DIR__ . '/../app/controllers/WarehouseController.php';
        (new WarehouseController())->create();
        break;

    case 'warehouse-store':
        require_once __DIR__ . '/../app/controllers/WarehouseController.php';
        (new WarehouseController())->store();
        break;

    case 'warehouse-edit':
        require_once __DIR__ . '/../app/controllers/WarehouseController.php';
        (new WarehouseController())->edit();
        break;

    case 'warehouse-update':
        require_once __DIR__ . '/../app/controllers/WarehouseController.php';
        (new WarehouseController())->update();
        break;

    case 'warehouse-delete':
        require_once __DIR__ . '/../app/controllers/WarehouseController.php';
        (new WarehouseController())->delete();
        break;

    case 'vendor':
        require_once __DIR__ . '/../app/controllers/VendorController.php';
        (new VendorController())->index();
        break;

    case 'vendor-create':
        require_once __DIR__ . '/../app/controllers/VendorController.php';
        (new VendorController())->create();
        break;

    case 'vendor-store':
        require_once __DIR__ . '/../app/controllers/VendorController.php';
        (new VendorController())->store();
        break;

    case 'vendor-edit':
        require_once __DIR__ . '/../app/controllers/VendorController.php';
        (new VendorController())->edit();
        break;

    case 'vendor-update':
        require_once __DIR__ . '/../app/controllers/VendorController.php';
        (new VendorController())->update();
        break;

    case 'vendor-delete':
        require_once __DIR__ . '/../app/controllers/VendorController.php';
        (new VendorController())->delete();
        break;

    case 'admin':
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        (new AdminController())->index();
        break;

    case 'admin-create':
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        (new AdminController())->create();
        break;

    case 'admin-store':
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        (new AdminController())->store();
        break;

    case 'admin-edit':
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        (new AdminController())->edit();
        break;

    case 'admin-update':
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        (new AdminController())->update();
        break;

    case 'admin-delete':
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        (new AdminController())->delete();
        break;

    case 'transactions':
        require_once __DIR__ . '/../app/controllers/StockTransactionController.php';
        (new StockTransactionController())->index();
        break;

    case 'transaction-create':
        require_once __DIR__ . '/../app/controllers/StockTransactionController.php';
        (new StockTransactionController())->create();
        break;

    case 'transaction-store':
        require_once __DIR__ . '/../app/controllers/StockTransactionController.php';
        (new StockTransactionController())->store();
        break;

    default:
        http_response_code(404);
        echo '404 - Halaman tidak ditemukan.';
}
