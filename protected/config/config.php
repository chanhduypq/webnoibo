<?php

/**
 * Config
 * Use configuration system
 * @author tuetc
 * @Company GMO Runsystem 
 */
require_once('config_text.php');
require_once('config_database.php');
require_once('config_title_for_page.php');
require_once('config_text_form.php');
require_once('config_position_user.php');
require_once('config_team_notice.php');
require_once('config_plan.php');
require_once('config_investigate.php');


class Config {

    /**
     * text trong file config_text.php
     */
    const TEXT_FOR_BACK_TO_LIST = Config_text::TEXT_FOR_BACK_TO_LIST;
    const TEXT_FOR_ADD_IN_PAGE_INDEX = Config_text::TEXT_FOR_ADD_IN_PAGE_INDEX;
    const TEXT_FOR_EDIT_IN_PAGE_DETAIL = Config_text::TEXT_FOR_EDIT_IN_PAGE_DETAIL;
    const TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX = Config_text::TEXT_FOR_EDIT_IN_PAGE_ADMIN_INDEX;
    const TEXT_FOR_CONFIRM_DELETE = Config_text::TEXT_FOR_CONFIRM_DELETE;
    const TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX = Config_text::TEXT_FOR_DELETE_IN_PAGE_ADMIN_INDEX;
    const TEXT_FOR_ADD_IN_LINK_BACK_DIV = Config_text::TEXT_FOR_ADD_IN_LINK_BACK_DIV;
    const TEXT_FOR_EDIT_IN_LINK_BACK_DIV = Config_text::TEXT_FOR_EDIT_IN_LINK_BACK_DIV;
    const TEXT_FOR_DETAIL_IN_LINK_BACK_DIV = Config_text::TEXT_FOR_DETAIL_IN_LINK_BACK_DIV;
    const TEXT_FOR_SHOW_HEADER_INDEX = Config_text::TEXT_FOR_SHOW_HEADER_INDEX;
    const TEXT_FOR_SHOW_HEADER_DETAIL = Config_text::TEXT_FOR_SHOW_HEADER_DETAIL;
    const TEXT_FOR_SHOW_HEADER_REGIST_DATE = Config_text::TEXT_FOR_SHOW_HEADER_REGIST_DATE;
    const TEXT_FOR_SHOW_HEADER_EDIT_DATE = Config_text::TEXT_FOR_SHOW_HEADER_EDIT_DATE;
    const TEXT_FOR_SHOW_HEADER_ACTION = Config_text::TEXT_FOR_SHOW_HEADER_ACTION;

    /**
     * text trong file config_text_form.php
     */
    const TEXT_FOR_INPUT_REQUIREMENT = Config_text_form::TEXT_FOR_INPUT_REQUIREMENT;
    const TEXT_FOR_LABEL_TITLE = Config_text_form::TEXT_FOR_LABEL_TITLE;
    const TEXT_FOR_LABEL_CONTENT = Config_text_form::TEXT_FOR_LABEL_CONTENT;
    const TEXT_FOR_LABEL_CANCEL_UPLOAD = Config_text_form::TEXT_FOR_LABEL_CANCEL_UPLOAD;
    const TEXT_FOR_NEXT_IN_PAGE_REGIST = Config_text_form::TEXT_FOR_NEXT_IN_PAGE_REGIST;
    const TEXT_FOR_NEXT_IN_PAGE_EDIT = Config_text_form::TEXT_FOR_NEXT_IN_PAGE_EDIT;
    const TEXT_FOR_BACK_IN_PAGE_CONFIRM = Config_text_form::TEXT_FOR_BACK_IN_PAGE_CONFIRM;
    const TEXT_FOR_CONFIRM_IN_PAGE_REGIST_CONFIRM = Config_text_form::TEXT_FOR_CONFIRM_IN_PAGE_REGIST_CONFIRM;
    const TEXT_FOR_CONFIRM_IN_PAGE_EDIT_CONFIRM = Config_text_form::TEXT_FOR_CONFIRM_IN_PAGE_EDIT_CONFIRM;
    const TEXT_FOR_PLACEHOLDER_TITLE = Config_text_form::TEXT_FOR_PLACEHOLDER_TITLE;
    const TEXT_FOR_PLACEHOLDER_CONTENT = Config_text_form::TEXT_FOR_PLACEHOLDER_CONTENT;
    const TEXT_FOR_SHOW_ABOVE_ATTACHMENT = Config_text_form::TEXT_FOR_SHOW_ABOVE_ATTACHMENT;
    const TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM = Config_text_form::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM;
    const TEXT_FOR_SHOW_ABOVE_ATTACHMENT_ONE_FILE = Config_text_form::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_ONE_FILE;
    const TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM_ONE_FILE = Config_text_form::TEXT_FOR_SHOW_ABOVE_ATTACHMENT_CONFIRM_ONE_FILE;

    /**
     * text trong file config_database.php
     */
    const HOST_DATA = Config_database::HOST_DATA;
    const DB_NAME = Config_database::DB_NAME;
    const LOGIN_DATA = Config_database::LOGIN_DATA;
    const PASS_DATA = Config_database::PASS_DATA;

    /**
     * text trong file config_title_for_page.php
     */
    const TITLE_FOR_MODULE_WORK_SMILE = Config_title_for_page::TITLE_FOR_MODULE_WORK_SMILE;
    const TITLE_FOR_MODULE_HOBBY_ITD = Config_title_for_page::TITLE_FOR_MODULE_HOBBY_ITD;
    const TITLE_FOR_MODULE_THANK = Config_title_for_page::TITLE_FOR_MODULE_THANK;
    const TITLE_FOR_MODULE_COFFEE = Config_title_for_page::TITLE_FOR_MODULE_COFFEE;
    const TITLE_FOR_MODULE_FORTUNE = Config_title_for_page::TITLE_FOR_MODULE_FORTUNE;
    const TITLE_FOR_MODULE_HOBBY_NEW = Config_title_for_page::TITLE_FOR_MODULE_HOBBY_NEW;
    const TITLE_FOR_MODULE_DESIGN_COMMENT = Config_title_for_page::TITLE_FOR_MODULE_DESIGN_COMMENT;
    const TITLE_FOR_MODULE_MOOD = Config_title_for_page::TITLE_FOR_MODULE_MOOD;
    const TITLE_FOR_MODULE_NEWS = Config_title_for_page::TITLE_FOR_MODULE_NEWS;
    const TITLE_FOR_TOP_PLAY = Config_title_for_page::TITLE_FOR_TOP_PLAY;
    const TITLE_FOR_TOP_MAJIME = Config_title_for_page::TITLE_FOR_TOP_MAJIME;
    const TITLE_FOR_TOP_ADMIN = Config_title_for_page::TITLE_FOR_TOP_ADMIN;
    const TITLE_FOR_MODULE_NOTICE = Config_title_for_page::TITLE_FOR_MODULE_NOTICE;
    /**
     * 
     */
    const LIMIT_ROW = 10;
    
    


    /* �p�X���[�h�đ��̃��[�� */
    const EMAIL_SUB = '�p�X���[�h�̃��}�C���_�[';

    /* �j���[�M���X�N�G�A�Ǘ��҂ւ̂��₢���킹�̂��߂̐ݒ�	 */
    //SMTP�w�T�[�o��
    const EMAIL_HOST = 'smtp.gmail.com';
    //���M��
    const EMAIL_USERNAME = 'chanhduypq@gmail.com';
    //���M��
    const PWDREMINDER_EMAIL_FROM = 'trungnt@runsystem.net';

    static $INQUIRY_EMAIL_TO = array('tuetc@runsystem.net');

    //�F�ؗp�̃p�X���[�h
    const EMAIL_PASS = 'buddha0812';
    //���M�|�[�g
    const EMAIL_PORT = '465';

    /* �Z�b�V�����^�C���A�E�g */
    const TIME_OUT = 7200;
    //image big
    const IMG_WIDTH_BIG = 800;
    const IMG_HEIGHT_BIG = 600;
    //image thumbs
    const IMG_WIDTH = 228;
    // const MINUTE=60;
    // const HOUR =24;
    //unit MB
    const MAX_FILE_SIZE = 10;
    //const Path log        
    const LOG_PATH = '/var/www/intraportal/protected/runtime/';
    const LOG_FILE_NAME = 'newgin.log';
    const LOG_FILE_NAME_MAX_SIZE = 0.001; //unit MB; input: float or integer

}
