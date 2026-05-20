<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");

$all_news = get_published_news(0);
?>

<div class="bgimg_2 parallax">
    <div class="caption">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9  col-md-7 col-lg-5 border text-center">
                <span class="capital">News</span>
            </div>
        </div>
    </div>
</div>

<div class="text-block">
    <?php if (count($all_news) === 0): ?>
        <p style="text-align:center;">No news available.</p>
    <?php else: ?>
        <?php foreach ($all_news as $item):
            $display_date = $item['news_date'] ? date('d.m.Y', strtotime($item['news_date'])) : date('d.m.Y', strtotime($item['created_at']));
        ?>
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['title']) ?></h5>
                            <p class="card-text text-muted" style="font-size:0.85em;"><?= $display_date ?></p>
                            <button class="btn btn-dark btn-sm news-read-more" data-id="<?= $item['id'] ?>">Read more</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="modal fade" id="newsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="newsModalTitle"></h5>
                    <small class="text-muted" id="newsModalDate"></small>
                </div>
                <button type="button" class="btn btn-dark ms-3" data-bs-dismiss="modal">X</button>
            </div>
            <div class="modal-body" id="newsModalContent"></div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php") ?>

<script>
var newsData = {
    <?php foreach ($all_news as $item):
        $d = $item['news_date'] ? date('d.m.Y', strtotime($item['news_date'])) : date('d.m.Y', strtotime($item['created_at']));
    ?>
    <?= $item['id'] ?>: {title: <?= json_encode($item['title']) ?>, date: <?= json_encode($d) ?>, content: <?= json_encode($item['content']) ?>},
    <?php endforeach; ?>
};
document.querySelectorAll('.news-read-more').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var d = newsData[this.dataset.id];
        document.getElementById('newsModalTitle').textContent = d.title;
        document.getElementById('newsModalDate').textContent = d.date;
        document.getElementById('newsModalContent').innerHTML = d.content;
        new bootstrap.Modal(document.getElementById('newsModal')).show();
    });
});
</script>
