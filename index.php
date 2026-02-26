<?php
include_once("includes/header.php");
?>
<?php
include_once("includes/nav_base.php");
?>

<div class="bgimg_1 parallax">

	<div class="caption_intro">
		<div class="row justify-content-center">
			<div class="col-11 col-sm-9  col-md-7 col-lg-6 border text-center">
                        <img src="img/ecjpfull.png" height="300" class="d-inline-block align-top" alt="">
                    <!--            <div class="col-8">
                                   <span class="capital">E</span><span>uropean</span><br><span class="capital">C</span><span>ommittee for</span><br><span class="capital">J</span><span>igsaw</span><br><span class="capital">P</span><span>uzzling</span>
                               </div>-->
                           </div>
                       </div>
                   </div>
               </div>
               <!--	   <div class="caption_intro">
                      <div class="row justify-content-center">
                          <div class="col-11 col-sm-9  col-md-7 col-lg-6 border text-start">
                              <img src="img/ecjpfull.png" height="200" class="d-inline-block align-top" alt="">
                          </div>
                      </div>
                  </div> -->
   </div>

   <div class="text-block">
     <h3 style="text-align:center;">What is ECJP</h3>
     <p>During the World Jigsaw Puzzle Championship 2025 in Valladolid, Spain, a new committee took shape. A European Committee to coordinate competitive puzzling in Europe and to connect, represent, and unite all the different associations.
   This independent committee is founded by association presidents in Europe, on their own initiative. This means that it is not connected to the World Jigsaw Puzzle Federation or Championship in any way. The committee recognizes maximum 1 not-for-profit Jigsaw Puzzle Association (JPA) per country. Member JPAs share and follow the objectives that are laid out by the ECJP. Members can use the network of the ECJP for best practices and to learn from other associations.</p><br><br><p>
           These are the key responsibilities of the ECJP:<br><br>
           - Coordinate the European Jigsaw Puzzle Championship (EJPC)<br>
           - Appoint the yearly rotating host country<br>
           - Unify the format and ruleset of the EJPC<br>
           - Oversee the finances of the EJPC<br>
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

    <div class="board-member-grid">
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
				'link' => 'https://www.speedpuzzling.be/',
				'association' => 'Speedpuzzling Belgium',
				'icon' => 'belgium.png'
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

        foreach ($countries as $country)
        {
            echo '<div class="member-tile member_tile_frame">';
            echo '<a href="' . $country['link'] . '" target="_blank">';
                echo '<div class="row member_frame">';
                    echo '<div class="col-12 member_frame_mage d-flex  align-items-center justify-content-center">';
                        echo '<img class="association_img" src="img/association/' . $country['icon'] . '">';
                        echo '</div>';
                    echo '<div class="col-12 member_frame_name d-flex justify-content-center">';
                        echo '<b>' . $country['association'] . '</b>';
                        echo '</div>';
                    echo '<div class="col-12 member_frame_name d-flex justify-content-center">';
                        echo '<img class="country_flag" src="img/flags/' . $country['shortcut'] . '.png"> <b>' . $country['name'] . '</b>';
                        echo '</div>';
                    echo '</div>';
                echo '</a>';
            echo '</div>';

        }
        ?>
    </div>

	<div class="row text-center mt-5">
		<p>If your European country is not represented here and you have a not-for-profit JPA, please contact us to become a member.</p>
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
            <p>The ECJP is managed by a board of 11 people who were elected in Valladolid by the representatives of each country present. Every year, at the open General Assembly (to be held at the yearly EJPC and to be attended by all member JPAs), board member elections will be held and the host for the next EJPC is revealed. Only half of the board member positions are open for election every year. The year between brackets next to a board member shows the end of their term.</p>
        </div>
    </div>

    <div class="board-member-grid">
        <?php
        $board_members = array(
            'BE' => array(
                'shortcut' => 'BE',
                'country' => 'Belgium',
                'name' => 'Andreas Heyerick',
                'title' => 'President',
                'year' => '2027',
                'img' => 'andreas_heyerick.png'
            ),
            'GB' => array(
                'shortcut' => 'GB',
                'country' => 'The United Kingdom',
                'name' => 'Anneka Thompson',
                'title' => 'Vice President',
                'year' => '2026',
                'img' => 'anneka_thompson.png'
            ),
            'CZ' => array(
                'shortcut' => 'CZ',
                'country' => 'Czech Republic',
                'name' => 'Klara Exnerová',
                'title' => '',
                'year' => '2026',
                'img' => 'klara_exnerova.png'
            ),
            'FI' => array(
                'shortcut' => 'FI',
                'country' => 'Finland',
                'name' => 'Jenni Puhto',
                'title' => '',
                'year' => '2026',
                'img' => 'jenni_puhto.png'
            ),
            'DE' => array(
                'shortcut' => 'DE',
                'country' => 'Germany',
                'name' => 'Michael Smit',
                'title' => '',
                'year' => '2027',
                'img' => 'michael_smit.png'
            ),
            'IT' => array(
                'shortcut' => 'IT',
                'country' => 'Italy',
                'name' => 'Pierminia Garau',
                'title' => '',
                'year' => '2027',
                'img' => 'pierminia_garau.png'
            ),
            'NL' => array(
                'shortcut' => 'NL',
                'country' => 'The Netherlands',
                'name' => 'Daniela Berendsen',
                'title' => '',
                'year' => '2026',
                'img' => 'daniela_berendsen.png'
            ),
            'PL' => array(
                'shortcut' => 'PL',
                'country' => 'Poland',
                'name' => 'Anna Dyl',
                'title' => '',
                'year' => '2027',
                'img' => 'anna_dyl.png'
            ),
            'PT' => array(
                'shortcut' => 'PT',
                'country' => 'Portugal',
                'name' => 'Dulce Pereira',
                'title' => '',
                'year' => '2027',
                'img' => 'dulce_perreira.png'
            ),
             'SE' => array(
                'shortcut' => 'SE',
                'country' => 'Sweden',
                'name' => 'David Engelhardt',
                'title' => '',
                'year' => '2026',
                'img' => 'david_engelhardt.png'
            ),
            'TR' => array(
                'shortcut' => 'TR',
                'country' => 'Türkiye',
                'name' => 'Pelin Çelik',
                'title' => '',
                'year' => '2027',
                'img' => 'pelin_celik.png'
            )
        );

        foreach ($board_members as $board_member)
        {
            echo '<div class="member-tile member_tile_frame">';
            echo '<div class="row member_frame">';
                echo '<div class="col-12 member_frame_mage d-flex  align-items-center justify-content-center">';
                    echo '<img class="association_img" src="img/board/' . $board_member['img'] .'">';
                    echo '</div>';
                echo '<div class="col-12 member_frame_name d-flex justify-content-center">';
                    echo '<b>' . $board_member['name'] . '</b>';
                    echo '</div>';
                echo '<div class="col-12 member_frame_name d-flex justify-content-center">';
                    echo '<b>' . $board_member['title'] . ' (' . $board_member['year'] . ')</b>';
                    echo '</div>';
                echo '<div class="col-12 member_frame_name d-flex justify-content-center">';
                    echo '<img class="country_flag" src="img/flags/' . $board_member['shortcut'] . '.png"> <b>' . $board_member['country'] . '</b>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        ?>

    </div>
</div>

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

<div class="bgimg_4 parallax" id="contact">
<div class="caption">
	<div class="row justify-content-center">
	<div class="col-11   col-md-8 col-lg-7 border text-start">
		<table>
		<tr><td><span class="capital">Contact us</span></td><td><a href="mailto:board@ecjp.eu"><img src="img/mail_blue.png" class="social_img"></img></a></td></tr>
		<tr><td><span class="capital">Follow us</span></td><td><a href="https://www.instagram.com/ecjp_ejpc/" target="_blank"><img src="img/instagram_blue.png" class="social_img"></img></a></td></tr>
		</table>

	</div>
	</div>
	</div>
</div>

<?php
include_once("includes/footer.php");
?>

