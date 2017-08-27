<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<style>
    #pagination a, #pagination span{
        float: none !important;
    }
</style>
<script language="javascript">


jQuery(function($) 
{        
	$("body").attr('id','admin');  
})
</script>
<input type="hidden" id="page_count" value="<?php  echo $pages->getPageCount();?>"/>
<div class="wrapper secondary admin">
 
    <div class="contents index">
        <?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Vừa làm vừa vui","link"=>'/adminwork_smile') ;         
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>
      <div class="mainBox detail">
        <div class="pageTtl">
          <h2></h2>

        </div>
        <div class="box">
          
          <table width="724" border="0" class="table list font14">
            <thead>
              <tr>
                <th><?php echo Config::TEXT_FOR_SHOW_HEADER_REGIST_DATE;?></th>
                <th><?php echo Config::TEXT_FOR_SHOW_HEADER_EDIT_DATE;?></th>
                <th><?php echo Config::TEXT_FOR_LABEL_TITLE;?></th>
                <th><?php echo Config::TEXT_FOR_SHOW_HEADER_ACTION;?></th>
              </tr>
            </thead>
            <tbody>
				<?php if(!is_null($model)): ?>
					 <?php foreach($model as $work_smile): ?>
						<tr>
							<td class="td-date alnC txtRed postsDate">
								<?php echo FunctionCommon::formatDate($work_smile->created_date); ?>
							</td>
							<td class="td-date alnC txtRed updateDate">
								<?php echo FunctionCommon::formatDate($work_smile->created_date); ?>
							</td>
							<td class="td-text">
							  <p class="text">
								 <a href="<?php echo Yii::app()->request->baseUrl; ?>/adminwork_smile/detail/?id=<?php echo $work_smile->id; ?>" >
									<?php echo htmlspecialchars($work_smile->title);?>
								</a>
							  </p>
							</td>
							<td class="td-edit">
							  <a href="<?php echo Yii::app()->request->baseUrl; ?>/adminwork_smile/edit/?id=<?php echo $work_smile->id; ?>" class="btn btn-work"><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX;?></a>
							  <a onclick="if(confirm('<?php echo Config::TEXT_FOR_CONFIRM_DELETE;?>')==true) window.location='<?php echo Yii::app()->request->baseUrl; ?>/adminwork_smile/delete/?id=<?php echo $work_smile->id; ?>';" href="#" class="btn btn-correct"><?php echo Config::TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX;?></a>	
							</td>
					  </tr>
					 <?php endforeach; ?>
				<?php endif; ?>
             </tbody>
          </table>
           <?php 

           $this->widget('CLinkPager', array(
                'currentPage' => $pages->getCurrentPage(),
                'itemCount' => $item_count,
                'pageSize' => $page_size,
                'maxButtonCount' => 5,
                'nextPageLabel' => 'Next',
                'prevPageLabel' => 'Previous',
                'lastPageLabel' => 'Last',
                'firstPageLabel' => 'First',
                'header' => '',
                'htmlOptions' => array('class' => 'pagination'),
            ));
           ?>
          <div class="pagination" id="pagination"></div>
        </div>
        <!-- /box -->
      </div>
      <!-- /mainBox -->
      <div class="sideBox">
        <ul>
          <li>
			  	 <?php $this->widget('MenuManager');?>
				 <?php $this->widget('AffairsManage');?>
				 <?php $this->widget('SystemManage');?>
				 <?php $this->widget('PostedByContentManage');?>
          </li>
        </ul>
      </div>
      <!-- /sideBox -->
    </div>
    <!-- /contents -->
   
</div>
<!-- /wrap -->