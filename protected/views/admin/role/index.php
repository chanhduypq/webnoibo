<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<style>
    #pagination a, #pagination span{
        float: none !important;
    }
</style>
<script>
    $(window).load(function(){
           $("body").attr('id','admin');
		   if(getCookie("rolename")!=null && getCookie("rolename")!=undefined){ 
           deleteCookies('rolename');
           deleteCookies('checkdata'); 
		   }
    });
    
</script>
<input type="hidden" id="page_count" value="<?php echo $pages->getPageCount();?>"/>
<div class="wrapper secondary admin">
    
        <div class="contents detail">
        	<?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Phân quyền","link"=>'/adminrole') ;         
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>
            <div class="mainBox">
            	<div class="pageTtl">
					<h2></h2>
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/adminrole/regist" class="btn btn-important">
						<i class="icon-pencil icon-white"></i> <?php echo Config::TEXT_FOR_ADD_IN_PAGE_INDEX;?>
					</a>
				</div>
                <div class="box">
<!--                <p class="descriptionTxt">役割の権限など管理情報をご確認いただけます。</p>-->
                <?php if(Yii::app()->user->hasFlash('deny')){?>
                    <div class="info">
                         <p class="descriptionTxt">
							<?php echo Yii::app()->user->getFlash('deny'); ?>
						</p>
                    </div>
                <?php    
                } ?>
                
                
                <table width="724" border="0" class="table list font14">
                	<thead>
						<tr>
							<th><?php echo Config::TEXT_FOR_SHOW_HEADER_REGIST_DATE;?></th>
							<th><?php echo Config::TEXT_FOR_SHOW_HEADER_EDIT_DATE;?></th>
							<th>Quyền</th>
							<th><?php echo Config::TEXT_FOR_SHOW_HEADER_ACTION;?></th>
						</tr>
					</thead>
                    <?php
                    if(!empty($roles)){
                        foreach($roles as $role){?>
                        <tr>
                            <td class="td-date alnC txtRed postsDate"><?php echo FunctionCommon::formatDate($role["created_date"]) ?></td>
                            <td class="td-date alnC txtRed updateDate"><?php echo FunctionCommon::formatDate($role["last_updated_date"]) ?></td>
                            <td class="td-text">
								<p class="text alnC">
									<a href="<?php echo Yii::app()->request->baseUrl; ?>/adminrole/detail/?id=<?php echo $role["id"]; ?>">
										<?php echo htmlspecialchars($role["role_name"]) ?>
									</a>
								</p>
                            </td>
                            <td class="td-edit">
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/adminrole/edit/?id=<?php echo $role["id"]; ?>" class="btn btn-work"><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX;?></a>
                                                                <?php 
                                                                if($role['count']=='0'){?>
								<a class="btn btn-correct" href="<?php echo Yii::app()->request->baseUrl; ?>/adminrole/delete/?id=<?php echo $role["id"]; ?>" onclick="return confirm('<?php echo Config::TEXT_FOR_CONFIRM_DELETE; ?>');"><?php echo Config::TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX;?></a>
                                                                <?php
                                                                }
                                                                ?>
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

