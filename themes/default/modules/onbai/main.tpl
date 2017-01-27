<!-- BEGIN: main -->
<div id="menuonbai">
    <a title="{LANG.ques}" href="{URL_QUES}" class="menu1">{LANG.ques}</a>        
    <a title="{LANG.test}" href="{URL_TEST}" class="menu2">{LANG.test}</a>    
    <a title="{LANG.compulsory}" href="{URL_COMPULSORY}" class="menu3">{LANG.compulsory}</a>    
</div>
<!-- BEGIN: loop -->
<h2 class="ques">{title}</h2>
<div class="bodyques">
    {ques}
</div>
<p onclick="ShowHide('what{DIV}'); return false;" id="show" class="show_anwser">{LANG.look}</p>
<div id="what{DIV}" class="anwser">
    {anwser}
</div>
<!-- END: loop -->
<script type="text/javascript">
function ShowHide(what){
    $("#"+what+"").animate({"height": "toggle"}, { duration: 90 });
}
</script>
<!-- END: main -->