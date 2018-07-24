$(function(){
    /*
     * 左边树/菜单栏动作
     */
//动态指示页面标签
    var tagName = sessionStorage.getItem("tagName"); //获取键的值
    //左侧栏状态初始化
    if(!tagName){
        var tagName = 'affairShow_Want';
    }
    $('#'+tagName).parent('.TagSon').addClass('active');
    $('#'+tagName).parents('.TagFather').addClass('open');
    
//  点击菜单后，JS写入缓存
    $('.TagSet').click(function(){
        $pageSta = $(this).attr("id");
        if($pageSta == 'SignOut') {
            $pageSta = 'affairShow_Want';
        }
        sessionStorage.setItem("tagName", $pageSta); //设置键的值
    });
    
    /*
     * 表单、文档和工程的绑定
     */
    var ProSelect = sessionStorage.getItem("ProSelect");
    if(ProSelect===null||ProSelect.length==0) {
        $('.Require').addClass('NoAction');
    }
    
    $('.SelectPro').click(function(){
        sessionStorage.setItem("ProSelect",$(this).text().replace(/\s/g, ""));
        $('.Require').removeClass('NoAction');
    })
    
    /*
     * model
     */
    //override dialog's title function to allow for HTML titles
    $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
        _title: function(title) {
            var $title = this.options.title || '&nbsp;'
            if( ("title_html" in this.options) && this.options.title_html == true )
                title.html($title);
            else title.text($title);
        }
    }));
    
    $( "#id-btn-dialog" ).on('click', function(e) {
        e.preventDefault();
    
        var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
            modal: true,
            title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>工作流设置</h4></div>",
            title_html: true,
            buttons: [ 
                {
                    text: "取消",
                    "class" : "btn btn-minier",
                    click: function() {
                        $( this ).dialog( "close" ); 
                    } 
                },
                {
                    text: "确定",
                    "class" : "btn btn-primary btn-minier",
                    click: function() {
                        
//                      $('#CirMes tr').eq(1).find('td').eq(2).find('select').val();
                        $( this ).dialog( "close" );
                    } 
                }
            ],
            width: "1200px",
        });
    });
    

});
