<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/color.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/common/gmo/css/base.css" rel="stylesheet" media="screen"/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/css/secondary.css" rel="stylesheet" type="text/css"/>
<style>
    #pagination a, #pagination span{
        float: none !important;
    }
    td.td-contents p a{        
        word-break: normal !important;
    }
</style>
<script language="javascript">

jQuery(function($) 
{        
			$("body").attr('id','admin');      
});
</script>
<input type="hidden" id="page_count" value="<?php echo $pages->getPageCount();?>"/>
<div class="wrap admin secondary user">
    

    
        <div class="contents index">
            <?php
        	$home_link='/admin';
        $link_array=array();
        $link_array[]=array("text"=>"user","link"=>'/adminuser') ;         
        $this->widget('Path_actionwidget', array('home_link'=>$home_link,'link_array'=>$link_array)); ?>

            <div class="mainBox detail">

                <div class="pageTtl">
                    <h2></h2>
                    <a href="<?php echo Yii::app()->baseUrl; ?>/adminuser/regist" class="btn btn-important"><i class="icon-pencil icon-white"></i> <?php echo Config::TEXT_FOR_ADD_IN_PAGE_INDEX;?></a>                    
                    
                </div> 
                <div class="box">

                    <?php

                    if ($item_count < 1) {
                        ?>
                        <table width="724" border="0" class="table list font14">
                            <thead>
                                <tr><th>ID nhân viên</th><th>Chi nhánh - bộ phận</th><th>Họ và tên</th><th><?php echo Config::TEXT_FOR_SHOW_HEADER_ACTION;?></th></tr>
                            </thead>
                            <tbody>       
                                <tr class="item"><td colspan="4" align="center"> <span style="padding-left:310px;"><?php echo Lang::MSG_0118; ?></span></td></tr>
                            </tbody>
                        </table>           
                        <?php
                    } else {
                        ?>
                        <?php echo CHtml::beginForm('', 'post', array('id' => 'index_frm')); ?>
                        <table width="724" border="0" class="table list font14">
                            <thead>
                                <tr><th>ID nhân viên</th><th>Chi nhánh - bộ phận</th><th>Họ và tên</th><th><?php echo Config::TEXT_FOR_SHOW_HEADER_ACTION;?></th></tr>
                            </thead>
                            <tbody>       
                                <?php
                                if ($users != null && is_array($users) && count($users) > 0) {

                                    foreach ($users as $user) {
                                        ?>


                                        <tr class="item">
                                            <td class="employee_number td-contents alnC"><?php echo $user['employee_number']; ?></td>
                                            <td class="department">

                                                <p>
            <?php
            $row=Yii::app()->db->createCommand("select unit_name from `unit` where `unit`.id=".$user['division'])->queryRow();
            $row1=Yii::app()->db->createCommand("select post_name from `post` where `post`.id=".$user['position'])->queryRow();
            
            if(is_array($row)&&count($row)>0){
                
                    echo $row['unit_name'].'&nbsp;-&nbsp;';
                    
                
            }
            
            if(is_array($row1)&&count($row1)>0){
                
                    echo $row1['post_name'];
                    
                
            }
            

            

            ?>
                                                    </p>

                                            </td>
                                            <td class="parson td-contents">
                                                <p class="name text-center">
                                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/adminuser/detail/?id=<?php echo $user['id']; ?>"><?php echo $user['lastname'] . ' ' . $user['firstname']; ?></a>
                                                </p>
                                                
                                            </td>
                                            <td class="td-edit">

                                                <a class="btn btn-work" href="<?php echo Yii::app()->request->baseUrl; ?>/adminuser/edit/?id=<?php echo $user['id']; ?>"><?php echo Config::TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX;?></a>
                                                <a onclick="if (confirm('<?php echo Config::TEXT_FOR_CONFIRM_DELETE;?>') == true)
                                                            window.location = '<?php echo Yii::app()->request->baseUrl; ?>/adminuser/delete/?id=<?php echo $user['id']; ?>';" href="#" class="btn btn-correct"><?php echo Config::TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX;?></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody></table>
    <?php
    if ($item_count > $page_size) {
        ?>
                            <div class="pagination">
                            <?php
                            $this->widget('CLinkPager', array(
                                'currentPage' => $pages->getCurrentPage(),
                                'itemCount' => $item_count,
                                'pageSize' => $page_size,
                                'maxButtonCount' => 5,
                                'nextPageLabel' => 'Next',
                                'prevPageLabel' => 'Prev',
                                'lastPageLabel' => 'Last',
                                'firstPageLabel' => 'First',
                                'header' => '',
                                'htmlOptions' => array('class' => 'yiiPager'),
                            ));
                            ?>
                            </div>
                                <?php
                            }
                        } //end $item_count > 0
                        ?>    
                    <?php echo CHtml::endForm(); ?>

                </div>
            </div>

            <div class="sideBox">
                <ul>
                    <li>
<?php $this->widget('MenuManager'); ?>
                        <?php $this->widget('AffairsManage'); ?>
                        <?php $this->widget('SystemManage'); ?>
                        <?php $this->widget('PostedByContentManage'); ?>
                    </li>
                </ul>
            </div><!-- /sideBox -->

        </div><!-- /contents -->
        

</div>

