<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Games</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Users</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Games-tab">
        <h1>Games</h1>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="Users-tab">
        <h1>Users</h1>
    </div>
</div>

<?= $this->endSection(); ?>