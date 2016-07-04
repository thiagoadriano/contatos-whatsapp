$(function(){
    var sandbox     = $('#sandbox-container'),
        btn         = $('#exportar'),
        dataInicial = $('#dataInicial'),
        dataFinal   = $('#dataFinal'),
        ipt         = $('input[type="radio"]'),
        iptChecked  = "all";
    sandbox.hide();
    
    function manipulaData(data)
    {
        var partesData = data.split('/');
        return new Date( partesData[2], partesData[1] - 1, partesData[0] );
    }
        
    ipt.on('click', function(){
        if($(this).val() === 'all'){
            sandbox.hide('fast');
            iptChecked = "all";
        }else{
            sandbox.show('fast');
            iptChecked = "data";
        } 
    });
    
    btn.on('click', function(e){
        e.preventDefault();

        if(!dataInicial.val() && iptChecked !== 'all')
        {
            $('#erro').show('fast');
        }
        else if(iptChecked !== 'all' && dataInicial.val() && dataFinal.val() && (manipulaData(dataFinal.val()) < manipulaData(dataInicial.val()) ))
        {
            $('#erroData').show('fast');
        }
        else
        {
            $('#formExport').submit();
        }
    });
    
    $('#sandbox-container .input-group.date').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        clearBtn: true,
        language: "pt-BR",
        orientation: "top left",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
});