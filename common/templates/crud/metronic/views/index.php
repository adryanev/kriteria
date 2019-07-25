<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-graph-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= "<?= " ?>Html::encode($this->title) ?> <small>portlet sub title</small>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">


                    <p>
                        <?= "<?= " ?>Html::a(<?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>
                    <?php if(!empty($generator->searchModelClass)): ?>
                        <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?php endif; ?>

                    <?php if ($generator->indexWidgetType === 'grid'): ?>
                        <?= "<?= " ?>GridView::widget([
                        'dataProvider' => $dataProvider,
                        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
                        ['class' => 'yii\grid\SerialColumn'],

                        <?php
                        $count = 0;
                        if (($tableSchema = $generator->getTableSchema()) === false) {
                            foreach ($generator->getColumnNames() as $name) {
                                if (++$count < 6) {
                                    echo "            '" . $name . "',\n";
                                } else {
                                    echo "            //'" . $name . "',\n";
                                }
                            }
                        } else {
                            foreach ($tableSchema->columns as $column) {
                                $format = $generator->generateColumnFormat($column);
                                if (++$count < 6) {
                                    echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                } else {
                                    echo "            //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                }
                            }
                        }
                        ?>

                        ['class' => 'yii\grid\ActionColumn'],
                        ],
                        ]); ?>
                    <?php else: ?>
                        <?= "<?= " ?>ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                        },
                        ]) ?>
                    <?php endif; ?>

                    <?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>

                </div>
            </div>
            <div class="kt-portlet__foot kt-hidden">
                <div class="row">
                    <div class="col-lg-6">
                        Portlet footer:
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <span class="kt-margin-left-10">or <a href="#" class="kt-link kt-font-bold">Cancel</a></span>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



