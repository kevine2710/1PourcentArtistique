<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Application de géolocalisation des œuvres d'art présentent dans les campus 
    de l'Université de Montpellier dans le cadre du 1% Artistique. À l’Université de Montpellier (UM), les premières 
    œuvres réalisées dans le cadre de ce dispositif datent de la construction du campus Triolet dans les années 1960-1970. 
    Les architectes Philippe Jaulmes et Jean de Richemond conçoivent alors un programme de décoration ambitieux et font 
    appel à des artistes de renom comme Pol Bury, Yaacov Agam et Albert Dupin. La plupart des œuvres réalisées sont de 
    style « Op Art » (ou art optique) et de style cinétique (œuvres en mouvement).">
    <link rel="shortcut icon" href="/assets/img/logo_artistique.ico">
    <meta name="author" content="Kévin Margueritte & Pierrick Giuliani"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">
	<link rel="stylesheet" href="/lib/css/magic.min.css">
	<link rel="stylesheet" href="/lib/caroussel/owl.carousel.css">
	<link href="/lib/overview/css/lightbox.css" rel="stylesheet">
	<link href="/lib/input-tags/ng-tags-input.bootstrap.min.css" rel="stylesheet">
	<link href="/lib/input-tags/ng-tags-input.min.css" rel="stylesheet">
	<link href="/lib/dropzone/dropzone.min.css" rel="stylesheet">
	<link href="/lib/dropzone/basic.min.css" rel="stylesheet">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
	<link href="/lib/autocomplete/easy-autocomplete.min.css" rel="stylesheet">
	<link href="/lib/back-to-top/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="shortcut icon" href="/assets/img/logo_artistique.ico" />
	<title></title>
</head>
<body ng-app="art">
	<?php include($_SERVER['DOCUMENT_ROOT']."/html/headerAdmin.php") ?>
	<?php include($_SERVER['DOCUMENT_ROOT']."/html/header.php") ?>
	<div class="oeuvre edition cd-container" ng-controller="page-art">
		<nav ng-hide="hideUIAdmin" class="nav-update navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<h1 class="navbar-brand">Editeur d'œuvre</h1>
			</div>

			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="#" ng-click="openTitle()">Informations générales</a></li>
					<li><a href="#" ng-click="addDescription()">Description de l'œuvre</a></li>
					<li><a href="#" ng-click="addPresentation()">Présentation de l'œuvre</a></li>
					<li><a href="#" ng-click="addPhotography()">Photographie(s) de l'œuvre</a></li>
					<li><a href="#" ng-click="addHistoric()">Historique de l'œuvre</a></li>
					<li><a href="#" ng-click="addBiography()">Biographie(s) des auteurs</a></li>
					<li><a href="#" ng-click="save()">Enregister</a></li>
				</ul>
			</div>
		</nav>
		<div ng-hide="hideTitle" class="title">
			<h1 id="name">
				{{art.name}} - {{art.date}}
			</h1>
			<h2 id="name_author">{{authorsList}}</h2>
		</div>
		<div ng-hide="hideOverview" class="overview clearfix">
			<div class="descriptions">
				<div class="description type clearfix">
					<span class="name">Type </span>
					<span class="entitled">{{art.type}}</span>
				</div>
				<div class="description lieu clearfix">
					<span class="name">Lieu </span>
					<span class="entitled">{{art.location}}</span>
				</div>
				<div class="description materiel clearfix">
					<span class="name">Matériaux </span>
					<span class="entitled">{{art.material}}</span>
				</div>
				<div class="description architecte clearfix">
					<span class="name">Architecte(s) </span>
					<span class="entitled">{{art.architect}}</span>
				</div>
			</div>
			<div class="description photo">
				<a ng-href="{{art.imagePath}}" data-lightbox="image-description">
					<img ng-src="{{art.imagePath}}" alt="{{art.imageAlt}}" >
				</a>
			</div>
		</div>
		<div ng-hide="hidePresentation" class="presentation clearfix">
			<h1 class="collapse-trigger collapse-off" data-toggle="collapse" data-target="#collapsePresentation">
				PRESENTATION
				<i class='glyphicon glyphicon-collapse glyphicon-chevron-up'></i>
			</h1>
			<div id="collapsePresentation" class="collapse on">
				<span ng-bind-html="art.presentationHTML"></span>
				<div ng-hide=videoHide>
					<h2>Vidéo(s)</h2>
					<video id="vjs-big-play-centered" class="video-js vjs-default-skin vjs-big-play-centered" controls autoplay="true" muted="true" preload="auto" data-setup="{}">
					</video>
					<table id="playlist" class="table table-bordered">
						<thead class="thead-default">
							<tr>
								<th>Liste des vidéo(s)</th>
							</tr>
						</thead>
						<tbody ng-repeat="video in art.videoList">
							<tr ng-click='play(video.name, $index)'>
								<td ng-class="{'active': video.active == true}">{{video.name}}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div ng-hide=soundHide>
					<h2>Son - {{art.soundName}}</h2>
					<audio ng-src="{{art.soundPath}}" controls></audio>
				</div>
			</div>
		</div>
		<div ng-hide="hidePhotography" class="photograph clearfix" ng-class="{'gray': hidePresentation == false}">
			<h1 class="collapse-trigger collapse-off carousel-photography-collapse" data-toggle="collapse" data-target="#collapsePhotography">
				PHOTOGRAPHIE(S) - {{nbPhotography + " photo(s)"}}
				<i class='glyphicon glyphicon-collapse glyphicon-chevron-up'></i>
			</h1>
			<div id="collapsePhotography" class="collapse on">
				<div class="carousel-photograph">
				    <div class="item" ng-repeat="photography in art.photographyList" repeat-owl-photography-post="ngRepeatFinishedHistoric">
				    	<a ng-href="{{photography.path}}" data-lightbox="image-photograph" title="<b>{{photography.name}}</b>">
				    		<img ng-src="{{photography.path}}">
				    	</a>
				    </div>
				</div>
			</div>
		</div>
		<div class="historic clearfix" ng-hide=hideHistoric ng-class="{'gray': (hidePresentation == true && hidePhotography == false) || (hidePresentation == false && hidePhotography == true)}">
			<h1 class="collapse-trigger collapse-off carousel-historic-collapse" data-toggle="collapse" data-target="#collapseHistoric">
				HISTORIQUE - {{nbHistoric + " photo(s) d'historique"}}
				<i class='glyphicon glyphicon-collapse glyphicon-chevron-up'></i>
			</h1>
			<div class="collapse on" id="collapseHistoric">
				<div class="carousel-historic">
				    <div class="item" ng-repeat="historic in art.historicList" repeat-owl-historic-post="ngRepeatFinished">
				    	<a ng-href="{{historic.path}}" data-lightbox="image-photograph" title="<b>{{historic.name}}</b>">
				    		<img ng-src="{{historic.path}}">
				    	</a>
				    </div>
				</div>
				<span ng-bind-html="art.historicHTML"></span>
			</div>
		</div>
		<div class="biography clearfix" ng-hide=hideBiography ng-class="{'gray': (hidePresentation == false && hidePhotography == false && hideHistoric == false) || (hidePresentation == false && hidePhotography == true && hideHistoric == true) || (hidePresentation == true && hidePhotography == true && hideHistoric == false)}">
			<h1 class="collapse-trigger collapse-off" data-toggle="collapse" data-target="#collapseBiography">
				BIOGRAPHIE(S)
				<i class='glyphicon glyphicon-collapse glyphicon-chevron-up'></i>
			</h1>
			<div class="collapse on" id="collapseBiography">
				<div ng-repeat="author in art.authors track by $index" ng-if="author.biography != ''" class="biographyLimit">
					<span ng-bind-html="author.biography" class="content">{{nbAuthors}}</span>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-title" tabindex="-1" role="dialog" aria-labelledby="modal-title">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="edit">
						<h1>Informations générales</h1>
						<div class="form-group">
							<label>Nom de l'œuvre</label>
							<input ng-model="art.name" type="text" class="form-control" placeholder="Nom">
						</div>
						<div class="form-group">
							<label>Année de l'œuvre</label>
							<input ng-model="art.date" type="number" min="1" max="2500" class="form-control" placeholder="Année">
						</div>
						<div class="form-group">
							<label>Type d'œuvre</label>
							<select class="form-control" ng-model="art.type">
							    <option ng-selected="true" value="Architecture">Architecture</option>
							    <option>Arts décoratifs</option>
							    <option>Arts numériques</option>
							    <option>Cinéma</option>
							    <option>Musique</option>
							    <option>Peinture</option>
							    <option>Photographie</option>
							    <option>Sculpture</option>
							</select>
						</div>
						<div class="form-group">
							<label>Localisation de l'œuvre</label>
							<input id="artLocation" ng-model="art.location">
						</div>
						<div class="form-group">
							<label>Adresse exacte de l'œuvre</label>
							<input type="text" class="form-control" id="art-adress" placeholder="Adresse">
						</div>
						<div id="map"></div>
						<button type="button" ng-click="forceGoogleRefresh($event)" accesskey="S" class="btn btn-forceMap">Rafraichir la carte</button>
						<table class="table">
							<thead class="thead-default">
								<tr>
									<th>Nom auteur</th>
									<th>Année naissance</th>
									<th>Année décès</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="rowAuthor in authorsArray">
									<td>{{rowAuthor.name}}</td>
									<td>{{rowAuthor.yearBirth}}</td>
									<td>{{rowAuthor.yearDeath}}</td>
									<td>
										<button type="button" ng-click="removeAuthor(rowAuthor.name)" class="btn btn-removeAuthor">Supprimer</button>
									</td>
								</tr>
							</tbody>
						</table>
						<button type="button" ng-click="addAuthor()" class="btn btn-add-author">Ajouter un auteur</button>
						<button type="button" ng-click="completeTitle($event)" accesskey="S" class="btn btn-complete">Modifier</button>
						<div ng-hide="hideErrorTitle" class="alert alert-danger">
							<strong>Erreur! </strong>{{titleError}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-author" tabindex="-1" role="dialog" aria-labelledby="modal-author">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="edit">
						<h1>Ajouter un auteur</h1>
						<div class="form-group">
							<label>Nom de l'auteur</label>
							<input ng-model="art.authors[nbAuthors].name" type="text" class="form-control" id="oeuvre-name" placeholder="Nom">
						</div>
						<div class="form-group">
							<label>Année de naissance</label>
							<input ng-model="art.authors[nbAuthors].yearBirth" type="number" min="1" max="2500" class="form-control" id="oeuvre-name" placeholder="Année">
						</div>
						<div class="form-group">
							<label>Année de décès</label>
							<input ng-model="art.authors[nbAuthors].yearDeath" type="number" min="1" max="2500" class="form-control" id="oeuvre-name" placeholder="Année">
						</div>
						<button type="button" ng-click="completeAuthor()" class="btn btn-complete">Ajouter</button>
						<div ng-hide="hideErrorAuthor" class="alert alert-danger">
							<strong>Erreur! </strong>{{errorAuthor}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-description" tabindex="-1" role="dialog" aria-labelledby="modal-description">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="edit">
						<h1>Description de l'œuvre</h1>
						<div class="form-group">
							<label>Matériaux utilisés</label>
							<tags-input replace-spaces-with-dashes=false add-On-Enter=true min-Length=1 on-Tag-Removed="materialDelete($tag)" on-Tag-Added="materialAdd($tag)" ng-model="art.materials" placeholder="Ajouter un matériau"></tags-input>
						</div>
						<div class="form-group">
							<label>Les architectes</label>
							<tags-input replace-spaces-with-dashes=false add-On-Enter=true min-Length=1 on-Tag-Removed="architectDelete($tag)" on-Tag-Added="architectAdd($tag)" ng-model="art.architects" placeholder="Ajouter un architecte"></tags-input>
						</div>
						<form class="dropzone" id="dropzoneDescription"></form>
						<button type="button" class="btn btn-complete" ng-click="completeDescription()">Modifier</button>
						<div ng-hide="hideErrorDescription" class="alert alert-danger">
							<strong>Erreur! </strong>{{errorDescription}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-presentation" tabindex="-1" role="dialog" aria-labelledby="modal-presentation">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="edit">
						<h1>Présentation de l'œuvre</h1>
						<div class="form-group">
							<label>Présentation de l'œuvre</label>
							<div id="wysywygPresentation"></div>
						</div>
						<div class="form-group">
							<label>Ajouter des vidéos</label>
							<form class="dropzone" id="dropzonePresentationVideos"></form>
						</div>
						<div class="form-group">
							<label>Ajouter un son</label>
							<form class="dropzone" id="dropzonePresentationSound"></form>
						</div>
						<button type="button" ng-click="completePresentation()" class="btn btn-complete">Ajouter</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-photography" tabindex="-1" role="dialog" aria-labelledby="modal-photography">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="edit">
						<h1>Photographie(s) de l'œuvre</h1>
						<div class="form-group">
							<form class="dropzone" id="dropzonePhotography"></form>
						</div>
						<button type="button" ng-click="completePhotography()" class="btn btn-complete">Ajouter</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-historic" tabindex="-1" role="dialog" aria-labelledby="modal-historic">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="edit">
						<h1>Historique de l'œuvre</h1>
						<div class="form-group">
							<form class="dropzone" id="dropzoneHistoric"></form>
						</div>
						<div class="form-group">
							<label>Description de l'historique</label>
							<div id="wysywygHistoric"></div>
						</div>
						<button type="button" ng-click="completeHistoric()" class="btn btn-complete">Ajouter</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-biography" tabindex="-1" role="dialog" aria-labelledby="modal-biography">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="edit">
						<h1>Biographie(s) des auteurs</h1>
						<table class="table">
							<thead class="thead-default">
								<tr>
									<th>Nom auteur</th>
									<th>Année naissance</th>
									<th>Année décès</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="rowAuthor in authorsArray">
									<td>{{rowAuthor.name}}</td>
									<td>{{rowAuthor.yearBirth}}</td>
									<td>{{rowAuthor.yearDeath}}</td>
									<td>
										<button type="button" ng-click="addBiographyAuthor(rowAuthor.name)" class="btn btn-addDescriptionAuthor">Biographie</button>
									</td>
								</tr>
							</tbody>
						</table>
						<button type="button" ng-click="completeBiography($event)" accesskey="S" class="btn btn-complete">Modifier</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-editBiography" tabindex="-1" role="dialog" aria-labelledby="modal-editBiography">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="edit">
						<h1>Ajouter la biographie de {{authorBiographyCurrent}}</h1>
						<div class="form-group">
							<label>Biographie</label>
							<div id="wysywygBiography"></div>
						</div>
						<button type="button" ng-click="completeEditBiography()" class="btn btn-add-author">Ajouter la biographie</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-save" tabindex="-1" role="dialog" aria-labelledby="modal-save">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="edit">
						<h1>Voulez-vous publier l'œuvre ?</h1>
						<div>
							<button type="button" ng-click="publish(true)" class="btn btn-add-publish">Oui, je publie</button>
						</div>
						<div>
							<button type="button" ng-click="publish(false)" class="btn btn-add-publishNo">Non, j'enregistre</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="#0" class="cd-top">Top</a>
	<?php include($_SERVER['DOCUMENT_ROOT']."/html/footer.php") ?>
	<script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"   integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI="   crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="http://vjs.zencdn.net/5.8.8/video.js"></script>
	<script src="/lib/caroussel/owl.carousel.js"></script>
	<script src="/lib/overview/js/lightbox.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<script src="/lib/input-tags/ng-tags-input.min.js"></script>
	<script src="/lib/dropzone/dropzone.js"></script>
	<script src="/lib/autocomplete/jquery.easy-autocomplete.js"></script>
	<script src="/lib/cookies/angular-cookies.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-sanitize.js"></script>
	<script src="https://code.angularjs.org/1.4.5/angular-touch.js"></script>
	<script src="https://npmcdn.com/draggabilly@2.1/dist/draggabilly.pkgd.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj9L77r-tVMiQNKm0iDaqYVnbjRO57HPc&sensor=false&signed_in=true&libraries=drawing,places"></script>
	<script src="/lib/back-to-top/js/modernizr.js"></script>
	<script src="/lib/back-to-top/js/backtotop.js"></script>
	<script src="/js/header.js"></script>
	<script src="/js/app.js"></script>
	<script src="/js/navAdmin.js"></script>
	<script src="/js/pageArt.js"></script>
	<script src="/js/search.js"></script>
</body>
</html>
