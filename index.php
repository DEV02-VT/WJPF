<?php
include_once("includes/header.php");
?>
<?php
include_once("includes/nav_base.php");
?>

<?php
$logo_competition_today = (new DateTime('now', new DateTimeZone('Europe/Berlin')))->format('Y-m-d');
if ($logo_competition_today >= '2026-08-01' && $logo_competition_today <= '2026-08-31'):
?>
    <?php $logo_examples = glob("img/logo/*.{png,jpg,jpeg,gif,webp,svg}", GLOB_BRACE); ?>
    <div class="row justify-content-center m-0">
        <div class="col-11 col-md-9 col-lg-7 text-center mt-3 mb-3">
            <div class="alert alert-dark border mb-0">
                <?php if (count($logo_examples) > 0): ?>
                    <style>
                        .logo-banner-tile {
                            width: 3.5rem;
                            height: 3.5rem;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            background: #fff;
                            padding: 0.25rem;
                        }
                        .logo-banner-tile img {
                            max-width: 100%;
                            max-height: 100%;
                            object-fit: contain;
                        }
                        .logo-banner-question {
                            font-size: 1.75rem;
                            font-weight: bold;
                            line-height: 1;
                        }
                    </style>
                    <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap mb-2">
                        <?php foreach ($logo_examples as $logo_example): ?>
                            <div class="border logo-banner-tile">
                                <img src="<?= htmlspecialchars($logo_example) ?>" alt="Logo example">
                            </div>
                        <?php endforeach; ?>
                        <div class="border logo-banner-tile">
                            <span class="logo-banner-question">?</span>
                        </div>
                    </div>
                <?php endif; ?>
                <strong>IJPA Logo Design Competition</strong> &ndash; submit your design by 31st August 2026!
                <a href="logo_competition.php" class="btn btn-dark btn-sm ms-2">Learn more</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="bgimg_1 parallax">

	<div class="caption_intro">
		<div class="row justify-content-center">
			<div class="col-11  col-md-9 col-lg-7 border text-center">
                <h2>International Jigsaw Puzzle Association (IJPA)</h2>
<!--   <img src="img/logo_ijpa.png" width="100%" class="d-inline-block align-top" alt=""> -->
            </div>
        </div>
    </div>
</div>




   <div class="text-block">
     <h3 style="text-align:center;">What is IJPA</h3>
     <p>The International Jigsaw Puzzle Association was founded in 2026 from puzzle enthusiasts from all over the world. A Association to coordinate competitive puzzling and to connect, represent, and unite all the different associations.
   The committee recognizes maximum 1 not-for-profit Jigsaw Puzzle Association (JPA) per country. Member JPAs share and follow the objectives that are laid out by the IJPA. Members can use the network of the IJPA for best practices and to learn from other associations.</p><p>

           The Federation's main objectives will be:<br>
           <div class="row justify-content-center">
               <div class="col-12 col-md-8 col-lg-6 text-start">
                   a) Sharing knowledge and best practice about speedpuzzling<br>
                   b) Developing, maintaining, and updating rules and standards for
                   international speed puzzling competitions.<br>
                   c) Supporting and overseeing the flagship World Jigsaw Puzzle Competition
                   and ensuring it meets standards of fairness, accessibility, and quality<br>
                   d) Encouraging collaboration and exchange among member associations.<br>
                   e) Coordinating and endorsing the International Competition Calendar.<br>
                   f) Guaranteeing common standards of ethics, inclusion, accessibility, and
                   diversity.<br>
                   g) Promoting training programs for judges, organizers, and competitors.
               </div>
           </div>
       </p>
   </div>

<div class="bgimg_2 parallax">

    <div class="caption_intro">
        <div class="row justify-content-center">
            <div class="col-11  col-md-9 col-lg-7 border text-center">
                <h2>News</h2>
                <!--   <img src="img/logo_ijpa.png" width="100%" class="d-inline-block align-top" alt=""> -->
            </div>
        </div>
    </div>
</div>

<?php
$latest_news = get_published_news(5);
if (count($latest_news) > 0):
?>
    <div class="text-block">
        <?php foreach ($latest_news as $item):
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
        <div class="row justify-content-center mt-2 mb-2">
            <div class="col-12 col-md-8 col-lg-6 text-center">
                <a href="news.php" class="btn btn-dark">All News</a>
            </div>
        </div>
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

    <script>
    var newsData = {
        <?php foreach ($latest_news as $item):
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
<?php endif; ?>

<?php
include_once("includes/footer.php");
?>

