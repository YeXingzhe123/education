<?php if (!defined('THINK_PATH')) exit();?>
<div  style="width:500px;padding: 10px;position: absolute;left:10px;top:30px">
    <table id="tt"></table>

</div>      

<div style="width:500px;padding: 10px;">
    <div id="p" class="easyui-panel" title="  ">
        <div style="padding: 10px;">
        <form>
            <div><span>星期：</span><span>
            <select  name="schedule_weekend" id="schedule_weekend">
              <option value="1">星期一</option>
              <option value="2">星期二</option>
              <option value="3">星期三</option>
              <option value="4">星期四</option>
              <option value="5">星期五</option>
              <option value="6">星期六</option>
              <option value="7">星期日</option>
              </select>
              </span></div>
            <br>
            <div><span>原始时间：</span><span>
           <span><select  name='select_updata_time' id='select_updata_time'><option value="">请选择---</option></select></span>
              </span></div>
            <br>
            <div><span>修改时间：</span><span><input class="easyui-timespinner" style="width:80%;" name="schedule_time" id="schedule_time"/></span></div>
            <br>
            <div><span>类目：</span><div id="select_item" style="width:400px;height:100%;position:relative;top:-20px;left:35px;"></div></div>
            <div id="hidden_data"></div>
            <br>
            <div data-options="region:'south',border:false" style="text-align:right;padding:5px 0 0;">
                            <a class="easyui-linkbutton" data-options="iconCls:'icon-ok'" href="javascript:void(0)" onclick="select_item_submit()" style="width:80px">确认修改</a>
                            <a class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" href="javascript:void(0)" onclick="$('#window_add_schedule').window('close');" style="width:80px">取消</a>
            </div>
            </form>
        </div>
        </div>
    </div>


</div>



<script type="text/javascript">

function select_item_submit(){
   
// 处理复选框数值
var str='/';
$('input[name="schedule_items_id"]:checked').each(
    function(){
    str = str+$(this).val()+"/";
 
});
// 处理隐藏框数值
var hidden='@';
$('input[name="hidden_id"]').each(
    function(){
    hidden = hidden+$(this).val()+"@";
});
$.ajax({
                type : 'POST',
                url : '<?php echo U("updateschedule_info");?>',
                dataType:'text',
                data:{  
            "schedule_weekend":$('#schedule_weekend').val(),
            "select_updata_hidden":hidden,
            "schedule_time":$("#schedule_time").val(),
            "schedule_items_id":str, 
                },
                success : function (data) {
                 
              $.messager.alert('消息','修改成功');
                $('#window_add_schedule').window("close");
                },
            });
    
};
// 读取时间
$.ajax({
    url:'<?php echo U("read_all_time");?>',
    type:'GET',
    dataType:'json',
    success:function(data){
        if (data) {
            for(var i=0;i<data.length;i++){       
             $('#select_updata_time').append("<option value='"+data[i].schedule_time+"'>"+data[i].schedule_time+"</option>");
            }
        }else{
            alert("数据返回错误");
        }
    }
   
});
// 读取类目
$.ajax({
    url:'<?php echo U("read_all_items_name");?>',
    type:'GET',
    dataType:'json',
    success:function(data){
        if (data) {
             $('#select_item').empty();
           for(var i=0;i<data.length;i++){
             $('#select_item').append("<span><input name='schedule_items_id' type='checkbox' value='"+data[i].items_id +"' />"+data[i].items_name+"</span><br/>");
            }
        }else{
            alert("数据返回错误");
        }
    }
   
});
// 星期下拉框改变事件
$('#schedule_weekend').change(function()
    {
        //清空节点
         $('#select_updata_time').empty();
          $('#select_updata_time').append("<option>请选择---</option>");
         $.ajax({
        url:'<?php echo U("read_all_time");?>',
        type:'GET',
        dataType:'json',
        success:function(data){
        if (data) {
            for(var i=0;i<data.length;i++){ 
            if (data[i].schedule_weekend == $('#schedule_weekend').val()) {      
             $('#select_updata_time').append("<option value='"+data[i].schedule_time+"'>"+data[i].schedule_time+"</option>");
             }
            }

        }else{
            alert("数据返回错误");
        }
    }
   
        });
    });
// 时间选择框已选择
$('#select_updata_time').change(function()
{

    $.ajax({
    url:'<?php echo U("read_select_items_name");?>',
    type:'GET',
    dataType:'json',
    data:{  
            "schedule_weekend":$('#schedule_weekend').val(),
            "schedule_time":$('#select_updata_time').val(), 
         },
    success:function(data){
         $('input:checkbox').each(function() { 
                $(this).prop("checked", false); 
            });
        if (data) {             
           for(var i=0;i<data.length;i++){
            $('input:checkbox').each(function() { 
                if ($(this).val() ==data[i].schedule_items_id) { 
                    $(this).prop("checked", true); 
                    $("#hidden_data").append("<input type='hidden' name='hidden_id' value='"+ data[i].schedule_id+"'/>");
                };
                
            }); 
            }
           
        }else{
            alert("数据返回错误");
        }
    }
   
    });
});
</script>