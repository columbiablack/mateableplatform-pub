<?php
require_once 'db.php';

// Enable error reporting (for debugging only - remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Pagination settings
$per_page = 9;  // videos per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $per_page;

// Get search query
$search_query = trim($_GET['q'] ?? '');

if (empty($search_query)) {
    die("No search term provided.");
}

// Get total videos count for this search
$count_stmt = $conn->prepare("SELECT COUNT(*) FROM videos WHERE title LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%')");
$count_stmt->bind_param("ss", $search_query, $search_query);
$count_stmt->execute();
$count_stmt->bind_result($total_videos);
$count_stmt->fetch();
$count_stmt->close();

// Fetch paginated videos
$stmt = $conn->prepare("SELECT video_id, title, thumbnail, description, views, added_on FROM videos WHERE title LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%') ORDER BY added_on DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ssii", $search_query, $search_query, $per_page, $offset);
$stmt->execute();
$results = $stmt->get_result();
$videos = $results->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch categories for sidebar and footer
$categories = [];
if (isset($conn) && $conn instanceof mysqli) {
    $result = $conn->query("SELECT category, COUNT(*) as count FROM videos GROUP BY category ORDER BY category ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categories[$row['category']] = $row['count'];
        }
        $result->free();
    }
}

// Page meta
$pageTitle = "Search results for \"$search_query\" | VidGiggles";
$pageDescription = "Search results on VidGiggles for '$search_query'";

// Header + nav
require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="container mt-4">
    <div class="row">
        <aside class="col-md-3">
            <?php include 'includes/sidebar.php'; ?>
        </aside>

        <section class="col-md-9">
            <h1 class="mb-3">Search Results for "<span class="text-primary"><?= htmlspecialchars($search_query) ?></span>"</h1>
            <p class="text-muted mb-4">
                <?= number_format($total_videos) ?> video<?= $total_videos !== 1 ? 's' : '' ?> found.
            </p>

            <?php if ($total_videos > 0): ?>
                <div class="row g-4">
                    <?php foreach ($videos as $video): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <a href="video.php?video_id=<?= htmlspecialchars($video['video_id']) ?>">
                                    <img src="<?= htmlspecialchars($video['thumbnail']) ?>" class="card-img-top" alt="<?= htmlspecialchars($video['title']) ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="video.php?video_id=<?= htmlspecialchars($video['video_id']) ?>" class="text-decoration-none text-dark">
                                            <?= htmlspecialchars($video['title']) ?>
                                        </a>
                                    </h5>
                                    <p class="card-text small text-muted"><?= date("M j, Y", strtotime($video['added_on'])) ?> &middot; <?= number_format($video['views']) ?> views</p>
                                    <p class="card-text text-truncate"><?= htmlspecialchars(mb_substr($video['description'], 0, 100)) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

<!-- Pagination -->
<?php
$total_pages = ceil($total_videos / $per_page);
if ($total_pages > 1): ?>
<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">

        <!-- Previous -->
        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?q=<?= urlencode($search_query) ?>&page=<?= max(1, $page - 1) ?>" aria-label="Previous">
                &laquo; Prev
            </a>
        </li>

        <?php
        $maxVisible = 5; // how many numbers to show around the current page
        $start = max(1, $page - floor($maxVisible / 2));
        $end = min($total_pages, $start + $maxVisible - 1);

        if ($start > 1) {
            echo '<li class="page-item"><a class="page-link" href="?q=' . urlencode($search_query) . '&page=1">1</a></li>';
            if ($start > 2) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        for ($i = $start; $i <= $end; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="?q=<?= urlencode($search_query) ?>&page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor;

        if ($end < $total_pages) {
            if ($end < $total_pages - 1) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            echo '<li class="page-item"><a class="page-link" href="?q=' . urlencode($search_query) . '&page=' . $total_pages . '">' . $total_pages . '</a></li>';
        }
        ?>

        <!-- Next -->
        <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
            <a class="page-link" href="?q=<?= urlencode($search_query) ?>&page=<?= min($total_pages, $page + 1) ?>" aria-label="Next">
                Next &raquo;
            </a>
        </li>
    </ul>
</nav>
<?php endif; ?>

            <?php else: ?>
                <div class="alert alert-warning">
                    No results found for "<strong><?= htmlspecialchars($search_query) ?></strong>".
                </div>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php 
// Footer (no specific category or video_id on search page)
$selectedCategory = 'funny fails';
$video_id = null;
require_once 'includes/footer.php'; 
?>
