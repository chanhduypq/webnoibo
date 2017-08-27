<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/flotr2.min.js"></script>
<?php 
if($has_comment==true){
?>
<div id="graph1">
</div>
<?php
}
else{?>
<div style="color: red;width: 600px;height: 300px;margin: 20px auto;border: 1px;border-style: solid;border-color: black;text-align: center;vertical-align: middle;padding-top: 200px;"><h3>Chưa có một nhận xét từ một thành viên nào của công ty</h3></div>
<?php    
}
?>
<style type="text/css">
	#graph1 {
	    width : 600px;
	    height: 400px;
	    margin: 20px auto;
	}
</style>

<script type="text/javascript">

(function basic_pie(container) {    
    <?php
    /**
     * nó sinh ra như thế này
     * var d1=[[0,3]],d2[[0,4]],d3[[0,7]],...,dn[[0,15]],
     */
    	    for($i=0,$n=count($items);$i<$n;$i++){
    	    	if($i==0){
    	    		echo "var ";
    	    	}
    	    	echo 'd'.($i+1).'=[[0,'.$items[$i]['count'].']],';    	    	
    	    } 
    ?>    
        graph;
    graph = Flotr.draw(container, [
    <?php
    /**
     * nó sinh ra như thế này
     * {data:d1,lable:"Độ tuổi 20"},...,{data:dn:...}
     * Nếu muốn vành cung nào xòe ra thi thêm ",pie: {explode: 50}" vào trong {} của vành cung đó. Vi dụ: {data:d1,lable:"Độ tuổi 20",pie: {explode: 50}}
     */
    for($i=0,$n=count($items);$i<$n;$i++){
    	echo '{ data:d'.($i+1).',label:"'.$items[$i]['name'].': '.$items[$i]['count'].'"'.'}';
    	
    	if($i<$n-1){
    		echo ',';
    	}
    } 
    ?>                               
    
    ], {
    	
        HtmlText: false,
        grid: {
            verticalLines: false,
            horizontalLines: false
        },
        xaxis: {
            showLabels: false
        },
        yaxis: {
            showLabels: false
        },
        pie: {
            show: true,
            explode: 6
        },
        mouse: {
            track: true
        },
        legend: {
            position: "se",
            backgroundColor: "#D2E8FF"
        }
    });
})(document.getElementById("graph1"));
</script>