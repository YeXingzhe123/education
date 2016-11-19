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
            <div><span>时间：</span><span><input class="easyui-timespinner" style="width:80%;" name="schedule_time" id="schedule_time"/></span></div>
            <br>
            <div><span>类目：</span><div id="select_item" style="width:400px;height:100%;position:relative;top:-20px;left:35px;"></div></div>
            <br>
            <div data-options="region:'south',border:false" style="text-align:right;padding:5px 0 0;">
                            <a class="easyui-linkbutton" data-options="iconCls:'icon-ok'" href="javascript:void(0)" onclick="select_item_submit1()" style="width:80px">确认提交</a>
                            <a class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" href="" onclick="$('#window_add_schedule').window('close');" style="width:80px">取消</a>
            </div>
            </form>
        </div>
        </div>
    </div>


</div>



<script type="text/javascript">

function select_item_submit1(){
   
// 处理复选框数值
var str='';
$('input[name="schedule_items_id"]:checked').each(
    function(){
    str = str+$(this).val();
 
});
// 检测提交数据
if ($("#schedule_time").val()=='' || str == '') {
    $.messager.alert('警告','内容不能为空');
}else{
    // 提交数据
$.ajax({
    type : 'POST',
    url : '<?php echo U("addschedule_info");?>',
    dataType:'text',
    data:{  
        "schedule_weekend":$('#schedule_weekend').val(),
        "schedule_time":$("#schedule_time").val(),
        "schedule_items_id":str, 
    },
    success: function (data) {
        console.log('121');
        $.messager.alert('消息','提交成功');
        $('#window_add_schedule').window("close");
    
    },
    
});
};
  
};

$.ajax({
    url:'<?php echo U("read_all_items_name");?>',
    type:'GET',
    dataType:'json',
    success:function(data){
        if (data) {
             $('#select_item').empty();
           for(var i=0;i<data.length;i++){
             $('#select_item').append("<span><input name='schedule_items_id' type='checkbox' value='"+data[i].items_id +"/'/>"+data[i].items_name+"</span><br/>");
            }
        }else{
            alert("数据返回错误");
        }
    }
   
});
</script>