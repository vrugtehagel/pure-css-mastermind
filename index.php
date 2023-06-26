<!DOCTYPE html>
<html lang=en>
<meta charset=utf-8>
<meta name=viewport content="width=device-width,initial-scale=1.0">

<title>Mastermind</title>

<link rel=icon href=./favicon.svg>
<link rel=mask-icon href=./mask-icon.svg color=#a0522d>
<link rel=apple-touch-icon href=./touch-icon.png>
<link rel=stylesheet href=https://fonts.googleapis.com/css2?family=Belanosima&display=swap>
<link rel=stylesheet href=./styles.css>
<link rel=stylesheet href=./logic.css>
<link rel=stylesheet href=./theme.css>

<style>
	<?php
		$pegs = 6;
		$holes = 4;
		$options = range(0, $pegs - 1);
		$solution = [];
		while($holes--){
			$index = random_int(0, count($options) - 1);
			[$color] = array_splice($options, $index, 1);
			array_push($solution, $color);
		}

		echo ":root {";
		foreach($solution as $index => $color) echo "--s$index: $color;";
		echo "}";
	?>
</style>


<main>
	<?php
		$theme = $_GET["theme"] ?? "";
		$theme_dark = $theme == "dark" ? "checked" : "";
		$theme_light = $theme == "light" ? "checked" : "";
		$theme_unknown = (!$theme_dark && !$theme_light) ? "checked" : "";
	?>
	<input id=unknown-theme type=radio name=theme <?= $theme_unknown ?>>
	<input id=light-theme type=radio name=theme <?= $theme_light ?>>
	<input id=dark-theme type=radio name=theme <?= $theme_dark ?>>
	<label class=icon for=light-theme></label>
	<label class=icon for=dark-theme></label>

	<div id=play-field>
		<div id=background></div>

		<a id=vrugtehagel href="https://vrugtehagel.nl">
			<svg viewBox="0 0 48 48">
				<title>vrugtehagel</title>
				<path d="M2 23C4 20 9 20 10 31S18 36 19 32S23 16 32 11C27 6 20 8 15 26C13 9 -2 12 2 23M27 38C30 22 41 8 46 14S38 21 27 38M26 28C23 21 28 18 30 20S28 23 26 28" fill="currentColor"></path>
			</svg>
		</a>

		<input id=about type=checkbox autocomplete=off>
		<label for=about></label>
		<label for=about class=icon></label>
		<div id=about-dialog class=dialog>
			<h2>About</h2>
			<p>This version of Mastermind uses no JavaScript! Basically, I just wanted to show off what styling can do.</p>
			<p>It uses inputs, labels, :checked and --variables for its logic. A few lines of PHP create a unique solution (in CSS) on page load.</p>
			<p>Enjoy!</p>
		</div>

		<h1>Mastermind</h1>

		<!-- Ids are a bit unreadable for uniqueness' sake, -->
		<!-- but it's quite simple, really -->
		<!-- p means "peg", the colored thingies -->
		<!-- h means "hole", it's where the pegs go -->
		<!-- g means "guess", group of 4 holes -->
		<!-- the numbers are just indexes -->
		<input id=how-to-play type=checkbox autocomplete=off>
		<label for=how-to-play></label>
		<div id=how-to-play-dialog class=dialog>
			<h2>How to play</h2>

			<p>Guess the code!</p>
			<p>Each guess is scored with a <span class=black-mark></span> for each color you got exactly right, and a <span class=white-mark></span> for every correct, but misplaced, color.</p>
			<label for=how-to-play class=button>Continue</label>
		</div>

		<div id=guesses>
			<div id=guesses-scroll-container>
				<input class=guess-done id=g0 type=checkbox autocomplete=off>
				<section class=guess>
					<div class=hole class=first-hole>
						<input id=g0h0x class=peg-picker-state type=radio name=g0h0p autocomplete=off>
						<label for=g0h0x></label>
						<input id=g0h0p_ class=no-peg type=radio name=g0h0p autocomplete=off checked>
						<label for=g0h0p_></label>
						<input id=g0h0p0 class=peg-0 type=radio name=g0h0p autocomplete=off>
						<label for=g0h0p0></label>
						<input id=g0h0p1 class=peg-1 type=radio name=g0h0p autocomplete=off>
						<label for=g0h0p1></label>
						<input id=g0h0p2 class=peg-2 type=radio name=g0h0p autocomplete=off>
						<label for=g0h0p2></label>
						<input id=g0h0p3 class=peg-3 type=radio name=g0h0p autocomplete=off>
						<label for=g0h0p3></label>
						<input id=g0h0p4 class=peg-4 type=radio name=g0h0p autocomplete=off>
						<label for=g0h0p4></label>
						<input id=g0h0p5 class=peg-5 type=radio name=g0h0p autocomplete=off>
						<label for=g0h0p5></label>
						<div class=peg></div>
						<div class=peg-picker></div>

						<div class=hole>
							<input id=g0h1x class=peg-picker-state type=radio name=g0h1p autocomplete=off>
							<label for=g0h1x></label>
							<input id=g0h1p_ class=no-peg type=radio name=g0h1p autocomplete=off checked>
							<label for=g0h1p_></label>
							<input id=g0h1p0 class=peg-0 type=radio name=g0h1p autocomplete=off>
							<label for=g0h1p0></label>
							<input id=g0h1p1 class=peg-1 type=radio name=g0h1p autocomplete=off>
							<label for=g0h1p1></label>
							<input id=g0h1p2 class=peg-2 type=radio name=g0h1p autocomplete=off>
							<label for=g0h1p2></label>
							<input id=g0h1p3 class=peg-3 type=radio name=g0h1p autocomplete=off>
							<label for=g0h1p3></label>
							<input id=g0h1p4 class=peg-4 type=radio name=g0h1p autocomplete=off>
							<label for=g0h1p4></label>
							<input id=g0h1p5 class=peg-5 type=radio name=g0h1p autocomplete=off>
							<label for=g0h1p5></label>
							<div class=peg></div>
							<div class=peg-picker></div>

							<div class=hole>
								<input id=g0h2x class=peg-picker-state type=radio name=g0h2p autocomplete=off>
								<label for=g0h2x></label>
								<input id=g0h2p_ class=no-peg type=radio name=g0h2p autocomplete=off checked>
								<label for=g0h2p_></label>
								<input id=g0h2p0 class=peg-0 type=radio name=g0h2p autocomplete=off>
								<label for=g0h2p0></label>
								<input id=g0h2p1 class=peg-1 type=radio name=g0h2p autocomplete=off>
								<label for=g0h2p1></label>
								<input id=g0h2p2 class=peg-2 type=radio name=g0h2p autocomplete=off>
								<label for=g0h2p2></label>
								<input id=g0h2p3 class=peg-3 type=radio name=g0h2p autocomplete=off>
								<label for=g0h2p3></label>
								<input id=g0h2p4 class=peg-4 type=radio name=g0h2p autocomplete=off>
								<label for=g0h2p4></label>
								<input id=g0h2p5 class=peg-5 type=radio name=g0h2p autocomplete=off>
								<label for=g0h2p5></label>
								<div class=peg></div>
								<div class=peg-picker></div>

								<div class=hole>
									<input id=g0h3x class=peg-picker-state type=radio name=g0h3p autocomplete=off>
									<label for=g0h3x></label>
									<input id=g0h3p_ class=no-peg type=radio name=g0h3p autocomplete=off checked>
									<label for=g0h3p_></label>
									<input id=g0h3p0 class=peg-0 type=radio name=g0h3p autocomplete=off>
									<label for=g0h3p0></label>
									<input id=g0h3p1 class=peg-1 type=radio name=g0h3p autocomplete=off>
									<label for=g0h3p1></label>
									<input id=g0h3p2 class=peg-2 type=radio name=g0h3p autocomplete=off>
									<label for=g0h3p2></label>
									<input id=g0h3p3 class=peg-3 type=radio name=g0h3p autocomplete=off>
									<label for=g0h3p3></label>
									<input id=g0h3p4 class=peg-4 type=radio name=g0h3p autocomplete=off>
									<label for=g0h3p4></label>
									<input id=g0h3p5 class=peg-5 type=radio name=g0h3p autocomplete=off>
									<label for=g0h3p5></label>
									<div class=peg></div>
									<div class=peg-picker></div>

									<div class=ui>
										<label class="submit icon" for=g0></label>

										<ul class=score>
											<li class=score-peg-0></li>
											<li class=score-peg-1></li>
											<li class=score-peg-2></li>
											<li class=score-peg-3></li>
										</ul>

										<div class="dialog-backdrop win"></div>
										<div class="dialog win">
											<h2>Holy mackerel!</h2>
											<p>You beat the game in ONE move!</p>
											<p>You aren't cheating, are you?</p>
											<a href=./?theme=dark class=button>Play again</a>
											<a href=./?theme=light class=button>Play again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>


				<input class=guess-done id=g1 type=checkbox autocomplete=off>
				<section class=guess>
					<div class=hole class=first-hole>
						<input id=g1h0x class=peg-picker-state type=radio name=g1h0p autocomplete=off>
						<label for=g1h0x></label>
						<input id=g1h0p_ class=no-peg type=radio name=g1h0p autocomplete=off checked>
						<label for=g1h0p_></label>
						<input id=g1h0p0 class=peg-0 type=radio name=g1h0p autocomplete=off>
						<label for=g1h0p0></label>
						<input id=g1h0p1 class=peg-1 type=radio name=g1h0p autocomplete=off>
						<label for=g1h0p1></label>
						<input id=g1h0p2 class=peg-2 type=radio name=g1h0p autocomplete=off>
						<label for=g1h0p2></label>
						<input id=g1h0p3 class=peg-3 type=radio name=g1h0p autocomplete=off>
						<label for=g1h0p3></label>
						<input id=g1h0p4 class=peg-4 type=radio name=g1h0p autocomplete=off>
						<label for=g1h0p4></label>
						<input id=g1h0p5 class=peg-5 type=radio name=g1h0p autocomplete=off>
						<label for=g1h0p5></label>
						<div class=peg></div>
						<div class=peg-picker></div>

						<div class=hole>
							<input id=g1h1x class=peg-picker-state type=radio name=g1h1p autocomplete=off>
							<label for=g1h1x></label>
							<input id=g1h1p_ class=no-peg type=radio name=g1h1p autocomplete=off checked>
							<label for=g1h1p_></label>
							<input id=g1h1p0 class=peg-0 type=radio name=g1h1p autocomplete=off>
							<label for=g1h1p0></label>
							<input id=g1h1p1 class=peg-1 type=radio name=g1h1p autocomplete=off>
							<label for=g1h1p1></label>
							<input id=g1h1p2 class=peg-2 type=radio name=g1h1p autocomplete=off>
							<label for=g1h1p2></label>
							<input id=g1h1p3 class=peg-3 type=radio name=g1h1p autocomplete=off>
							<label for=g1h1p3></label>
							<input id=g1h1p4 class=peg-4 type=radio name=g1h1p autocomplete=off>
							<label for=g1h1p4></label>
							<input id=g1h1p5 class=peg-5 type=radio name=g1h1p autocomplete=off>
							<label for=g1h1p5></label>
							<div class=peg></div>
							<div class=peg-picker></div>

							<div class=hole>
								<input id=g1h2x class=peg-picker-state type=radio name=g1h2p autocomplete=off>
								<label for=g1h2x></label>
								<input id=g1h2p_ class=no-peg type=radio name=g1h2p autocomplete=off checked>
								<label for=g1h2p_></label>
								<input id=g1h2p0 class=peg-0 type=radio name=g1h2p autocomplete=off>
								<label for=g1h2p0></label>
								<input id=g1h2p1 class=peg-1 type=radio name=g1h2p autocomplete=off>
								<label for=g1h2p1></label>
								<input id=g1h2p2 class=peg-2 type=radio name=g1h2p autocomplete=off>
								<label for=g1h2p2></label>
								<input id=g1h2p3 class=peg-3 type=radio name=g1h2p autocomplete=off>
								<label for=g1h2p3></label>
								<input id=g1h2p4 class=peg-4 type=radio name=g1h2p autocomplete=off>
								<label for=g1h2p4></label>
								<input id=g1h2p5 class=peg-5 type=radio name=g1h2p autocomplete=off>
								<label for=g1h2p5></label>
								<div class=peg></div>
								<div class=peg-picker></div>

								<div class=hole>
									<input id=g1h3x class=peg-picker-state type=radio name=g1h3p autocomplete=off>
									<label for=g1h3x></label>
									<input id=g1h3p_ class=no-peg type=radio name=g1h3p autocomplete=off checked>
									<label for=g1h3p_></label>
									<input id=g1h3p0 class=peg-0 type=radio name=g1h3p autocomplete=off>
									<label for=g1h3p0></label>
									<input id=g1h3p1 class=peg-1 type=radio name=g1h3p autocomplete=off>
									<label for=g1h3p1></label>
									<input id=g1h3p2 class=peg-2 type=radio name=g1h3p autocomplete=off>
									<label for=g1h3p2></label>
									<input id=g1h3p3 class=peg-3 type=radio name=g1h3p autocomplete=off>
									<label for=g1h3p3></label>
									<input id=g1h3p4 class=peg-4 type=radio name=g1h3p autocomplete=off>
									<label for=g1h3p4></label>
									<input id=g1h3p5 class=peg-5 type=radio name=g1h3p autocomplete=off>
									<label for=g1h3p5></label>
									<div class=peg></div>
									<div class=peg-picker></div>

									<div class=ui>
										<label class="submit icon" for=g1></label>

										<ul class=score>
											<li class=score-peg-0></li>
											<li class=score-peg-1></li>
											<li class=score-peg-2></li>
											<li class=score-peg-3></li>
										</ul>

										<div class="dialog-backdrop win"></div>
										<div class="dialog win">
											<h2>Incredible!</h2>
											<p>You won in only two moves!</p>
											<p>Now that's a mastermind at work!</p>
											<a href=./?theme=dark class=button>Play again</a>
											<a href=./?theme=light class=button>Play again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</section>


				<input class=guess-done id=g2 type=checkbox autocomplete=off>
				<section class=guess>
					<div class=hole class=first-hole>
						<input id=g2h0x class=peg-picker-state type=radio name=g2h0p autocomplete=off>
						<label for=g2h0x></label>
						<input id=g2h0p_ class=no-peg type=radio name=g2h0p autocomplete=off checked>
						<label for=g2h0p_></label>
						<input id=g2h0p0 class=peg-0 type=radio name=g2h0p autocomplete=off>
						<label for=g2h0p0></label>
						<input id=g2h0p1 class=peg-1 type=radio name=g2h0p autocomplete=off>
						<label for=g2h0p1></label>
						<input id=g2h0p2 class=peg-2 type=radio name=g2h0p autocomplete=off>
						<label for=g2h0p2></label>
						<input id=g2h0p3 class=peg-3 type=radio name=g2h0p autocomplete=off>
						<label for=g2h0p3></label>
						<input id=g2h0p4 class=peg-4 type=radio name=g2h0p autocomplete=off>
						<label for=g2h0p4></label>
						<input id=g2h0p5 class=peg-5 type=radio name=g2h0p autocomplete=off>
						<label for=g2h0p5></label>
						<div class=peg></div>
						<div class=peg-picker></div>

						<div class=hole>
							<input id=g2h1x class=peg-picker-state type=radio name=g2h1p autocomplete=off>
							<label for=g2h1x></label>
							<input id=g2h1p_ class=no-peg type=radio name=g2h1p autocomplete=off checked>
							<label for=g2h1p_></label>
							<input id=g2h1p0 class=peg-0 type=radio name=g2h1p autocomplete=off>
							<label for=g2h1p0></label>
							<input id=g2h1p1 class=peg-1 type=radio name=g2h1p autocomplete=off>
							<label for=g2h1p1></label>
							<input id=g2h1p2 class=peg-2 type=radio name=g2h1p autocomplete=off>
							<label for=g2h1p2></label>
							<input id=g2h1p3 class=peg-3 type=radio name=g2h1p autocomplete=off>
							<label for=g2h1p3></label>
							<input id=g2h1p4 class=peg-4 type=radio name=g2h1p autocomplete=off>
							<label for=g2h1p4></label>
							<input id=g2h1p5 class=peg-5 type=radio name=g2h1p autocomplete=off>
							<label for=g2h1p5></label>
							<div class=peg></div>
							<div class=peg-picker></div>

							<div class=hole>
								<input id=g2h2x class=peg-picker-state type=radio name=g2h2p autocomplete=off>
								<label for=g2h2x></label>
								<input id=g2h2p_ class=no-peg type=radio name=g2h2p autocomplete=off checked>
								<label for=g2h2p_></label>
								<input id=g2h2p0 class=peg-0 type=radio name=g2h2p autocomplete=off>
								<label for=g2h2p0></label>
								<input id=g2h2p1 class=peg-1 type=radio name=g2h2p autocomplete=off>
								<label for=g2h2p1></label>
								<input id=g2h2p2 class=peg-2 type=radio name=g2h2p autocomplete=off>
								<label for=g2h2p2></label>
								<input id=g2h2p3 class=peg-3 type=radio name=g2h2p autocomplete=off>
								<label for=g2h2p3></label>
								<input id=g2h2p4 class=peg-4 type=radio name=g2h2p autocomplete=off>
								<label for=g2h2p4></label>
								<input id=g2h2p5 class=peg-5 type=radio name=g2h2p autocomplete=off>
								<label for=g2h2p5></label>
								<div class=peg></div>
								<div class=peg-picker></div>

								<div class=hole>
									<input id=g2h3x class=peg-picker-state type=radio name=g2h3p autocomplete=off>
									<label for=g2h3x></label>
									<input id=g2h3p_ class=no-peg type=radio name=g2h3p autocomplete=off checked>
									<label for=g2h3p_></label>
									<input id=g2h3p0 class=peg-0 type=radio name=g2h3p autocomplete=off>
									<label for=g2h3p0></label>
									<input id=g2h3p1 class=peg-1 type=radio name=g2h3p autocomplete=off>
									<label for=g2h3p1></label>
									<input id=g2h3p2 class=peg-2 type=radio name=g2h3p autocomplete=off>
									<label for=g2h3p2></label>
									<input id=g2h3p3 class=peg-3 type=radio name=g2h3p autocomplete=off>
									<label for=g2h3p3></label>
									<input id=g2h3p4 class=peg-4 type=radio name=g2h3p autocomplete=off>
									<label for=g2h3p4></label>
									<input id=g2h3p5 class=peg-5 type=radio name=g2h3p autocomplete=off>
									<label for=g2h3p5></label>
									<div class=peg></div>
									<div class=peg-picker></div>

									<div class=ui>
										<label class="submit icon" for=g2></label>

										<ul class=score>
											<li class=score-peg-0></li>
											<li class=score-peg-1></li>
											<li class=score-peg-2></li>
											<li class=score-peg-3></li>
										</ul>

										<div class="dialog-backdrop win"></div>
										<div class="dialog win">
											<h2>Well done!</h2>
											<p>And only 3 moves! Very nice!</p>
											<a href=./?theme=dark class=button>Play again</a>
											<a href=./?theme=light class=button>Play again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<input class=guess-done id=g3 type=checkbox autocomplete=off>
				<section class=guess>
					<div class=hole class=first-hole>
						<input id=g3h0x class=peg-picker-state type=radio name=g3h0p autocomplete=off>
						<label for=g3h0x></label>
						<input id=g3h0p_ class=no-peg type=radio name=g3h0p autocomplete=off checked>
						<label for=g3h0p_></label>
						<input id=g3h0p0 class=peg-0 type=radio name=g3h0p autocomplete=off>
						<label for=g3h0p0></label>
						<input id=g3h0p1 class=peg-1 type=radio name=g3h0p autocomplete=off>
						<label for=g3h0p1></label>
						<input id=g3h0p2 class=peg-2 type=radio name=g3h0p autocomplete=off>
						<label for=g3h0p2></label>
						<input id=g3h0p3 class=peg-3 type=radio name=g3h0p autocomplete=off>
						<label for=g3h0p3></label>
						<input id=g3h0p4 class=peg-4 type=radio name=g3h0p autocomplete=off>
						<label for=g3h0p4></label>
						<input id=g3h0p5 class=peg-5 type=radio name=g3h0p autocomplete=off>
						<label for=g3h0p5></label>
						<div class=peg></div>
						<div class=peg-picker></div>

						<div class=hole>
							<input id=g3h1x class=peg-picker-state type=radio name=g3h1p autocomplete=off>
							<label for=g3h1x></label>
							<input id=g3h1p_ class=no-peg type=radio name=g3h1p autocomplete=off checked>
							<label for=g3h1p_></label>
							<input id=g3h1p0 class=peg-0 type=radio name=g3h1p autocomplete=off>
							<label for=g3h1p0></label>
							<input id=g3h1p1 class=peg-1 type=radio name=g3h1p autocomplete=off>
							<label for=g3h1p1></label>
							<input id=g3h1p2 class=peg-2 type=radio name=g3h1p autocomplete=off>
							<label for=g3h1p2></label>
							<input id=g3h1p3 class=peg-3 type=radio name=g3h1p autocomplete=off>
							<label for=g3h1p3></label>
							<input id=g3h1p4 class=peg-4 type=radio name=g3h1p autocomplete=off>
							<label for=g3h1p4></label>
							<input id=g3h1p5 class=peg-5 type=radio name=g3h1p autocomplete=off>
							<label for=g3h1p5></label>
							<div class=peg></div>
							<div class=peg-picker></div>

							<div class=hole>
								<input id=g3h2x class=peg-picker-state type=radio name=g3h2p autocomplete=off>
								<label for=g3h2x></label>
								<input id=g3h2p_ class=no-peg type=radio name=g3h2p autocomplete=off checked>
								<label for=g3h2p_></label>
								<input id=g3h2p0 class=peg-0 type=radio name=g3h2p autocomplete=off>
								<label for=g3h2p0></label>
								<input id=g3h2p1 class=peg-1 type=radio name=g3h2p autocomplete=off>
								<label for=g3h2p1></label>
								<input id=g3h2p2 class=peg-2 type=radio name=g3h2p autocomplete=off>
								<label for=g3h2p2></label>
								<input id=g3h2p3 class=peg-3 type=radio name=g3h2p autocomplete=off>
								<label for=g3h2p3></label>
								<input id=g3h2p4 class=peg-4 type=radio name=g3h2p autocomplete=off>
								<label for=g3h2p4></label>
								<input id=g3h2p5 class=peg-5 type=radio name=g3h2p autocomplete=off>
								<label for=g3h2p5></label>
								<div class=peg></div>
								<div class=peg-picker></div>

								<div class=hole>
									<input id=g3h3x class=peg-picker-state type=radio name=g3h3p autocomplete=off>
									<label for=g3h3x></label>
									<input id=g3h3p_ class=no-peg type=radio name=g3h3p autocomplete=off checked>
									<label for=g3h3p_></label>
									<input id=g3h3p0 class=peg-0 type=radio name=g3h3p autocomplete=off>
									<label for=g3h3p0></label>
									<input id=g3h3p1 class=peg-1 type=radio name=g3h3p autocomplete=off>
									<label for=g3h3p1></label>
									<input id=g3h3p2 class=peg-2 type=radio name=g3h3p autocomplete=off>
									<label for=g3h3p2></label>
									<input id=g3h3p3 class=peg-3 type=radio name=g3h3p autocomplete=off>
									<label for=g3h3p3></label>
									<input id=g3h3p4 class=peg-4 type=radio name=g3h3p autocomplete=off>
									<label for=g3h3p4></label>
									<input id=g3h3p5 class=peg-5 type=radio name=g3h3p autocomplete=off>
									<label for=g3h3p5></label>
									<div class=peg></div>
									<div class=peg-picker></div>

									<div class=ui>
										<label class="submit icon" for=g3></label>

										<ul class=score>
											<li class=score-peg-0></li>
											<li class=score-peg-1></li>
											<li class=score-peg-2></li>
											<li class=score-peg-3></li>
										</ul>

										<div class="dialog-backdrop win"></div>
										<div class="dialog win">
											<h2>You win!</h2>
											<p>4 moves, extraordinary!</p>
											<p>Well played!</p>
											<a href=./?theme=dark class=button>Play again</a>
											<a href=./?theme=light class=button>Play again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>


				<input class=guess-done id=g4 type=checkbox autocomplete=off>
				<section class=guess>
					<div class=hole class=first-hole>
						<input id=g4h0x class=peg-picker-state type=radio name=g4h0p autocomplete=off>
						<label for=g4h0x></label>
						<input id=g4h0p_ class=no-peg type=radio name=g4h0p autocomplete=off checked>
						<label for=g4h0p_></label>
						<input id=g4h0p0 class=peg-0 type=radio name=g4h0p autocomplete=off>
						<label for=g4h0p0></label>
						<input id=g4h0p1 class=peg-1 type=radio name=g4h0p autocomplete=off>
						<label for=g4h0p1></label>
						<input id=g4h0p2 class=peg-2 type=radio name=g4h0p autocomplete=off>
						<label for=g4h0p2></label>
						<input id=g4h0p3 class=peg-3 type=radio name=g4h0p autocomplete=off>
						<label for=g4h0p3></label>
						<input id=g4h0p4 class=peg-4 type=radio name=g4h0p autocomplete=off>
						<label for=g4h0p4></label>
						<input id=g4h0p5 class=peg-5 type=radio name=g4h0p autocomplete=off>
						<label for=g4h0p5></label>
						<div class=peg></div>
						<div class=peg-picker></div>

						<div class=hole>
							<input id=g4h1x class=peg-picker-state type=radio name=g4h1p autocomplete=off>
							<label for=g4h1x></label>
							<input id=g4h1p_ class=no-peg type=radio name=g4h1p autocomplete=off checked>
							<label for=g4h1p_></label>
							<input id=g4h1p0 class=peg-0 type=radio name=g4h1p autocomplete=off>
							<label for=g4h1p0></label>
							<input id=g4h1p1 class=peg-1 type=radio name=g4h1p autocomplete=off>
							<label for=g4h1p1></label>
							<input id=g4h1p2 class=peg-2 type=radio name=g4h1p autocomplete=off>
							<label for=g4h1p2></label>
							<input id=g4h1p3 class=peg-3 type=radio name=g4h1p autocomplete=off>
							<label for=g4h1p3></label>
							<input id=g4h1p4 class=peg-4 type=radio name=g4h1p autocomplete=off>
							<label for=g4h1p4></label>
							<input id=g4h1p5 class=peg-5 type=radio name=g4h1p autocomplete=off>
							<label for=g4h1p5></label>
							<div class=peg></div>
							<div class=peg-picker></div>

							<div class=hole>
								<input id=g4h2x class=peg-picker-state type=radio name=g4h2p autocomplete=off>
								<label for=g4h2x></label>
								<input id=g4h2p_ class=no-peg type=radio name=g4h2p autocomplete=off checked>
								<label for=g4h2p_></label>
								<input id=g4h2p0 class=peg-0 type=radio name=g4h2p autocomplete=off>
								<label for=g4h2p0></label>
								<input id=g4h2p1 class=peg-1 type=radio name=g4h2p autocomplete=off>
								<label for=g4h2p1></label>
								<input id=g4h2p2 class=peg-2 type=radio name=g4h2p autocomplete=off>
								<label for=g4h2p2></label>
								<input id=g4h2p3 class=peg-3 type=radio name=g4h2p autocomplete=off>
								<label for=g4h2p3></label>
								<input id=g4h2p4 class=peg-4 type=radio name=g4h2p autocomplete=off>
								<label for=g4h2p4></label>
								<input id=g4h2p5 class=peg-5 type=radio name=g4h2p autocomplete=off>
								<label for=g4h2p5></label>
								<div class=peg></div>
								<div class=peg-picker></div>

								<div class=hole>
									<input id=g4h3x class=peg-picker-state type=radio name=g4h3p autocomplete=off>
									<label for=g4h3x></label>
									<input id=g4h3p_ class=no-peg type=radio name=g4h3p autocomplete=off checked>
									<label for=g4h3p_></label>
									<input id=g4h3p0 class=peg-0 type=radio name=g4h3p autocomplete=off>
									<label for=g4h3p0></label>
									<input id=g4h3p1 class=peg-1 type=radio name=g4h3p autocomplete=off>
									<label for=g4h3p1></label>
									<input id=g4h3p2 class=peg-2 type=radio name=g4h3p autocomplete=off>
									<label for=g4h3p2></label>
									<input id=g4h3p3 class=peg-3 type=radio name=g4h3p autocomplete=off>
									<label for=g4h3p3></label>
									<input id=g4h3p4 class=peg-4 type=radio name=g4h3p autocomplete=off>
									<label for=g4h3p4></label>
									<input id=g4h3p5 class=peg-5 type=radio name=g4h3p autocomplete=off>
									<label for=g4h3p5></label>
									<div class=peg></div>
									<div class=peg-picker></div>

									<div class=ui>
										<label class="submit icon" for=g4></label>

										<ul class=score>
											<li class=score-peg-0></li>
											<li class=score-peg-1></li>
											<li class=score-peg-2></li>
											<li class=score-peg-3></li>
										</ul>

										<div class="dialog-backdrop win"></div>
										<div class="dialog win">
											<h2>You cracked it!</h2>
											<p>5 moves is pretty darn good!</p>
											<a href=./?theme=dark class=button>Play again</a>
											<a href=./?theme=light class=button>Play again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>


				<input class=guess-done id=g5 type=checkbox autocomplete=off>
				<section class=guess>
					<div class=hole class=first-hole>
						<input id=g5h0x class=peg-picker-state type=radio name=g5h0p autocomplete=off>
						<label for=g5h0x></label>
						<input id=g5h0p_ class=no-peg type=radio name=g5h0p autocomplete=off checked>
						<label for=g5h0p_></label>
						<input id=g5h0p0 class=peg-0 type=radio name=g5h0p autocomplete=off>
						<label for=g5h0p0></label>
						<input id=g5h0p1 class=peg-1 type=radio name=g5h0p autocomplete=off>
						<label for=g5h0p1></label>
						<input id=g5h0p2 class=peg-2 type=radio name=g5h0p autocomplete=off>
						<label for=g5h0p2></label>
						<input id=g5h0p3 class=peg-3 type=radio name=g5h0p autocomplete=off>
						<label for=g5h0p3></label>
						<input id=g5h0p4 class=peg-4 type=radio name=g5h0p autocomplete=off>
						<label for=g5h0p4></label>
						<input id=g5h0p5 class=peg-5 type=radio name=g5h0p autocomplete=off>
						<label for=g5h0p5></label>
						<div class=peg></div>
						<div class=peg-picker></div>

						<div class=hole>
							<input id=g5h1x class=peg-picker-state type=radio name=g5h1p autocomplete=off>
							<label for=g5h1x></label>
							<input id=g5h1p_ class=no-peg type=radio name=g5h1p autocomplete=off checked>
							<label for=g5h1p_></label>
							<input id=g5h1p0 class=peg-0 type=radio name=g5h1p autocomplete=off>
							<label for=g5h1p0></label>
							<input id=g5h1p1 class=peg-1 type=radio name=g5h1p autocomplete=off>
							<label for=g5h1p1></label>
							<input id=g5h1p2 class=peg-2 type=radio name=g5h1p autocomplete=off>
							<label for=g5h1p2></label>
							<input id=g5h1p3 class=peg-3 type=radio name=g5h1p autocomplete=off>
							<label for=g5h1p3></label>
							<input id=g5h1p4 class=peg-4 type=radio name=g5h1p autocomplete=off>
							<label for=g5h1p4></label>
							<input id=g5h1p5 class=peg-5 type=radio name=g5h1p autocomplete=off>
							<label for=g5h1p5></label>
							<div class=peg></div>
							<div class=peg-picker></div>

							<div class=hole>
								<input id=g5h2x class=peg-picker-state type=radio name=g5h2p autocomplete=off>
								<label for=g5h2x></label>
								<input id=g5h2p_ class=no-peg type=radio name=g5h2p autocomplete=off checked>
								<label for=g5h2p_></label>
								<input id=g5h2p0 class=peg-0 type=radio name=g5h2p autocomplete=off>
								<label for=g5h2p0></label>
								<input id=g5h2p1 class=peg-1 type=radio name=g5h2p autocomplete=off>
								<label for=g5h2p1></label>
								<input id=g5h2p2 class=peg-2 type=radio name=g5h2p autocomplete=off>
								<label for=g5h2p2></label>
								<input id=g5h2p3 class=peg-3 type=radio name=g5h2p autocomplete=off>
								<label for=g5h2p3></label>
								<input id=g5h2p4 class=peg-4 type=radio name=g5h2p autocomplete=off>
								<label for=g5h2p4></label>
								<input id=g5h2p5 class=peg-5 type=radio name=g5h2p autocomplete=off>
								<label for=g5h2p5></label>
								<div class=peg></div>
								<div class=peg-picker></div>

								<div class=hole>
									<input id=g5h3x class=peg-picker-state type=radio name=g5h3p autocomplete=off>
									<label for=g5h3x></label>
									<input id=g5h3p_ class=no-peg type=radio name=g5h3p autocomplete=off checked>
									<label for=g5h3p_></label>
									<input id=g5h3p0 class=peg-0 type=radio name=g5h3p autocomplete=off>
									<label for=g5h3p0></label>
									<input id=g5h3p1 class=peg-1 type=radio name=g5h3p autocomplete=off>
									<label for=g5h3p1></label>
									<input id=g5h3p2 class=peg-2 type=radio name=g5h3p autocomplete=off>
									<label for=g5h3p2></label>
									<input id=g5h3p3 class=peg-3 type=radio name=g5h3p autocomplete=off>
									<label for=g5h3p3></label>
									<input id=g5h3p4 class=peg-4 type=radio name=g5h3p autocomplete=off>
									<label for=g5h3p4></label>
									<input id=g5h3p5 class=peg-5 type=radio name=g5h3p autocomplete=off>
									<label for=g5h3p5></label>
									<div class=peg></div>
									<div class=peg-picker></div>

									<div class=ui>
										<label class="submit icon" for=g5></label>

										<ul class=score>
											<li class=score-peg-0></li>
											<li class=score-peg-1></li>
											<li class=score-peg-2></li>
											<li class=score-peg-3></li>
										</ul>

										<div class="dialog-backdrop win"></div>
										<div class="dialog win">
											<h2>Not bad!</h2>
											<p>You solved it in 6 moves!</p>
											<p>Not too shabby, not at all!</p>
											<a href=./?theme=dark class=button>Play again</a>
											<a href=./?theme=light class=button>Play again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>


				<input class=guess-done id=g6 type=checkbox autocomplete=off>
				<section class=guess>
					<div class=hole class=first-hole>
						<input id=g6h0x class=peg-picker-state type=radio name=g6h0p autocomplete=off>
						<label for=g6h0x></label>
						<input id=g6h0p_ class=no-peg type=radio name=g6h0p autocomplete=off checked>
						<label for=g6h0p_></label>
						<input id=g6h0p0 class=peg-0 type=radio name=g6h0p autocomplete=off>
						<label for=g6h0p0></label>
						<input id=g6h0p1 class=peg-1 type=radio name=g6h0p autocomplete=off>
						<label for=g6h0p1></label>
						<input id=g6h0p2 class=peg-2 type=radio name=g6h0p autocomplete=off>
						<label for=g6h0p2></label>
						<input id=g6h0p3 class=peg-3 type=radio name=g6h0p autocomplete=off>
						<label for=g6h0p3></label>
						<input id=g6h0p4 class=peg-4 type=radio name=g6h0p autocomplete=off>
						<label for=g6h0p4></label>
						<input id=g6h0p5 class=peg-5 type=radio name=g6h0p autocomplete=off>
						<label for=g6h0p5></label>
						<div class=peg></div>
						<div class=peg-picker></div>

						<div class=hole>
							<input id=g6h1x class=peg-picker-state type=radio name=g6h1p autocomplete=off>
							<label for=g6h1x></label>
							<input id=g6h1p_ class=no-peg type=radio name=g6h1p autocomplete=off checked>
							<label for=g6h1p_></label>
							<input id=g6h1p0 class=peg-0 type=radio name=g6h1p autocomplete=off>
							<label for=g6h1p0></label>
							<input id=g6h1p1 class=peg-1 type=radio name=g6h1p autocomplete=off>
							<label for=g6h1p1></label>
							<input id=g6h1p2 class=peg-2 type=radio name=g6h1p autocomplete=off>
							<label for=g6h1p2></label>
							<input id=g6h1p3 class=peg-3 type=radio name=g6h1p autocomplete=off>
							<label for=g6h1p3></label>
							<input id=g6h1p4 class=peg-4 type=radio name=g6h1p autocomplete=off>
							<label for=g6h1p4></label>
							<input id=g6h1p5 class=peg-5 type=radio name=g6h1p autocomplete=off>
							<label for=g6h1p5></label>
							<div class=peg></div>
							<div class=peg-picker></div>

							<div class=hole>
								<input id=g6h2x class=peg-picker-state type=radio name=g6h2p autocomplete=off>
								<label for=g6h2x></label>
								<input id=g6h2p_ class=no-peg type=radio name=g6h2p autocomplete=off checked>
								<label for=g6h2p_></label>
								<input id=g6h2p0 class=peg-0 type=radio name=g6h2p autocomplete=off>
								<label for=g6h2p0></label>
								<input id=g6h2p1 class=peg-1 type=radio name=g6h2p autocomplete=off>
								<label for=g6h2p1></label>
								<input id=g6h2p2 class=peg-2 type=radio name=g6h2p autocomplete=off>
								<label for=g6h2p2></label>
								<input id=g6h2p3 class=peg-3 type=radio name=g6h2p autocomplete=off>
								<label for=g6h2p3></label>
								<input id=g6h2p4 class=peg-4 type=radio name=g6h2p autocomplete=off>
								<label for=g6h2p4></label>
								<input id=g6h2p5 class=peg-5 type=radio name=g6h2p autocomplete=off>
								<label for=g6h2p5></label>
								<div class=peg></div>
								<div class=peg-picker></div>

								<div class=hole>
									<input id=g6h3x class=peg-picker-state type=radio name=g6h3p autocomplete=off>
									<label for=g6h3x></label>
									<input id=g6h3p_ class=no-peg type=radio name=g6h3p autocomplete=off checked>
									<label for=g6h3p_></label>
									<input id=g6h3p0 class=peg-0 type=radio name=g6h3p autocomplete=off>
									<label for=g6h3p0></label>
									<input id=g6h3p1 class=peg-1 type=radio name=g6h3p autocomplete=off>
									<label for=g6h3p1></label>
									<input id=g6h3p2 class=peg-2 type=radio name=g6h3p autocomplete=off>
									<label for=g6h3p2></label>
									<input id=g6h3p3 class=peg-3 type=radio name=g6h3p autocomplete=off>
									<label for=g6h3p3></label>
									<input id=g6h3p4 class=peg-4 type=radio name=g6h3p autocomplete=off>
									<label for=g6h3p4></label>
									<input id=g6h3p5 class=peg-5 type=radio name=g6h3p autocomplete=off>
									<label for=g6h3p5></label>
									<div class=peg></div>
									<div class=peg-picker></div>

									<div class=ui>
										<label class="submit icon" for=g6></label>

										<ul class=score>
											<li class=score-peg-0></li>
											<li class=score-peg-1></li>
											<li class=score-peg-2></li>
											<li class=score-peg-3></li>
										</ul>

										<div class="dialog-backdrop win"></div>
										<div class="dialog win">
											<h2>Congrats!</h2>
											<p>You beat the game in 7 moves!</p>
											<p>Hats off to you!</p>
											<a href=./?theme=dark class=button>Play again</a>
											<a href=./?theme=light class=button>Play again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<input class=guess-done id=g7 type=checkbox autocomplete=off>
				<section class=guess>
					<div class=hole class=first-hole>
						<input id=g7h0x class=peg-picker-state type=radio name=g7h0p autocomplete=off>
						<label for=g7h0x></label>
						<input id=g7h0p_ class=no-peg type=radio name=g7h0p autocomplete=off checked>
						<label for=g7h0p_></label>
						<input id=g7h0p0 class=peg-0 type=radio name=g7h0p autocomplete=off>
						<label for=g7h0p0></label>
						<input id=g7h0p1 class=peg-1 type=radio name=g7h0p autocomplete=off>
						<label for=g7h0p1></label>
						<input id=g7h0p2 class=peg-2 type=radio name=g7h0p autocomplete=off>
						<label for=g7h0p2></label>
						<input id=g7h0p3 class=peg-3 type=radio name=g7h0p autocomplete=off>
						<label for=g7h0p3></label>
						<input id=g7h0p4 class=peg-4 type=radio name=g7h0p autocomplete=off>
						<label for=g7h0p4></label>
						<input id=g7h0p5 class=peg-5 type=radio name=g7h0p autocomplete=off>
						<label for=g7h0p5></label>
						<div class=peg></div>
						<div class=peg-picker></div>

						<div class=hole>
							<input id=g7h1x class=peg-picker-state type=radio name=g7h1p autocomplete=off>
							<label for=g7h1x></label>
							<input id=g7h1p_ class=no-peg type=radio name=g7h1p autocomplete=off checked>
							<label for=g7h1p_></label>
							<input id=g7h1p0 class=peg-0 type=radio name=g7h1p autocomplete=off>
							<label for=g7h1p0></label>
							<input id=g7h1p1 class=peg-1 type=radio name=g7h1p autocomplete=off>
							<label for=g7h1p1></label>
							<input id=g7h1p2 class=peg-2 type=radio name=g7h1p autocomplete=off>
							<label for=g7h1p2></label>
							<input id=g7h1p3 class=peg-3 type=radio name=g7h1p autocomplete=off>
							<label for=g7h1p3></label>
							<input id=g7h1p4 class=peg-4 type=radio name=g7h1p autocomplete=off>
							<label for=g7h1p4></label>
							<input id=g7h1p5 class=peg-5 type=radio name=g7h1p autocomplete=off>
							<label for=g7h1p5></label>
							<div class=peg></div>
							<div class=peg-picker></div>

							<div class=hole>
								<input id=g7h2x class=peg-picker-state type=radio name=g7h2p autocomplete=off>
								<label for=g7h2x></label>
								<input id=g7h2p_ class=no-peg type=radio name=g7h2p autocomplete=off checked>
								<label for=g7h2p_></label>
								<input id=g7h2p0 class=peg-0 type=radio name=g7h2p autocomplete=off>
								<label for=g7h2p0></label>
								<input id=g7h2p1 class=peg-1 type=radio name=g7h2p autocomplete=off>
								<label for=g7h2p1></label>
								<input id=g7h2p2 class=peg-2 type=radio name=g7h2p autocomplete=off>
								<label for=g7h2p2></label>
								<input id=g7h2p3 class=peg-3 type=radio name=g7h2p autocomplete=off>
								<label for=g7h2p3></label>
								<input id=g7h2p4 class=peg-4 type=radio name=g7h2p autocomplete=off>
								<label for=g7h2p4></label>
								<input id=g7h2p5 class=peg-5 type=radio name=g7h2p autocomplete=off>
								<label for=g7h2p5></label>
								<div class=peg></div>
								<div class=peg-picker></div>

								<div class=hole>
									<input id=g7h3x class=peg-picker-state type=radio name=g7h3p autocomplete=off>
									<label for=g7h3x></label>
									<input id=g7h3p_ class=no-peg type=radio name=g7h3p autocomplete=off checked>
									<label for=g7h3p_></label>
									<input id=g7h3p0 class=peg-0 type=radio name=g7h3p autocomplete=off>
									<label for=g7h3p0></label>
									<input id=g7h3p1 class=peg-1 type=radio name=g7h3p autocomplete=off>
									<label for=g7h3p1></label>
									<input id=g7h3p2 class=peg-2 type=radio name=g7h3p autocomplete=off>
									<label for=g7h3p2></label>
									<input id=g7h3p3 class=peg-3 type=radio name=g7h3p autocomplete=off>
									<label for=g7h3p3></label>
									<input id=g7h3p4 class=peg-4 type=radio name=g7h3p autocomplete=off>
									<label for=g7h3p4></label>
									<input id=g7h3p5 class=peg-5 type=radio name=g7h3p autocomplete=off>
									<label for=g7h3p5></label>
									<div class=peg></div>
									<div class=peg-picker></div>

									<div class=ui>
										<label class="submit icon" for=g7></label>

										<ul class=score>
											<li class=score-peg-0></li>
											<li class=score-peg-1></li>
											<li class=score-peg-2></li>
											<li class=score-peg-3></li>
										</ul>

										<div class="dialog-backdrop win"></div>
										<div class="dialog win">
											<h2>Clutch!</h2>
											<p>That was close!</p>
											<p>You got it on your last guess!</p>
											<a href=./?theme=dark class=button>Play again</a>
											<a href=./?theme=light class=button>Play again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>

										<div class="dialog-backdrop lost"></div>
										<div class="dialog lost">
											<h2>Game over!</h2>
											<p>You couldn't crack it.</p>
											<p>That's okay!</p>
											<a href=./?theme=dark class=button>Try again</a>
											<a href=./?theme=light class=button>Try again</a>
											<div class=solution>
												<div class=fake-score></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[0] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[1] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[2] ?>)"></div>
												<div class=fake-peg style="--peg-color:var(--peg-color-<?= $solution[3] ?>)"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</main>
