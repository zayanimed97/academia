<div class="flex justify-center mt-9 space-x-2 text-base font-semibold text-gray-400 items-center">
    <?php if (!$isFirstPage) : ?>
        <a href="<?= $previous ?>" class="py-1 px-3 bg-gray-200 rounded"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <!-- <a href="<?= $firstUrl ?>" class="py-1 px-3 bg-gray-200 rounded"> 1 </a> -->
        <!-- <ion-icon name="ellipsis-horizontal" class="text-lg -mb-4"></ion-icon> -->
    <?php endif ?>

    <?php foreach ($pages as $link) : ?>
        <a href="<?= $link['url'] ?>" class="py-1 px-2 bg-gray-200 rounded <?= $link['active'] ? 'text-gray-600' : '' ?>"> <?= $link['pageNumber'] ?></a>
    <?php endforeach ?>

    <?php if (!$isLastPage) : ?>
        <!-- <ion-icon name="ellipsis-horizontal" class="text-lg -mb-4"></ion-icon> -->
        <!-- <a href="<?= $lastUrl ?>" class="py-1 px-2 bg-gray-200 rounded"> <?= $totalPages ?> </a> -->
        <a href="<?= $next ?>" class="py-1 px-2 bg-gray-200 rounded"> <ion-icon name="arrow-forward-outline"></ion-icon> </a>
    <?php endif ?>
    
</div>