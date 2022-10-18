<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <form method="post" action="/reset">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="text" class="form-control" name="password" id="pass">
        </div>
        <input type="submit" class="btn btn-primary" value="Enter">
    </form>
</div>
<?= $this->endSection() ?>