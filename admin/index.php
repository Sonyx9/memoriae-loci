<?php
session_start();

// Simple authentication - in production, use proper password hashing
$correct_password = 'admin123'; // Change this!

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === $correct_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/articles.php');
        exit;
    } else {
        $error = 'Nesprávné heslo';
    }
}

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    header('Location: /admin/articles.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Memoriae Loci</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-slate-900 p-8 rounded-lg border border-slate-800">
        <h1 class="text-2xl font-bold mb-6 text-center">Admin Login</h1>
        <?php if (isset($error)): ?>
            <div class="bg-red-900/50 border border-red-700 text-red-200 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Heslo</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
            </div>
            <button 
                type="submit" 
                class="w-full px-4 py-2 bg-orange-500 text-slate-950 font-semibold rounded-lg hover:bg-orange-400 transition-colors"
            >
                Přihlásit se
            </button>
        </form>
    </div>
</body>
</html>
