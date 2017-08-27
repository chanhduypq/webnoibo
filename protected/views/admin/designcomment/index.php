<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript">

 
    jQuery(function($) {
       
        $("body").attr('id','admin');      
    });
</script>


<div class="wrapper secondary admin">
    
        <div class="contents index">
        	<?php
        $home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"Design","link"=>'/admindesigncomment') ;        
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>
            <div class="mainBox detail">
            	<div class="pageTtl"><h2>今日のありがとう</h2>                    
                    <a class="btn btn-important" href="<?php echo Yii::app()->baseUrl;?>/admindesigncomment/regist"><i class="icon-pencil icon-white"></i> <?php echo Config::TEXT_FOR_ADD_IN_PAGE_INDEX;?></a>                    
            	</div>
                <div class="box">
                
                <!--p class="descriptionTxt"></p-->
                
                <table width="724" border="0" class="table list font14">
                	<thead>
                            <tr>
                            <th class="td-target">Name</th>                            
                            <th class="td-edit">編集</th>
                                    </tr>
                        </thead>
                	<tbody>
                    
                    <?php 
                    if(isset($moods)&&is_array($moods)&&count($moods)>0){
                        foreach ($moods as $mood){
							
							?>
                            <tr>
	                        <td class="td-target">
                                        
                        		<p class="base_name">
                                 <?php echo htmlspecialchars($mood['name']);?>
								
                                </p>
                        		
	                        </td>
	                        
	                        <td class="td-edit"><a class="btn btn-work" href="<?php echo Yii::app()->baseUrl; ?>/admindesigncomment/edit/?id=<?php echo $mood['id'];?>"><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX;?></a><a onclick="if(confirm('<?php echo Config::TEXT_FOR_CONFIRM_DELETE;?>')==true) window.location='<?php echo Yii::app()->request->baseUrl; ?>/admindesigncomment/delete/?id=<?php echo $mood['id']; ?>'" href="#" class="btn btn-correct"><?php echo Config::TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX;?></a></td>
	                    </tr>
                            
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>

                   
                        
                
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

