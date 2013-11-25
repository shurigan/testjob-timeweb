<?php $menu = "results"; include "layout/header.tpl.php"; ?>

<table class="ui table segment" id="results">
    <thead>
    <tr>
        <th>URL</th>
        <th>Вхождений</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($results as $result): ?>
        <tr data-id="<?php echo $result->getId()?>">
            <td><?php echo $result->getUrl();?></td>
            <td><?php echo $result->getTotal()?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="ui modal"></div>

<?php include "layout/footer.tpl.php"; ?>
