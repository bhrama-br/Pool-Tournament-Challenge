<?php $v->layout("_theme", ["title" => "Home"]); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-header">
                        <?= $friend->name . ' ' . $friend->lastName; ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="card-title">Wins: <?= $wins; ?></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="card-title">Losses: <?= $losses; ?></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="card-title">Points: <?= $friend->points; ?></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="card-title">Balls: <?= $friend->balls; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Date</th>
                                        <th scope="col" class="text-center">Winner</th>
                                        <th scope="col" class="text-center">Loser</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataMatch as $match){ ?>
                                        <tr>
                                            <th class="text-center" scope="row"><?= $match['date'] ?></th>
                                            <td class="text-center"><a href="/friend/<?= $match['winner_id'] ?>"><?= $match['winner_name'] ?></a></td>
                                            <td class="text-center"><a href="/friend/<?= $match['loser_id'] ?>"><?= $match['loser_name'] ?></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $v->start("js"); ?>


<?php $v->end(); ?>
