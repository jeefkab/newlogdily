<h1>
<pre>
	
<?php 

$u = Users::model()->findAll();
$users=array();
foreach ($u as $v) {
	$users[$v->username]=$v->password;
}

print_r($users);


?>

</h1>