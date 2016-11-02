<?php if (!defined('THINK_PATH')) exit();?><div style="position: relative;left: 0px;top: 0px;">
    <div style="position: absolute;left:10px;top: 10px;">学生/教师添加修改 >>
        <font style="font-weight: bold"> 添加/修改学生</font> </div>
    <div style="position: absolute;left: 50px;top: 30px;"><table id="admin_item_box" style="width: 900px;"></table>
</div>
<div id="admin_item_tb" style="">
    <div style="">
        <table style="width: 890px">
            <tr><td style="width: 450px;text-align: left;">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="obj_admin_item.add();">添加</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="obj_admin_item.edit();">修改</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="obj_admin_item.remove();">删除</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" style="display:none;" id="save" onclick="obj_admin_item.save();">保存</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" style="display:none;" id="redo" onclick="obj_admin_item.redo();">取消编辑</a>
            </td>
                <td style="width: 450px;text-align: right;">
        查询班级：<input type="text" class="textbox" name="items_name" style="width:110px">

        <a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="obj_admin_item.search();">查询</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>  </tr> </table>
    </div>
</div></div>
<script type="text/javascript">
$(function () {

    obj_admin_item = {
        editRow : undefined,
        search : function () {
            $('#admin_item_box').datagrid('load', {
                items_name : $.trim($('input[name="items_name"]').val()),
            });
        },
        add : function () {
            $('#save,#redo').show();
          
            if (this.editRow == undefined) {
                //添加一行
                $('#admin_item_box').datagrid('insertRow', {
                    index : 0,
                    row : {
                    //    item_sex:'男',
                    //    item_password:'123456',
                        /*
                         user : 'bnbbs',
                         email : 'bnbbs@163.com',
                         date : '2014-11-11',
                         */
                    },
                });

                //将第一行设置为可编辑状态
                $('#admin_item_box').datagrid('beginEdit', 0);

                this.editRow = 0;
            }
        },
        save : function () {
            //这两句不应该放这里，应该是保存成功后，再执行
            //$('#save,#redo').hide();
            //this.editRow = false;
            //将第一行设置为结束编辑状态
            $('#admin_item_box').datagrid('endEdit', this.editRow);
        },
        redo : function () {
            $('#save,#redo').hide();
            this.editRow = undefined;
            $('#admin_item_box').datagrid('rejectChanges');
        },
        edit : function () {
            var rows = $('#admin_item_box').datagrid('getSelections');
            if (rows.length == 1) {
                if (this.editRow != undefined) {
                    $('#admin_item_box').datagrid('endEdit', this.editRow);
                }

                if (this.editRow == undefined) {
                    var index = $('#admin_item_box').datagrid('getRowIndex', rows[0]);
                    $('#save,#redo').show();
                    $('#admin_item_box').datagrid('beginEdit', index);
                    this.editRow = index;
                    $('#admin_item_box').datagrid('unselectRow', index);
                }
            } else {
                $.messager.alert('警告', '修改必须或只能选择一行！', 'warning');
            }
        },
        remove : function () {
            var rows = $('#admin_item_box').datagrid('getSelections');
            if (rows.length > 0) {
                $.messager.confirm('确定操作', '您正在要删除所选的记录吗？', function (flag) {
                    if (flag) {
                        var ids = [];
                        for (var i = 0; i < rows.length; i ++) {
                            ids.push(rows[i].items_id);
                        }
                        $.ajax({
                            type : 'POST',
                            url : '<?php echo U("deleteitem_info");?>',
                            data : {
                                ids : ids.join(','),
                            },
                            beforeSend : function () {
                                $('#admin_item_box').datagrid('loading');
                            },
                            success : function (data) {
                                if (data) {
                                    $('#admin_item_box').datagrid('loaded');
                                    $('#admin_item_box').datagrid('load');
                                    $('#admin_item_box').datagrid('unselectAll');
                                    $.messager.show({
                                        title : '提示',
                                        msg : data+'学生被删除成功！',
                                    });
                                }
                            },
                        });
                    }
                });
            } else {
                $.messager.alert('提示', '请选择要删除的记录！', 'info');
            }
        },
    };

    $('#admin_item_box').datagrid({
        width : 900,
       // url : '<?php echo U("read_search_item");?>',
        url : '<?php echo U("readallitem");?>',
        title : '<center>学生列表</center>',
        iconCls : 'icon-search',
        striped : true,
        nowrap : true,
        rownumbers : true,
        //singleSelect : true,
        fitColumns : true,
        columns : [[
            {
                field : 'items_name',
                title : '类目(班级)名',
                sortable : true,
                width : 150,
                editor : {
                    type : 'validatebox',
                    options : {
                        required : true,
                        validType : 'length[2,6]',
                    },
                },
            },
            {
                field : 'items_times',
                title : '总次数',
                sortable : true,
                width : 150,
                editor : {
                    type : 'numberbox',
                    options : {
                        required : true,
                        validType : 'length[1,5]',
                    },
                },
            },
         
              {
                field : 'items_price',
                title : '单次价格',

                width : 150,
                editor : {
                    type : 'numberbox',
                    options : {
                        required : true,
                        validType : 'length[1,20]',


                    },
                },
            },
               {
                field : 'teacher_name',
                title : '负责老师',
                width : 150,
                  editor : {
                    type : 'combobox',
                    options : {
                    url:'<?php echo U("read_all_teacher");?>',
                    required : true,
                    valueField:'teacher_id',
                     textField:'teacher_name',
                     editable:'false',
                     panelHeight:150,
                     onLoadSuccess: function () {
                            if(obj_admin_item.editRow>0){
                                var row = $('#admin_student_box').datagrid('getData').rows[obj_admin_item.editRow];
                                $(this).combobox('setValue', row["teacher_id"]);
                                $(this).combobox('setText', row["teacher_name"]);
                            }
                      }

                    }
                }

            },
              {
                field : 'items_id',
                title : 'aa',
                hidden:'true',
                width : 0

            },
        ]],
        toolbar : '#admin_item_tb',
        pagination : true,
        pageSize : 10,
        pageList : [10, 20, 30],
        pageNumber : 1,
        sortName : 'items_name',
        sortOrder : 'DESC',
        onDblClickRow : function (rowIndex, rowData) {

            if (obj_admin_item.editRow != undefined) {
                $('#admin_item_box').datagrid('endEdit', obj_admin_item.editRow);
            }
            else{
                if (obj_admin_item.editRow == undefined) {
                $('#save,#redo').show();
                 obj_admin_item.editRow = rowIndex;
                $('#admin_item_box').datagrid('beginEdit', rowIndex);
                    obj_admin_advisor.editRow = rowIndex;

                 }
            }

        },
        onAfterEdit : function (rowIndex, rowData, changes) {
            $('#save,#redo').hide();

            var inserted_item = $('#admin_item_box').datagrid('getChanges', 'inserted');
            var updated_item = $('#admin_item_box').datagrid('getChanges', 'updated');


            obj_admin_item.editRow = undefined;


            var url = info =  '';

            //新增用户
            if (inserted_item.length > 0) {
                url = '<?php echo U("additem_info");?>';
                info = '新增';
            }

            //修改用户
            if (updated_item.length > 0) {
                url = '<?php echo U("updateitem_info");?>';
                info = '修改';
            }

            $.ajax({
                type : 'POST',
                url : url,
                data : {
                    row : rowData,
                },
                beforeSend : function () {
                    $('#box').datagrid('loading');
                },
                success : function (data) {
                    if (data=="成功") {
                        $('#admin_item_box').datagrid('loaded');
                        $('#admin_item_box').datagrid('load');
                        $('#admin_item_box').datagrid('unselectAll');
                        $.messager.show({
                            title : '提示',
                            msg :  '用户被' + info + '成功！',
                        });
                        obj_admin_item.editRow = undefined;
                    }
                    else{
                        $('#admin_item_box').datagrid('loaded');
                        $('#admin_item_box').datagrid('load');
                    }
                },
            });
            //console.log(rowData);
        },
    });

});

</script>