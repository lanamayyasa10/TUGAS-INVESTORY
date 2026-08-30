<?php
require_once __DIR__ . '/../../../config/helpers.php';
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Inventory Management') ?></title>
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>

<div class="app-shell">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            Inventory<br>
            <span>Management</span>
        </div>

        <nav>
            <a href="index.php?page=dashboard">Dashboard</a>
            <a href="index.php?page=inventory">Inventory</a>
            <a href="index.php?page=warehouse">Gudang</a>
            <a href="index.php?page=vendor">Vendor</a>
            <a href="index.php?page=transactions">Transaksi Stok</a>
            <a class="logout" href="index.php?page=logout">Logout</a>
        </nav>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
    <header class="topbar">

    <div class="topbar-title">
        <h2><?= e($title ?? 'Inventory Management') ?></h2>
        <small>Halo, <?= e($_SESSION['admin_name'] ?? 'Admin') ?> 👋</small>
    </div>

    <div class="topbar-right">

        <!-- SEARCH -->
        <div class="global-search">
        <span class="search-icon">⌕</span>

        <input
            type="text"
            id="globalSearch"
            placeholder="Cari sesuatu..."
            autocomplete="off"
        >

        <div class="search-results" id="searchResults"></div>
    </div>

        <!-- PROFILE -->
        <a href="index.php?page=admin" class="profile-icon">
            👤
        </a>

    </div>

</header>


        <!-- FLASH MESSAGE -->
        <?php if ($flash): ?>

            <div class="alert <?= e($flash['type']) ?>">
                <?= e($flash['message']) ?>
            </div>

        <?php endif; ?>

        <script>
const globalSearch = document.getElementById('globalSearch');
const searchResults = document.getElementById('searchResults');

let searchTimer;

if (globalSearch) {

    globalSearch.addEventListener('input', function () {

        clearTimeout(searchTimer);

        const query = this.value.trim();

        if (query.length < 2) {
            searchResults.innerHTML = '';
            searchResults.classList.remove('show');
            return;
        }

        searchTimer = setTimeout(() => {

            fetch('index.php?page=search&q=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {

                    searchResults.innerHTML = '';

                    if (data.length === 0) {

                        searchResults.innerHTML = `
                            <div class="search-empty">
                                Tidak ada hasil untuk "<strong>${escapeHtml(query)}</strong>"
                            </div>
                        `;

                        searchResults.classList.add('show');

                        return;
                    }

                    data.forEach(item => {

                        const result = document.createElement('a');

                        result.href = item.url;
                        result.className = 'search-result-item';

                        result.innerHTML = `
                            <div class="search-result-icon">
                                ${item.icon}
                            </div>

                            <div class="search-result-content">

                                <div class="search-result-name">
                                    ${escapeHtml(item.name)}
                                </div>

                                <div class="search-result-type">
                                    ${escapeHtml(item.type)} • ${escapeHtml(item.description)}
                                </div>

                            </div>
                        `;

                        searchResults.appendChild(result);
                    });

                    searchResults.classList.add('show');

                })
                .catch(error => {
                    console.error('Search error:', error);
                });

        }, 250);
    });


    // Tutup hasil ketika klik di luar search
    document.addEventListener('click', function(event) {

        const searchBox = document.querySelector('.global-search');

        if (searchBox && !searchBox.contains(event.target)) {
            searchResults.classList.remove('show');
        }

    });


    // Buka kembali ketika input diklik
    globalSearch.addEventListener('focus', function () {

        if (this.value.trim().length >= 2) {
            searchResults.classList.add('show');
        }

    });

}


// Mencegah HTML injection dari hasil database
function escapeHtml(text) {

    const div = document.createElement('div');

    div.textContent = text;

    return div.innerHTML;
}
</script>
