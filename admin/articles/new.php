<?php
require_once 'auth.php';

function getArticlesDir() {
    return __DIR__ . '/../src/content/articles/';
}

function slugify($text) {
    $text = mb_strtolower($text, 'UTF-8');
    $text = str_replace(['á', 'č', 'ď', 'é', 'ě', 'í', 'ň', 'ó', 'ř', 'š', 'ť', 'ú', 'ů', 'ý', 'ž'], 
                       ['a', 'c', 'd', 'e', 'e', 'i', 'n', 'o', 'r', 's', 't', 'u', 'u', 'y', 'z'], $text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $slug = $_POST['slug'] ?? slugify($title);
    $status = $_POST['status'] ?? 'draft';
    $publishedAt = $_POST['publishedAt'] ?? date('Y-m-d');
    $excerpt = $_POST['excerpt'] ?? '';
    $content = $_POST['content'] ?? '';
    $coverImage = $_POST['coverImage'] ?? '';
    $project = $_POST['project'] ?? '';
    $tags = $_POST['tags'] ?? '';
    
    if (empty($title) || empty($slug)) {
        $error = 'Název a slug jsou povinné';
    } else {
        $articlesDir = getArticlesDir();
        if (!is_dir($articlesDir)) {
            mkdir($articlesDir, 0755, true);
        }
        
        $filename = $slug . '.md';
        $filepath = $articlesDir . $filename;
        
        if (file_exists($filepath)) {
            $error = 'Článek s tímto slugem již existuje';
        } else {
            $tagsArray = array_filter(array_map('trim', explode(',', $tags)));
            $tagsStr = !empty($tagsArray) ? '["' . implode('", "', $tagsArray) . '"]' : '[]';
            
            $frontmatter = "---\n";
            $frontmatter .= "title: \"$title\"\n";
            $frontmatter .= "status: $status\n";
            $frontmatter .= "publishedAt: \"$publishedAt\"\n";
            $frontmatter .= "excerpt: \"$excerpt\"\n";
            if ($coverImage) {
                $frontmatter .= "coverImage: \"$coverImage\"\n";
            }
            if ($project) {
                $frontmatter .= "project: \"$project\"\n";
            }
            $frontmatter .= "tags: $tagsStr\n";
            $frontmatter .= "---\n\n";
            
            $fullContent = $frontmatter . $content;
            
            if (file_put_contents($filepath, $fullContent)) {
                header('Location: /admin/articles.php?success=created');
                exit;
            } else {
                $error = 'Chyba při ukládání souboru';
            }
        }
    }
}

$projects = ['zapomenuta-mista', 'pribehy-mest', 'zapomenuta-mista-liberec'];
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nový článek - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Nový článek</h1>
            <a href="/admin/articles.php" class="px-4 py-2 bg-slate-800 text-slate-50 rounded-lg hover:bg-slate-700 transition-colors">
                Zpět
            </a>
        </div>
        
        <?php if ($error): ?>
            <div class="bg-red-900/50 border border-red-700 text-red-200 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" class="bg-slate-900 rounded-lg border border-slate-800 p-6 space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium mb-2">Název *</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    required
                    value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
            </div>
            
            <div>
                <label for="slug" class="block text-sm font-medium mb-2">Slug *</label>
                <input 
                    type="text" 
                    id="slug" 
                    name="slug" 
                    required
                    value="<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
                <p class="text-xs text-slate-400 mt-1">URL-friendly identifikátor (např. muj-clanek)</p>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium mb-2">Status</label>
                    <select 
                        id="status" 
                        name="status"
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    >
                        <option value="draft" <?php echo ($_POST['status'] ?? 'draft') === 'draft' ? 'selected' : ''; ?>>Draft</option>
                        <option value="published" <?php echo ($_POST['status'] ?? '') === 'published' ? 'selected' : ''; ?>>Published</option>
                    </select>
                </div>
                
                <div>
                    <label for="publishedAt" class="block text-sm font-medium mb-2">Datum publikace</label>
                    <input 
                        type="date" 
                        id="publishedAt" 
                        name="publishedAt" 
                        value="<?php echo htmlspecialchars($_POST['publishedAt'] ?? date('Y-m-d')); ?>"
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    />
                </div>
            </div>
            
            <div>
                <label for="excerpt" class="block text-sm font-medium mb-2">Perex</label>
                <textarea 
                    id="excerpt" 
                    name="excerpt" 
                    rows="3"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                ><?php echo htmlspecialchars($_POST['excerpt'] ?? ''); ?></textarea>
            </div>
            
            <div>
                <label for="coverImage" class="block text-sm font-medium mb-2">Obrázek (URL)</label>
                <input 
                    type="text" 
                    id="coverImage" 
                    name="coverImage" 
                    value="<?php echo htmlspecialchars($_POST['coverImage'] ?? ''); ?>"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    placeholder="/images/articles/example.jpg"
                />
            </div>
            
            <div>
                <label for="project" class="block text-sm font-medium mb-2">Projekt</label>
                <select 
                    id="project" 
                    name="project"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                >
                    <option value="">Žádný</option>
                    <?php foreach ($projects as $proj): ?>
                        <option value="<?php echo $proj; ?>" <?php echo ($_POST['project'] ?? '') === $proj ? 'selected' : ''; ?>>
                            <?php echo ucfirst(str_replace('-', ' ', $proj)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div>
                <label for="tags" class="block text-sm font-medium mb-2">Tagy (oddělené čárkou)</label>
                <input 
                    type="text" 
                    id="tags" 
                    name="tags" 
                    value="<?php echo htmlspecialchars($_POST['tags'] ?? ''); ?>"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    placeholder="historie, památky, dokumentace"
                />
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium mb-2">Obsah (Markdown) *</label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="15"
                    required
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500 font-mono text-sm"
                ><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>
                <p class="text-xs text-slate-400 mt-1">Použijte Markdown syntaxi</p>
            </div>
            
            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-orange-500 text-slate-950 font-semibold rounded-lg hover:bg-orange-400 transition-colors"
                >
                    Vytvořit článek
                </button>
                <a 
                    href="/admin/articles.php" 
                    class="px-6 py-2 bg-slate-800 text-slate-50 rounded-lg hover:bg-slate-700 transition-colors"
                >
                    Zrušit
                </a>
            </div>
        </form>
    </div>
    
    <script>
        document.getElementById('title').addEventListener('input', function() {
            const slug = document.getElementById('slug');
            if (!slug.value || slug.value === '<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>') {
                slug.value = this.value.toLowerCase()
                    .replace(/á/g, 'a').replace(/č/g, 'c').replace(/ď/g, 'd')
                    .replace(/é/g, 'e').replace(/ě/g, 'e').replace(/í/g, 'i')
                    .replace(/ň/g, 'n').replace(/ó/g, 'o').replace(/ř/g, 'r')
                    .replace(/š/g, 's').replace(/ť/g, 't').replace(/ú/g, 'u')
                    .replace(/ů/g, 'u').replace(/ý/g, 'y').replace(/ž/g, 'z')
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        });
    </script>
</body>
</html>
