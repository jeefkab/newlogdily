<?php
/* @var $this NodesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Nodes',
);

$this->menu=array(
    array('label'=>'Create Nodes', 'url'=>array('create')),
    array('label'=>'Manage Nodes', 'url'=>array('admin')),
);
?>

<h1>ทามไลน์บุญ </h1>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nodes-form',
	//'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'htmlOptions' => array( 'enctype'=>'multipart/form-data', ),
    )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model,'text'); ?>
        <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'text'); ?>
	</div>

    <div class="row">
    	<?php echo $form->labelEx($model, 'picture'); ?>
        <?php echo CHtml::activeFileField($model, 'picture'); ?> 
        <?php echo $form->error($model, 'picture'); ?>
    </div>


	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
        
    <hr>

<?php $this->endWidget(); ?>
    
</div><!-- form -->


<?php 
foreach ($dataProvider as $k => $v) {
    
?>    
    
    <div style="box-sizing: border-box; ">
		<div style="" id="profile">
			
			<p>
				<img width="50" src="<?php echo Yii::app()->baseUrl.'/profilepicture/'.CHtml::decode($v->users->picture); ?>"> 
			<!-- <a href=""><?php echo $v->users->firstname; ?></a> -->
				 <?php echo CHtml::link($v->users->firstname, array('users/'.$v->users->id)); ?>
			</p>
			
		</div>
        <div style="float: left; padding-left: 52px;">
		
			<!-- <p>Title: <?php echo CHtml::decode($v['title']); ?></p>-->
            <p ><?php echo CHtml::decode($v['text']); ?></p>
            <p>
				<?php if($v['picture']){ ?>
				<img src="<?php echo Yii::app()->baseUrl.'/picture/'.CHtml::decode($v['picture']); ?>" width="100"> 
				<?php } ?>
			</p>
			
			<div class="comment comment<?php echo $v['id']; ?>">
				<?php 
					$comment = Nodes::model()->findAll(
						array(
							'order'=>'date_create asc'
							, 'condition'=>'parent_id=:parent_id'
							, 'params'=>array(':parent_id'=> $v['id'] )
						)
					);
				foreach( $comment as $vc ){					
				?>
				<p>
					<img width="30" src="<?php echo Yii::app()->baseUrl.'/profilepicture/'.$vc->users->picture; ?>" /> 
					<?php echo urldecode($vc->users->firstname); ?> พูดว่า: 
				</p>
				<p style="padding-left: 34px;"><?php echo urldecode($vc->text); ?></p>
				<?php } ?>
			</div>
			
            <p>
				<textarea id="text<?php echo $v['id']; ?>" style="height: 30px; padding:0; margin:0;"></textarea> 
				<button style="height: 30px; padding:0; margin:0;" onclick="sendComment('<?php echo CHtml::decode($v['id']); ?>', 'text<?php echo $v['id']; ?>', '<?php echo $v->users->id; ?>');">Send</button>
			</p>
			
        </div>
        
        <div style="clear: both;">
            
            <span onclick="playSatoo(); doSatoo('<?php echo CHtml::decode($v['id']); ?>');">
                <img src="<?php echo Yii::app()->baseUrl.'/images/satoo.png'; ?>" >
            </span>
            <span><?php 
                // satoo
                $satoo = Satoo::model()->findAllByAttributes(
                    array(),
                    $condition = 'node_id=:node_id',
                    $params = array(':node_id'=>$v['id'])
                );
                
                foreach ($satoo as $v) {
                    echo $v->users->firstname.' ';
                }
            ?> <?php if(count($satoo)!=0) { ?>สาธุในสิ่งนี้<?php } ?></span>
        </div>
    </div>
    <div style="border-bottom: 1px #fff solid; clear: both; margin-bottom: 5px; padding-bottom: 5px;"></div>

<?php } ?>

<div id="satoo_element"></div>
<script>

function playSatoo(){
    var sound_file_url='<?php echo Yii::app()->baseUrl.'/sound/'; ?>satoo.mp3';

    document.getElementById("satoo_element").innerHTML= 
    "<embed src='"+sound_file_url+"' hidden=true autostart=true loop=false>";
}

function doSatoo(nodeid){
    $(function(){
        $.get('<?php echo Yii::app()->baseUrl.'/nodes/dosatoo?nodeid='; ?>'+nodeid , function(data) {
            //$('.result').html(data);
        });
    });
}

//$(function(){
function sendComment(nodeid, textid, owner){
	
	if ( $('#'+textid).val().trim()=='' )
	{
		return;
	}
	
	$.post( '<?php echo Yii::app()->baseUrl.'/nodes/comment'; ?>' , 
	{ nodeid: nodeid, text: $('#'+textid).val(), nodeowner: owner, YII_CSRF_TOKEN:'<?php echo Yii::app()->request->csrfToken; ?>' } , 
	function(data) {
	
		$('.comment'+nodeid).append(
		'<p>'+
			'<img width="30" src="<?php if( isset(Yii::app()->user->picture) ){ echo Yii::app()->baseUrl.'/profilepicture/'.Yii::app()->user->picture; ?>" /> '+
			'<?php echo Yii::app()->user->firstname; } ?> พูดว่า: '+
		'</p>'+
		'<p style="padding-left: 34px;">'+$('#'+textid).val()+'</p>'
		);
		
		// clear value textarea
		$('#'+textid).val('');
		
		console.log(data);
	});

}
//});



</script>