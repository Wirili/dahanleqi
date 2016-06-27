/**
 * Created by w3324 on 2016/5/6.
 */
$(function(){
    var oLanguage={
        "oAria": {
            "sSortAscending": ": 升序排列",
            "sSortDescending": ": 降序排列"
        },
        "oPaginate": {
            "sFirst": "首页",
            "sLast": "末页",
            "sNext": "下页",
            "sPrevious": "上页"
        },
        "sEmptyTable": "没有相关记录",
        "sInfo": "第 _START_ 到 _END_ 条记录，共 _TOTAL_ 条",
        "sInfoEmpty": "第 0 到 0 条记录，共 0 条",
        "sInfoFiltered": "(从 _MAX_ 条记录中检索)",
        "sInfoPostFix": "",
        "sDecimal": "",
        "sThousands": ",",
        "sLengthMenu": "每页数:_MENU_",
        "sLoadingRecords": "正在载入...",
        "sProcessing": "正在载入...",
        "sSearch": "搜索:",
        "sSearchPlaceholder": "",
        "sUrl": "",
        "sZeroRecords": "没有相关记录"
    }
    $.fn.dataTable.defaults.oLanguage=oLanguage;
    //提示栏
    $('[data-toggle="tooltip"]').tooltip();

    $('.menu-list').on('mouseover',function(){
        $(this).addClass('nav-hover');
    });
    $('.menu-list').on('mouseout',function(){
        $(this).removeClass('nav-hover');
    });
    $('.menu-list > a').on('click',function(){
        if(!$('body').hasClass('mini')) {
            var t = $(this);
            if (t.parent('.menu-list').hasClass('nav-active')) {
                t.next('.sub-menu-list').slideUp(200, function () {
                    t.parent('.menu-list').removeClass('nav-active')
                });
            } else {
                visibleSubMenuClose();
                t.parent('.menu-list').addClass('nav-active')
                t.next('.sub-menu-list').slideDown(200);
            }
        }
    });

    function visibleSubMenuClose() {
        $('.menu-list').each(function() {
            var t = $(this);
            if(t.hasClass('nav-active') && t.find('> ul').length > 0) {
                t.find('> ul').slideUp(200, function(){
                    t.removeClass('nav-active');
                });
            }else{
                t.removeClass('nav-active');
            }
        });
    }
});
