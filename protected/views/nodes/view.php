<?php
/* @var $this NodesController */
/* @var $model Nodes */

$this->breadcrumbs=array(
	'Nodes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Nodes', 'url'=>array('index')),
	array('label'=>'Create Nodes', 'url'=>array('create')),
	array('label'=>'Update Nodes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Nodes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nodes', 'url'=>array('admin')),
);
?>

<h1>View Nodes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'text',
		'date_create',
		'date_update',
		'user_id',
		'category_id',
		'parent_id',
	),
)); ?>
