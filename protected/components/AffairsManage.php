<?php
class AffairsManage extends CWidget
{
	public function init()
	{
	}

	public function run()
	{
            return;
?>
		<dl class="menu sub">
            <dt>Quản lý bộ phận</dt>
            <?php if(FunctionCommon::isAdminFunction('celebrate')==true){?>
<!--            <dd><a class="celebrate" href="<?php echo Yii::app()->baseUrl;?>/admincelebrate/">お祝い</a></dd>-->
            <?php 
			}
			if(FunctionCommon::isAdminFunction('pickup')==true){?>
<!--            <dd class="work"><a class="pickup" href="<?php echo Yii::app()->baseUrl;?>/adminpickup/">今日の社員ピックアップ</a></dd>-->
             <?php 
			}
			if(FunctionCommon::isAdminFunction('base_news')==true){?>
<!--            <dd class="work"><a class="base_news" href="<?php echo Yii::app()->baseUrl;?>/adminbase_news/">今週の部署紹介</a></dd>-->
             <?php 
			}
			if(FunctionCommon::isAdminFunction('sales_ranking')==true){?>
<!--            <dd class="work"><a class="sales_ran" href="<?php echo Yii::app()->baseUrl;?>/adminsales_ranking/">販売ランキング</a></dd>-->
             <?php 
			}
			if(FunctionCommon::isAdminFunction('soumu_jinji')==true){?>
<!--            <dd class="work"><a class="soumu_jinji" href="<?php echo Yii::app()->baseUrl;?>/adminsoumu_jinji/">総務からのお知らせ<br/>人事</a></dd>-->
             <?php 
			}
			if(FunctionCommon::isAdminFunction('soumu_news')==true){?>
<!--            <dd class="work"><a class="soumu_news" href="<?php echo Yii::app()->baseUrl;?>/adminsoumu_news/">総務からのお知らせ<br/>その他</a></dd>-->
             <?php 
			}
			
			if(FunctionCommon::isAdminFunction('celebrate_rpt')==true){?>
<!--            <dd class="play"><a class="celebrate_rpt" href="<?php echo Yii::app()->baseUrl;?>/admincelebrate_rpt/">お祝い報告</a></dd>-->
             <?php 
			}
			
			if(FunctionCommon::isAdminFunction('skill')==true){?>
<!--            <dd class="play"><a class="skill" href="<?php echo Yii::app()->baseUrl;?>/adminskill/">資格取得・スキルアップ！</a></dd>-->
             <?php 
			}
			if(FunctionCommon::isAdminFunction('link')==true){?>
<!--            <dd class="play"><a class="link" href="<?php echo Yii::app()->baseUrl;?>/adminlink/">リンク集</a></dd>-->
            <?php }
            if(FunctionCommon::isAdminFunction('zentaishihyou')==true){?>
<!--            <dd class="work"><a class="zentaishihyou" href="<?php echo Yii::app()->baseUrl;?>/adminzentaishihyou/">全体指標</a></dd>-->
            <?php }
            if(FunctionCommon::isAdminFunction('share_item')==true){?>
<!--            <dd class="work"><a class="share_item" href="<?php echo Yii::app()->baseUrl;?>/adminshare_item/">共有事項</a></dd>-->
            <?php }?>
        </dl>
<?php		
	}
}