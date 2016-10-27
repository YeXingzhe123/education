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
           if (node.url){
               //alert({$advisor_id});
               if($('#student_tabs').tabs('exists',node.text)){
                   $('#student_tabs').tabs('select', node.text)
               }
               else{
               $('#student_tabs').tabs('add',{
                   title:node.text,
                   href:node.url,
                   closable:true,
                   iconcls:node.inconcls,


               })
               }

           }

    },
});
    $('#student_tabs').tabs({
        fit : true,
        border:false,
    });


    var ischart = '';

	
});

