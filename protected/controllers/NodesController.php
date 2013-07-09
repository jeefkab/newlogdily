<?php

class NodesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(

            array('allow', // allow all users to perform 'index' and 'view' actions
            //    'actions' => array('index', 'view', 'create', 'update', 'comment', 'do' ),
                'users' => array('@'),
            ),

            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),    
			
           
			array('deny',  // deny all anonymous
				'actions' => array('index', 'view', 'create', 'update', 'comment', 'do' ),
				'users'=>array('*'),
			),
         
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Nodes;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Nodes'])) {
            $model->attributes = $_POST['Nodes'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Nodes'])) {
            $model->attributes = $_POST['Nodes'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Nodes();
        if (isset($_POST['Nodes'])) {
            
            $rnd = rand(0,9999).time();
            
            $model->attributes=$_POST['Nodes'];
            $model->title = $_POST['Nodes']['title'];
            $model->text = $_POST['Nodes']['text'];
            $model->date_create = date("Y-m-d H:i:s");
            $model->date_update = date("Y-m-d H:i:s");
            $model->parent_id = 0; 
            $model->user_id = Yii::app()->user->id ;
            $model->category_id = 1;
            
            $m = CUploadedFile::getInstance($model,'picture');
            if ($m) { // avoid empty picture upload
                $filename = $rnd.'.'.$m->extensionName;
                $model->picture = $filename;
            }
            
            if ( $model->save() ) {    
                if ($m) { // avoid empty picture upload
                    $images_path = realpath(Yii::app()->basePath.'/../picture');
                    $m->saveAs($images_path.'/'.$filename);
                }

                $this->redirect( Yii::app()->baseUrl.'/nodes' );
            }
        }
      
        $dataProvider = Nodes::model()->findAll(
			array(
				'order'=>'id desc '
				, 'condition'=>'category_id=:category_id and user_id=:user_id '
				, 'params'=>array( ':category_id'=> '1', ':user_id'=>Yii::app()->user->id )
			)
		);
		
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model'=> $model,
			//'satoo'=>$satoo
        ));
        
    }
    
    public function actionCreate2(){
//        $images_path = realpath(Yii::app()->basePath . '/../picture');
//        echo $images_path . '/';        
       echo Yii::app()->baseUrl;
    }
    

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Nodes('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Nodes']))
            $model->attributes = $_GET['Nodes'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Nodes the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Nodes::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Nodes $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'nodes-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionDosatoo($nodeid){
        //echo $nodeid; exit;
        $satoo = new Satoo;
        $satoo->node_id = $nodeid;
        $satoo->user_id = Yii::app()->user->id;
        
//        echo 'nodeid:'.$satoo->node_id.'<br>';
//        echo 'user_id:'.$satoo->user_id.'<br>';
        
        if ($satoo->save()) {
            echo 'saved';
        }else{
            echo 'error: ';            
        }
        
    }
    
    public function actionDo(){ 
		$this->render('msg', array('data'=>'sdfdsf')); 
	}
    
    public function actionComment(){
    	if ( $_POST ){
			$node = new Nodes;
			$node->parent_id = (int)$_POST['nodeid'];
			$node->text = urlencode($_POST['text']);
			$node->date_create = date("Y-m-d H:i:s");
			$node->date_update = date("Y-m-d H:i:s");
			$node->title='-';
			$node->user_id=Yii::app()->user->id;
			$node->category_id=4; // Category::model->findById(4);
			//echo $node->title; exit;
			
			$notify = new Notify;
			$notify->message = $_POST['text'];
			$notify->node_id = (int)$_POST['nodeid'];
			$notify->user_receive_id = (int)$_POST['nodeowner'];
			$notify->user_send_id = (int)Yii::app()->user->id;
			$notify->type_id = 0;
			$notify->Isreaded = 0;
			$notify->datetime_noti = date( 'Y-m-d H:i:s', time() );
			
			/*$notify->save() ;
			print_r($notify->getErrors());
			exit;*/
			
			if( $node->save() && $notify->save() ){
				//$this->render('msg', array('data'=>'saved')); 
				echo 'saved';
			}else{				
				//$this->render('msg', array('data'=>'error')); 
				echo 'error';
			}
		}   	
    }
	
	public function actionTest(){
		echo 'test';
	}
	
	public function actionCheckUpdateComment(){
		
	Yii::app()->clientScript->registerCoreScript('cookie');		
		
	//	if ( $_POST ){		
		$model=Notify::model()->findAll(
			array(
				'order'=>'datetime_noti asc' ,
				'condition'=>':user_receive_id=user_receive_id' ,
				'params'=>array(':user_receive_id' => Yii::app()->user->id )
			)
		);
		
		//print_r($model); exit;			
		$this->renderPartial('_msg', array('model'=> $model));
	//	}
		
	}

}
