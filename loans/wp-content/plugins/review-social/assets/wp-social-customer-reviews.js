var vshcr3 = vshcr3 || {};
vshcr3.mousemove_total = 0;
vshcr3.keypress_total = 0;
vshcr3.mousemove_need = 5;
vshcr3.keypress_need = 5;

vshcr3.getPostUrl = function(elm) {
	var ajaxurl = elm.attr("data-ajaxurl");
	ajaxurl = JSON.parse(ajaxurl);
	ajaxurl = ajaxurl.join('.').replace(/\|/g,'/')
	return ajaxurl;
};

vshcr3.onhover = function() {
	var $ = jQuery;
    $(".vshcr3_respond_2 .vshcr3_rating_stars").unbind("click.vshcr3");
    $(".vshcr3_respond_2 .vshcr3_rating_style1_base").addClass('vshcr3_hide');
    $(".vshcr3_respond_2 .vshcr3_rating_style1_status").removeClass('vshcr3_hide');
};

vshcr3.set_hover = function() {
	var $ = jQuery;
	$(".vshcr3_frating").val("");
    $(".vshcr3_respond_2 .vshcr3_rating_stars").unbind("click.vshcr3");
    vshcr3.onhover();
};

vshcr3.showform = function() {
	var $ = jQuery;
	var t = $(this);
	var parent = t.closest(".vshcr3_respond_1");
	
	var btn1 = parent.find(".vshcr3_respond_3 .vshcr3_show_btn");
    var resp2 = parent.find(".vshcr3_respond_2");
	resp2.slideToggle(400, function() {
		parent.find(".vshcr3_table_2").find("input:text:visible:first").focus();
		if (resp2.is(":visible")) {
			btn1.addClass('vshcr3_hide');
		} else {
			btn1.removeClass('vshcr3_hide');
		}
	});
};

vshcr3.ajaxPost = function(parent, data, cb) {
	 
	return jQuery.ajax({
		type : "POST",
		url : vshcr3.getPostUrl(parent),
		data : data,
		dataType : "json",
		success : function(rtn) { 
			if (rtn.err.length) {
				rtn.err = rtn.err.join('\n');
				alert(rtn.err);
				vshcr3.enableSubmit();
				return cb(rtn.err);
			}
			 
			return cb(null, rtn);
		},
		error : function(rtn) {
			alert('An unknown error has occurred. E01');
			vshcr3.enableSubmit();
		} 
	});
};

vshcr3.submit = function(e) {
	var $ = jQuery;
	var t = $(this);
	
	var parent = t.closest(".vshcr3_respond_1");
	e.preventDefault();

	var div2 = parent.find('.vshcr3_div_2'), submit = div2.find('.vshcr3_submit_btn');
	var c1 = parent.find('.vshcr3_fconfirm1'), c2 = parent.find('.vshcr3_fconfirm2'), c3 = parent.find('.vshcr3_fconfirm3');
	 
	if (submit.hasClass('vshcr3_disabled')) { return false; }
	
	if (vshcr3.mousemove_total <= vshcr3.mousemove_need || vshcr3.keypress_total <= vshcr3.keypress_need) {
		alert('You did not pass our human detection check. Code '+vshcr3.mousemove_total+','+vshcr3.keypress_total);
		return false;
	}
	
	var c1_fail = (c1.is(':checked') === true), c2_fail = (c2.is(':checked') === false), c3_fail = (c3.is(':checked') === false);
	if (c1_fail || c3_fail) {
		alert('You did not pass our bot detection check. Code '+c1_fail+','+c3_fail+','+c2_fail);
		return false;
	}
	if (c2_fail) {
		alert('You must check the box to confirm you are human.');
		return false;
	}
	
	var fields = div2.find('input,textarea');
	
	var req = [];
	$.each(fields, function(i,v) {
		v = $(v);
		if (v.hasClass('vshcr3_required') && $.trim(v.val()).length === 0) {
			var label = div2.find('label[for="'+v.attr('id')+'"]'), err = '';
			if (label.length) {
				err = $.trim(label.text().replace(':',''))+' is required.';
			} else {
				err = 'A required field has not been filled out.';
			}
			req.push(err);
		}
	});
	
	if (req.length > 0) {
		req = req.join("\n");
		alert(req);
		return false;
	}
	
	submit.addClass('vshcr3_disabled');
	 
	var postid = parent.attr("data-postid");
	div2.find('.vshcr3_checkid').remove();
	div2.append('<input type="hidden" name="vshcr3_checkid" class="vshcr3_checkid" value="'+postid+'" />');
	div2.append('<input type="hidden" name="vshcr3_ajaxAct" class="vshcr3_checkid" value="form" />');
	fields = div2.find('input,textarea');
	
	var ajaxData = {};
	fields.each(function(i, v) {
		v = $(v), val = v.val();
		if (v.attr('type') === 'checkbox' && v.is(':checked') === false) { val = '0'; }
		ajaxData[v.attr('name')] = val;
	});
	
	vshcr3.ajaxPost(parent, ajaxData, function(err, rtn) { 
		if (err) { return; }
		
		alert('Thank you! Your review has been received and will be posted soon.');
		$(window).scrollTop(0);
		vshcr3.clearFields();
		parent.find(".vshcr3_cancel_btn").click();
	});
	
};

vshcr3.clearFields = function() {
	var $ = jQuery;
	var div2 = $('.vshcr3_div_2'), fields = div2.find('input,textarea');;
	vshcr3.enableSubmit();
	fields.attr('autocomplete', 'off').not('[type="checkbox"], [type="hidden"]').val('');
};

vshcr3.enableSubmit = function() {
	var $ = jQuery;
	var div2 = $('.vshcr3_div_2'), submit = div2.find('.vshcr3_submit_btn');
	submit.removeClass('vshcr3_disabled');
};

vshcr3.init = function() {
	var $ = jQuery;
		
	$(".vshcr3_respond_3 .vshcr3_show_btn, .vshcr3_respond_2 .vshcr3_cancel_btn").click(vshcr3.showform);
	
	var evt_1 = 'mousemove.vshcr3 touchmove.vshcr3';
	$(document).bind(evt_1, function() {
		vshcr3.mousemove_total++; if (vshcr3.mousemove_total > vshcr3.mousemove_need) { $(document).unbind(evt_1); }
	});
	
	var evt_2 = 'keypress.vshcr3 keydown.vshcr3';
	$(document).bind(evt_2, function() {
		vshcr3.keypress_total++; if (vshcr3.keypress_total > vshcr3.keypress_need) { $(document).unbind(evt_2); }
	});
	
	$(".vshcr3_respond_2 .vshcr3_rating_style1_score > div").click(function(e) {
		e.preventDefault();
		e.stopImmediatePropagation();
		
		var vshcr3_rating = $(this).html(), new_w = 20 * vshcr3_rating + "%";
		$(".vshcr3_frating").val(vshcr3_rating);
		$(".vshcr3_respond_2 .vshcr3_rating_style1_base").removeClass('vshcr3_hide');
		$(".vshcr3_respond_2 .vshcr3_rating_style1_average").css("width",new_w);
		$(".vshcr3_respond_2 .vshcr3_rating_style1_status").addClass('vshcr3_hide');

		$(".vshcr3_respond_2 .vshcr3_rating_stars").unbind("mouseover.vshcr3").bind("click.vshcr3", vshcr3.set_hover);
		
		return false;
    });

    $(".vshcr3_respond_2 .vshcr3_rating_stars").bind("mouseover.vshcr3", vshcr3.onhover);
	
	var pagingCb = function(e) {
		e.preventDefault();
		var t = $(this);
		if (t.hasClass("vshcr3_disabled")) { return false; }
		
		var parent = t.parents(".vshcr3_respond_1:first");
		var pager = t.parents(".vshcr3_pagination:first");
		var reviews = parent.find(".vshcr3_reviews_holder");
		var page = t.attr("data-page");
		var pageOpts = pager.attr("data-page-opts");
		var on_postid = parent.attr("data-on-postid");
		
		var ajaxData = { ajaxAct : "pager", on_postid : on_postid, page : page, pageOpts : pageOpts };
		vshcr3.ajaxPost(parent, ajaxData, function(err, rtn) {
			if (err) { return; }
			
			reviews.html(rtn.output);
			pager.remove();
			$('html,body').animate({
			   scrollTop : (reviews.offset().top - 100)
			});
		});	
	};
	
	if ($("body").on !== undefined) {
		$(".vshcr3_respond_1").on("click", ".vshcr3_pagination .vshcr3_a", pagingCb);
	} else {
		// support older versions of jQuery
		$(".vshcr3_respond_1 .vshcr3_pagination .vshcr3_a").live("click", pagingCb);
	}
	
	var div2 = $('.vshcr3_div_2'), submit = div2.find('.vshcr3_submit_btn');
	submit.click(vshcr3.submit);
	
	vshcr3.clearFields();
};

jQuery(function() {
	vshcr3.init();
});