<!doctype html>
<html lang="fr">

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/css/magic.min.css">
    <link rel="stylesheet" href="/lib/caroussel/owl.carousel.css">
    <link href="/lib/overview/css/lightbox.css" rel="stylesheet">
    <link href="/lib/input-tags/ng-tags-input.bootstrap.min.css" rel="stylesheet">
    <link href="/lib/input-tags/ng-tags-input.min.css" rel="stylesheet">
    <link href="/lib/dropzone/dropzone.min.css" rel="stylesheet">
    <link href="/lib/dropzone/basic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <title>1% artistique</title>
  </head>

  <body ng-app="myApp">
    <div ng-controller="artList">
      <table class="table">
        <thead class="thead-default">
          <tr>
            <th>Nom oeuvre</th>
            <th>Publier</th>
            <th>Supprimer</th>
          </tr>
        </thead>
        <tbody>
          <!-- If the art is not published (IsPublic = 0), then displays it on a red background with the "Publier" -->
          <tr class="danger" ng-repeat="oeuvre in allOeuvre" ng-if="oeuvre.isPublic == 0">
            <td>{{oeuvre.name}}</td>
            <td> <button type="button" ng-click="publishArt(oeuvre.name)" class="btn btn-default">Publier</button> </td>
            <td> <button type="button" ng-click="deleteArt(oeuvre.name)" class="btn btn-danger">Supprimer</button> </td>
          </tr>
          <!-- If the art is published (IsPublic = 1), then displays it on a green background with the "Dépublier" -->
          <tr class="success" ng-repeat="oeuvre in allOeuvre" ng-if="oeuvre.isPublic == 1">
            <td>{{oeuvre.name}}</td>
            <td ng-if="oeuvre.isPublic == 1"> <button type="button" ng-click="unPublishArt(oeuvre.name)" class="btn btn-default">Dépublier</button> </td>
            <td> <button type="button" ng-click="deleteArt(oeuvre.name)" class="btn btn-danger">Supprimer</button> </td>
          </tr>
        </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js" integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="http://vjs.zencdn.net/5.8.8/video.js"></script>
    <script src="/lib/caroussel/owl.carousel.js"></script>
    <script src="/lib/overview/js/lightbox.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
    <script src="/lib/input-tags/ng-tags-input.min.js"></script>
    <script src="/lib/dropzone/dropzone.js"></script>
    <script src="/lib/fso/fso.min.js"></script>
    <!-- <script src="/js/oeuvre.js"></script> -->
    <script src="/js/listeOeuvre.js"></script>
  </body>

</html>