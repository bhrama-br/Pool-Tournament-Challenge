<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pool - <?= $title; ?></title>

    <script src="https://use.fontawesome.com/dc70991b52.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= url("/views/assets/css/style.css"); ?>" />

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Pool Tournament Challenge</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link btn-new" href="#"  data-toggle="modal" data-target="#newMatch">New Match</a>
                </li>


            </ul>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="newMatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Match</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/match-create" id="new-match" method="POST">
                        <div class="form-group">
                            <label for="win">Winner</label>
                            <select name="win" id="win" class="form-control" onchange="getFriendLoser(this.value)" required>
                                <option value="">Select Winner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="loser">Loser</label>
                            <select name="loser" id="loser" class="form-control" required>
                                <option value="">Select Loser</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" placeholder="Date" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Remaining Balls</label>
                            <input type="number" name="balls" id="number" min="0" max="7" class="form-control" placeholder="Balls" required>
                        </div>
                        <div class="form-group">
                            <label for="forfeit">Was the game forfeited?</label>
                            <select name="forfeit" id="forfeit" class="form-control" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

<?= $v->section("content"); ?>

<div id='ajax_loader'>
    <div class="spinner-grow text-secondary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>



<script src="<?= url("/views/assets/js/jquery-3.5.1.min.js"); ?>" ></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script>
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/api/friends",
            success: function (res) {
                $.each(res, function( index, value ) {

                    $("#new-match #win").append(
                        '<option value="'+value["id"]+'">'+
                            value['name']+' ' + value['lastName'] +
                        '</options>'
                    );
                })
            }
        });


        function getFriendLoser(v){
            $("#new-match #loser").html('<option value="">Select Loser</option>');
            if(v == ''){

            }else{
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "/api/match-loser/"+v,

                    success: function (result) {
                        $.each(result, function( index, value ) {
                            $("#new-match #loser").append(
                                '<option value="'+value["id"]+'">'+
                                value['name']+' ' + value['lastName'] +
                                '</options>'
                            );
                        })
                    }
                });
            }
        }
    </script>

<?= $v->section("js"); ?>

</body>
</html>