<?php $v->layout("_theme", ["title" => "Home"]); ?>

<section id="ranking">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Ranking</h1>
            </div>

            <div id="ranking-table" class="col-md-8 mx-auto table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Points</th>
                        <th scope="col" class="text-center">Total Remaining Balls</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



<section id="matches">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Macthes</h1>

                <select id="friends_select" onchange="search_win(this.value)">
                    <option value="">Select Friend Winner</option>
                </select>
            </div>

            <div id="matches-table" class="col-md-8 mx-auto table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Date</th>
                        <th scope="col" class="text-center">Winner</th>
                        <th scope="col" class="text-center">Loser</th>
                        <th scope="col" class="text-center">Forfeit</th>
                        <th scope="col" class="text-center">View</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



<?php $v->start("js"); ?>
<script>
    function load(action){
        var load_div = $("#ajax_loader");

        if(action === "open"){
            load_div.fadeIn().css("display", "flex");
        } else{
            load_div.fadeOut();
        }
    }
    $(function(){


        //Get Ranking
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/api/ranking",
            beforeSend: function(){
              load("open");
            },
            success: function (result) {
                $.each(result, function( index, value ) {
                    var win = '';
                    if(index == 0){
                        win = '<i class="fa fa-trophy yellow" aria-hidden="true"></i>';
                    }

                    var u = index +1;
                    $("#ranking-table tbody").append(
                        '<tr>'+
                            '<th class="text-center" scope="row">'+u+'</th>'+
                                '<td class="text-center"><a href="/friend/'+value['id']+'">'+value['name']+'</a> '+win+'</td>'+
                                '<td class="text-center">'+value['points']+'</td>'+
                                '<td class="text-center">'+value['balls']+'</td>'+
                            '</tr>'
                    );
                })
            },
            complete: function (){
                getFriends();
            }
        });

        function getFriends(){
            //Get Match
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/api/friends",
                success: function (res) {
                    $.each(res, function( index, value ) {

                        $("#friends_select").append(
                            '<option value="'+value["id"]+'">'+
                                value['name']+
                            '</options>'
                        );
                    })
                },
                complete: function (){
                    getMatches();
                }
            });
        }

        function getMatches(){
            //Get Match
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/api/matches",
                success: function (res) {
                    $.each(res, function( index, value ) {
                        var forfeit = '';
                        if(value['forfeit'] == 0){
                            forfeit = '<i class="fa fa-circle green" aria-hidden="true"></i>';
                        }else{
                            forfeit = '<i class="fa fa-circle gray" aria-hidden="true"></i>';
                        }

                        $("#matches-table tbody").append(
                            '<tr>'+
                            '<th class="text-center" scope="row">'+value['date']+'</th>'+
                            '<td class="text-center"><a href="/friend/'+value['winner_id']+'">'+value['winner_name']+'</a></td>'+
                            '<td class="text-center"><a href="/friend/'+value['loser_id']+'">'+value['loser_name']+'</a></td>'+
                            '<td class="text-center">'+forfeit+'</td>'+
                            '<td class="text-center"><a href="/match/'+value['id']+'"><i class="fa fa-external-link-square" aria-hidden="true"></i></a></td>'+
                            '</tr>'
                        );
                    })
                },
                complete: function (){
                    load("close");
                }
            });
        }
    })



    function search_win(v){
        var url = '/api/matches/'+v;

        if(v == ''){
            url = '/api/matches';
        }

        //Get Match
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            beforeSend: function(){
                load("open");
            },
            success: function (res) {
                $("#matches-table tbody").html('');
                $.each(res, function( index, value ) {
                    var forfeit = '';
                    if(value['forfeit']){
                        forfeit = '<i class="fa fa-circle green" aria-hidden="true"></i>';
                    }else{
                        forfeit = '<i class="fa fa-circle gray" aria-hidden="true"></i>';
                    }

                    $("#matches-table tbody").append(
                        '<tr>'+
                        '<th class="text-center" scope="row">'+value['date']+'</th>'+
                        '<td class="text-center"><a href="/friend/'+value['winner_id']+'">'+value['winner_name']+'</a></td>'+
                        '<td class="text-center"><a href="/friend/'+value['loser_id']+'">'+value['loser_name']+'</a></td>'+
                        '<td class="text-center">'+forfeit+'</td>'+
                        '<td class="text-center"><a href="/match/'+value['id']+'"><i class="fa fa-external-link-square" aria-hidden="true"></i></a></td>'+
                        '</tr>'
                    );
                })
            },
            complete: function (){
                load("close");
            }
        });
    }


</script>
<?php $v->end(); ?>
