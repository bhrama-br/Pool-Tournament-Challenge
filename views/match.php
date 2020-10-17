<?php $v->layout("_theme", ["title" => "Home"]); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-header">
                        Match
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <h5 class="card-title">Date:</h5>
                                <h5><?= $match->date; ?></h5>
                            </div>
                            <div class="col-md-2">
                                <h5 class="card-title">Winner:</h5>
                                <h5><?= $match->winner()->name; ?></h5>
                            </div>
                            <div class="col-md-2">
                                <h5 class="card-title">Loser:</h5>
                                <h5><?= $match->winner()->lastName; ?></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="card-title">Remaining Balls:</h5>
                                <h5><?= $match->remaining_balls; ?></h5>
                            </div>
                            <div class="col-md-2">
                                <h5 class="card-title">Status:</h5>
                                <h5><i class="fa fa-circle <?= ($match->forfeit) ? 'green' : 'gray'; ?>" aria-hidden="true"></i></h5>
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
