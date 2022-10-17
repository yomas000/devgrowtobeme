<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="custom-control custom-switch col-md-5 ml-5">

            <div class="row">
                <div class="col col-lg-5">
                    <input type="checkbox" class="custom-control-input" disabled id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Family Mode</label>
                </div>
                <div class="col col-lg-5">
                    <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                    <label class="custom-control-label" for="customSwitch1">Dark Mode</label>
                </div>
                <div>

                    <form class="mt-5 ml-0">
                        <div class="form-group">
                            <label>Feedback for inprovements or fixes</label>
                            <textarea class="form-control" id="feedbackInput"></textarea>
                        </div>
                    </form>
                    <button class="btn btn-primary" onclick="sendFeedback();">Enter</button>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>