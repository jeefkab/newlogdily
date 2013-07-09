<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

?>

<h3>View user <?php echo $model->firstname; ?> <?php echo $model->lastname; ?></h3>

<p><?php if(Yii::app()->user->id != $model->id) { ?> <a href="<?php echo Yii::app()->baseUrl; ?>/users/addfriend/<?php echo $model->id; ?>" >Add to friend</a> <?php } else {?> โปรไฟล์ของคุณ <?php }?></p>
</br>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'firstname',
        'lastname',
        'username',
        'age',
        'sex',
        'address',
        'email',
        'telephone',
    //    'permission',
		
        array(
            'label' => 'profile picture',
            'type' => 'raw',
            //'value' => html_entity_decode(CHtml::image(Yii::app()->baseUrl . '/profilepicture/'.
            //        $model->picture ,'alt',array('width'=>100,'height'=>100))),
            'value' => html_entity_decode(CHtml::image(Yii::app()->baseUrl . '/profilepicture/'.
                    $model->picture ,'alt',array('style'=>'max-height: 100px;'))),
        ), 
        'group_id',
    ),
));
?>
