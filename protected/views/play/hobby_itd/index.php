<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<style>
    #pagination a, #pagination span{
        float: none !important;
    }
</style>
<script type="text/javascript">

 
    jQuery(function($) {
       
        $("body").attr('id','admin');      
    });
</script>
<input type="hidden" id="page_count" value="<?php echo $pages->getPageCount();?>"/>

<div class="wrapper secondary admin">
    
    <div class="content_left"> 
        <div class="contents index">
        	<?php
        $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Thành viên bóng đá","link"=>'/adminhobby_itd') ;        
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>
            <div class="mainBox detail">
            	<div class="pageTtl">
          <h2></h2>

        </div>
                <div class="box">
                
                <!--p class="descriptionTxt"></p-->
                
                <table width="724" border="0" class="table list font14">
                	<thead>
                            <tr>
                                <th class="td-target" colspan="2">Thành viên bóng đá</th>                            
                            
                                    </tr>
                        </thead>
                	<tbody>
                    
                    <?php 
                    if(isset($hobby_itds)&&is_array($hobby_itds)&&count($hobby_itds)>0){
                        foreach ($hobby_itds as $hobby_itd){
							
							?>
                            <tr>
	                        <td class="td-target">
                                        <?php if($hobby_itd['photo']!=""){ ?><img style="height: 52px;" src="<?php echo Yii::app()->request->baseUrl.FunctionCommon::getFilenameInThumnail($hobby_itd['photo']);?>"/><?php } 
                                              else{                                                  
                                                  echo '<img style="width: 70px;height: 52px;" alt="" src="' .Yii::app()->request->baseUrl . '/css/common/img/img_photo01.gif">';
                                              }
                                        ?>
                        		
                        		<p class="name"><?php echo htmlspecialchars($hobby_itd['lastname']).' '.htmlspecialchars($hobby_itd['firstname']);?></p>
	                        </td>
                                <td>
                                    <p class="base_name">
                                 <?php 
									$unit = Yii::app()->db->createCommand()
									->select(array(
										'unit.id',
										'unit.unit_name'
										
											)
									)
									->from('unit')
									
									->where("unit.active_flag=1 and unit.id ='".$hobby_itd['division']."'")
									
									->queryRow();
                                                                        $post = Yii::app()->db->createCommand()
									->select(array(
										
										'post.post_name'
										
											)
									)
									->from('post')
									
									->where("post.id =".$hobby_itd['position'])
									
									->queryRow();
									 echo htmlspecialchars($unit['unit_name']).' - '.htmlspecialchars($post['post_name']);
							    ?>
								
                                </p>
                                </td>
	                        
	                        
	                    </tr>
                            
                    <?php
                        }
                    }
                    ?>
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
                
                </div><!-- /box -->
            </div><!-- /mainBox -->
            
            
            
  </div><!-- /contents -->
</div>
        

</div>

