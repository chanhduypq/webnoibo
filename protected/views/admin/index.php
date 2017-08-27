<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<style>
    #pagination a, #pagination span{
        float: none !important;
    }
    td.td-contents span{        
        word-break: normal !important;
    }
</style>
<script type="text/javascript">
    jQuery(function($) {
        
        
        $("body").attr('id','admin');        
    });
</script>
<input type="hidden" id="page_count" value="<?php  echo $pages->getPageCount();?>"/>
<div class="wrapper secondary admin">

   
        <div class="contents detail">
             <?php
        	$home_link='/admin';
        $link_array=array();
        
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>
        	
            <div class="mainBox">
            	<div class="pageTtl"><h2></h2></div>
                <div class="box">
                
<!--                <p class="descriptionTxt">投稿履歴をご確認いただけます。</p>-->
                <?php if(Yii::app()->user->hasFlash('deny')){?>
                    <div class="info">
                         <p class="descriptionTxt"><?php echo Yii::app()->user->getFlash('deny'); ?></p>
                    </div>
                <?php    
                } ?>
                
                <table width="724" border="0" class="table list font14">
                	<tr><th><?php echo Config::TEXT_FOR_SHOW_HEADER_REGIST_DATE;?></th><th><?php echo Config::TEXT_FOR_SHOW_HEADER_EDIT_DATE;?></th><th>Chức năng</th><th><?php echo Config::TEXT_FOR_LABEL_TITLE;?></th><th><?php echo Config::TEXT_FOR_SHOW_HEADER_ACTION;?></th></tr>
                    
                    <?php 
                    $module_tile_array=  Constants::$module_tile_array;
                    if(is_array($items)&&count($items)>0){
                        foreach ($items as $item){?>                            
                            <tr>
                                <td class="td-date alnC txtRed postsDate">
									<?php echo  FunctionCommon::formatDate($item['created_date']);?>
								</td>
                                <td class="td-date alnC txtRed updateDate">
									<?php echo  FunctionCommon::formatDate($item['last_updated_date']);?>
								</td>
                                <td class="td-contents"><span>
                                        <?php 
                                        if(is_array($module_tile_array)&&count($module_tile_array)){                                            
                                            foreach ($module_tile_array as $key=>$value){
                                                if($key==$item['table_name']){
                                                    echo $value;
                                                }
                                            }
                                        }
                                        ?>
                                    </span></td>
                                <td class="td-text">
                                    <p class="text">
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin<?php echo $item['table_name'].'/detail/?id='.$item['id'];?>"><?php echo htmlspecialchars($item['title']);?></a>
                                    </p>
                                </td>
                                <td class="td-edit">
                                    <a class="btn btn-work" href="<?php echo Yii::app()->request->baseUrl; ?>/admin<?php echo $item['table_name'];?>/edit/?id=<?php echo $item['id']; ?>"><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX;?></a>
                                    <a onclick="if(confirm('<?php echo Config::TEXT_FOR_CONFIRM_DELETE;?>')==true) window.location='<?php echo Yii::app()->request->baseUrl; ?>/admin/delete/?id=<?php echo $item['id']; ?>&table_name=<?php echo $item['table_name'];?>';" href="#" class="btn btn-correct"><?php echo Config::TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX;?></a>
                                </td>
                            </tr> 
                    <?php
                        }
                    }
                    ?>
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
                
              </div><!-- /box -->
            </div><!-- /mainBox -->
            
            <div class="sideBox">
            	<ul>
                	<li>
                    	 <?php $this->widget('MenuManager');?>
                         <?php $this->widget('AffairsManage');?>
                         <?php $this->widget('SystemManage');?>
                         <?php $this->widget('PostedByContentManage');?>
                    </li>
                </ul>
            </div><!-- /sideBox -->
            
  </div><!-- /contents -->
        

</div><!-- /wrap -->
<script>
	jQuery(function($) 
	{       
	   $(window).load(function () 
	   {
		  setCookie("temple","1");        
	   });  

		jQuery(function($) 
		{        
			$("body").attr('id','admin');      
		});    
	});




  

</script>
