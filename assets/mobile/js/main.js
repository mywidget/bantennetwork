webpackJsonp([2], {
	1: function(a, e, t) {
		a.exports = t("aZpi")
	},
	aZpi: function(a, e, t) {
		"use strict";
		Object.defineProperty(e, "__esModule", {
			value: !0
		});
		var n = t("Wt6M"),
			o = t.n(n);
		$(document).ready(function() {
			$("#myModal").modal("show")
		}), $(document).ready(function() {
			$(".slide-navbar").css("box-shadow", "0px 5px 15px lightgray"), $(window).bind("scroll", function() {
				$(window).scrollTop() > 150 ? $(".slide-navbar").css("box-shadow", "none") : $(".slide-navbar").css("box-shadow", "0px 5px 15px lightgray")
			}), $(".navbar-brand").click(function() {
				$("#indexNav").toggle(function() {
					$("html").toggleClass("overflow-hide")
				})
			})
		}), $(document).ready(function() {
			$("#slide-header").owlCarousel({
				lazyLoad: !0,
				loop: !0,
				margin: 10,
				dots: 1,
				nav: !0,
				autoHeight: !0,
				autoplay: 1,
				autoplayTimeout: 5e3,
				autoplayHoverPause: !0,
				navContainerClass: "slide-control",
				navText: ["<span class='fa-layers fa-fw fa-2x'><i class='fas fa-circle' /><i class='fa-inverse fas fa-angle-left' data-fa-transform='shrink-6' /></span>", "<span class='fa-layers fa-fw fa-2x'><i class='fas fa-circle' /><i class='fa-inverse fas fa-angle-right' data-fa-transform='shrink-6' /></span>"],
				items: 1
			})
		}), $(".next-slide").click(function() {
			var a = $("ul#slide-navbar"),
				e = a.scrollLeft();
			a.animate({
				scrollLeft: e + 200
			}, 1e3)
		}), $(".slide-fokus").owlCarousel({
			lazyLoad: !0,
			navContainerClass: "slide-control",
			navText: ["<span class='fa-layers fa-fw fa-2x'><i class='fas fa-circle' /><i class='fa-inverse fas fa-caret-left' data-fa-transform='shrink-6' /></span>", "<span class='fa-layers fa-fw fa-2x'><i class='fas fa-circle' /><i class='fa-inverse fas fa-caret-right' data-fa-transform='shrink-6' /></span>"],
			loop: !1,
			margin: 10,
			nav: !0,
			dots: !1,
			autoplay: !0,
			autoplayTimeout: 5e3,
			autoplayHoverPause: !0,
			items: 2
		}), $("#detail-foto-slider").owlCarousel({
			loop: !1,
			nav: !1,
			lazyLoad: !0,
			autoHeight: !0,
			margin: 10,
			dots: !0,
			items: 1
		}), $("#homepage_kolom .slide-kolom").owlCarousel({
			loop: !0,
			nav: !1,
			lazyLoad: !0,
			margin: 10,
			dots: !0,
			autoplay: !0,
			autoplayTimeout: 5e3,
			autoplayHoverPause: !0,
			items: 2
		}), $("#media .media-carousel").owlCarousel({
			navContainerClass: "slide-control",
			navText: ["<span class='fa-layers fa-fw fa-2x'><i class='fas fa-circle' /><i class='fa-inverse fas fa-caret-left' data-fa-transform='shrink-6' /></span>", "<span class='fa-layers fa-fw fa-2x'><i class='fas fa-circle' /><i class='fa-inverse fas fa-caret-right' data-fa-transform='shrink-6' /></span>"],
			loop: !0,
			nav: !1,
			lazyLoad: !0,
			margin: 10,
			dots: !1,
			autoplay: !0,
			autoplayTimeout: 5e3,
			autoplayHoverPause: !0,
			items: 1
		}), $(".lainnya").on("click", function() {
			var a = $(this);
			a.addClass("disabled"), a.text("Loading..");
			var e = a.data("url"),
				t = a.data("append"),
				n = a.data("template"),
				o = a.data("cat-id"),
				l = void 0 === a.data("page") ? 1 : a.data("page"),
				r = void 0 === a.data("page-size") ? 10 : a.data("page-size"),
				s = $(t),
				i = document.querySelector(n),
				c = "" + e + (e.includes("?") ? "&" : "?") + "page=" + l + "&page_size=" + r;
			c = void 0 === o ? c : c + "&id_kategori=" + o, $.getJSON(c, function(e) {
				var t = [];
				e.forEach(function(a) {
					var e = i.content.querySelectorAll(".loadmore-url"),
						n = i.content.querySelector(".loadmore-img"),
						o = i.content.querySelector(".loadmore-category"),
						l = i.content.querySelector(".loadmore-title"),
						r = i.content.querySelector(".loadmore-time"),
						s = i.content.querySelector(".loadmore-caption"),
						c = i.content.querySelector(".loadmore-writer"),
						u = i.content.querySelector(".loadmore-writer-img"),
						d = i.content.querySelector(".loadmore-label");
					if (null != e && e.forEach(function(e) {
							e.href = a.slug
						}), null != n) {
						var f = 4 == a.id_jenis ? a.thumbnail : a.gambar.url_small;
						n.src = "https://lenteranews.tv/" + f
					}
					if (null != o && (o.innerText = a.kategori_utama.kategori), null != l && "" != l && (l.innerText = a.judul.replace("<p>", "").replace("</p>", "")), a.subjudul) {
						var p = $("<span class='sub-judul'>subjudul</span>").get(0);
						l.prepend(p)
					}
					if (null != d && a.label && (d.innerText = a.label), null != r && (r.innerText = a.tanggal_string), null != s && (s.innerText = "0" == a.lead_p ? "" : a.lead_p), null != c && "" != c && a.nama_kolom_penulis && (c.innerHTML = "<h5>" + a.nama_kolom_penulis + "</h5>"), null != u) {
						var m = a.foto_kolom_penulis ? "https://lenteranews.tv/" + a.foto_kolom_penulis : "/images/not_found.png";
						u.src = m
					}
					var g = document.importNode(i.content, !0);
					t.push(g), null != d && (d.innerText = "")
				}), s.append(t), a.data("page", l + 1)
			}).fail(function() {
				a.hide()
			}).always(function() {
				a.removeClass("disabled"), a.text("Lainnya")
			})
		}), $(".lainnya-fokus").on("click", function() {
			var a = $(this);
			a.prop("disabled", !0), a.text("Loading..");
			var e = a.data("url"),
				t = a.data("append");
			N;
			var n = a.data("template"),
				o = void 0 === a.data("page") ? 1 : a.data("page"),
				l = void 0 === a.data("page-size") ? 10 : a.data("page-size"),
				r = $(t),
				s = document.querySelector(n),
				i = e + "?page=" + o + "&page_size=" + l;
			$.getJSON(i, function(e) {
				var t = [];
				e.forEach(function(a) {
					var e = s.content.querySelectorAll(".loadmore-url"),
						n = s.content.querySelectorAll(".loadmore-img"),
						o = s.content.querySelectorAll(".loadmore-category"),
						l = s.content.querySelectorAll(".loadmore-title"),
						r = s.content.querySelectorAll(".loadmore-time"),
						i = s.content.querySelectorAll(".loadmore-caption"),
						c = s.content.querySelectorAll(".loadmore-label"),
						u = s.content.querySelector(".loadmore-fokus-img"),
						d = s.content.querySelector(".loadmore-fokus-title"),
						f = s.content.querySelector(".loadmore-fokus-url");
					if (null != f && (f.href = "/fokus/" + a.slug), null != u && (u.src = "https://lenteranews.tv/" + a.gambar.url), null != d && (d.innerText = a.judul), a.subjudul) {
						var p = $("<span class='sub-judul'>subjudul</span>").get(0);
						d.prepend(p)
					}
					for (var m = 0; m < 2; m++) {
						var g = a.beritas[m];
						if (null != e[m] && (e[m].href = "/" + g.slug), null != n[m] && (n[m].src = "https://lenteranews.tv/" + g.gambar.url_small), null != o[m] && (o[m].innerText = g.kategori_utama.kategori), null != l && (l[m].innerText = g.judul.replace("<p>", "").replace("</p>", "")), g.subjudul) {
							var v = $("<span class='sub-judul'>subjudul</span>").get(0);
							l[m].prepend(v)
						}
						null != r[m] && (r[m].innerText = g.tanggal_string), null != i[m] && (i[m].innerText = g.lead_p), null != c[m] && g.label && (c[m].innerText = g.label)
					}
					var h = document.importNode(s.content, !0);
					t.push(h), null != label && (label.innerText = "")
				}), r.append(t), a.data("page", o + 1)
			}).fail(function() {
				a.hide()
			}).always(function() {
				a.prop("disabled", !1), a.text("Lainnya")
			})
		}), $(document).ready(function() {
			o.a.option({
				resizeDuration: 200,
				wrapAround: !0,
				disableScrolling: !0,
				alwaysShowNavOnTouchDevices: !0,
				positionFromTop: 100
			})
		}), $("main#detail-berita article#artikel header.infografis-content img").click(function() {
			var a = ImageViewer(),
				e = document.getElementById("gambar-zoom").src;
			a.show(e)
		});
	}
}, [1]);