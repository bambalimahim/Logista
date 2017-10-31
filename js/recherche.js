$(document).ready(function(){
    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-chevron-down glyphicon-chevron-right');
    }
    
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
    
    $("#z").trigger('click');

    function Resolveparam(e,parameter,self) {
        e.preventDefault();
        var param = self.attr("href").replace("#","");
        var concept = self.text();
        $('.search-panel span#search_concept_'+parameter).text(concept);
        $('.input-group #search_param_'+parameter).val(param);
    }

    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        //console.log($(this));
        Resolveparam(e,$(this).parent().parent().parent().parent().children(1)[1].name,$(this));
        //onsole.log($(this).parent().parent().parent().parent().children(1)[1].name);
     });
    
    /*$('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();
        $('.search-panel span#search_concept_prenom').text(concept);
        $('.input-group #search_param_prenom').val(param);
    });*/
    
    function addfilter(nameId,textOfTheLabel,typeOfTheInput){
        var inbefore = $("fieldset:first");
        //the big div form-group col-xs-6
        var render = $(document.createElement("div"));
        render.addClass('form-group col-xs-6');
        render.html("\
            <label for=\""+nameId+"\">"+textOfTheLabel+"</label>\
            <div class=\"input-group\">\
            <input type=\"hidden\" name=\"search_param_"+nameId+"\" id=\"search_param_"+nameId+"\">\
            <input type=\""+typeOfTheInput+"\" class=\"form-control\" name=\""+nameId+"\" id=\""+nameId+"\">\
            <div class=\"input-group-btn search-panel\">\
            <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">\
            <span id=\"search_concept_"+nameId+"\">Contient</span> <span class=\"caret\"></span>\
            </button>\
            <ul class=\"dropdown-menu\" role=\"menu\">\
            <li><a href=\"#contient\">Contient</a></li>\
            <li><a href=\"#commencepar\">Commence par</a></li>\
            <li><a href=\"#terminepar\">Termine par</a></li>\
            <li><a href=\"#est\">Est</a></li>\
            </ul>\
            </div>\
            </div>\
            ");
        render.insertBefore(inbefore);
        $("#filteradder").val("dfault");
        $("#filteradder option[value="+nameId+"]").remove();
    }
    
    $("#filteradder").change(function () {
        if($(this).val()!="dfault"){
            var newfilter = $(this).val();
            switch (newfilter) {
                case "numTel":
                    addfilter("numTel","Numéro de Téléphone","text");
                    break;
                case "cni":
                    addfilter("cni","CNI","text");
                    break;
                case "serieBac":
                    addfilter("serieBac","Série Bac","text");
                    break;
                default:
                    addfilter("matricule",'Matricule','text');
                    break;
            }
        }
    });
});