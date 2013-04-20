ETReports = {
  
  closeFunction: function(){
     ETReports.close($(this).parents(".reportContainer"));
  },
  
  openFunction: function(){
      ETReports.open($(this).parents(".reportContainer"));
  },
  
  init: function(){
      ET.selector = true
      
      $("[class*=control-]").tooltip({alignment: "center"});
      $(".control-reportClose").click(this.closeFunction);
      $(".control-reportOpen").click(this.openFunction);
      $(".control-reportDetail").click(function(){
          ETReports.detail($(this).parents(".reportContainer"));
      })
      
      this.openReports   = $("#moderationOpen");
      this.closedReports = $("#moderationClosed");      
  },
  
  toggle: function(sender, closing){
    if (!sender) return false;
    
    confMsg = T('Are you sure you want to ' + (closing ? 'close' : 'open') + ' the report?')
    
    conf = confirm(confMsg);
    if (!conf) return false;
    
    var id = sender.data('reportid');
    
    if (closing){
        ajaxId  = 'reportClose';
        ajaxUrl = 'moderation/reportClose';
        newDiv  = ETReports.closedReports;
        childClass = ".control-reportClose";
        newTitle   = T('Open');
        newFunc    = ETReports.openFunction;
    } else {
        ajaxId  = 'reportOpen';
        ajaxUrl = 'moderation/reportOpen';
        newDiv  = ETReports.openReports;
        childClass = ".control-reportOpen";
        newTitle   = T('Close');
        newFunc    = ETReports.closeFunction;
    }
    
    oldDiv = newDiv == ETReports.openReports ? ETReports.closedReports : ETReports.openReports;
    
    $.ETAjax({
        id: ajaxId,
        url: ajaxUrl,
        type: "post",
        data: {'reportId': id},
        success: function(data){
            if (data['sucess']) {
                // Se só houver "Sem denúncias", remove a visibilidade.
                reports = newDiv.children();
                
                if (reports.size() == 1) reports.slideUp(); 

                // Se não houverem denúncias, adiciona a visibilidade.
                reports = oldDiv.children();
                if (reports.size() == 2) reports.slideDown();
                    
                sender.slideUp({complete: function(){ // Após o slideUp:
                    // Remove a denúncia da div (aberta/fechada) e adiciona na contrária
                    sender.detach().appendTo(newDiv);
                    
                    // Muda classe Aberta <-> Fechada
                    ctrl = $(sender.children().children().children(childClass))
                    ctrl.toggleClass('control-reportClose');
                    ctrl.toggleClass('control-reportOpen');
                    
                    // Atualiza o título (tooltip)
                    ctrl.data('title', newTitle);
                    ctrl.attr('title', newTitle);
                    ctrl.html(newTitle);
                    
                    // Atualiza a função Abrir // Fechar
                    ctrl.unbind('click');
                    ctrl.click(newFunc)
                    
                    // Fade in já na nova div
                    sender.slideDown();
                }})
            }
        }
    });
  },
  
  open: function(sender){
      ETReports.toggle(sender, false);
  },
  
  close: function(sender){
      ETReports.toggle(sender, true);
  },
  
  detail: function(sender){
      if (sender.data("visible")){
          mainDiv = sender.children('.reportDetail')
          
          mainDiv.slideUp({complete: function(){
                 mainDiv.detach();
          }});
      
          sender.data('visible', false);
      } else {
        $.ETAjax({
          id: 'reportDetail',
          url: 'moderation/reportDetail',
          type: 'post',
          data: {'reportId': sender.data('reportid')},
          success: function(data){
                console.log(data);
                sender.data('visible', true)

                // Div principal
                mainDiv = $('<div class="reportDetail"></div>');
                sender.append(mainDiv);

                // Separador
                mainDiv.append($('<hr class="sep"/>'));

                // Comentários
                commentList = $("<ul></ul>");
                jQuery.each(data['comments'], function(id, elem){
                    commentList.append($("<li></li>").append($(elem)))
                });
                 mainDiv.append(commentList);
                
                // Separador
                mainDiv.append($('<hr class="sep"/>'));
                
                // Conteúdo do post
                postContent = $('<div class="reportPostContent"></div>');
                mainDiv.append(postContent);
                postContent.html(data['postData']);
                
                // Tooltip do tempo
                $('span.time').tooltip({alignment: 'center'});
                 
                // Mostra
                mainDiv.slideDown();
          }
        });
      }
  }

};

$(function() {
	ETReports.init();
});