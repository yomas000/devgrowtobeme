<?= $this->extend('layout') ?>

<?= $this->section('menu') ?>
<div class="row">
    <div class="col-md-6 span6" style="float: none; margin: 0 auto;">
        <?php if (!$auth) : ?>
            <button type="button" class="btn btn-primary border-0" data-toggle="modal" data-target="#exampleModalCenter">
                Sign In
            </button>
            <a href="/create"><button class="btn btn-primary border-0">Create Account</button></a>
        <?php endif; ?>
    </div>

    <div class="col-md-4" id="signin">

        <?php if ($auth) : ?>
            <link rel="stylesheet" href="style.css">
            <div class="wrapper">
                <!-- Sidebar -->
                <nav id="sidebar" class="rounded">
                    <div class="sidebar-header rounded">
                        <h4><a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Welcome <?= $username ?></a></h4>
                    </div>

                    <ul class="list-unstyled components collapse" id="homeSubmenu">

                        <li>
                            <a href="/account">Acount</a>
                        </li>

                        <li>
                            <a href="/friends">Friends</a>
                        </li>
                        <?php if ($admin) : ?>
                            <li>
                                <a href="/admin">Admin</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
        <?php endif; ?>


        <?php if (!$auth) : ?>
            <?php if (isset($error)) : ?>
                <div class='card text-center' style='background-color: #f7a028;'>
                    <h4><?= $error ?></h4>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    .card {
        padding: 10px;
        margin-bottom: 3%;
    }

    .btn {
        background-color: #4fc3cb;
    }
</style>

<div class="row">
    <?php foreach ($cards as $card) : ?>
        <div class="col-md-4">
            <div class="card">
                <h2 class="card-title"><?= $card["gameName"]; ?></h2>
                <img src="<?= $card["imgPath"] ?>" class="rounded thumbnail" alt="Image of <?= $card['gameName']; ?>" onerror="this.src='game.webp'">
                <p class="card-text"><?= $card["gameDescription"]; ?></p>

                <div class="container">
                    <div class="row">
                        <a href="/games/<?= $card["id"] ?>" class="btn col-5 mr-5">See Game</a>
                        <a href="/tables/<?= $card["id"] ?>" class="btn col-5">Scores</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>


<?= $this->endSection() ?>