jQuery(document).ready(function($){
	var badgeHtmlTextAreaWidth = 568;
	var badgePreviewMargin = 20;
	var badgeWrappers = $("#dmca-badge-settings-badges").find(".badge-option-wrapper");
	var badgeUrl = $("#dmca-badge-settings-badge-url").val();
	var badgeHtmlTextArea = $("#dmca-badge-settings-badge-html");
	var badgeInputArea = $("#field-html-input");

	function updateBadgePreview(badgeUrl,reinitialize) {
		badgeInputArea.show();
		var badgeHtml = $("#badge-template").text().replace("{{badge_url}}",badgeUrl);
		if (reinitialize) {
			$("#dmca-badge-settings-badge-url").val(badgeUrl);
			badgeHtmlTextArea.val(badgeHtml);
		}
		$("#badge-preview").remove();
		badgeHtmlTextArea.before("<div id=\"badge-preview\"><img src=\""+badgeUrl+"\"/></div>");
		waitForImageLoad(badgeUrl,function() {
			var badgeWidth = parseInt($("#badge-preview").css("width").replace("px",""));
			var newTextAreaWidth = badgeHtmlTextAreaWidth-badgeWidth-badgePreviewMargin;
			badgeHtmlTextArea.css("width",newTextAreaWidth+"px");
		});
	}
	/**
	 * @see http://stackoverflow.com/a/1820460/102699
	 */
	function waitForImageLoad(url,callback) {
		var image = new Image();
		image.onload = callback;
		image.src = url;
	}

	badgeWrappers.find("img").click(function(){
		badgeWrappers.find("img.selected").removeClass("selected");
		$(this).addClass("selected");
		updateBadgePreview($(this).attr("src"),true);
	});

	if ( badgeUrl.length ) {
		updateBadgePreview(badgeUrl,false);
	}


});
