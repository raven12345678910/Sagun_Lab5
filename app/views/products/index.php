<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$products = $products ?? [];
$username = $username ?? 'Admin';
$totalProducts = count($products);
$totalQuantity = 0;
$lowStock = 0;
foreach ($products as $p) {
    $qty = (int)($p['quantity'] ?? 0);
    $totalQuantity += $qty;
    if ($qty <= 5) $lowStock++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products | Product Management</title>
<style>
:root{--bg:#f5f7fb;--card:#fff;--text:#172033;--muted:#718096;--line:#e8edf5;--primary:#635bff;--primary2:#7c3aed;--danger:#ef476f;--shadow:0 18px 50px rgba(31,41,55,.08)}
*{box-sizing:border-box}body{margin:0;background:var(--bg);color:var(--text);font-family:Inter,Segoe UI,Arial,sans-serif}.layout{min-height:100vh;display:flex}.sidebar{width:245px;background:#15152b;color:#fff;padding:28px 18px;position:fixed;inset:0 auto 0 0}.brand{display:flex;align-items:center;gap:12px;padding:4px 10px 30px}.brand-icon{width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,#8b5cf6,#5b5cf6);display:grid;place-items:center;font-weight:900}.brand strong{font-size:18px}.brand span{display:block;color:#a8aac0;font-size:11px;margin-top:3px}.nav-title{font-size:10px;color:#777a98;text-transform:uppercase;letter-spacing:1.5px;padding:10px}.nav a{display:flex;align-items:center;gap:12px;padding:13px 12px;margin:5px 0;border-radius:10px;color:#c9cade;text-decoration:none;font-size:14px}.nav a.active,.nav a:hover{background:#272642;color:#fff}.nav a.active{box-shadow:inset 3px 0 #8b5cf6}.sidebar-bottom{position:absolute;bottom:22px;left:18px;right:18px}.user-mini{border-top:1px solid #2b2b43;padding:18px 10px 12px;display:flex;align-items:center;gap:10px}.avatar{width:36px;height:36px;border-radius:50%;background:#302f52;display:grid;place-items:center;color:#bdaeff;font-weight:800}.user-mini small{display:block;color:#81849f;font-size:11px}.main{margin-left:245px;width:calc(100% - 245px);padding:32px 38px}.topbar{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;margin-bottom:28px}.eyebrow{font-size:12px;color:var(--primary);font-weight:800;letter-spacing:.7px;text-transform:uppercase;margin:0 0 7px}.topbar h1{font-size:30px;margin:0 0 7px;letter-spacing:-.7px}.subtitle{margin:0;color:var(--muted);font-size:14px}.top-actions{display:flex;gap:10px;align-items:center}.btn{border:0;text-decoration:none;padding:11px 16px;border-radius:10px;font-size:13px;font-weight:800;cursor:pointer;display:inline-flex;align-items:center;gap:8px}.btn-primary{background:linear-gradient(135deg,var(--primary),var(--primary2));color:#fff;box-shadow:0 8px 20px rgba(99,91,255,.22)}.btn-light{background:#fff;color:#4a5568;border:1px solid var(--line)}.stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:22px}.stat{background:var(--card);border:1px solid var(--line);border-radius:16px;padding:19px 20px;box-shadow:0 8px 25px rgba(31,41,55,.04)}.stat-head{display:flex;justify-content:space-between;color:var(--muted);font-size:12px;font-weight:700}.stat-icon{width:34px;height:34px;border-radius:10px;background:#f0efff;color:var(--primary);display:grid;place-items:center;font-weight:900}.stat strong{display:block;font-size:27px;margin-top:12px}.panel{background:var(--card);border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);overflow:hidden}.panel-head{padding:20px 22px;display:flex;justify-content:space-between;align-items:center;gap:15px;border-bottom:1px solid var(--line)}.panel-head h2{margin:0;font-size:17px}.panel-head p{margin:4px 0 0;color:var(--muted);font-size:12px}.search{width:245px;padding:10px 12px;border:1px solid var(--line);border-radius:9px;outline:0;font-size:13px}.search:focus{border-color:#9b94ff;box-shadow:0 0 0 3px #635bff12}.table-wrap{overflow:auto}table{width:100%;border-collapse:collapse;min-width:900px}th,td{padding:15px 18px;border-bottom:1px solid var(--line);text-align:left;font-size:13px}th{font-size:10px;text-transform:uppercase;letter-spacing:.8px;color:#8992a5;background:#fbfcfe}tbody tr:hover{background:#fafaff}.id{color:#9aa3b3;font-weight:700}.product-name{font-weight:800;color:#252b3b}.desc{color:#758096;max-width:250px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.price{font-weight:800}.qty{font-weight:800}.badge{display:inline-block;padding:5px 9px;border-radius:999px;font-size:10px;font-weight:800;background:#eaf8f0;color:#1c8a50}.badge.low{background:#fff0f2;color:#d13d61}.actions{display:flex;gap:7px}.action{padding:7px 10px;border-radius:8px;text-decoration:none;font-weight:800;font-size:11px}.edit{background:#f0efff;color:#5149db}.delete{background:#fff0f2;color:#d13d61}.empty{padding:55px;text-align:center;color:var(--muted)}.empty strong{display:block;color:var(--text);font-size:16px;margin-bottom:6px}.footer{padding:18px 3px;color:#9aa3b3;font-size:11px;text-align:right}
@media(max-width:900px){.sidebar{width:75px;padding:20px 10px}.brand{justify-content:center;padding-bottom:22px}.brand strong,.brand span,.nav-title,.nav a span,.user-mini div:not(.avatar){display:none}.nav a{justify-content:center}.main{margin-left:75px;width:calc(100% - 75px);padding:24px 18px}.stats{grid-template-columns:1fr}.topbar{flex-direction:column}.top-actions{width:100%}.search{width:100%}}
@media(max-width:560px){.main{padding:18px 12px}.topbar h1{font-size:24px}.panel-head{align-items:stretch;flex-direction:column}.top-actions{flex-wrap:wrap}.btn{flex:1;justify-content:center}}
</style>
</head>
<body>
<div class="layout">
<aside class="sidebar">
    <div class="brand"><div class="brand-icon">PM</div><div><strong>ProductHub</strong><span>LABORATORY EXERCISE 05</span></div></div>
    <div class="nav-title">Workspace</div>
    <nav class="nav">
        <a class="active" href="<?= site_url('/products') ?>"><b>▦</b><span>Products</span></a>
        <a href="<?= site_url('/products/create') ?>"><b>＋</b><span>Add Product</span></a>
    </nav>
    <div class="sidebar-bottom">
        <div class="user-mini"><div class="avatar"><?= strtoupper(substr($username,0,1)) ?></div><div><strong><?= htmlspecialchars($username) ?></strong><small>Administrator</small></div></div>
        <a class="nav a" href="<?= site_url('/logout') ?>" style="margin:0;display:flex;align-items:center;gap:12px;padding:12px;color:#ff9aaf;text-decoration:none;font-size:13px"><b>↪</b><span>Logout</span></a>
    </div>
</aside>
<main class="main">
    <header class="topbar">
        <div><p class="eyebrow">Dashboard</p><h1>Product Management</h1><p class="subtitle">Manage your inventory quickly and efficiently.</p></div>
        <div class="top-actions"><a class="btn btn-light" href="<?= site_url('/products') ?>">↻ Refresh</a><a class="btn btn-primary" href="<?= site_url('/products/create') ?>">＋ Add Product</a></div>
    </header>
    <section class="stats">
        <div class="stat"><div class="stat-head"><span>TOTAL PRODUCTS</span><div class="stat-icon">▦</div></div><strong><?= $totalProducts ?></strong></div>
        <div class="stat"><div class="stat-head"><span>TOTAL STOCK</span><div class="stat-icon">#</div></div><strong><?= $totalQuantity ?></strong></div>
        <div class="stat"><div class="stat-head"><span>LOW STOCK</span><div class="stat-icon">!</div></div><strong><?= $lowStock ?></strong></div>
    </section>
    <section class="panel">
        <div class="panel-head"><div><h2>All Products</h2><p>View, update, or remove products from your inventory.</p></div><input id="search" class="search" type="search" placeholder="Search products..." aria-label="Search products"></div>
        <div class="table-wrap"><table><thead><tr><th>ID</th><th>Product</th><th>Description</th><th>Price</th><th>Stock</th><th>Created</th><th>Actions</th></tr></thead><tbody id="productRows">
        <?php if (!empty($products)): foreach ($products as $product): $qty=(int)$product['quantity']; ?>
        <tr><td class="id">#<?= (int)$product['id'] ?></td><td class="product-name"><?= htmlspecialchars($product['product_name']) ?></td><td class="desc" title="<?= htmlspecialchars($product['description']) ?>"><?= htmlspecialchars($product['description'] ?: 'No description') ?></td><td class="price">₱<?= number_format((float)$product['price'],2) ?></td><td class="qty"><span class="badge <?= $qty<=5?'low':'' ?>"><?= $qty ?> <?= $qty<=5?'Low':'In stock' ?></span></td><td><?= htmlspecialchars($product['created_at']) ?></td><td><div class="actions"><a class="action edit" href="<?= site_url('/products/edit/'.(int)$product['id']) ?>">Edit</a><a class="action delete" href="<?= site_url('/products/delete/'.(int)$product['id']) ?>" onclick="return confirm('Delete this product?')">Delete</a></div></td></tr>
        <?php endforeach; else: ?><tr><td colspan="7" class="empty"><strong>No products yet</strong>Click “Add Product” to create your first inventory item.</td></tr><?php endif; ?>
        </tbody></table></div>
    </section>
    <div class="footer">LavaLust CRUD • Authenticated Product Management</div>
</main></div>
<script>
const search=document.getElementById('search');
if(search){search.addEventListener('input',()=>{const q=search.value.toLowerCase();document.querySelectorAll('#productRows tr').forEach(r=>{r.style.display=r.innerText.toLowerCase().includes(q)?'':'none';});});}
</script>
</body>
</html>
