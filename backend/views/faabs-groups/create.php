<?php


$this->title = 'Add FaaBS group';
$this->params['breadcrumbs'][] = ['label' => 'FaaBS groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>
</div>
