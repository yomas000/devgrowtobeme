<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <?php if (!$success) : ?>
        <form method="post" action="/resetmail">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
            </div>
            <input type="submit" class="btn btn-primary" value="Enter">
        </form>
    <?php endif ?>
</div>
<?= $this->endSection() ?>