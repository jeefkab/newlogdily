<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="th" lang="th">
<head>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<meta name="keyword" content="เก็บบุญ, ทำบุญ, บันทึกบุญ, ทำทาน, ปล่อยนก, บันทึกบุญกุศล">
	<meta name="description" content="เว็บไซต์สำหรับบันทึกความดี">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	
	<meta charset="utf-8" />
	<meta name="language" content="th" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
		
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/prettify.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
	
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/kendoui/styles/kendo.common.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/kendoui/styles/kendo.default.min.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/kendoui/js/kendo.web.min.js"></script>

	<?php Yii::app()->clientScript->registerCoreScript('cookie'); ?>
	
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shiv.js"></script>
	<![endif]-->
        
</head>

<body>

    <div class="container">
		
        <div class="row-fluid">
            <div class="span12 controll-menu">

                    <!-- <nav class="nav">
                    <ul>
                        <li class="current"><a href="#">profile</a></li>
                        <li><a href="#">setting</a></li>
                        <li><a href="#">friend</a></li>
                        <li><a href="#">logout</a></li>
                        <li><a href="#"><input type="text" id="search" value="search" ></a></li>
                    </ul>
                </nav>-->

                <div id="mainmenu">
                    <?php
					if ( isset(Yii::app()->user->firstname) )
						$firstname = Yii::app()->user->firstname;
					else
						$firstname = '';					
					
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Home', 'url' => array('/site/index')),
                            array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                            array('label' => 'Contact', 'url' => array('/site/contact')),
                            array('label' => 'Login', 'url' => array('/site/login'), 
                                'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Logout (' . $firstname . ')', 
                                'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                    ));
                    ?>
                </div><!-- mainmenu -->
                
                <?php
//                    $this->widget('CStarRating',array(
//                        //'model'=>$model,
//                        //'attribute'=>'rating',
//                        'name'=>'rating1',
//                        'value'=>3,
//                    ));
//                    
//                    $this->widget('CMaskedTextField',array(
//                        //'model'=>$model,
//                        //'attribute'=>'date',
//                        'name'=>'date',
//                        'mask'=>'99.99.9999',
//                        'htmlOptions'=>array(
//                            'style'=>'width:80px;'
//                        ),
//                    ));

                ?>

            </div>
        </div>
		
        <div class="row-fluid">
            <div class="span12 header">
			<?php 
			// check variable login
			if( isset(Yii::app()->user->id) ){ 
			?>
				<img src="<?= Yii::app()->baseUrl.'/profilepicture/'.Yii::app()->user->picture; ?> " width="100" /> 
                notification : 
				<?php 				
				$model=Notify::model()->findAll(
					array(
						'order'=>'datetime_noti desc' , 
						'condition'=>':user_receive_id=user_receive_id' , 
						'params'=>array(':user_receive_id'=> Yii::app()->user->id )
					)
				);				
				$numnoti= count( $model );		
				
				$friendModel=Friend::model()->findAll(
					array(
						'condition'=>':to_id = to_id and status_id = 1 ' , 
						'params'=>array(':to_id'=> Yii::app()->user->id )
					)
				);				
				
				
				?>
				<span id="notificationSummary"><?php echo $numnoti; ?></span>
				&nbsp;userid : <?= Yii::app()->user->id; ?> 
				&nbsp;firstname : <?= Yii::app()->user->firstname; ?> 
				&nbsp;permission : <?= Yii::app()->user->permission; ?> 
				
				<div><br>
					<?php
						foreach( $friendModel as $v )
						{
							echo '<button onclick="acceptFriend('.$v->id
							.');"> ตอบรับการเป็นเพื่อนกับ '. $v->id.$v->response_friend->firstname
							.'</button>';
							
						//	print_r( $v );
						}
						//print_r( $friendModel );
					?>
				</div>
				
				<div id="notification-bar"></div>
				<br>
				
				<script>
					$("#notification-bar").kendoPanelBar({
						dataSource: [
							{
								text: "การแจ้งเตือน ", imageUrl: "<?php echo Yii::app()->request->baseUrl; ?>/kendoui/examples/content/shared/icons/sports/baseball.png",
								items: [
								<?php 
								$i=0;
								foreach( $model as $v ){ 
								$i++;
								?>
								<?php if( $i != 1 ) echo ','; ?>{ text: "<?php echo $v->message; ?>", imageUrl: "<?php echo Yii::app()->request->baseUrl; ?>/kendoui/examples/content/shared/icons/16/star.png" }								
								<?php } ?>								
								]
							}
						]
					});
				</script>
				
				<?php } ?>
            </div>
        </div>
	
	  <div class="row-fluid left-bar">
	    <div class="span3 leftbar">
		
                <?php echo CHtml::link('Nodes', array('nodes/index') ); ?><br>
                <?php echo CHtml::link('Users', array('users/index') ); ?><br>
                <?php echo CHtml::link('Category', array('category/index') ); ?><br>
                    
                <ul>
                    <?php foreach (Category::model()->findAll() as $v){ ?>
                    <li><a href="#"><?php echo $v->name; ?></a></li>
                    <?php } ?>
                </ul>    
                    
	      <!--Sidebar content-->
	    </div>
	    <div class="span9 content">
                <?php echo $content; ?>
                <div class="clear"></div>
	      <!--Body content-->
	    </div>
	  </div>	
            <div class="row-fluid">
                <div class="span12 footer">
                    footer
                </div>
            </div>	
	</div>
    
<script>
function checkUpdateComment(){
	$.post( '<?php echo Yii::app()->baseUrl; ?>/nodes/checkUpdateComment' , 
		{timeupdate: '<?=time(); ?>' , YII_CSRF_TOKEN:'<?php echo Yii::app()->request->csrfToken; ?>' } ,
		function(data){
			if ( $.cookie('noticount') != parseInt( $("#notificationSummary").text() ) )
			{
				eval( data );
			}		
		}
	);
}

// checkupdate comment
function reCheckUpdateComment(){	
	//setInterval('checkUpdateComment()', 3000);	
}

$(function(){
	// when ready loaded then reCheckUpdateComment
	reCheckUpdateComment();
});

function acceptFriend(id){
	$.post( '<?php echo Yii::app()->baseUrl; ?>/users/acceptfriend' , 
		{friend_id: id , YII_CSRF_TOKEN: '<?php echo Yii::app()->request->csrfToken; ?>' } ,
		function(data){
			alert('เพิ่มเป็นเพื่อนแล้ว');
			location.href=location.href;
		}
	);
}

</script>

</body>
</html>
