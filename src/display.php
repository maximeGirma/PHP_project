<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 13/01/18
 * Time: 09:54
 */

function display_interface($content_1 = '',$content_2='',$content_3='',$content_4=''){

    $header="<head>

	<title>Stapa Access</title>
	<meta charset=\"utf-8\">
	<meta name=\"description\" content=\"page\">
	<meta name=\"robots\" content=\"noindex,nofollow\">


	<meta name=\"author\" content=\"Team_Seven\">
	<meta name=\"copyright\" content=\"Team_Seven\">

	<link href=\"images/favicon.png\" rel=\"shortcut icon\" type=\"image/png\">
	<link href=\"css/index_style.css\" rel=\"stylesheet\" type=\"text/css\">
	<!-- 	<link href=\"js/script.js\" type=\"text/javascript\">

    </head>

    <body>

        <section id=\"content\">

            <section>															<!-- début header -->

	<header>

		<hgroup id=\"bann_m\">
			<h2>
				<a>S T A P A</a>
				<a>A C C E S</a>
				<picture  id=\"logo_m\">
					<img src=\"images/bus_t.png\"  alt=\"-image-\">
				</picture>
			</h2>
		</hgroup>

	</header>

	</section>

	<section>															<!-- début main -->

		<main>

			<section id=\"main_m\">

				<fieldset>
					<legend>requete</legend>
					<form action=\"requete_operator.php\" method=\"post\">
						<p>
							<label for=\"predifined_query\"></label>
							<input type=\"text\" name=\"predifined_query\">
							<!--On ne peut cocher qu'un radio pour un name donné-->
						</p>
						<p>
							<input type=\"submit\" name=\"REQUEST!\">
						</p>
					</form>
				</fieldset>
			</section>

		</main>

	</section>															<!-- fin phrasing -->

	<section id=\"end\">															<!-- début footer -->
";

    $footer="		<footer>

			<p>
				<a>MENTION LÉGALE</a>
				<a>CONTACT</a>
				<a>&copy TEAM SEVEN</a>
			</p>

		</footer>

	</section>															<!-- fin footer -->

	</section>																<!-- fin corps -->

	</body>


</html>";




    echo $header;
    echo $content_1;
    echo $content_2;
    echo $content_3;
    echo $content_4;
    echo $footer;
}