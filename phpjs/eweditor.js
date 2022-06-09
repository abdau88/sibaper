/**
 * Create HTML Editor (for PHPMaker 2019)
 * @license (C) 2019 e.World Technology Ltd.
 */
CKEDITOR.env.cssClass = "ew-editor";
ew.createEditor = function(formid, name, cols, rows, readonly) {
	if (typeof CKEDITOR == "undefined" || name.indexOf("$rowindex$") > -1)
		return;
	var $ = jQuery, form = $("#" + formid)[0], el = ew.getElement(name, form);
	if (!el)
		return;
	var longname = formid + "$" + name + "$";
	var w = (cols ? Math.abs(cols) : 35) * 2 + "em"; // width
	var h = ((rows ? Math.abs(rows) : 4) + 4) * 1.5 + "em"; // height
	var path = window.location.href.substring(0, window.location.href.lastIndexOf("/") + 1);
	var lang = (ew.LANGUAGE_ID || "").toLowerCase();
	if (lang == "zh-hk" || lang == "zh-tw" || lang == "de-at" || lang == "pt-pt" || lang == "es-419")
		lang = lang.substring(0, 2);
	var settings = {

		//width: w, // DO NOT specify width
		height: h,
		language: lang,
		autoUpdateElement: false,
		baseHref: ''
	};
	var args = {"id": name, "form": form, "enabled": true, "settings": settings};
	$(document).trigger("create.editor", [args]);
	if (!args.enabled)
		return;
	if (readonly) {
		args.settings.readOnly = true;
		args.settings.toolbar = [["Source"]];
	}
	var editor = {
		name: name,
		active: false,
		instance: null,
		create: function() {
			var ed = this.instance = CKEDITOR.replace(el, args.settings);
			ed.on("loaded", ew.fixLayoutHeight);
			this.active = true;
		},
		set: function() { // update value from textarea to editor
			if (this.instance) this.instance.setData(this.instance.element.value);
		},
		save: function() { // update value from editor to textarea
			if (this.instance) this.instance.updateElement();
			var args = {"id": name, "form": form, "value": ew.removeSpaces(el.value)};
			$(document).trigger("save.editor", [args]).val(args.value);
		},
		focus: function() { // focus editor
			if (this.instance) this.instance.focus();
		},
		destroy: function() { // destroy
			if (this.instance) this.instance.destroy();
		}
	};
	$(el).data("editor", editor).addClass("editor");
}
