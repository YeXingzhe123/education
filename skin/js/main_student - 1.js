$(function () {
$('#box').layout({
fit : true,
});
$('#boxaccordion').accordion({
fit : true,
border : true,
animate : true,
multiple : false,
selected : 1,
});
$('#boxaccordion_basic').panel({
	iconCls: 'icon-edit',
	headerCls:'header1',
});
$('#boxaccordion_paper').panel({
	iconCls: 'icon-edit',
	headerCls:'header1',
});
$('#student_tree_1').tree({
		url : './skin/js/tree.json',
		animate : true,
		lines : true,
       onClick : function (node) {
           if (node.id==11){
               addTabs(node.id,node.text,node.url);
           }

    },
});
    $('#student_tabs').tabs({
        fit : true,
    });


    var ischart = '';
    function addTabs(id,tit,url){
        var ishas = $("#student_tabs").tabs('exists',ischart);
        if(!ishas){
            $("#student_tabs").tabs('add',{
                id : id,
                title : tit,
                href : url,//'./index.php?m=home&c=advisoredit&a=add',
                closable : true

            });
            ischart = tit;
        }

    }
	
});

