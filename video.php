<?php
require_once 'db.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get video ID from URL
$video_id = $_GET['video_id'] ?? null;
if (!$video_id || !preg_match('/^[a-zA-Z0-9_-]{11}$/', $video_id)) {
    die("Invalid video ID.");
}

// Update view count
$stmt = $conn->prepare("UPDATE videos SET views = views + 1 WHERE video_id = ?");
$stmt->bind_param("s", $video_id);
$stmt->execute();
$stmt->close();

// Fetch video details
$stmt = $conn->prepare("SELECT title, category, description, added_on, views, thumbnail, average_rating, total_votes FROM videos WHERE video_id = ?");
$stmt->bind_param("s", $video_id);
$stmt->execute();
$video = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$video) {
    die("Video not found.");
}

// Fetch categories with counts
$categories = [];
$query = "SELECT category, COUNT(*) as video_count FROM videos GROUP BY category";
$result = $conn->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categories[$row['category']] = $row['video_count'];
    }
}

// Fetch related videos
$stmt = $conn->prepare("SELECT video_id, title, thumbnail FROM videos WHERE category = ? AND video_id != ? ORDER BY RAND() LIMIT 4");
$stmt->bind_param("ss", $video['category'], $video_id);
$stmt->execute();
$related_videos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Add this after fetching video details
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_rating = 0;
$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


// Set page metadata
$pageTitle = htmlspecialchars($video['title']) . " | Funny Video Hub";
$pageDescription = htmlspecialchars($video['description'] ?? "Watch this funny video");

// Include header
require_once 'includes/header.php';
// Include navigation
require_once 'includes/nav.php';
?>

<main class="container mt-4">
    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <?php include 'includes/sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Video Player -->
                    <div class="ratio ratio-16x9 mb-4">
                        <iframe src="https://www.youtube.com/embed/<?= $video_id ?>"
                                allowfullscreen
                                class="rounded"
                                loading="lazy"></iframe>
                    </div>

                    <!-- Video Metadata -->
                    <h1 class="h3 mb-3"><?= htmlspecialchars($video['title']) ?></h1>


                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1">
                                <i class="bi bi-eye-fill text-primary"></i>
                                <?= number_format($video['views']) ?> views
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-clock-fill text-primary"></i>
                                <?= date("M j, Y", strtotime($video['added_on'])) ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1">
                                <i class="bi bi-tag-fill text-primary"></i>
                                <?= htmlspecialchars($video['category']) ?>
                            </p>
                        </div>
                    </div>
                    <div class="rating-section mb-4">
                        <div class="star-rating" id="starRating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio"
                                       id="star<?= $i ?>"
                                       name="rating"
                                       value="<?= $i ?>"
                                       style="display: none;"> <!-- Ensures it's hidden -->
                                <label for="star<?= $i ?>"
                                       class="star-label <?= $user_rating ? 'rated' : '' ?>"
                                       data-value="<?= $i ?>">
                                    <i class="bi bi-star-fill"></i>
                                </label>
                            <?php endfor; ?>
                            <div class="rating-text">
                                <span class="current-rating">
                                    <?= number_format($video['average_rating'], 1) ?>/5
                                    (<?= $video['total_votes'] ?> ratings)
                                </span>
                                <div id="ratingMessage" class="text-danger small mt-1"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <?php if (!empty($video['description'])): ?>
                        <div class="mb-4">
                            <h4 class="h5">Description</h4>
                            <p class="text-muted"><?= nl2br(htmlspecialchars($video['description'])) ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Floating Share Button -->
                <button class="btn btn-primary rounded-circle shadow"
                        onclick="openShareModal()"
                        style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                    <i class="bi bi-share-fill"></i>
                </button>
                <!-- Share Modal -->
                <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-4">
                            <h5 class="mb-3">Share this video</h5>
                            <div class="d-flex flex-wrap gap-3 justify-content-center">
                                <!-- Icons are just links -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url ?>" target="_blank"
                                   class="btn btn-outline-primary">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= $url ?>&text=<?= urlencode($video['title']) ?>"
                                   target="_blank" class="btn btn-outline-info">
                                    <i class="bi bi-twitter-x"></i> X
                                </a>
                                <a href="https://api.whatsapp.com/send?text=<?= urlencode($video['title'] . ' ' . $url) ?>"
                                   target="_blank" class="btn btn-outline-success">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                                <a href="https://www.reddit.com/submit?url=<?= $url ?>&title=<?= urlencode($video['title']) ?>"
                                   target="_blank" class="btn btn-outline-danger">
                                    <i class="bi bi-reddit"></i> Reddit
                                </a>
                                <button class="btn btn-outline-secondary" onclick="copyVideoLink()">
                                    <i class="bi bi-clipboard"></i> Copy Link
                                </button>
                            </div>
                            <div id="copyMsg" class="text-success mt-2 d-none">Link copied!</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</main>

<?php
// Set footer category before including footer
$selectedCategory = $video['category'];
// Include footer Suggested Videos and AD
require_once 'includes/footer.php'; ?>
