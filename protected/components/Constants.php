<?php

class Constants 
{
    
    /*contain title in modules*/
        public static $module_tile_array=array(         
         'coffee' => 'Coffee break',            
            'hobby_new'=>"Tin tức bóng đá",
            'news'=>'Đọc ngay nhé (Vui chơi)',
            'work_smile'=>'Vừa làm vừa vui',
            'ideas'=>'Ý tưởng mới',
            'criticism'=>'Các văn bản & quyết định',
            'news_cv'=>'Đọc ngay nhé (Công việc)',
            'notice'=>'Thông báo nội bộ',
            'itcontest'=>'IT Contest',
            'contribute'=>'Hòm thư góp ý',
            'plan'=>'Mục tiêu và hành động',
            'investigate'=>'Câu hỏi điều tra',
            'hr'=>'Thông báo từ phòng hành chính nhân sự',

        );
        
	
	
	
	
	
	/*Type image file*/
	public static $imgExtention=array("gif","jpg","png","jpeg","GIF","JPG","PNG","JPEG");
	/*Type zip file*/
	public static $zipExtention=array("zip","rar","ZIP","RAR");
	/*Type word file*/
	public static $wordExtention=array("doc","docx","DOC","DOCX");
	/*Type pdf file*/
	public static $pdfExtention=array("pdf","PDF");
	/*Type Excel file*/
	public static $excelExtention=array("xls","xlsx","XLS","XLSX");
	/*Type Powerpoint file*/
	public static $powerpointExtention=array("ppt","pptx","PPT","PPTX");
    //Base role
    public static $baserole=array("view"=>1,"post"=>2,"admin"=>3);
    //Admin role
    
    
}
