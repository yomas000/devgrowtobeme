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
            <?php for($i = 0; $i < count($scores); $i++) : ?>
                <tr>
                    <th scope="row"><?= $i + 1?></th>
                    <td><?= $scores[$i]["username"] ?></td>
                    <td><?= $scores[$i]["score"] ?></td>
                </tr>
            <?php endfor ?>
        </tbody> 
    </table>
<?= $this->endSection() ?>