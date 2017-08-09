@extends('admin_layout')

<!-- 在这里写style样式，或者在这里外加link -->
@section('style')
<link rel="stylesheet" type="text/css" href="/js/layui/css/layui.css">
<link rel="stylesheet" type="text/css" href="/admin/wechat/automenu/automenu.css">
@endsection

@section('content')


            <div class="wraper container-fluid" style="background: #FFF;">
                <div class="page-title"> 
                    <h3 class="title">设置自定义菜单</h3>
                </div>

                <div class="row">
                    
                    <div class="col-lg-12" style="width: 1000px;">

                        <div class="highlight_box icon_wrap border menu_setting_msg js_menustatus dn" id="menustatus_1" style="display: block;">
                            <i class="icon icon icon_msg_small success"></i>            
                            <p class="title">API版本菜单编辑中</p>            
                            <p class="desc">
                                该页面显示的菜单版本正在编辑中。若停用菜单，请
                                <a href="#" class="js_closeMenu">点击这里</a>
                            </p>        
                        </div>

                        <div class="highlight_box icon_wrap border menu_setting_msg js_menustatus dn" id="menustatus_2" style="display: block;">
                            <i class="icon icon icon_msg_small success"></i>            
                            <p class="title">API版本已发布</p>            
                            <p class="desc">
                                该页面显示的菜单版本已发布。若恢复已发布菜单，请
                                <a href="#" class="js_closeMenu">点击这里</a>
                            </p>        
                        </div>

                        <div class="menu_setting_area js_editBox">
                            <div class="menu_preview_area">
                                <div class="mobile_menu_preview">
                                    <div class="mobile_hd tc">张贤健</div>
                                    <div class="mobile_bd">
                                        <ul class="pre_menu_list grid_line ui-sortable ui-sortable-disabled" id="menuList">
                                            <!-- <li class="jsMenu pre_menu_item grid_item jslevel1 ui-sortable ui-sortable-disabled size1of3 current selected bigMenu" id="menu_0">
                                                <a href="javascript:void(0);" class="pre_menu_link" draggable="false">
                                                    <i class="icon_menu_dot js_icon_menu_dot dn" style="display: none;"></i>
                                                    <i class="icon20_common sort_gray"></i>
                                                    <span class="js_l1Title">菜单名称</span>
                                                </a>
                                                <div class="sub_pre_menu_box js_l2TitleBox" style="">
                                                    <ul class="sub_pre_menu_list">
                                                        
                                                        <li class="js_addMenuBox"><a href="javascript:void(0);" class="jsSubView js_addL2Btn" title="最多添加5个子菜单" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon14_menu_add"></i></span></a></li>
                                                    </ul>
                                                    <i class="arrow arrow_out"></i>
                                                    <i class="arrow arrow_in"></i>
                                                </div>
                                            </li>
        
                                            <li class="jsMenu pre_menu_item grid_item jslevel1 ui-sortable ui-sortable-disabled size1of3 bigMenu" id="menu_1">
                                                <a href="javascript:void(0);" class="pre_menu_link" draggable="false">
                                                    
                                                    <i class="icon_menu_dot js_icon_menu_dot dn"></i>
                                                    <i class="icon20_common sort_gray"></i>
                                                    <span class="js_l1Title">菜单名称</span>
                                                </a>
                                                <div class="sub_pre_menu_box js_l2TitleBox" style="display:block;">
                                                    <ul class="sub_pre_menu_list">
                                                        
                                                        <li id="subMenu_menu_1_0" class="jslevel2"><a href="javascript:void(0);" class="jsSubView" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon20_common sort_gray"></i><span class="js_l2Title">子菜单名称</span></span></a></li>
                                                        <li id="subMenu_menu_1_1" class="jslevel2 current selected"><a href="javascript:void(0);" class="jsSubView" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon20_common sort_gray"></i><span class="js_l2Title">子菜单名称</span></span></a></li>
                                                        
                                                        <li class="js_addMenuBox"><a href="javascript:void(0);" class="jsSubView js_addL2Btn" title="最多添加5个子菜单" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon14_menu_add"></i></span></a></li>
                                                    </ul>
                                                    <i class="arrow arrow_out"></i>
                                                    <i class="arrow arrow_in"></i>
                                                </div>
                                            </li> -->
        
                                            <!-- <li class="jsMenu pre_menu_item grid_item jslevel1 ui-sortable ui-sortable-disabled size1of3" id="menu_2" style="display: none;">
                                                <a href="javascript:void(0);" class="pre_menu_link" draggable="false">
                                                    
                                                    <i class="icon_menu_dot js_icon_menu_dot dn"></i>
                                                    <i class="icon20_common sort_gray"></i>
                                                    <span class="js_l1Title">菜单名称</span>
                                                </a>
                                                <div class="sub_pre_menu_box js_l2TitleBox" style="display:none;">
                                                    <ul class="sub_pre_menu_list">
                                                        
                                                        <li id="subMenu_menu_2_0" class="jslevel2"><a href="javascript:void(0);" class="jsSubView" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon20_common sort_gray"></i><span class="js_l2Title">子菜单名称</span></span></a></li>
                                                        
                                                        <li id="subMenu_menu_2_1" class="jslevel2"><a href="javascript:void(0);" class="jsSubView" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon20_common sort_gray"></i><span class="js_l2Title">子菜单名称</span></span></a></li>
                                                        
                                                        <li id="subMenu_menu_2_2" class="jslevel2"><a href="javascript:void(0);" class="jsSubView" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon20_common sort_gray"></i><span class="js_l2Title">子菜单名称</span></span></a></li>
                                                        
                                                        <li id="subMenu_menu_2_3" class="jslevel2"><a href="javascript:void(0);" class="jsSubView" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon20_common sort_gray"></i><span class="js_l2Title">子菜单名称</span></span></a></li>
                                                        
                                                        <li class="js_addMenuBox"><a href="javascript:void(0);" class="jsSubView js_addL2Btn" title="最多添加5个子菜单" draggable="false"><span class="sub_pre_menu_inner js_sub_pre_menu_inner"><i class="icon14_menu_add"></i></span></a></li>
                                                    </ul>
                                                    <i class="arrow arrow_out"></i>
                                                    <i class="arrow arrow_in"></i>
                                                </div>
                                            </li> -->
        
                                            <li class="js_addMenuBox pre_menu_item grid_item no_extra">
                                                <a href="javascript:void(0);" class="pre_menu_link js_addL1Btn" title="最多添加3个一级菜单" draggable="false">
                                                    <i class="icon14_menu_add"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="sort_btn_wrp">
                                    <a id="orderBt" class="btn btn_default" href="javascript:void(0);" style="display: inline-block;">菜单排序</a>
                                    <span id="orderDis" class="dn btn btn_disabled" style="display: none;">菜单排序</span>
                                    <a id="finishBt" href="javascript:void(0);" class="dn btn btn_default">完成</a>
                                </div>
                            </div>

                            <div class="menu_form_area" style="width: 600px;">
                                <div id="js_none" class="menu_initial_tips tips_global" style="display: none;">
                                    点击左侧菜单进行编辑操作
                                </div>
                                <div id="js_rightBox" class="portable_editor to_left" style="display: block;">
                                    <div class="editor_inner">
                                        <div class="global_mod float_layout menu_form_hd js_second_title_bar">
                                            <h4 class="global_info">
                                            菜单名称
                                            </h4>                            
                                            <div class="global_extra">                                
                                            <a href="javascript:void(0);" id="jsDelBt">删除菜单</a>                            
                                            </div>                        
                                        </div>                        
                                        <div class="menu_form_bd" id="view">                            
                                            <div id="js_innerNone" style="display:none;" class="msg_sender_tips tips_global">
                                            </div>                            
                                            <div class="frm_control_group js_setNameBox">                                
                                                <label for="" class="frm_label">                                    
                                                    <strong class="title js_menuTitle">菜单名称</strong>
                                                </label>
                                                <div class="frm_controls">                                    
                                                    <span class="frm_input_box with_counter counter_in append">
                                                        <input type="text" class="frm_input js_menu_name">
                                                    </span>
                                                    <p class="frm_msg fail js_titleEorTips dn">字数超过上限</p>
                                                    <p class="frm_msg fail js_titlenoTips dn" style="display: none;">请输入菜单名称</p>
                                                    <p class="frm_tips js_titleNolTips">字数不超过4个汉字或8个字母</p>
                                                </div>                         
                                            </div>
                                            <div class="frm_control_group">
                                                <label for="" class="frm_label">
                                                    <strong class="title js_menuContent">菜单内容</strong>
                                                </label>
                                                <div class="frm_controls frm_vertical_pt">
                                                    <label class="frm_radio_label js_radio_sendMsg selected" data-editing="0">
                                                        <i class="icon_radio"></i>
                                                        <span class="lbl_content">发送消息</span>
                                                        <input type="radio" name="hello" class="frm_radio">
                                                    </label>
                                                    <label class="frm_radio_label js_radio_url" data-editing="0">
                                                        <i class="icon_radio"></i>
                                                        <span class="lbl_content">跳转网页</span>
                                                        <input type="radio" name="hello" class="frm_radio">
                                                    </label>
                                                    <label class="frm_radio_label js_radio_weapp" data-editing="0">
                                                        <i class="icon_radio"></i>
                                                        <span class="lbl_content">跳转小程序</span>
                                                        <input type="radio" name="hello" class="frm_radio">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="menu_content_container">
                                                <div class="menu_content send jsMain" id="edit" style="display: block;">
                                                    <div class="msg_sender" id="editDiv">
                                                        <div class="msg_tab">
                                                            <div class="tab_navs_panel">
                                                                <span class="tab_navs_switch_wrp switch_prev js_switch_prev">
                                                                    <span class="tab_navs_switch"></span>
                                                                </span>
                                                                <span class="tab_navs_switch_wrp switch_next js_switch_next" style="display: none;">
                                                                    <span class="tab_navs_switch"></span>
                                                                </span>
                                                                <div class="tab_navs_wrp">
                                                                    <ul class="tab_navs js_tab_navs" style="margin-left:0;">
                                                                        
                                                                        <li class="tab_nav tab_appmsg width4 selected" data-type="10" data-tab=".js_appmsgArea" data-tooltip="图文消息">
                                                                            <a href="javascript:void(0);" onclick="return false;">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">图文消息</span></a>
                                                                        </li>
                                                                        
                                                                        <li class="tab_nav tab_img width4" data-type="2" data-tab=".js_imgArea" data-tooltip="图片">
                                                                            <a href="javascript:void(0);" onclick="return false;">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">图片</span></a>
                                                                        </li>
                                                                        
                                                                        <li class="tab_nav tab_audio width4" data-type="3" data-tab=".js_audioArea" data-tooltip="语音">
                                                                            <a href="javascript:void(0);" onclick="return false;">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">语音</span></a>
                                                                        </li>
                                                                        
                                                                        <li class="tab_nav tab_video width4 no_extra" data-type="15" data-tab=".js_videoArea" data-tooltip="视频">
                                                                            <a href="javascript:void(0);" onclick="return false;">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">视频</span></a>
                                                                        </li>
                                                                        
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="tab_panel">
                                                                
                                                                <div class="tab_content">
                                                                    <div class="js_appmsgArea inner ">
                                                                        <!--type 10图文 2图片  3语音 15视频 11商品消息-->
                                                                        
                                                                        <div class="tab_cont_cover jsMsgSendTab" data-index="0">
                                                                            <div class="media_cover">
                                                                                <span class="create_access">
                                                                                    <a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;" data-type="10" data-index="0">
                                                                                        <i class="icon36_common add_gray"></i>
                                                                                        <strong>从素材库中选择</strong>
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                            <div class="media_cover">
                                                                                <span class="create_access">
                                                                                    <a target="_blank" class="add_gray_wrp create_new_appmsg" href="javascript:;">
                                                                                        <i class="icon36_common add_gray"></i>
                                                                                        <strong>新建图文消息</strong>
                                                                                    </a>
                                                                                    <a target="_blank" href="/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;isMul=1&amp;isNew=1&amp;lang=zh_CN&amp;token=2087822649"><i class="icon_appmsg_selfcreate"></i><strong>自建图文</strong></a>
                                                                                    <a target="_blank" href="/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;isMul=1&amp;isNew=1&amp;share=1&amp;lang=zh_CN&amp;token=2087822649"><i class="icon_appmsg_share"></i><strong>分享图文</strong></a>
                                                                                </span>
                                                                            </div>
                                                                        </div>              
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="tab_content" style="display: none;">
                                                                    <div class="js_imgArea inner ">
                                                                        <!--type 10图文 2图片  3语音 15视频 11商品消息-->
                                                                        
                                                                        <div class="tab_cont_cover jsMsgSendTab" data-index="1" data-type="2">
                                                                            <div class="media_cover">
                                                                                <span class="create_access">
                                                                                    <a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;" data-type="2" data-index="1">
                                                                                        <i class="icon36_common add_gray"></i>
                                                                                        <strong>从素材库中选择</strong>
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                            <div class="media_cover">
                                                                                <span class="create_access">
                                                                                    <a class="add_gray_wrp" id="msgSendImgUploadBt" data-type="2" href="javascript:;">
                                                                                        <i class="icon36_common add_gray"></i>
                                                                                        <strong>上传图片</strong>
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="tab_content" style="display: none;">
                                                                    <div class="js_audioArea inner ">
                                                                        <!--type 10图文 2图片  3语音 15视频 11商品消息-->
                                                                        
                                                                        <div class="tab_cont_cover jsMsgSendTab" data-index="2" data-type="3">
                                                                            <div class="media_cover">
                                                                                <span class="create_access">
                                                                                    <a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;" data-type="3" data-index="2">
                                                                                        <i class="icon36_common add_gray"></i>
                                                                                        <strong>从素材库中选择</strong>
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                            <div class="media_cover">
                                                                                <span class="create_access">
                                                                                    <a class="add_gray_wrp " id="msgSendAudioUploadBt" href="javascript:;">
                                                                                        <i class="icon36_common add_gray"></i>
                                                                                        <strong>新建语音</strong>
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="tab_content" style="display: none;">
                                                                    <div class="js_videoArea inner ">
                                                                        <!--type 10图文 2图片  3语音 15视频 11商品消息-->
                                                                        
                                                                        <div class="tab_cont_cover jsMsgSendTab" data-index="3">
                                                                            <div class="media_cover">
                                                                                <span class="create_access">
                                                                                    <a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;" data-type="15" data-index="3">
                                                                                        <i class="icon36_common add_gray"></i>
                                                                                        <strong>从素材库中选择</strong>
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                            <div class="media_cover">
                                                                                <span class="create_access">
                                                                                    <a target="_blank" class="add_gray_wrp" href="/cgi-bin/appmsg?t=media/videomsg_edit&amp;action=video_edit&amp;type=15&amp;lang=zh_CN&amp;token=2087822649">
                                                                                        <i class="icon36_common add_gray"></i>
                                                                                        <strong>新建视频</strong>
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="profile_link_msg_global menu_send mini_tips warn dn js_warn">
                                                        请勿添加其他公众号的主页链接
                                                    </p>                                
                                                </div>
                                                <div class="menu_content url jsMain" id="url" style="display: none;">
                                                    <form action="" id="urlForm" onsubmit="return false;">
                                                        <p class="menu_content_tips tips_global">订阅者点击该子菜单会跳到以下链接</p>
                                                        <div class="frm_control_group">
                                                            <label for="" class="frm_label">页面地址</label>
                                                            <div class="frm_controls">
                                                                <span class="frm_input_box">
                                                                    <input type="text" class="frm_input" id="urlText" name="urlText">
                                                                </span>
                                                                <p class="profile_link_msg_global menu_url mini_tips warn dn js_warn">
                                                                    请勿添加其他公众号的主页链接
                                                                </p>
                                                                <p class="frm_tips" id="js_urlTitle" style="display: none;">来自<span class="js_name"></span>
                                                                <span style="display:none;"> -《<span class="js_title"></span>》</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="frm_control_group btn_appmsg_wrap">
                                                            <div class="frm_controls">
                                                                <p class="frm_msg fail dn" id="urlUnSelect" style="display: none;">
                                                                    <span for="urlText" class="frm_msg_content" style="display: inline;">请选择一篇文章</span>
                                                                </p>
                                                                <a href="javascript:;" id="js_appmsgPop">从公众号图文消息中选择</a>
                                                                <a href="javascript:void(0);" class="dn btn btn_default" id="js_reChangeAppmsg">重新选择</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="menu_content weapp " id="weapp" style="display: none;">
                                                    <div class="link_weapp_loading js_link_weapp_loading" style="display: none;">
                                                        <i class="icon_loading_small white"></i>
                                                    </div>
                                                    <div class="weapp_empty_box js_weapp_no_binded_hint">
                                                        <p class="desc">自定义菜单可跳转已绑定的小程序，本公众号尚未绑定小程序。</p>
                                                        <a href="https://mp.weixin.qq.com/cgi-bin/wxopen?action=list&amp;token=2087822649&amp;lang=zh_CN" class="btn btn_default">前往绑定</a>
                                                    </div>
                                                    <form action="" id="weappSettingsForm" onsubmit="return false;">
                                                        <p class="menu_content_tips tips_global">订阅者点击该子菜单会跳到以下小程序</p>
                                                            <div class="frm_control_group js_weapp_select_group">
                                                                <label for="" class="frm_label">小程序</label>
                                                                <div class="frm_controls">
                                                                    <a href="" class="btn btn_default js_weapp_select">选择小程序</a>
                                                                </div>
                                                                <input type="hidden" class="js_weapp_appid" id="" name="">
                                                            </div>
                                                            <div class="frm_control_group js_weapp_path_group">
                                                            <label for="" class="frm_label">小程序路径</label>
                                                            <div class="frm_controls">
                                                                <span class="frm_input_box">
                                                                    <input type="text" class="frm_input js_weapp_path" id="" name="">
                                                                </span>
                                                                <p class="frm_tips">已选择小程序 - <span class="js_weapp_title">中华小当家</span>
                                                                </p>
                                                                <a href="" class="btn btn_default js_weapp_select">重新选择</a>
                                                            </div>
                                                        </div>
                                                        <div class="frm_control_group">
                                                            <label for="" class="frm_label">备用网页</label>
                                                            <div class="frm_controls js_weapp_backup_url_input_wrapper">
                                                                <span class="frm_input_box js_weapp_backup_url_input">
                                                                    <input type="text" class="frm_input js_weapp_backup_url" id="" name="">
                                                                </span>
                                                                <div class="js_weapp_backup_url_select" style="display: none">
                                                                    <p><a href="javascript:;" id="js_weapp_appmsgPop">从公众号图文消息中选择</a></p>
                                                                    <p class="frm_tips js_weapp_url_title" style="display: none;">来自<span class="js_name"></span>
                                                                        <span style="display:none;"> -《<span class="js_title"></span>》</span>
                                                                    </p>
                                                                    <a href="javascript:void(0);" class="dn btn btn_default" id="js_weapp_reChangeAppmsg">重新选择</a>
                                                                </div>
                                                                <p class="profile_link_msg_global mini_tips warn dn js_warn"></p>
                                                                <p class="frm_tips" id="" style="">旧版微信客户端无法支持小程序，用户点击菜单时将会打开备用网页。</p>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="menu_content sended" style="display:none;">
                                                    <p class="menu_content_tips tips_global">订阅者点击该子菜单会跳到以下链接</p>
                                                    <div class="msg_wrp" id="viewDiv"></div>
                                                    <p class="frm_tips">来自<span class="js_name">素材库</span>
                                                        <span style="display:none;"> -《<span class="js_title"></span>》</span>
                                                    </p>
                                                </div>
                                                <div id="js_errTips" style="display:none;" class="msg_sender_msg mini_tips warn"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="editor_arrow_wrp">
                                        <i class="editor_arrow editor_arrow_out"></i>
                                        <i class="editor_arrow editor_arrow_in"></i>
                                    </span>
                                </div>
                            </div>
                        </div>



                        <div class="tool_bar tc js_editBox">
                            <span id="pubBt" class="btn btn_input btn_primary">
                                <button>保存并发布</button>
                            </span>
                            <a href="javascript:void(0);" class="btn btn_default" id="viewBt">预览</a>
                        </div>
<!-- wechat -->


                    </div> <!-- end col -->
                    
                </div> <!-- end row -->

            </div>
@endsection
            

<!-- 加js代码，或引入 -->
@section('jquery')
<script type="text/javascript" src="/js/layui/layui.js"></script>
<script type="text/javascript" src="/admin/wechat/automenu/automenu.js"></script>
<script type="text/javascript">
    $(function(){
        $('#computer_footer').css('display', 'none');
        layui.use('layer', function(){
            window.layer = layui.layer;
        });
    })
</script>
@endsection