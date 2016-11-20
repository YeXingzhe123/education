<?php if (!defined('THINK_PATH')) exit();?><div style="position: relative;left: 0px;top: 0px;">
    <div style="position: absolute;left:10px;top: 10px;">教师添加修改 >>
        <font style="font-weight: bold"> 添加/修改教师</font> </div>
    <div style="position: absolute;left: 50px;top: 30px;"><table id="admin_teacher_box" style="width: 900px;"></table>
</div>
<div id="admin_teacher_tb" style="">
    <div style="">
        <table style="width: 890px">
            <tr><td style="width: 450px;text-align: left;">
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="obj_admin_teacher.add();">添加</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="obj_admin_teacher.edit();">修改</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="obj_admin_teacher.remove();">删除</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" style="display:none;" id="save" onclick="obj_admin_teacher.save();">保存</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" style="display:none;" id="redo" onclick="obj_admin_teacher.redo();">取消编辑</a>
            </td>
                <td style="width: 450px;text-align: right;">
        查询姓名/工号：<input type="text" class="textbox" name="teacher_name" style="width:110px">

        <a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="obj_admin_teacher.search();">查询</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>  </tr> </table>
    </div>
</div></div>
<script type="text/javascript">
$(function () {

    obj_admin_teacher = {
        editRow : undefined,
        search : function () {
            $('#admin_teacher_box').datagrid('load', {
                teacher_name : $.trim($('input[name="teacher_name"]').val()),
            });
        },
        add : function () {
            $('#save,#redo').show();
            /*
             //当前页行结尾添加
             $('#box').datagrid('appendRow', {
             user : 'bnbbs',
             email : 'bnbbs@163.com',
             date : '2014-11-11',
             });
             */

            if (this.editRow == undefined) {
                //添加一行
                $('#admin_teacher_box').datagrid('insertRow', {
                    index : 0,
                    row : {
                        teacher_sex:'男',
                        teacher_password:'123456',
                        /*
                         user : 'bnbbs',
                         email : 'bnbbs@163.com',
                         date : '2014-11-11',
                         */
                    },
                });

                //将第一行设置为可编辑状态
                $('#admin_teacher_box').datagrid('beginEdit', 0);

                this.editRow = 0;
            }
        },
        save : function () {
            //这两句不应该放这里，应该是保存成功后，再执行
            //$('#save,#redo').hide();
            //this.editRow = false;
            //将第一行设置为结束编辑状态
            $('#admin_teacher_box').datagrid('endEdit', this.editRow);
        },
        redo : function () {
            $('#save,#redo').hide();
            this.editRow = undefined;
            $('#admin_teacher_box').datagrid('rejectChanges');
        },
        edit : function () {
            var rows = $('#admin_teacher_box').datagrid('getSelections');
            if (rows.length == 1) {
                if (this.editRow != undefined) {
                    $('#admin_teacher_box').datagrid('endEdit', this.editRow);
                }

                if (this.editRow == undefined) {
                    var index = $('#admin_teacher_box').datagrid('getRowIndex', rows[0]);
                    $('#save,#redo').show();
                    $('#admin_teacher_box').datagrid('beginEdit', index);
                    this.editRow = index;
                    $('#admin_teacher_box').datagrid('unselectRow', index);
                }
            } else {
                $.messager.alert('警告', '修改必须或只能选择一行！', 'warning');
            }
        },
        remove : function () {
            var rows = $('#admin_teacher_box').datagrid('getSelections');
            if (rows.length > 0) {
                $.messager.confirm('确定操作', '您正在要删除所选的记录吗？', function (flag) {
                    if (flag) {
                        var ids = [];
                        for (var i = 0; i < rows.length; i ++) {
                            ids.push(rows[i].teacher_id);
                        }
                        //console.log(ids.join(','));
                        $.ajax({
                            type : 'POST',
                            url : '<?php echo U("deleteteacher_info");?>',
                            data : {
                                ids : ids.join(','),
                            },
                            beforeSend : function () {
                                $('#admin_teacher_box').datagrid('loading');
                            },
                            success : function (data) {
                                if (data) {
                                    $('#admin_teacher_box').datagrid('loaded');
                                    $('#admin_teacher_box').datagrid('load');
                                    $('#admin_teacher_box').datagrid('unselectAll');
                                    $.messager.show({
                                        title : '提示',
                                        msg : data+'教师被删除成功！',
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

    $('#admin_teacher_box').datagrid({
        width : 900,
        url : '<?php echo U("readallteacher");?>',
       // url : 'user.php',
        title : '<center>教师列表</center>',
        iconCls : 'icon-search',
        striped : true,
        nowrap : true,
        rownumbers : true,
        //singleSelect : true,
        fitColumns : true,
        columns : [[
        {
            field : 'teacher_name',
            title : '教师姓名',
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
            field : 'teacher_no',
            title : '工号',
            sortable : true,
            width : 150,
            editor : {
                type : 'numberbox',
                options : {
                    required : true,
                    validType : 'length[3,20]',
                },
            },
        },
        {
            field : 'teacher_password',
            title : '密码',

            width : 150,
            editor : {
                type : 'validatebox',
                options : {
                    required : true,
                    validType : 'length[6,20]',


                },
            },
        },
        {
            field : 'teacher_sex',
            title : '性别',

            width : 50,
            editor : {

                type : 'combobox',
                options : {

                    valueField:'value',
                    textField:'text',
                    editable:false,
                    data:[{
                        value: '男',
                        text: '男'
                    },{
                        value: '女',
                        text: '女'
                    }],

                    panelHeight:40



                },


            },
        },
        {
            field : 'teacher_birthday',
            title : '出生日期',

            width : 100,
            editor : {
                type : 'datebox',
                options : {

                },
            },
        },
        {
            field : 'teacher_id_card',
            title : '身份证号',

            width : 100,
            editor : {
                type : 'numberbox',
                options : {
                    validType : 'length[18,18]',

                },
            },
        },
        {
            field : 'teacher_education',
            title : '学历',

            width : 100,
            editor : {
                type : 'validatebox',
                options : {
                    validType : 'length[2,13]',

                },
            },
        },
        {
            field : 'teacher_major',
            title : '专业',

            width : 100,
            editor : {
                type : 'validatebox',
                options : {
                    validType : 'length[2,13]',

                },
            },
        },
        {
            field : 'teacher_salary',
            title : '薪资',

            width : 100,
            editor : {
                type : 'numberbox',
                options : {
                    validType : 'length[0,9]',

                },
            },
        },
        {
            field : 'teacher_remark',
            title : '备注',

            width : 100,
            editor : {
                type : 'validatebox',
                options : {
                    validType : 'length[0,50]',

                },
            },
        },
            {
                field : 'teacher_id',
                title : 'aa',
                hidden:'true',
                width : 0

            },
        ]],
        toolbar : '#admin_teacher_tb',
        pagination : true,
        pageSize : 10,
        pageList : [10, 20, 30],
        pageNumber : 1,
        sortName : 'teacher_no',
        sortOrder : 'DESC',
        onDblClickRow : function (rowIndex, rowData) {

            if (obj_admin_teacher.editRow != undefined) {
                $('#admin_teacher_box').datagrid('endEdit', obj_admin_teacher.editRow);
            }
            else{
                if (obj_admin_teacher.editRow == undefined) {
                $('#save,#redo').show();
                 obj_admin_teacher.editRow = rowIndex;
                $('#admin_teacher_box').datagrid('beginEdit', rowIndex);
                    obj_admin_advisor.editRow = rowIndex;

                 }
            }

        },
        onAfterEdit : function (rowIndex, rowData, changes) {
            $('#save,#redo').hide();

            var inserted_teacher = $('#admin_teacher_box').datagrid('getChanges', 'inserted');
            var updated_teacher = $('#admin_teacher_box').datagrid('getChanges', 'updated');


            obj_admin_teacher.editRow = undefined;


            var url = info =  '';

            //新增用户
            if (inserted_teacher.length > 0) {
                url = '<?php echo U("addteacher_info");?>';
                info = '新增';
            }

            //修改用户
            if (updated_teacher.length > 0) {
                url = '<?php echo U("updateteacher_info");?>';
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
                        $('#admin_teacher_box').datagrid('loaded');
                        $('#admin_teacher_box').datagrid('load');
                        $('#admin_teacher_box').datagrid('unselectAll');
                        $.messager.show({
                            title : '提示',
                            msg :  '用户被' + info + '成功！',
                        });
                        obj_admin_teacher.editRow = undefined;
                    }
                    else{
                        $('#admin_teacher_box').datagrid('loaded');
                        $('#admin_teacher_box').datagrid('load');
                    }
                },
            });
            //console.log(rowData);
        },
    });

});

</script>