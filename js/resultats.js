$(document).ready(function () {
    $('.lieuNaiss').addClass('hidden');
    $('.paysNaiss').addClass('hidden');
    $('.dateNaiss').addClass('hidden');
    $('.sexe').addClass('hidden');
    $('.serieBac').addClass('hidden');
    $('.resultat').addClass('hidden');
    $('.civilite').addClass('hidden');
    $('.nationalite').addClass('hidden');
    $('#nom_col').change(function () {
        if($('#nom_col').val()!='1'){
            var texte = $('#nom_col').val();
            var th = $('th.'+texte+'');
            var newth = th.clone();
            newth.removeClass('hidden');
            $('#head').append(newth);
            var tds = $('td.'+texte+'');
            var newtds = tds.clone();
            newtds.removeClass('hidden');
            newtds.addClass('notHidden');
            var oldtrs = $('tbody tr');
            for(var i=0;i<newtds.length;i++){
                console.log(newtds[i]);
                oldtrs[i].append(newtds[i]);
            }
            $('#nom_col option[value='+texte+']').remove();
        }
    });

    $('#buttRapport').click(function (e) {
        e.preventDefault();
        //alert();
        $('#formAll').attr('action','admin/attestation_resultat.php');
        //alert($('#formAll').attr('action'));
        var etud = [];
        var j=0;
        $('#formAll').find(':checkbox:checked').each(function () {
            /*if (i==0)
                etud += $(this).val();
            else
                etud += ','+$(this).val();
            */
            if ($(this).attr('id')=='selectAll') {

            }else{
                etud[j] = $(this).val();
                j= j+1;
            }

        });
        $('input[name="choixEtud"]').val(etud);
        console.log($('input[name="choixEtud[]"]'));

        /*
        var typeAtt = $('#typeAttestation').val();
        var dateJury = $('#dateJury').val();
        
        $.ajax({
            type : 'POST',
            url : 'admin/attestation_resultat.php',
            data : {typeAttest : typeAtt, dateJury: dateJury},
            dataType : 'text',
            success : function () {
                console.log('donnees envoyees');
            }
        });
        */
        //$('#formAll').submit();
        if(etud==''){
            alert('Veuillez cocher vos choix!');
            return false;
        }
        $('#formRapports').submit();
    });

    $('#btnSend').click(function (e) {
        e.preventDefault();
        //alert('kjkf');
        //Je commente cette ligne
        //$('#formAll').attr('action','admin/sendSms.php');
        //alert($('#formAll').attr('action'));
        var etud = [];
        var j=0;
        $('#formAll').find(':checkbox:checked').each(function () {
            if ($(this).attr('id')=='selectAll') {

            }else{
                etud[j] = $(this).val();
                j= j+1;
            }
        });
        $('input[name="choixEtud1"]').val(etud);
        //console.log($('input[name="choixEtud[]"]'));
        if(etud==''){
            alert('Veuillez cocher vos choix!');
            return false;
        }
        if($('#msgObject').val()==""){
            alert('Veuillez entrer l objet de votre message');
            return false;
        }
        //ici au lieu de submit on transmet par post
        //$('#formContacts').submit();
        $.post('admin/sendSms.php', { choixEtud1: $('#choixEtud1').val(), msgObject: $('#msgObject').val(), msgContent : $('#msgContent').val() }, function(data, status){
            console.log(data);
            if(status=="success"){
                console.log('Messages envoyes');
            }
        });
        $('#contacts').modal('hide');
        
    });


    //gestion loading
    var $loading = $('#loading').hide();
    $(document)
        .ajaxStart(function () {
            $loading.show();
        })
        .ajaxStop(function () {
            $loading.hide();
            $('#msgSent').modal('show');
        });

    $('#predefinedMessages').find('a').each(function (e) {
        $(this).click(function (e) {
            e.preventDefault();
            var predefinedMessage = $(this).text();
            predefinedMessage = predefinedMessage.split(" : ");
            $('#msgObject').val(predefinedMessage[0]);
            $('#msgContent').text(predefinedMessage[1]);
        });
    });

    $('#typeAttestation').change(function () {
        if ($(this).val()=='AttestationResultat') {
		  /*
            $('#divChoixRap').removeClass('col-md-offset-3');
			 $('#divChoixRap').removeClass('col-md-6');
            $('#divDateJury').removeClass('hidden');
			*/
            $('#formRapports').attr('action','admin/attestation_resultat.php');
			$('#divDateJury').addClass('hidden');
            $('#divChoixRap').removeClass('col-md-6');
            $('#divChoixRap').addClass('col-md-offset-3 col-md-6');
        }

        else if ($('#divDateJury').hasClass('hidden')==false) {
            $('#formRapports').attr('action','admin/certificatInscription.php');
            $('#divDateJury').addClass('hidden');
            $('#divChoixRap').removeClass('col-md-6');
            $('#divChoixRap').addClass('col-md-offset-3 col-md-6');
        }
            

            
    });
    /* selectionner tout */
    $("#selectAll").click(function () {
        if ($("#selectAll").is(':checked')) {
            $("#my-table input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#my-table input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });

    /* Gestion des dependances */
    /* Quand on decoche departement ca decoche dept option et formation */
    $('#departement').click(function () {
        if($("#departement").not(':checked')){
                $('#option').prop('checked', false);
                $('#formation').prop('checked', false);
                $('#niveau').prop('checked',false);
        }
    });

    /* Quand on decoche option ca decoche formation et niveau */
    $('#option').click(function () {
        if($("#option").not(':checked')){
            $('#formation').prop('checked', false);
            $('#niveau').prop('checked',false);
        }
    });
    /* Quand on decoche une formation ca decoche niveau  */
    $('#formation').click(function () {
        if($("#formation").not(':checked')){
            $('#niveau').prop('checked',false);
        }
    });

    /* Quand on coche une option ca coche dept */
    $('#option').click(function () {
        if ($("#option").is(':checked')) {
            $('#departement').prop('checked','true');
        }
    });
    /* Quand on coche une formation ca coche dept et option */
    $('#formation').click(function () {
        if ($("#formation").is(':checked')) {
            $('#departement').prop('checked','true');
            $('#option').prop('checked','true');
        }
    });
    /* Quand on coche  niveau ca coche dept, option et formation */
    $('#niveau').click(function () {
        if ($("#niveau").is(':checked')) {
            $('#departement').prop('checked','true');
            $('#option').prop('checked','true');
            $('#formation').prop('checked','true');
            $('#niveau').prop('checked','true');
        }
    });

});