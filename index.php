<?php
include_once("includes/header.php");
?>
<?php
include_once("includes/nav_base.php");
?>

<div class="bgimg_1 parallax">

	<div class="caption_intro">
		<div class="row justify-content-center">
			<div class="col-11  col-md-9 col-lg-7 border text-center">
                        <img src="img/logo_wjpf.png" width="100%" class="d-inline-block align-top" alt="">
            </div>
        </div>
    </div>
</div>

   <div class="text-block">
     <h3 style="text-align:center;">What is WJPF</h3>
     <p>The World Jigsaw Puzzle Federation was founded in 2025 from puzzle enthusiasts from all over the world. A Federation to coordinate competitive puzzling and to connect, represent, and unite all the different associations.
   The committee recognizes maximum 1 not-for-profit Jigsaw Puzzle Association (JPA) per country. Member JPAs share and follow the objectives that are laid out by the WJPF. Members can use the network of the WJPF for best practices and to learn from other associations.</p><p>
           These are the key responsibilities of the WJPF:<br><br>
           - Coordinate the World Jigsaw Puzzle Championship (WJPC)<br>
           - Appoint the yearly rotating host country<br>
           - Unify the format and ruleset of the WJPC<br>
           - Oversee the finances of the WJPC<br>
           - Assist in establishing new Jigsaw Puzzle Associations
       </p>
   </div>

   <!-- <div class="bgimg_2 parallax">
   </div>

   <div style="position:relative;">
     <div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify;">
     <p>Scroll up and down to really get the feeling of how Parallax Scrolling works.</p>
     </div>
   </div> -->

<div class="bgimg_3 parallax">
	<div class="caption">
		<div class="row justify-content-center">
			<div class="col-11 col-sm-9  col-md-7 col-lg-5 border text-start">
				<span class="capital">Members</span>
			</div>
		</div>
	</div>
</div>
<div class="text-block" id="members">

    <div class="board-user-grid">
        <?php
	$countries = array(
		'AT' => array(
				'shortcut' => 'AT',
				'name' => 'Austria',
				'link' => 'https://puzzleverein.at/',
				'association' => 'Puzzleverein Österreich',
				'icon' => 'austria.png'
			),
        'BE' => array(
            'shortcut' => 'BE',
            'name' => 'Belgium',
            'link' => 'https://www.facebook.com/PuzzlesBulgaria/',
            'link' => 'https://www.speedpuzzling.be/',
            'association' => 'Speedpuzzling Belgium',
            'icon' => 'belgium.png'
        ),
        'BG' => array(
            'shortcut' => 'BG',
            'name' => 'Bulgaria',
            'link' => 'https://www.facebook.com/PuzzlesBulgaria/',
            'association' => 'Puzzles Bulgaria',
            'icon' => 'bulgaria.png'
        ),
		'CZ' => array(
				'shortcut' => 'CZ',
				'name' => 'Czech Republic',
				'link' => 'https://czjpa.cz/',
				'association' => 'Czech Jigsaw Puzzle Association',
				'icon' => 'czechrepublic.png'
			),
        'DK' => array(
            'shortcut' => 'DK',
            'name' => 'Denmark',
            'link' => 'https://danskpuslespilsforening.dk/',
            'association' => 'Danish Jigsaw Puzzle Association',
            'icon' => 'denmark.png'
        ),
		'DE' => array(
				'shortcut' => 'DE',
				'name' => 'Germany',
				'link' => 'https://puzzleverein.de/',
				'association' => 'Puzzleverein Deutschland e.V.',
				'icon' => 'germany.png'
			),
        'FI' => array(
            'shortcut' => 'FI',
            'name' => 'Finland',
            'link' => 'https://palapeliurheiluliitto.fi/fi',
            'association' => 'Suomen palapeliurheiluliitto',
            'icon' => 'finland.png'
        ),
        'FR' => array(
            'shortcut' => 'FR',
            'name' => 'France',
            'link' => 'https://www.instagram.com/assofrancaisedespuzzleurs/',
            'association' => 'Association Française des Puzzleurs',
            'icon' => 'france.jpg'
        ),
        'GR' => array(
            'shortcut' => 'GR',
            'name' => 'Greece',
            'link' => 'https://www.facebook.com/groups/277251826757297/',
            'association' => 'Ελληνικός Όμιλος Πάζλ',
            'icon' => 'greece.png'
        ),
        'HU' => array(
            'shortcut' => 'HU',
            'name' => 'Hungary',
            'link' => 'https://www.mopepuzzle.hu/',
            'association' => 'Hungarian Jigsaw Puzzle Association',
            'icon' => 'hungary.png'
        ),



/*
        'IE' => array(
            'shortcut' => 'IE',
            'name' => 'Ireland',
            'link' => 'https://www.facebook.com/groups/565221655857149',
            'association' => 'Irish Jigsaw Puzzle Association',
            'icon' => 'ireland.png'
        ),*/
        'IT' => array(
            'shortcut' => 'IT',
            'name' => 'Italy',
            'link' => 'https://www.associazioneitalianapuzzle.it',
            'association' => 'Associazione Italiana Puzzle',
            'icon' => 'italy.png'
        ),
        'LV' => array(
            'shortcut' => 'LV',
            'name' => 'Latvia',
            'link' => 'https://latviapuzzle.lv/',
            'association' => 'Latvijas Pužļu Federācija',
            'icon' => 'latvia.png'
        ),
		'NL' => array(
				'shortcut' => 'NL',
				'name' => 'The Netherlands',
				'link' => 'https://speedpuzzling.nl/en/',
				'association' => 'Speedpuzzling  The Netherlands',
				'icon' => 'netherlands.png'
			),
        'NO' => array(
            'shortcut' => 'NO',
            'name' => 'Norway',
            'link' => 'https://www.norgespuslespillforbund.no/',
            'association' => 'Norges Puslespillforbund',
            'icon' => 'norway.png'
        ),
		'PL' => array(
				'shortcut' => 'PL',
				'name' => 'Poland',
				'link' => 'https://www.facebook.com/PolskieStowarzyszeniePuzzlowe/',
				'association' => 'Polskie Stowarzyszenie Puzzlowe',
				'icon' => 'poland.png'
			),
        'PT' => array(
            'shortcut' => 'PT',
            'name' => 'Portugal',
            'link' => 'https://appz.pt/',
            'association' => 'Associação Portuguesa de Puzzle',
            'icon' => 'portugal.png'
        ),
/*        'RS' => array(
            'shortcut' => 'RS',
            'name' => 'Serbia',
            'link' => 'https://www.facebook.com/people/Puzlijada/61570207834685/?_rdr',
            'association' => 'Puzlijada Srbija',
            'icon' => 'serbia.png'
        ),*/
        'SI' => array(
            'shortcut' => 'SI',
            'name' => 'Slovenia',
            'link' => 'https://drustvosestavljank.si/',
            'association' => 'Slovensko društvo ljubiteljev sestavljank',
            'icon' => 'slovenia.png'
        ),
        'ES' => array(
            'shortcut' => 'ES',
            'name' => 'Spain',
            'link' => 'https://aepuzz.es',
            'association' => 'Asociación Española de Puzzles',
            'icon' => 'spain.png'
        ),
        'SE' => array(
            'shortcut' => 'SE',
            'name' => 'Sweden',
            'link' => 'https://www.svenskapusselforbundet.se/',
            'association' => 'Svenska Pusselförbundet',
            'icon' => 'sweden.png'
        ),
        'CH' => array(
            'shortcut' => 'CH',
            'name' => 'Switzerland',
            'link' => 'https://www.schweizerpuzzlemeisterschaft.ch/',
            'association' => 'Schweizer Puzzle Meisterschaft',
            'icon' => 'switzerland.png'
        ),
        'TR' => array(
            'shortcut' => 'TR',
            'name' => 'Türkiye',
            'link' => 'https://puzzledernegi.com/',
            'association' => 'Puzzle Derneği',
            'icon' => 'tuerkiye.png'
        ),
        'GB' => array(
            'shortcut' => 'GB',
            'name' => 'The United Kingdom',
            'link' => 'https://ukjpa.org/',
            'association' => 'UK Jigsaw Puzzle Association',
            'icon' => 'uk.png'
        )
	);


            display_federation_associations();
        ?>
    </div>

	<div class="row text-center mt-5">
		<p>If your country is not represented here and you have a not-for-profit JPA, please contact us to become a member.</p>
	</div>
</div>

<div class="bgimg_2 parallax">
    <div class="caption">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9  col-md-7 col-lg-5 border text-start">
                <span class="capital">Board</span>
            </div>
        </div>
    </div>
</div>
<div class="text-block"  id="board">
    <div class="row justify-content-center text-center">
        <div class="col-11 col-sm-9  col-md-7">
            <p>The WJPF is managed by a board of 9 people who were elected at the General Assembly by the representatives of each member association. You can contact each member of the board directly or via the central E-Mail <a href="mailto:board@wjpf.org">board@wjpf.org</img></a></p>
        </div>
    </div>

    <div class="board-user-grid">
        <?php
            display_board_users();
        ?>

    </div>
</div>

<!--
<div class="bgimg_5 parallax">
    <div class="caption" id="publications">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9  col-md-7 col-lg-6 border text-start">
                <span class="capital">Publications</span>
            </div>
        </div>
    </div>
</div>
<div class="text-block"  >
    <div class="row justify-content-center text-center mt-3 mb-3">
        <div class="col-11 col-sm-9  col-md-7">
            <p>Here you can find all publications of the ECJP.</p>
        </div>
        <div class="col-11 col-sm-9  col-md-7 mt-3">
            <table class="document_table ">
                <tbody>
                <tr><td>2025/10/4</td><td><a href="documents/COMMUNICATION - Launch of a new independent European Committee.pdf" target="_blank">Launch of a new independent European Committee.pdf</a></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="bgimg_6 parallax">
    <div class="caption" id="events">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9  col-md-7 col-lg-6 border text-start">
                <span class="capital">Events</span>
            </div>
        </div>
    </div>
</div>
<div class="text-block" >
    <div class="row justify-content-center text-center mt-3 mb-3">
        <a href="https://puzzledernegi.com/" target="_blank">
        <div class="user-tile user_tile_frame">
            <div class="row user_frame">
                <div class="col-12 col-md-4 user_frame_image d-flex  align-items-center justify-content-center">
                    <img class="event_img" src="img/event/puzzle_dernegi.png">
                </div>
            <div class="col-12 col-md-8 user_frame_name d-flex justify-content-center">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <span class="capital capital_dark">European Jigsaw Puzzle Championships 2026</span>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <span class="dark_date">27–29.11.2026 – İstanbul, Türkiye</span>
                    </div>
                </div>
            </div>
        </div>
        </a>
        </div>
    </div>
</div>-->

<div class="bgimg_4 parallax" id="contact">
<div class="caption">
	<div class="row justify-content-center">
	<div class="col-11   col-md-8 col-lg-7 border text-start">
		<table>
		<tr><td><span class="capital">Contact us</span></td><td><a href="mailto:board@wjpf.org"><img src="img/mail_blue.png" class="social_img"></img></a></td></tr>
<!--		<tr><td><span class="capital">Follow us</span></td><td><a href="https://www.instagram.com/ecjp_ejpc/" target="_blank"><img src="img/instagram_blue.png" class="social_img"></img></a></td></tr> -->
		</table>

	</div>
	</div>
	</div>
</div>

<?php
include_once("includes/footer.php");
?>

