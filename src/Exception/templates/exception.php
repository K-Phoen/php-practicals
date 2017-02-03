<style>
    li.trace {
        padding: 5px 0 5px 0;
    }

    .excerpt {
        padding-top: 5px;
    }

    li.selected {
        background-color: lightyellow;
        padding-top: 2px;
        padding-bottom: 2px;
    }

    em {
        color: lightgray;
    }
</style>

<div style="width: 70%; margin: 10px auto">
    <h1><?= empty($message) ? 'Ooops, something went wrong!' : $message ?></h1>
    <p>Stack Trace:</p>
    <ol>
        <?php foreach ($trace as $infos) : ?>
            <li class="trace">
                <?php if (isset($infos['excerpt'])) : ?>
                    <?= $infos['file'] ?> line <strong><?= $infos['line'] ?></strong>
                    <?= $infos['excerpt'] ?>
                <?php else: ?>
                    at <strong><?= empty($infos['class']) ? '' : $infos['class'] . $infos['type'] ?><?= $infos['function'] ?></strong>()

                    <?php if (isset($infos['file'])) : ?>
                        <br />
                        <em>in <?= $infos['file'] ?> line <?= $infos['line'] ?></em>
                    <?php endif; ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
