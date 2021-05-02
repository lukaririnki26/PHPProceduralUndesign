$(document).ready(function(){
    $('#cari').hide();
    $('#txcari').on('keyup',function(){
        //ajax load
        // $('#content').load('ajax/masyarakat.php?cari='+$('#txcari').val());
        $('.loader').show();
        $.get('ajax/masyarakat.php?cari='+$('#txcari').val(),function(data){
            $('#content').html(data);
            $('.loader').hide();
        })

    });
});