<?php $pager->setSurroundCount(2) ?>

<div class="flex justify-center mt-9 space-x-2 text-base font-semibold text-gray-400 items-center">
    <?php if ($pager->hasPrevious()) : ?>
        <a href="<?= $pager->getPreviousPage() ?>" class="py-1 px-3 bg-gray-200 rounded"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <a href="<?= $pager->getFirst() ?>" class="py-1 px-3 bg-gray-200 rounded"> <?= $pager->getFirstPageNumber() ?> </a>
        <ion-icon name="ellipsis-horizontal" class="text-lg -mb-4"></ion-icon>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <a href="<?= $link['uri'] ?>" class="py-1 px-2 bg-gray-200 rounded <?= $link['active'] ? 'text-gray-600' : '' ?>"> <?= $link['title'] ?></a>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <ion-icon name="ellipsis-horizontal" class="text-lg -mb-4"></ion-icon>
        <a href="<?= $pager->getLast() ?>" class="py-1 px-2 bg-gray-200 rounded"> <?= $pager->getLastPageNumber() ?> </a>
        <a href="<?= $pager->getNextPage() ?>" class="py-1 px-2 bg-gray-200 rounded"> <ion-icon name="arrow-forward-outline"></ion-icon> </a>
    <?php endif ?>
    
</div>