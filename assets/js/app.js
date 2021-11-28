$(".se-pre-con").fadeOut("slow");
$(document).ready(function () {
    $('#myModalProd, #VideoDemo').on('show.bs.modal', function (e) {
        $(".modal-dialog").animate({
            top: "0px",
            left: "0px"
        });
        $('[autofocus]', e.target).focus();
        var modfile = $(e.relatedTarget).data('modfile');
        var l_modul = $(e.relatedTarget).data('id');
        if (modfile == 'modul') {
            var classmod = $(e.relatedTarget).data('classname');
            var modname = $(e.relatedTarget).data('modname');
            var modlink = $(e.relatedTarget).data('modlink');
            var namamod = $(e.relatedTarget).data('namamod');
            var warna = $(e.relatedTarget).data('modwarna');
            var appid = $(e.relatedTarget).data('appid');
            $("#title-mod").html('Hitung ' + namamod);
            $.ajaxQueue({
                type: 'POST',
                url: SITE_API + '/appm/',
                data: {
                    modul: l_modul,
                    link: modlink,
                    modfile: modfile,
                    namamod: namamod,
                    warna: warna,
                    appid: appid
                },
                cache: false,
                beforeSend: function () {
                    $(".se-pre-con").fadeIn("slow");
                },
                success: function (data) {
                    if (modname) {
                        $(".se-pre-con").fadeOut("slow");
                        $('.fetched-data').html(data);
                        $('#modal-lgs').addClass(classmod);
                    } else {
                        $('.fetched-dua').html(data);
                        $('#modal-lg2').addClass(classmod);
                        $("#myModalProd").hide();
                        $(".se-pre-con").fadeOut("slow");
                    }
                }
            });
        } else if (modfile == 'video') {
		var vid = $(e.relatedTarget).data('vid');
            var modname = $(e.relatedTarget).data('modename');
            var vidlink = $(e.relatedTarget).data('vidlink');
            var modembed = $(e.relatedTarget).data('embed');
            $.ajaxQueue({
                type: 'POST',
                url: SITE_API + '/appv/',
                data: {
                    modul: vid,
                    link: vidlink,
                    embed: modembed,
                    modname: modname,
                    modfile: modfile,
                    warna: warna
                },
                cache: false,
                beforeSend: function () {
                    $(".modshow").hide();
                    $(".sections").show();
                    $(".se-pre-con").fadeIn("slow");
                },
                success: function (data) {
                    $('.fetched-video').html(data);
                    $(".modshow").show();
                    $(".sections").hide();
                    $(".se-pre-con").fadeOut("slow");
                }
            });
        } else {
            $.ajaxQueue({
                type: 'POST',
                url: SITE_API + '/appm/',
                data: {
                    modul: l_modul,
                    link: modlink,
                    modfile: modfile,
                    warna: warna,
                    appid: appid
                },
                cache: false,
                beforeSend: function () {
                    $(".se-pre-con").fadeIn("slow");
                },
                success: function (data) {
                    if (modname) {
                        $('.fetched-data').html(data);
                        $('#modal-lgs').addClass(classmod);
                        $(".se-pre-con").fadeOut("slow");
                    } else {
                        $('.fetched-dua').html(data);
                        $('#modal-lg2').addClass(classmod);
                        $("#myModalProd").hide();
                        $(".modshow").show();
                        $(".se-pre-con").fadeOut("slow");
                    }
                }
            });
        }
        // $('.modal-dialog').draggable({
            // handle: ".modal-header"
        // });
    });
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
        $("#modal-lgs").removeClass('modal-lg');
        $('.modal-backdrop').remove();
    });
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('[autofocus]').focus();
        $(this).removeData('bs.modal');
    });
});
$(window).scroll(function () {
    var scrolled = $(window).scrollTop();
    if (scrolled > 200)
        $('.go-top').fadeIn('slow');
    if (scrolled < 200)
        $('.go-top').fadeOut('slow');
});
$('.go-top').click(function () {
    $("html, body").animate({
        scrollTop: "0"
    }, 500);
});
