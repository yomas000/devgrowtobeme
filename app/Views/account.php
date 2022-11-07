<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <form class="ml-0">
                <div class="form-group">
                    <label>Feedback for inprovements or fixes</label>
                    <textarea class="form-control" id="feedbackInput"></textarea>
                </div>
            </form>
            <button class="btn btn-primary" onclick="sendFeedback();">Enter</button>
        </div>

        <div class="col">
            <?php foreach($settings as $setting) : ?>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="<?= $setting['setting'] ?>" <?php if ($setting["active"] == 1) : ?> checked <?php endif; ?> onclick="updateSetting(this);">
                    <label class="custom-control-label" for="<?= $setting['setting'] ?>"><?= $setting['setting'] ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?= $this->endSection() ?>