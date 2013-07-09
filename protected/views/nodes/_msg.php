<?php  
$d=array();

setcookie('noticount', count($model), time()+123456789000);

foreach( $model as $v )
{
	//$d[]['message']=$v->message;
	//$d[]['user_receive_id']=$v->user_receive_id;
	//$d[]['user_send_id']=$v->user_send_id;
	//$d[]['datetime_noti']=$v->datetime_noti;
	//$d[]['node_id']=$v->node_id;
	//$d[]['Isreaded']=$v->Isreaded;
	
	echo 
	'
	$(\'.comment'.$v->node_id.'\').append(
	\'<p>\'+
		\'<img width="30" src="#" /> \'+
		\'kkk พูดว่า: \'+
	\'</p>\'+
	\'<p style="padding-left: 34px;">'.$v->message.'</p>\'
	);
	';
	
}


echo '$("#notificationSummary").text('. count($model) .');';


?>