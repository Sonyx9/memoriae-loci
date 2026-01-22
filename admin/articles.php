<?php
require_once 'auth.php';

function getArticlesDir() {
    return __DIR__ . '/../src/content/articles/';
}

function getArticles() {
    $articlesDir = getArticlesDir();
    $articles = [];
    
    if (!is_dir($articlesDir)) {
        mkdir($articlesDir, 0755, true);
    }
    
    $files = glob($articlesDir . '*.md');
    
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $parts = explode('---', $content, 3);
        
        if (count($parts) >= 3) {
            $frontmatter = $parts[1];
            $body = trim($parts[2]);
            
            $data = [];
            foreach (explode("\n", $frontmatter) as $line) {
                if (strpos($line, ':') !== false) {
                    list($key, $value) = explode(':', $line, 2);
                    $key = trim($key);
                    $value = trim($value);
                    
                    if ($key === 'tags') {
                        $value = array_map('trim', explode(',', trim($value, '[]')));
                    } else {
                        $value = trim($value, '"\'');
                    }
                    
                    $data[$key] = $value;
                }
            }
            
            $filename = basename($file);
            $slug = str_replace('.md', '', $filename);
            $articles[] = [
                'file' => $filename,
                'slug' => $slug,
                'title' => $data['title'] ?? '',
                'status' => $data['status'] ?? 'draft',
                'publishedAt' => $data['publishedAt'] ?? '',
                'excerpt' => $data['excerpt'] ?? '',
            ];
        }
    }
    
    usort($articles, function($a, $b) {
        return strcmp($b['publishedAt'], $a['publishedAt']);
    });
    
    return $articles;
}

$articles = getArticles();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Články - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Články</h1>
            <div class="flex gap-4">
                <a href="/admin/articles/new.php" class="px-4 py-2 bg-orange-500 text-slate-950 font-semibold rounded-lg hover:bg-orange-400 transition-colors">
                    Nový článek
                </a>
                <a href="/" class="px-4 py-2 bg-slate-800 text-slate-50 rounded-lg hover:bg-slate-700 transition-colors">
                    Zpět na web
                </a>
            </div>
        </div>
        
        <div class="bg-slate-900 rounded-lg border border-slate-800 overflow-hidden">
            <table class="w-full">
                <thead class="bg-slate-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Název</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Slug</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Datum</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold">Akce</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    <?php if (empty($articles)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                                Žádné články. <a href="/admin/articles/new.php" class="text-orange-500 hover:text-orange-400">Vytvořit první článek</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($articles as $article): ?>
                            <tr class="hover:bg-slate-800/50">
                                <td class="px-6 py-4">
                                    <div class="font-medium"><?php echo htmlspecialchars($article['title']); ?></div>
                                    <?php if ($article['excerpt']): ?>
                                        <div class="text-sm text-slate-400 mt-1"><?php echo htmlspecialchars(substr($article['excerpt'], 0, 60)) . '...'; ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-slate-400 text-sm"><?php echo htmlspecialchars($article['slug']); ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs font-medium <?php echo $article['status'] === 'published' ? 'bg-green-900/50 text-green-300' : 'bg-yellow-900/50 text-yellow-300'; ?>">
                                        <?php echo htmlspecialchars($article['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-400 text-sm"><?php echo htmlspecialchars($article['publishedAt']); ?></td>
                                <td class="px-6 py-4 text-right">
                                    <a href="/admin/articles/edit.php?file=<?php echo urlencode($article['file']); ?>" class="text-orange-500 hover:text-orange-400">
                                        Upravit
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
