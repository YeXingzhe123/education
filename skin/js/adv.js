/**
 * Created by simon on 16-7-12.
 */
$(function () {
    $('#advisor_check').datagrid({
            width:500px,
            title:'毕业设计指导老师一览',

            iconCls:'icon-search',
            url:'{:U("read")}',
            columns :[[{
                field : 'advisor_name',
                title : '姓名 ',
                sortable : true,
            }
                {
                    field : 'advisor_no',
                    title : '工号 ',
                    sortable : true,
                }
                {
                    field : 'college_name',
                    title : '学院 ',
                    sortable : true,
                }
            ]]
    )};
alert("aaa");
});