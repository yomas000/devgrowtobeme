<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card p-5">
        <form action="/admin" class="form" method="post">
            <div class="form-group">
                <label>Confomation Code:</label>
                <input class="form-control" type="number" name="confCode">
            </div>
            <div class="container d-flex justify-content-center">
                <input class="btn btn-primary" type="submit">
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>