<?php
global $imageIds;
$images = [];
foreach ($imageIds as $image) {
    $images[wp_get_attachment_image_src($image, '')[0]] = wp_get_attachment_image_src($image)[0];
}

$first = array_keys($images)[0];
?>

<div class="row" style="margin-bottom: 24px;">
    <div class="col-xs-12">
        <img id="main-carousel" src="<?= $first ?>" style="width: 100%"/>
    </div>
</div>
<?php $i = 0; ?>
<?php foreach ($images as $src => $thumbnail): ?>
    <?php if ($i == 0 || $i % 4 == 0): ?>
        <div class="row">
    <?php endif; ?>
    <div class="col-xs-3">
        <img class="gallery-thumb <?= $src == $first ? 'active' : ''?>" src="<?= $thumbnail ?>" data-src="<?= $src ?>"/>
    </div>
    <?php if ($i % 4 == 3): ?>
        </div>
    <?php endif; ?>
    <?php $i++; ?>
<?php endforeach; ?>

<script>
    $(document).ready(function(e){
        $('.gallery-thumb').click(function(e){
            $('.active').removeClass('active');
            $('#main-carousel').attr('src', $(this).attr('data-src'));
            $(this).addClass('active');
        });
    });
</script>

<style>
    .gallery-thumb {
        margin-bottom: 24px;
    }

    .gallery-thumb.active {
        border: 5px solid rgb(49, 208, 21);
        max-width: 140px;
        max-height: 140px;
        border-radius: 5px;
        margin-bottom: 0px;
    }
</style>