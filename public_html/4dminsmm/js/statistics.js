$(function() {
$('#source').tableBarChart('.chart1', '', false);
$('#oincomesta').tableBarChart('.chart2', '', false);
$(".chart2 .doll").each(function(){
if($(this).html()==""){
$(this).html("$0");
}else {
$(this).html("$"+$(this).html());
}
});
});