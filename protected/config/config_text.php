<?php

class Config_text{
    /**
     * text dùng hiển thị cho button quay lại danh sách trong các page: regist, edit
     * nằm trong <a class="btn btn-important">...</a>
     * sau <i class="icon-chevron-left icon-white"></i>
     * text cũ: 一覧に戻る							
     */
    const TEXT_FOR_BACK_TO_LIST="Quay lại danh sách";
    /**
     * text dùng hiển thị cho button thêm mới tại các page index
     * nằm trong <a class="btn btn-important">...</a>
     * sau <i class="icon-pencil icon-white"></i>
     * text cũ: 登録
     */
    const TEXT_FOR_ADD_IN_PAGE_INDEX="Add";
    /**
     * text dùng hiển thị cho button sửa tại các page detail
     * nằm trong <a class="btn btn-work">...</a>
     * sau <i class="icon-pencil icon-white"></i>
     * text cũ: 修正
     */
    const TEXT_FOR_EDIT_IN_PAGE_DETAIL="Edit";
    /**
     * text dùng hiển thị cho button sửa tại các page adminxxx/index và admin/index
     * nằm trong <table...<tr..<td.. <a class="btn btn-work">...</a> .......</table>    
     * text cũ: 修正
     */
    const TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX="Edit";
    /**      
     * text cũ: 削除します。よろしいですか？
     */
    const TEXT_FOR_CONFIRM_DELETE="Bạn có chắc xóa không?";        
    /**
     * text dùng hiển thị cho button xóa tại các page adminxxx/index và admin/index
     * nằm trong <table...<tr..<td.. <a class="btn btn-correct">...</a> .......</table>         
     * text cũ: 削除
     */
    const TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX="Delete";    
    /**
     * các text hiển thị tại <div class="link_back"></div>
     */
    const TEXT_FOR_ADD_IN_LINK_BACK_DIV="Thêm mới";
    const TEXT_FOR_EDIT_IN_LINK_BACK_DIV="Sửa";
    const TEXT_FOR_DETAIL_IN_LINK_BACK_DIV="Chi tiết";    
    /**
     * text hiển thị danh sách tại các page index     
     * <h2 class="skyblue"><span>Danh sách</span></h2>
     */
    const TEXT_FOR_SHOW_HEADER_INDEX="Danh sách";
    /**
     * text hiển thị ngày đăng tại các page detail     
     * <div class="postsDate"><i class="icon-pencil"></i> 投稿日時：</div>
     */
    const TEXT_FOR_SHOW_HEADER_DETAIL="Thời gian đăng tin:";
    /**
     * text hiển thị ngày đăng tại các page index (admin)     
     * <th>投稿年月日</th>
      * text cũ: 投稿年月日
     */
    const TEXT_FOR_SHOW_HEADER_REGIST_DATE="Ngày đăng";
    /**
     * text hiển thị ngày đăng tại các page index (admin)     
     * <th>更新年月日</th>
      * text cũ: 更新年月日
     */
    const TEXT_FOR_SHOW_HEADER_EDIT_DATE="Ngày sửa";
    /**
     * text hiển thị action (delete/edit) các page index (admin)     
     * <th>編集</th>
      * text cũ: 編集
     */
    const TEXT_FOR_SHOW_HEADER_ACTION="Chỉnh sửa";
    /*
     * text trong các button hiển thị tại index của mỗi module
     */
}

