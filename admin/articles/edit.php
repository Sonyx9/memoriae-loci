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

$file = $_GET['file'] ?? '';
$articlesDir = getArticlesDir();
$filepath = $articlesDir . $file;

if (empty($file) || !file_exists($filepath)) {
    header('Location: /admin/articles.php');
    exit;
}

// Get slug from filename
$currentSlug = str_replace('.md', '', $file);

$error = '';

// Load existing article
$content = file_get_contents($filepath);
$parts = explode('---', $content, 3);

$data = [
    'title' => '',
    'slug' => $currentSlug,
    'status' => 'draft',
    'publishedAt' => date('Y-m-d'),
    'excerpt' => '',
    'coverImage' => '',
    'project' => '',
    'tags' => '',
    'content' => '',
];

if (count($parts) >= 3) {
    $frontmatter = $parts[1];
    $data['content'] = trim($parts[2]);
    
    foreach (explode("\n", $frontmatter) as $line) {
        if (strpos($line, ':') !== false) {
            list($key, $value) = explode(':', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            if ($key === 'tags') {
                $tagsArray = array_map('trim', explode(',', trim($value, '[]"')));
                $data['tags'] = implode(', ', $tagsArray);
            } else {
                $value = trim($value, '"\'');
                $data[$key] = $value;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['title'] = $_POST['title'] ?? '';
    $data['slug'] = $_POST['slug'] ?? slugify($data['title']);
    $data['status'] = $_POST['status'] ?? 'draft';
    $data['publishedAt'] = $_POST['publishedAt'] ?? date('Y-m-d');
    $data['excerpt'] = $_POST['excerpt'] ?? '';
    $data['content'] = $_POST['content'] ?? '';
    $data['coverImage'] = $_POST['coverImage'] ?? '';
    $data['project'] = $_POST['project'] ?? '';
    $data['tags'] = $_POST['tags'] ?? '';
    
    if (empty($data['title']) || empty($data['slug'])) {
        $error = 'Název a slug jsou povinné';
    } else {
        $tagsArray = array_filter(array_map('trim', explode(',', $data['tags'])));
        $tagsStr = !empty($tagsArray) ? '["' . implode('", "', $tagsArray) . '"]' : '[]';
        
        $frontmatter = "---\n";
        $frontmatter .= "title: \"{$data['title']}\"\n";
        $frontmatter .= "status: {$data['status']}\n";
        $frontmatter .= "publishedAt: \"{$data['publishedAt']}\"\n";
        $frontmatter .= "excerpt: \"{$data['excerpt']}\"\n";
        if ($data['coverImage']) {
            $frontmatter .= "coverImage: \"{$data['coverImage']}\"\n";
        }
        if ($data['project']) {
            $frontmatter .= "project: \"{$data['project']}\"\n";
        }
        $frontmatter .= "tags: $tagsStr\n";
        $frontmatter .= "---\n\n";
        
        $fullContent = $frontmatter . $data['content'];
        
        // If slug changed, rename the file
        $newFilename = $data['slug'] . '.md';
        $newFilepath = $articlesDir . $newFilename;
        
        if ($newFilename !== $file) {
            // Rename file if slug changed
            if (file_exists($newFilepath)) {
                $error = 'Soubor s tímto slugem již existuje';
            } else {
                if (rename($filepath, $newFilepath)) {
                    $filepath = $newFilepath;
                }
            }
        }
        
        if (empty($error) && file_put_contents($filepath, $fullContent)) {
            header('Location: /admin/articles.php?success=updated');
            exit;
        } else if (empty($error)) {
            $error = 'Chyba při ukládání souboru';
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
    <title>Upravit článek - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Upravit článek</h1>
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
                    value="<?php echo htmlspecialchars($data['title']); ?>"
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
                    value="<?php echo htmlspecialchars($data['slug']); ?>"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium mb-2">Status</label>
                    <select 
                        id="status" 
                        name="status"
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    >
                        <option value="draft" <?php echo $data['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                        <option value="published" <?php echo $data['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                    </select>
                </div>
                
                <div>
                    <label for="publishedAt" class="block text-sm font-medium mb-2">Datum publikace</label>
                    <input 
                        type="date" 
                        id="publishedAt" 
                        name="publishedAt" 
                        value="<?php echo htmlspecialchars($data['publishedAt']); ?>"
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
                ><?php echo htmlspecialchars($data['excerpt']); ?></textarea>
            </div>
            
            <div>
                <label for="coverImage" class="block text-sm font-medium mb-2">Obrázek (URL)</label>
                <input 
                    type="text" 
                    id="coverImage" 
                    name="coverImage" 
                    value="<?php echo htmlspecialchars($data['coverImage']); ?>"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
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
                        <option value="<?php echo $proj; ?>" <?php echo $data['project'] === $proj ? 'selected' : ''; ?>>
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
                    value="<?php echo htmlspecialchars($data['tags']); ?>"
                    class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
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
                ><?php echo htmlspecialchars($data['content']); ?></textarea>
            </div>
            
            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-orange-500 text-slate-950 font-semibold rounded-lg hover:bg-orange-400 transition-colors"
                >
                    Uložit změny
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
</body>
</html>
