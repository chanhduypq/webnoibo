<?php

class Config_text_form{
    /**
     * text dùng hiển thị cho các input bắt buộc trong 1 form
     * text cũ: 必須
     */
    const TEXT_FOR_INPUT_REQUIREMENT="*";
    /**
     * text dùng hiển thị cho label title
     * text cũ: タイトル
     */
    const TEXT_FOR_LABEL_TITLE="Tiêu đề";
    /**
     * text dùng hiển thị cho label content
     * text cũ: 本文
     */
    const TEXT_FOR_LABEL_CONTENT="Nội dung";
    /**
     * text dùng hiển thị cho label hủy file
     * text cũ: 本文
     */
    const TEXT_FOR_LABEL_CANCEL_UPLOAD="Hủy";
    /**
     * text dùng hiển thị cho button next tại các page add, regist   
     * nằm trong <button class="btn btn-important" type="submit"><i class="icon-chevron-right icon-white">　</i>  確認</button>  
     * text cũ: 確認
     */
    const TEXT_FOR_NEXT_IN_PAGE_REGIST="Next";
    /**
     * text dùng hiển thị cho button next tại các page edit   
     * nằm trong <button class="btn btn-important" type="submit"><i class="icon-chevron-right icon-white">　</i> 確認</button>  
     * text cũ: 確認
     */
    const TEXT_FOR_NEXT_IN_PAGE_EDIT="Next";
    /**
     * text dùng hiển thị cho button next tại các page addconfirm, registconfirm, editconfirm, confirm   
     * nằm trong <button class="btn" type="submit"><i class="icon-chevron-left">　</i> もどる</button>  
     * text cũ:  もどる
     */
    const TEXT_FOR_BACK_IN_PAGE_CONFIRM="Back";
    /**
     * text dùng hiển thị cho button confirm tại các page add, regist   
     * nằm trong <button class="btn btn-important" type="submit"><i class="icon-chevron-right icon-white">　</i>  登録</button>  
     * text cũ:  登録
     */
    const TEXT_FOR_CONFIRM_IN_PAGE_REGIST_CONFIRM="Add";
    /**
     * text dùng hiển thị cho button confirm tại các page edit   
     * nằm trong <button class="btn btn-important" type="submit"><i class="icon-chevron-right icon-white">　</i> 更新</button>  
     * text cũ:  更新
     */
    const TEXT_FOR_CONFIRM_IN_PAGE_EDIT_CONFIRM="Edit";
    /**
     * placeholder for title
     */
    const TEXT_FOR_PLACEHOLDER_TITLE="Vui lòng nhập tựa đề";
    /**
     * placeholder for content
     */
    const TEXT_FOR_PLACEHOLDER_CONTENT="Vui lòng nhập nội dung";
    /**
     * text hiển thị trên vùng attachment tại các page (edit, regist, add)
     * <div class="attachements"><div class="title">text tại đây</div></div>
     * text cũ: 添付資料 (PDF,Office,Zip,画像ファイルを添付可。ファイルサイズ10MB迄可)
     */
    const TEXT_FOR_SHOW_ABOVE_ATTACHMENT="Các file được upload: pdf, zip, rar, office, image. Dung lượng mỗi file không vượt quá 10 MB.";
    /**
     * text hiển thị trên vùng attachment tại các page (editconfirm, registconfirm, addconfirm)
     * <div class="field attachements"><div class="title">text tại đây</div></div>
     * text cũ: 添付資料
     */
    const TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM="File đính kèm.";
    /**
     * text hiển thị trên vùng attachment tại các page (edit, regist, add)
     * <div class="attachements"><div class="title">text tại đây</div></div>    
     */
    const TEXT_FOR_SHOW_ABOVE_ATTACHMENT_ONE_FILE="File được upload: image. Dung lượng file không vượt quá 10 MB.";
    /**
     * text hiển thị trên vùng attachment tại các page (editconfirm, registconfirm, addconfirm)
     * <div class="field attachements"><div class="title">text tại đây</div></div>    
     */
    const TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM_ONE_FILE="File đính kèm.";
}

