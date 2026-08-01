<?php
$today = (new DateTime('now', new DateTimeZone('Europe/Berlin')))->format('Y-m-d');
if ($today < '2026-08-01' || $today > '2026-08-31') {
    header('Location: index.php');
    exit;
}

include_once("includes/header.php");
include_once("includes/nav_base.php");
?>

<div class="bgimg_2 parallax">
    <div class="caption">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9  col-md-7 col-lg-5 border text-center">
                <span class="capital">Logo Competition</span>
            </div>
        </div>
    </div>
</div>

<div class="text-block" id="logo_competition">
    <h3 style="text-align:center;">IJPA Logo Design Competition</h3>

    <?php $logo_examples = glob("img/logo/*.{png,jpg,jpeg,gif,webp,svg}", GLOB_BRACE); ?>
    <?php if (count($logo_examples) > 0): ?>
        <style>
            .logo-example-tile {
                aspect-ratio: 1 / 1;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #fff;
                padding: 0.75rem;
            }
            .logo-example-tile img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }
            .logo-example-question {
                font-size: 5rem;
                font-weight: bold;
                line-height: 1;
            }
        </style>
        <div class="row justify-content-center align-items-center g-3 mb-4">
            <?php foreach ($logo_examples as $logo_example): ?>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="border logo-example-tile">
                        <img src="<?= htmlspecialchars($logo_example) ?>" alt="Logo example">
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="border logo-example-tile">
                    <span class="logo-example-question">?</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center mb-4">
            <div class="col-11 col-md-8 col-lg-6">
                <p class="mb-0"><em>What will the IJPA logo look like? That is up to you &ndash; we are looking for your design!</em></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-11 col-md-8 col-lg-6 text-start">
            <p>Hi Members,</p>
            <p>As you know, we are represented on the world stage by the International Jigsaw Puzzle Association (IJPA). As it is a brand new organisation and they do not currently have a logo, they thought it would be a fun idea for each member association to organise an informal &ldquo;IJPA LOGO DESIGN COMPETITION&rdquo;.</p>
            <p>You may also submit entries directly to IJPA via <a href="mailto:board@internationaljigsawpuzzle.org">board@internationaljigsawpuzzle.org</a> providing your name and contact email.</p>
            <p><strong>The closing date for entries is 31st August 2026.</strong></p>
            <p>Good luck and have fun!</p>
            <p>The IJPA Board.</p>
        </div>
    </div>
    <h3 style="text-align:center;">Intellectual Property</h3>
    <div class="row justify-content-center">
        <div class="col-11 col-md-8 col-lg-6 text-start">
            <p>By submitting an entry to this competition, each participant confirms that the submitted design is their original work and does not infringe the intellectual property or other rights of any third party.</p>
            <p>Participants retain ownership of their intellectual property unless and until their entry is selected as a winning entry. Upon notification that an entry has been selected as a winner, the participant irrevocably assigns to the Organiser, with full title guarantee, all worldwide intellectual property rights, including copyright and any associated design rights, in the winning design. The participant agrees to execute any additional documents reasonably required to give effect to this assignment.</p>
            <p>Participants whose entries are not selected as winners retain ownership of their intellectual property. However, by entering the competition, all participants grant the Organiser a non-exclusive, royalty-free licence to reproduce, display, and publish submitted entries solely for the purposes of administering, judging, promoting, and publicising the competition, unless otherwise agreed in writing.</p>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php") ?>
