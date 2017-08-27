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
<!--<div class="wrap admin secondary hobby_itd">-->
<div class="wrapper secondary admin">
    
        <div class="contents index">
        	<?php
        $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Thành viên bóng đá","link"=>'/adminhobby_itd') ;        
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>
            <div class="mainBox detail">
            	<div class="pageTtl"><h2></h2>                    
                    <a class="btn btn-important" href="<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/regist"><i class="icon-pencil icon-white"></i> <?php echo Config::TEXT_FOR_ADD_IN_PAGE_INDEX;?></a>
                    <a onclick="if(confirm('<?php echo Config::TEXT_FOR_CONFIRM_DELETE;?>')) window.location='<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/deleteall';" class="btn btn-work" href="#"><i class="icon-trash icon-white"></i> Xóa tất cả</a>
            	</div>
                <div class="box">
                
                <!--p class="descriptionTxt"></p-->
                
                <table width="724" border="0" class="table list font14">
                	<thead>
                            <tr>
                                <th class="td-target" colspan="2">Thành viên bóng đá</th>
                            
                            <th class="td-edit"><?php echo Config::TEXT_FOR_SHOW_HEADER_ACTION;?></th>
                                    </tr>
                        </thead>
                	<tbody>
                    
                    <?php 
                    if(isset($hobby_itd)&&is_array($hobby_itd)&&count($hobby_itd)>0){
                        foreach ($hobby_itd as $thank){
							
							?>
                            <tr>
                                <td class="td-target">
                                    <?php if($thank['photo']!=""&& file_exists(Yii::getPathOfAlias('webroot') .$thank['photo'])){                                        
                                        $thumnail_file_path=FunctionCommon::getFilenameInThumnail($thank['photo']);
                                $url = ltrim($thumnail_file_path, '/');
                                list($width_orig, $height_orig) = getimagesize($url);
                                if($width_orig>70){
                                    $width=70;
                                }
                                else{
                                    $width=$width_orig;
                                }
                                $height= ceil($height_orig*$width/$width_orig);
                                if($height>52){
                                    $height=52;
                                    $ratio=$width_orig/$height_orig;
                                    $width= ceil($height*$ratio);
                                }
                                        ?><img style="height: <?php echo $height;?>px;width: <?php echo $width;?>px;" src="<?php echo $thumnail_file_path;?>"/><?php } 
                                              else{                                                  
                                                  echo '<img style="width: 70px;height: 52px;" alt="" src="' .Yii::app()->request->baseUrl . '/css/common/img/img_photo01.gif">';
                                              }
                                        ?>
                                    <p class="name"><?php echo htmlspecialchars($thank['lastname']).' '.htmlspecialchars($thank['firstname']);?></p>
                                </td>
	                        <td class="td-target">
                                        
                        		<p class="base_name">
                                 <?php 
									$unit = Yii::app()->db->createCommand()
									->select(array(
										
										'unit.unit_name'
										
											)
									)
									->from('unit')
									
									->where("unit.active_flag=1 and unit.id =".$thank['division'])
									
									->queryRow();
                                                                        $post = Yii::app()->db->createCommand()
									->select(array(
										
										'post.post_name'
										
											)
									)
									->from('post')
									
									->where("post.id =".$thank['position'])
									
									->queryRow();
									 echo htmlspecialchars($unit['unit_name']).' - '.htmlspecialchars($post['post_name']);
							    ?>
								
                                </p>
                        		
	                        </td>
	                        
	                        <td class="td-edit"><a class="btn btn-work" href="<?php echo Yii::app()->baseUrl; ?>/adminhobby_itd/edit/?id=<?php echo $thank['id'];?>"><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX;?></a><a onclick="if(confirm('<?php echo Config::TEXT_FOR_CONFIRM_DELETE;?>')==true) window.location='<?php echo Yii::app()->request->baseUrl; ?>/adminhobby_itd/delete/?id=<?php echo $thank['id']; ?>'" href="#" class="btn btn-correct"><?php echo Config::TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX;?></a></td>
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
        

</div>

