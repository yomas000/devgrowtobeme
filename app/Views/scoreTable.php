<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Place</th>
            <th scope="col">Username</th>
            <th scope="col">Score</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($scores) != 0) : ?>
            <?php foreach($scores as $score) : ?>
                <tr>
                    <th scope="row"><?= $score['place']?></th>
                    <td><?= $score["username"] ?></td>
                    <td><?= $score["score"] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?= $this->endSection() ?>