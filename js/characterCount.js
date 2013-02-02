$(function(){
   var counter = $("#characterCount #value");
   var text    = $("#characterCount #text");
   
   var maxValue = ET.charCountMax;
   var singular = ET.charCountSingular;
   var plural   = ET.charCountPlural;
   var elem     = ET.charCountElem;
   
   $("#" + elem + " textarea").characterCounter(maxValue, function(length){
      left = maxValue - length;
      counter.html(left);
      text.html(left == 1 ? singular : plural);
   });
});