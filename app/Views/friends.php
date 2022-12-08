<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Friends</a>
    </li>
</ul>


<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <?php if (isset($scores)) : ?>
            <div class="row">
                <?php foreach ($scores as $score) : ?>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-10">
                                <h2><?= $score["username"] ?></h2>
                            </div>
                            <div class="col-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" class="bi bi-file-minus" viewBox="0 0 16 16" id="<?= $score["username"] ?>" onclick="deleteFriend(this);">
                                    <path d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                </svg>
                            </div>
                        </div>
                        <table class="table">
                            <?php for ($i = 0; $i < count($score) - 1; $i++) : ?>
                                <tr>
                                    <th scope="row"><?= $score[$i]["game"] ?></th>
                                    <th scope="row"><?= $score[$i]["score"] ?></th>
                                </tr>
                            <?php endfor ?>
                        </table>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
    <div class="tab-pane fade" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
        <div id="wrapper">
            <div class="container mx-auto">
                <div id="chatbox">
                    <?=$chatContents?>
                </div>

                <div class="row container">
                    <div class="col-8">
                        <input class="form-control" name="usermsg" type="text" id="usermsg" />
                    </div>
                    <div class="col-2">
                        <input class="from-control" name="submitmsg" type="button" id="submitmsg" value="Send" onclick="sendMessage();" />
                    </div>
                </div>
            </div>
        </div>
    </div>


        <?= $this->endSection() ?>

        <?= $this->section('menu') ?>
        <link rel="stylesheet" href="style.css">
        <script src="scripts.js"></script>
        <div class="mt-0">
            <div class="card p-4 mt-2 mb-5 w-75" style="margin-right: auto; margin-left: auto;">
                <form>
                    <div class="form-group">
                        <label>Friend's Username</label>
                        <input type="text" class="form-control" id="friendName">
                    </div>
                </form>
                <div class="form-group">
                    <button class="form-control btn btn-primary" onclick="sendFriendRequest();">Enter</button>
                </div>
                <div id="status">

                </div>
            </div>
        </div>

        <?php if (isset($pendingFreinds)) : ?>
            <?php foreach ($pendingFreinds as $friend) : ?>
                <div class="card text-center p-1 mb-2" id="yesbutton">
                    <h1><?= $friend["username"] ?> has requestioned a friend</h1>
                    <p>PS They are lonely and you were chosen</p>
                    <div class="row w-50" style="margin-right: auto; margin-left:auto;">
                        <button class="col-sm-5 btn btn-primary m-2" id="<?= $friend['username'] ?>" onclick="makeFriends(this)">Make a Friend Today</button>
                        <button class="col-sm-5 btn btn-danger m-2" id="<?= $friend['username'] ?>" onclick="noFriends(this)">NO! No Friends</button>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
        <?php if (count($scores) < 1) : ?>
            <div class="container text-center w-75">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                </svg>
                <h2>Find Friends</h2>
            </div>
        <?php endif ?>


        <?= $this->endSection() ?>