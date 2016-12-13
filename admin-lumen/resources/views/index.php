<!DOCTYPE html>
<html>
<head>
    <title>Admin - Emine Hakan - Ostéopathe DO</title>

    <link rel="stylesheet" type="text/css" href="/stylesheets/theme.css">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <p>
                <img src="images/logo.png">
            </p>
            <h2 class="text-primary">Emine Hakan - Ostéopathe D.O.<br><small>Gestion des articles</small></h2>
        </div>

        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h2 class="text-center">Ajouter un article</h2>
                    <br>
                    <form>
                        <div class="form-group">
                            <label for="url">Url de la page</label>
                            <input type="text" name="url" class="form-control">
                        </div>
                        <button class="btn btn-primary add-article" type="button">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>

        <div>
            <h2>Liste des articles</h2>
            <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Lien</th>
                    <th style="min-width: 113px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="images/article.jpg" alt="" style="width: 200px;">
                    </td>
                    <td>Qu'est-ce que les facias ?</td>
                    <td>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum</td>
                    <td>http://lien-de-mon-article/category/article.com</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="actions">
                            <a href="#" class="btn btn-primary">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="#" class="btn btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="images/article.jpg" alt="" style="width: 200px;">
                    </td>
                    <td>Qu'est-ce que les facias ?</td>
                    <td>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum</td>
                    <td>http://lien-de-mon-article/category/article.com</td>
                    <td>
                        <div class="btn-group">
                            <a href="#" class="btn btn-primary">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="#" class="btn btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="images/article.jpg" alt="" style="width: 200px;">
                    </td>
                    <td>Qu'est-ce que les facias ?</td>
                    <td>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum</td>
                    <td>http://lien-de-mon-article/category/article.com</td>
                    <td>
                        <div class="btn-group">
                            <a href="#" class="btn btn-primary">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="#" class="btn btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>

        <hr>

        <div class="panel">
            <div class="panel-footer">
                Un peu d'explications seront peut-être nécessaires...
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var button = document.querySelector('.add-article');
        button.addEventListener('click', getInfo)

        function getInfo () {
            console.log('test');

            var url = 'http://www.etpourquoipascoline.fr/2016/12/onze-marques-de-chaussures-veganes/';
            var encodedUrl = encodeURIComponent(url);

            var requestUrl = 'http://opengraph.io/api/1.0/site/' + encodedUrl ;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', requestUrl, true);
            xhr.send(null);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    console.log(xhr.responseText);
                }
            };
        }
    </script>
</body>
</html>

