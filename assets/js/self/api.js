//平台端的接口，JS获取在此处修改，php获取在MesContro
URL_API = "http://192.168.0.100:8080/"

function getApiIp(){
    return URL_API;
}

function getProMesAll(url) {
    
    $.ajax({
        type:"post",
        url:URL_API+"TongXinweb/project/AllPro",
        async:true,
        data:'',
        dataType:'json',
        success:function(data){
            if(data['success']) {
                tableProAll(data['data']);
            }
        },
        error:function(s,e,t){
            console.log(s,e,t);
        }
    });
}

function getProMesSel(data) {
    $.ajax({
        type:"post",
        url:URL_API+"TongXinweb/project/GetProById",
        async:true,
        data:{
            "projectId":"0b5c5b47-0927-48ec-a336-9b925881ec54",
        },
        success:function(data){
            console.log(data);
//          return dara;
        },
        error:function(s,e,t){
            console.log(s,e,t);
        }
    });
}

function getFomMesAll() {
    
    $.ajax({
        type:"post",
        url:URL_API+"TongXinweb/form/Allform",
        async:true,
        data:'',
        dataType:'json',
        success:function(data){
            
        },
        error:function(s,e,t){
            console.log(s,e,t);
        }
    });
}

function getFomMesSel_ProId() {
    var proId = sessionStorage.getItem('projectId');
    $.ajax({
        type:"post",
        url:URL_API+"TongXinweb/form/getFormByPid",
        async:true,
        data:{
            "projectId":proId,
        },
        dataType:'json',
        success:function(data){
            if(data['success']) {
                tabMesShow_Pro(data['data']);
            }
        },
        error:function(s,e,t){
            console.log(s,e,t);
        }
    });
}

function getFomMesSel_FomId() {
    $.ajax({
        type:"post",
        url:URL_API+"TongXinweb/form/getFormByFid",
        async:true,
        data:{
            "formId":"36dde2bb-d8bc-4cf2-aa7e-3c8fe2a8bb0b",
        },
        success:function(data){
            console.log(data);
//          return dara;
        },
        error:function(s,e,t){
            console.log(s,e,t);
        }
    });
}

function getAllNote() {
    $.ajax({
    	type:"post",
    	url:URL_API+"TongXinweb/Tree/AllNode",
    	async:true,
    	dataType:'json',
    	success:function(data){
    	    console.log(data)
    	},
    	error:function(s,e,t){
    	    console.log(s)
    	}
    });
}
