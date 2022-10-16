<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="style.css">

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Games</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Users</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent" role="tablist">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Games-tab">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Game name</th>
                    <th scope="col">Game Description</th>
                    <th scope="col">File Path</th>
                    <th scope="col">Image Path</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody id="adminGameTable">
                <?php for($i = 0; $i < count($gameList); $i++) : ?>
                    <tr>
                        <th><input class="form-control" type="text" value="<?= $gameList[$i]["gameName"]; ?>"></th>
                        <th><input class="form-control" type="text" value="<?= $gameList[$i]["gameDescription"]; ?>"></th>
                        <th><input class="form-control" type="text" value="<?= $gameList[$i]["filePath"]; ?>"></th>
                        <th><input class="form-control" type="text" value="<?= $gameList[$i]["imgPath"]; ?>"></th>
                        <th><button class="btn btn-success" id="u<?=$gameList[$i]['id'] ?>">Update</button></th>
                        <th><button class="btn btn-danger" id="d<?=$gameList[$i]['id'] ?>">Delete</button></th>
                    </tr>
                <?php endfor ?>
            </tbody> 
        </table>
        <div class="container text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-circle hover-button" viewBox="0 0 16 16" onclick="addRow();">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </div>
    </div>
    <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="Users-tab">
        <h1>Users</h1>
    </div>
</div>

<?= $this->endSection(); ?>