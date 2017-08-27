<style>
    dl.menu.sub dd a{        
        word-break: normal !important;
    }
</style>
<?php
class PostedByContentManage extends CWidget
{
	public function init()
	{
	}

	public function run()
	{
?>
		<dl class="menu sub">
            <dt>Quản lý nội dung</dt>
              <?php 
              if(FunctionCommon::isAdminFunction('hr')==true){?>
            <dd class="work"><a class="newitems" href="<?php echo Yii::app()->baseUrl;?>/adminhr/">Thông báo từ phòng hành chính nhân sự</a></dd>
             <?php 
			}
			if(FunctionCommon::isAdminFunction('investigate')==true){?>
            <dd class="work"><a class="newitems" href="<?php echo Yii::app()->baseUrl;?>/admininvestigate/">Câu hỏi điều tra</a></dd>
             <?php 
			}
			if(FunctionCommon::isAdminFunction('criticism')==true){?>
            <dd class="work"><a class="criticism" href="<?php echo Yii::app()->baseUrl;?>/admincriticism/">Các văn bản & quyết định</a></dd>
             <?php 
			}
                        if(FunctionCommon::isAdminFunction('news_cv')==true){?>
            <dd class="work"><a class="criticism" href="<?php echo Yii::app()->baseUrl;?>/adminnews_cv/">Đọc ngay nhé (công việc)</a></dd>
             <?php 
                        }
			if(FunctionCommon::isAdminFunction('notice')==true){?>
            <dd class="work"><a class="criticism" href="<?php echo Yii::app()->baseUrl;?>/adminnotice/">Thông báo nội bộ</a></dd>
             <?php 
			}
			if(FunctionCommon::isAdminFunction('contribute')==true){?>
            <dd class="work"><a class="criticism" href="<?php echo Yii::app()->baseUrl;?>/admincontribute/">Hòm thư góp ý</a></dd>
             <?php 
			}
			if(FunctionCommon::isAdminFunction('itcontest')==true){?>
            <dd class="work"><a class="criticism" href="<?php echo Yii::app()->baseUrl;?>/adminitcontest/">IT Contest</a></dd>
             <?php 
			}	
                        if(FunctionCommon::isAdminFunction('plan')==true){?>
            <dd class="work"><a class="criticism" href="<?php echo Yii::app()->baseUrl;?>/adminplan/">Mục tiêu và hành động</a></dd>
             <?php 
			}
			
			
			if(FunctionCommon::isAdminFunction('ideas')==true){?>
            <dd class="work"><a class="ideas" href="<?php echo Yii::app()->baseUrl;?>/adminideas/">Ý tưởng mới</a></dd>
             <?php 
			}
			
			if(FunctionCommon::isAdminFunction('coffee')==true){?>
            <dd class="play"><a class="pride" href="<?php echo Yii::app()->baseUrl;?>/admincoffee/">Coffe break</a></dd>
             <?php 
			
			
			}
			if(FunctionCommon::isAdminFunction('hobby_new')==true){?>
            <dd class="play"><a class="hobby_new" href="<?php echo Yii::app()->baseUrl;?>/adminhobby_new/">Tin tức bóng đá</a></dd>
             <?php 
			}
			if(FunctionCommon::isAdminFunction('hobby_itd')==true){?>
            <dd class="play"><a class="hobby_itd" href="<?php echo Yii::app()->baseUrl;?>/adminhobby_itd/">Thành viên bóng đá</a></dd>
            <?php }
                       
            if(FunctionCommon::isAdminFunction('work_smile')==true){?>
            <dd class="play"><a class="work_smile" href="<?php echo Yii::app()->baseUrl;?>/adminwork_smile/">Vừa làm vừa vui</a></dd>
            <?php }
            if(FunctionCommon::isAdminFunction('news')==true){?>
            <dd class="play"><a class="work_smile" href="<?php echo Yii::app()->baseUrl;?>/adminnews/">Đọc ngay nhé (Vui chơi)</a></dd>
            <?php }
            if(FunctionCommon::isAdminFunction('thanks')==true){?>
            <dd class="play"><a class="thanks" href="<?php echo Yii::app()->baseUrl;?>/adminthanks/">Happy box</a></dd>
             <?php 
			}
            ?>
            
        </dl>
<?php		
	}
}