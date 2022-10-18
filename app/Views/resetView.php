<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <?php if (!$success) : ?>
        <form method="post" action="<?= "/reset/" . strVal($id) ?>">
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
    <?php endif ?>
    <?php if ($success) : ?>
        <div class="card text-center">
            <h1 class="btn btn-success">Success</h1>
            <a href="/"><h3 class="">Go Home</h1></a>
        </div>
    <?php endif ?>
</div>
<?= $this->endSection() ?>