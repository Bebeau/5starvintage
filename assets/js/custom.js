// jQuery validate
(function(e){e.extend(e.fn,{validate:function(t){if(!this.length){t&&t.debug&&window.console&&console.warn("Nothing selected, can't validate, returning nothing.");return}var n=e.data(this[0],"validator");if(n)return n;this.attr("novalidate","novalidate");n=new e.validator(t,this[0]);e.data(this[0],"validator",n);if(n.settings.onsubmit){this.validateDelegate(":submit","click",function(t){n.settings.submitHandler&&(n.submitButton=t.target);e(t.target).hasClass("cancel")&&(n.cancelSubmit=!0);e(t.target).attr("formnovalidate")!==undefined&&(n.cancelSubmit=!0)});this.submit(function(t){function r(){var r;if(n.settings.submitHandler){n.submitButton&&(r=e("<input type='hidden'/>").attr("name",n.submitButton.name).val(e(n.submitButton).val()).appendTo(n.currentForm));n.settings.submitHandler.call(n,n.currentForm,t);n.submitButton&&r.remove();return!1}return!0}n.settings.debug&&t.preventDefault();if(n.cancelSubmit){n.cancelSubmit=!1;return r()}if(n.form()){if(n.pendingRequest){n.formSubmitted=!0;return!1}return r()}n.focusInvalid();return!1})}return n},valid:function(){if(e(this[0]).is("form"))return this.validate().form();var t=!0,n=e(this[0].form).validate();this.each(function(){t=t&&n.element(this)});return t},removeAttrs:function(t){var n={},r=this;e.each(t.split(/\s/),function(e,t){n[t]=r.attr(t);r.removeAttr(t)});return n},rules:function(t,n){var r=this[0];if(t){var i=e.data(r.form,"validator").settings,s=i.rules,o=e.validator.staticRules(r);switch(t){case"add":e.extend(o,e.validator.normalizeRule(n));delete o.messages;s[r.name]=o;n.messages&&(i.messages[r.name]=e.extend(i.messages[r.name],n.messages));break;case"remove":if(!n){delete s[r.name];return o}var u={};e.each(n.split(/\s/),function(e,t){u[t]=o[t];delete o[t]});return u}}var a=e.validator.normalizeRules(e.extend({},e.validator.classRules(r),e.validator.attributeRules(r),e.validator.dataRules(r),e.validator.staticRules(r)),r);if(a.required){var f=a.required;delete a.required;a=e.extend({required:f},a)}return a}});e.extend(e.expr[":"],{blank:function(t){return!e.trim(""+e(t).val())},filled:function(t){return!!e.trim(""+e(t).val())},unchecked:function(t){return!e(t).prop("checked")}});e.validator=function(t,n){this.settings=e.extend(!0,{},e.validator.defaults,t);this.currentForm=n;this.init()};e.validator.format=function(t,n){if(arguments.length===1)return function(){var n=e.makeArray(arguments);n.unshift(t);return e.validator.format.apply(this,n)};arguments.length>2&&n.constructor!==Array&&(n=e.makeArray(arguments).slice(1));n.constructor!==Array&&(n=[n]);e.each(n,function(e,n){t=t.replace(new RegExp("\\{"+e+"\\}","g"),function(){return n})});return t};e.extend(e.validator,{defaults:{messages:{},groups:{},rules:{},errorClass:"error",validClass:"valid",errorElement:"label",focusInvalid:!0,errorContainer:e([]),errorLabelContainer:e([]),onsubmit:!0,ignore:":hidden",ignoreTitle:!1,onfocusin:function(e,t){this.lastActive=e;if(this.settings.focusCleanup&&!this.blockFocusCleanup){this.settings.unhighlight&&this.settings.unhighlight.call(this,e,this.settings.errorClass,this.settings.validClass);this.addWrapper(this.errorsFor(e)).hide()}},onfocusout:function(e,t){!this.checkable(e)&&(e.name in this.submitted||!this.optional(e))&&this.element(e)},onkeyup:function(e,t){if(t.which===9&&this.elementValue(e)==="")return;(e.name in this.submitted||e===this.lastElement)&&this.element(e)},onclick:function(e,t){e.name in this.submitted?this.element(e):e.parentNode.name in this.submitted&&this.element(e.parentNode)},highlight:function(t,n,r){t.type==="radio"?this.findByName(t.name).addClass(n).removeClass(r):e(t).addClass(n).removeClass(r)},unhighlight:function(t,n,r){t.type==="radio"?this.findByName(t.name).removeClass(n).addClass(r):e(t).removeClass(n).addClass(r)}},setDefaults:function(t){e.extend(e.validator.defaults,t)},messages:{required:"This field is required.",remote:"Please fix this field.",email:"Please enter a valid email address.",url:"Please enter a valid URL.",date:"Please enter a valid date.",dateISO:"Please enter a valid date (ISO).",number:"Please enter a valid number.",digits:"Please enter only digits.",creditcard:"Please enter a valid credit card number.",equalTo:"Please enter the same value again.",maxlength:e.validator.format("Please enter no more than {0} characters."),minlength:e.validator.format("Please enter at least {0} characters."),rangelength:e.validator.format("Please enter a value between {0} and {1} characters long."),range:e.validator.format("Please enter a value between {0} and {1}."),max:e.validator.format("Please enter a value less than or equal to {0}."),min:e.validator.format("Please enter a value greater than or equal to {0}.")},autoCreateRanges:!1,prototype:{init:function(){function r(t){var n=e.data(this[0].form,"validator"),r="on"+t.type.replace(/^validate/,"");n.settings[r]&&n.settings[r].call(n,this[0],t)}this.labelContainer=e(this.settings.errorLabelContainer);this.errorContext=this.labelContainer.length&&this.labelContainer||e(this.currentForm);this.containers=e(this.settings.errorContainer).add(this.settings.errorLabelContainer);this.submitted={};this.valueCache={};this.pendingRequest=0;this.pending={};this.invalid={};this.reset();var t=this.groups={};e.each(this.settings.groups,function(n,r){typeof r=="string"&&(r=r.split(/\s/));e.each(r,function(e,r){t[r]=n})});var n=this.settings.rules;e.each(n,function(t,r){n[t]=e.validator.normalizeRule(r)});e(this.currentForm).validateDelegate(":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'] ","focusin focusout keyup",r).validateDelegate("[type='radio'], [type='checkbox'], select, option","click",r);this.settings.invalidHandler&&e(this.currentForm).bind("invalid-form.validate",this.settings.invalidHandler)},form:function(){this.checkForm();e.extend(this.submitted,this.errorMap);this.invalid=e.extend({},this.errorMap);this.valid()||e(this.currentForm).triggerHandler("invalid-form",[this]);this.showErrors();return this.valid()},checkForm:function(){this.prepareForm();for(var e=0,t=this.currentElements=this.elements();t[e];e++)this.check(t[e]);return this.valid()},element:function(t){t=this.validationTargetFor(this.clean(t));this.lastElement=t;this.prepareElement(t);this.currentElements=e(t);var n=this.check(t)!==!1;n?delete this.invalid[t.name]:this.invalid[t.name]=!0;this.numberOfInvalids()||(this.toHide=this.toHide.add(this.containers));this.showErrors();return n},showErrors:function(t){if(t){e.extend(this.errorMap,t);this.errorList=[];for(var n in t)this.errorList.push({message:t[n],element:this.findByName(n)[0]});this.successList=e.grep(this.successList,function(e){return!(e.name in t)})}this.settings.showErrors?this.settings.showErrors.call(this,this.errorMap,this.errorList):this.defaultShowErrors()},resetForm:function(){e.fn.resetForm&&e(this.currentForm).resetForm();this.submitted={};this.lastElement=null;this.prepareForm();this.hideErrors();this.elements().removeClass(this.settings.errorClass).removeData("previousValue")},numberOfInvalids:function(){return this.objectLength(this.invalid)},objectLength:function(e){var t=0;for(var n in e)t++;return t},hideErrors:function(){this.addWrapper(this.toHide).hide()},valid:function(){return this.size()===0},size:function(){return this.errorList.length},focusInvalid:function(){if(this.settings.focusInvalid)try{e(this.findLastActive()||this.errorList.length&&this.errorList[0].element||[]).filter(":visible").focus().trigger("focusin")}catch(t){}},findLastActive:function(){var t=this.lastActive;return t&&e.grep(this.errorList,function(e){return e.element.name===t.name}).length===1&&t},elements:function(){var t=this,n={};return e(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function(){!this.name&&t.settings.debug&&window.console&&console.error("%o has no name assigned",this);if(this.name in n||!t.objectLength(e(this).rules()))return!1;n[this.name]=!0;return!0})},clean:function(t){return e(t)[0]},errors:function(){var t=this.settings.errorClass.replace(" ",".");return e(this.settings.errorElement+"."+t,this.errorContext)},reset:function(){this.successList=[];this.errorList=[];this.errorMap={};this.toShow=e([]);this.toHide=e([]);this.currentElements=e([])},prepareForm:function(){this.reset();this.toHide=this.errors().add(this.containers)},prepareElement:function(e){this.reset();this.toHide=this.errorsFor(e)},elementValue:function(t){var n=e(t).attr("type"),r=e(t).val();return n==="radio"||n==="checkbox"?e("input[name='"+e(t).attr("name")+"']:checked").val():typeof r=="string"?r.replace(/\r/g,""):r},check:function(t){t=this.validationTargetFor(this.clean(t));var n=e(t).rules(),r=!1,i=this.elementValue(t),s;for(var o in n){var u={method:o,parameters:n[o]};try{s=e.validator.methods[o].call(this,i,t,u.parameters);if(s==="dependency-mismatch"){r=!0;continue}r=!1;if(s==="pending"){this.toHide=this.toHide.not(this.errorsFor(t));return}if(!s){this.formatAndAdd(t,u);return!1}}catch(a){this.settings.debug&&window.console&&console.log("Exception occurred when checking element "+t.id+", check the '"+u.method+"' method.",a);throw a}}if(r)return;this.objectLength(n)&&this.successList.push(t);return!0},customDataMessage:function(t,n){return e(t).data("msg-"+n.toLowerCase())||t.attributes&&e(t).attr("data-msg-"+n.toLowerCase())},customMessage:function(e,t){var n=this.settings.messages[e];return n&&(n.constructor===String?n:n[t])},findDefined:function(){for(var e=0;e<arguments.length;e++)if(arguments[e]!==undefined)return arguments[e];return undefined},defaultMessage:function(t,n){return this.findDefined(this.customMessage(t.name,n),this.customDataMessage(t,n),!this.settings.ignoreTitle&&t.title||undefined,e.validator.messages[n],"<strong>Warning: No message defined for "+t.name+"</strong>")},formatAndAdd:function(t,n){var r=this.defaultMessage(t,n.method),i=/\$?\{(\d+)\}/g;typeof r=="function"?r=r.call(this,n.parameters,t):i.test(r)&&(r=e.validator.format(r.replace(i,"{$1}"),n.parameters));this.errorList.push({message:r,element:t});this.errorMap[t.name]=r;this.submitted[t.name]=r},addWrapper:function(e){this.settings.wrapper&&(e=e.add(e.parent(this.settings.wrapper)));return e},defaultShowErrors:function(){var e,t;for(e=0;this.errorList[e];e++){var n=this.errorList[e];this.settings.highlight&&this.settings.highlight.call(this,n.element,this.settings.errorClass,this.settings.validClass);this.showLabel(n.element,n.message)}this.errorList.length&&(this.toShow=this.toShow.add(this.containers));if(this.settings.success)for(e=0;this.successList[e];e++)this.showLabel(this.successList[e]);if(this.settings.unhighlight)for(e=0,t=this.validElements();t[e];e++)this.settings.unhighlight.call(this,t[e],this.settings.errorClass,this.settings.validClass);this.toHide=this.toHide.not(this.toShow);this.hideErrors();this.addWrapper(this.toShow).show()},validElements:function(){return this.currentElements.not(this.invalidElements())},invalidElements:function(){return e(this.errorList).map(function(){return this.element})},showLabel:function(t,n){var r=this.errorsFor(t);if(r.length){r.removeClass(this.settings.validClass).addClass(this.settings.errorClass);r.html(n)}else{r=e("<"+this.settings.errorElement+">").attr("for",this.idOrName(t)).addClass(this.settings.errorClass).html(n||"");this.settings.wrapper&&(r=r.hide().show().wrap("<"+this.settings.wrapper+"/>").parent());this.labelContainer.append(r).length||(this.settings.errorPlacement?this.settings.errorPlacement(r,e(t)):r.insertAfter(t))}if(!n&&this.settings.success){r.text("");typeof this.settings.success=="string"?r.addClass(this.settings.success):this.settings.success(r,t)}this.toShow=this.toShow.add(r)},errorsFor:function(t){var n=this.idOrName(t);return this.errors().filter(function(){return e(this).attr("for")===n})},idOrName:function(e){return this.groups[e.name]||(this.checkable(e)?e.name:e.id||e.name)},validationTargetFor:function(e){this.checkable(e)&&(e=this.findByName(e.name).not(this.settings.ignore)[0]);return e},checkable:function(e){return/radio|checkbox/i.test(e.type)},findByName:function(t){return e(this.currentForm).find("[name='"+t+"']")},getLength:function(t,n){switch(n.nodeName.toLowerCase()){case"select":return e("option:selected",n).length;case"input":if(this.checkable(n))return this.findByName(n.name).filter(":checked").length}return t.length},depend:function(e,t){return this.dependTypes[typeof e]?this.dependTypes[typeof e](e,t):!0},dependTypes:{"boolean":function(e,t){return e},string:function(t,n){return!!e(t,n.form).length},"function":function(e,t){return e(t)}},optional:function(t){var n=this.elementValue(t);return!e.validator.methods.required.call(this,n,t)&&"dependency-mismatch"},startRequest:function(e){if(!this.pending[e.name]){this.pendingRequest++;this.pending[e.name]=!0}},stopRequest:function(t,n){this.pendingRequest--;this.pendingRequest<0&&(this.pendingRequest=0);delete this.pending[t.name];if(n&&this.pendingRequest===0&&this.formSubmitted&&this.form()){e(this.currentForm).submit();this.formSubmitted=!1}else if(!n&&this.pendingRequest===0&&this.formSubmitted){e(this.currentForm).triggerHandler("invalid-form",[this]);this.formSubmitted=!1}},previousValue:function(t){return e.data(t,"previousValue")||e.data(t,"previousValue",{old:null,valid:!0,message:this.defaultMessage(t,"remote")})}},classRuleSettings:{required:{required:!0},email:{email:!0},url:{url:!0},date:{date:!0},dateISO:{dateISO:!0},number:{number:!0},digits:{digits:!0},creditcard:{creditcard:!0}},addClassRules:function(t,n){t.constructor===String?this.classRuleSettings[t]=n:e.extend(this.classRuleSettings,t)},classRules:function(t){var n={},r=e(t).attr("class");r&&e.each(r.split(" "),function(){this in e.validator.classRuleSettings&&e.extend(n,e.validator.classRuleSettings[this])});return n},attributeRules:function(t){var n={},r=e(t),i=r[0].getAttribute("type");for(var s in e.validator.methods){var o;if(s==="required"){o=r.get(0).getAttribute(s);o===""&&(o=!0);o=!!o}else o=r.attr(s);/min|max/.test(s)&&(i===null||/number|range|text/.test(i))&&(o=Number(o));o?n[s]=o:i===s&&i!=="range"&&(n[s]=!0)}n.maxlength&&/-1|2147483647|524288/.test(n.maxlength)&&delete n.maxlength;return n},dataRules:function(t){var n,r,i={},s=e(t);for(n in e.validator.methods){r=s.data("rule-"+n.toLowerCase());r!==undefined&&(i[n]=r)}return i},staticRules:function(t){var n={},r=e.data(t.form,"validator");r.settings.rules&&(n=e.validator.normalizeRule(r.settings.rules[t.name])||{});return n},normalizeRules:function(t,n){e.each(t,function(r,i){if(i===!1){delete t[r];return}if(i.param||i.depends){var s=!0;switch(typeof i.depends){case"string":s=!!e(i.depends,n.form).length;break;case"function":s=i.depends.call(n,n)}s?t[r]=i.param!==undefined?i.param:!0:delete t[r]}});e.each(t,function(r,i){t[r]=e.isFunction(i)?i(n):i});e.each(["minlength","maxlength"],function(){t[this]&&(t[this]=Number(t[this]))});e.each(["rangelength","range"],function(){var n;if(t[this])if(e.isArray(t[this]))t[this]=[Number(t[this][0]),Number(t[this][1])];else if(typeof t[this]=="string"){n=t[this].split(/[\s,]+/);t[this]=[Number(n[0]),Number(n[1])]}});if(e.validator.autoCreateRanges){if(t.min&&t.max){t.range=[t.min,t.max];delete t.min;delete t.max}if(t.minlength&&t.maxlength){t.rangelength=[t.minlength,t.maxlength];delete t.minlength;delete t.maxlength}}return t},normalizeRule:function(t){if(typeof t=="string"){var n={};e.each(t.split(/\s/),function(){n[this]=!0});t=n}return t},addMethod:function(t,n,r){e.validator.methods[t]=n;e.validator.messages[t]=r!==undefined?r:e.validator.messages[t];n.length<3&&e.validator.addClassRules(t,e.validator.normalizeRule(t))},methods:{required:function(t,n,r){if(!this.depend(r,n))return"dependency-mismatch";if(n.nodeName.toLowerCase()==="select"){var i=e(n).val();return i&&i.length>0}return this.checkable(n)?this.getLength(t,n)>0:e.trim(t).length>0},email:function(e,t){return this.optional(t)||/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(e)},url:function(e,t){return this.optional(t)||/^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(e)},date:function(e,t){return this.optional(t)||!/Invalid|NaN/.test((new Date(e)).toString())},dateISO:function(e,t){return this.optional(t)||/^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}$/.test(e)},number:function(e,t){return this.optional(t)||/^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(e)},digits:function(e,t){return this.optional(t)||/^\d+$/.test(e)},creditcard:function(e,t){if(this.optional(t))return"dependency-mismatch";if(/[^0-9 \-]+/.test(e))return!1;var n=0,r=0,i=!1;e=e.replace(/\D/g,"");for(var s=e.length-1;s>=0;s--){var o=e.charAt(s);r=parseInt(o,10);i&&(r*=2)>9&&(r-=9);n+=r;i=!i}return n%10===0},minlength:function(t,n,r){var i=e.isArray(t)?t.length:this.getLength(e.trim(t),n);return this.optional(n)||i>=r},maxlength:function(t,n,r){var i=e.isArray(t)?t.length:this.getLength(e.trim(t),n);return this.optional(n)||i<=r},rangelength:function(t,n,r){var i=e.isArray(t)?t.length:this.getLength(e.trim(t),n);return this.optional(n)||i>=r[0]&&i<=r[1]},min:function(e,t,n){return this.optional(t)||e>=n},max:function(e,t,n){return this.optional(t)||e<=n},range:function(e,t,n){return this.optional(t)||e>=n[0]&&e<=n[1]},equalTo:function(t,n,r){var i=e(r);this.settings.onfocusout&&i.unbind(".validate-equalTo").bind("blur.validate-equalTo",function(){e(n).valid()});return t===i.val()},remote:function(t,n,r){if(this.optional(n))return"dependency-mismatch";var i=this.previousValue(n);this.settings.messages[n.name]||(this.settings.messages[n.name]={});i.originalMessage=this.settings.messages[n.name].remote;this.settings.messages[n.name].remote=i.message;r=typeof r=="string"&&{url:r}||r;if(i.old===t)return i.valid;i.old=t;var s=this;this.startRequest(n);var o={};o[n.name]=t;e.ajax(e.extend(!0,{url:r,mode:"abort",port:"validate"+n.name,dataType:"json",data:o,success:function(r){s.settings.messages[n.name].remote=i.originalMessage;var o=r===!0||r==="true";if(o){var u=s.formSubmitted;s.prepareElement(n);s.formSubmitted=u;s.successList.push(n);delete s.invalid[n.name];s.showErrors()}else{var a={},f=r||s.defaultMessage(n,"remote");a[n.name]=i.message=e.isFunction(f)?f(t):f;s.invalid[n.name]=!0;s.showErrors(a)}i.valid=o;s.stopRequest(n,o)}},r));return"pending"}}});e.format=e.validator.format})(jQuery);(function(e){var t={};if(e.ajaxPrefilter)e.ajaxPrefilter(function(e,n,r){var i=e.port;if(e.mode==="abort"){t[i]&&t[i].abort();t[i]=r}});else{var n=e.ajax;e.ajax=function(r){var i=("mode"in r?r:e.ajaxSettings).mode,s=("port"in r?r:e.ajaxSettings).port;if(i==="abort"){t[s]&&t[s].abort();t[s]=n.apply(this,arguments);return t[s]}return n.apply(this,arguments)}}})(jQuery);(function(e){e.extend(e.fn,{validateDelegate:function(t,n,r){return this.bind(n,function(n){var i=e(n.target);if(i.is(t))return r.apply(i,arguments)})}})})(jQuery);
// jQuery Masked input
(function(e){function t(){var e=document.createElement("input"),t="onpaste";return e.setAttribute(t,""),"function"==typeof e[t]?"paste":"input"}var n,a=t()+".mask",r=navigator.userAgent,i=/iphone/i.test(r),o=/android/i.test(r);e.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn",placeholder:"_"},e.fn.extend({caret:function(e,t){var n;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof e?(t="number"==typeof t?t:e,this.each(function(){this.setSelectionRange?this.setSelectionRange(e,t):this.createTextRange&&(n=this.createTextRange(),n.collapse(!0),n.moveEnd("character",t),n.moveStart("character",e),n.select())})):(this[0].setSelectionRange?(e=this[0].selectionStart,t=this[0].selectionEnd):document.selection&&document.selection.createRange&&(n=document.selection.createRange(),e=0-n.duplicate().moveStart("character",-1e5),t=e+n.text.length),{begin:e,end:t})},unmask:function(){return this.trigger("unmask")},mask:function(t,r){var c,l,s,u,f,h;return!t&&this.length>0?(c=e(this[0]),c.data(e.mask.dataName)()):(r=e.extend({placeholder:e.mask.placeholder,completed:null},r),l=e.mask.definitions,s=[],u=h=t.length,f=null,e.each(t.split(""),function(e,t){"?"==t?(h--,u=e):l[t]?(s.push(RegExp(l[t])),null===f&&(f=s.length-1)):s.push(null)}),this.trigger("unmask").each(function(){function c(e){for(;h>++e&&!s[e];);return e}function d(e){for(;--e>=0&&!s[e];);return e}function m(e,t){var n,a;if(!(0>e)){for(n=e,a=c(t);h>n;n++)if(s[n]){if(!(h>a&&s[n].test(R[a])))break;R[n]=R[a],R[a]=r.placeholder,a=c(a)}b(),x.caret(Math.max(f,e))}}function p(e){var t,n,a,i;for(t=e,n=r.placeholder;h>t;t++)if(s[t]){if(a=c(t),i=R[t],R[t]=n,!(h>a&&s[a].test(i)))break;n=i}}function g(e){var t,n,a,r=e.which;8===r||46===r||i&&127===r?(t=x.caret(),n=t.begin,a=t.end,0===a-n&&(n=46!==r?d(n):a=c(n-1),a=46===r?c(a):a),k(n,a),m(n,a-1),e.preventDefault()):27==r&&(x.val(S),x.caret(0,y()),e.preventDefault())}function v(t){var n,a,i,l=t.which,u=x.caret();t.ctrlKey||t.altKey||t.metaKey||32>l||l&&(0!==u.end-u.begin&&(k(u.begin,u.end),m(u.begin,u.end-1)),n=c(u.begin-1),h>n&&(a=String.fromCharCode(l),s[n].test(a)&&(p(n),R[n]=a,b(),i=c(n),o?setTimeout(e.proxy(e.fn.caret,x,i),0):x.caret(i),r.completed&&i>=h&&r.completed.call(x))),t.preventDefault())}function k(e,t){var n;for(n=e;t>n&&h>n;n++)s[n]&&(R[n]=r.placeholder)}function b(){x.val(R.join(""))}function y(e){var t,n,a=x.val(),i=-1;for(t=0,pos=0;h>t;t++)if(s[t]){for(R[t]=r.placeholder;pos++<a.length;)if(n=a.charAt(pos-1),s[t].test(n)){R[t]=n,i=t;break}if(pos>a.length)break}else R[t]===a.charAt(pos)&&t!==u&&(pos++,i=t);return e?b():u>i+1?(x.val(""),k(0,h)):(b(),x.val(x.val().substring(0,i+1))),u?t:f}var x=e(this),R=e.map(t.split(""),function(e){return"?"!=e?l[e]?r.placeholder:e:void 0}),S=x.val();x.data(e.mask.dataName,function(){return e.map(R,function(e,t){return s[t]&&e!=r.placeholder?e:null}).join("")}),x.attr("readonly")||x.one("unmask",function(){x.unbind(".mask").removeData(e.mask.dataName)}).bind("focus.mask",function(){clearTimeout(n);var e;S=x.val(),e=y(),n=setTimeout(function(){b(),e==t.length?x.caret(0,e):x.caret(e)},10)}).bind("blur.mask",function(){y(),x.val()!=S&&x.change()}).bind("keydown.mask",g).bind("keypress.mask",v).bind(a,function(){setTimeout(function(){var e=y(!0);x.caret(e),r.completed&&e==x.val().length&&r.completed.call(x)},0)}),y()}))}})})(jQuery);

// check to make sure it is not loaded on mobile device
var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);

var FSV = {
	onReady: function() {
		FSV.preload();
		FSV.initAddClasses();
		FSV.initValidateForms();
		FSV.initNotify();
		FSV.initScooch();
		FSV.initDelayClasses();
		FSV.initRemoveClass();
		FSV.initScroll();
		FSV.initScoochHover();
		FSV.initSwapImage();
		FSV.initAddHandle();
		FSV.initTrackDrop();
		FSV.initUnlink();
		FSV.initProductImage();
		FSV.initBlogScroll();
		if(jQuery('body').hasClass('post-type-archive-product') || jQuery('body').hasClass('tax-product_cat')) {
			// FSV.initBlogScroll();
		}
		if(isMobile) {
			// FSV.mobileHoverFix();
		}
	},
	preload: function(arrayOfImages) {
		jQuery(arrayOfImages).each(function(){
	        jQuery('<img/>')[0].src = this;
	    });
	},
	mobileHoverFix: function() {
        // Check if the device supports touch events
        if('ontouchstart' in document.documentElement) {
            // Loop through each stylesheet
            for(var sheetI = document.styleSheets.length - 1; sheetI >= 0; sheetI--) {
                var sheet = document.styleSheets[sheetI];
                // Verify if cssRules exists in sheet
                if(sheet.cssRules) {
                    // Loop through each rule in sheet
                    for(var ruleI = sheet.cssRules.length - 1; ruleI >= 0; ruleI--) {
                        var rule = sheet.cssRules[ruleI];
                        // Verify rule has selector text
                        if(rule.selectorText) {
                            // Replace hover psuedo-class with active psuedo-class
                            rule.selectorText = rule.selectorText.replace(":hover", ":active");
                        }
                    }
                }
            }
        }
        // try to keep the hover over effect on mobile links
        jQuery('a, button').each(function() {
            jQuery(this).bind('touchstart touchend', function() {
                jQuery(this).toggleClass("hover");
            });
        });
    },
	initProductImage: function() {
		jQuery('.thumbnails a').click(function(e){
			e.preventDefault();
			var img = jQuery(this).find("img").attr("url");
			jQuery('.woocommerce-main-image img').attr("src",img);
		});
		jQuery('.woocommerce-main-image img').click(function(e){
			e.preventDefault();
		});
	},
	initUnlink: function() {
		jQuery('.unlink').click(function(e){
			e.preventDefault();
		});
	},
	initCountChar: function(val) {
		var len = val.value.length;
		if (len >= 140) {
			val.value = val.value.substring(0, 140);
		} else {
			jQuery('#charNum').text(140 - len);
		}
	},
	initTrackDrop: function() {
		var imageLoader = jQuery("#img");
		if(imageLoader.length) {
    		imageLoader.addEventListener('change', FSV.initDroppable(), false);
    	}
	},
	initDroppable: function(e) {
		var reader = new FileReader();
	    reader.onload = function (event) {
	    	jQuery('.desc').hide();
	        jQuery('#imageDrop').prepend('<img src="'+event.target.result+'" alt="" />');
	    }
	    reader.readAsDataURL(e.target.files[0]);
	},
	initTweetValidate: function() {
		var val = document.getElementById('img').value;
		var val2 = document.getElementById('txt').value;
		var msg = '';

		if(val == '') {
			msg+='Select An Image\n';
		}
		if(val2 == '') {
		    msg+='Enter Your Tweet';
		}
		if(msg != '') {
			alert(msg);
			return false;	
		} else {
			return true;
		}
	},
	initAddHandle: function() {
		jQuery("#txt").on('click', function() {
		    var caretPos = document.getElementById("txt").selectionStart;
		    var textAreaTxt = jQuery("#txt").val();
		    var txtToAdd = "@5StarVintage ";
		    if(jQuery("#txt").val() === "") {
		    	jQuery("#txt").val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
		    }
		});
	},
	initScroll: function() {
		var window_width = jQuery(window).width() - jQuery('.m-scooch-inner').width();
		var document_height = jQuery(document).height() - jQuery(window).height();

		jQuery(window).scroll(function () {
			// console.log("fired");
	        var scroll_position = jQuery(window).scrollTop();
	        var object_position_left = window_width * (scroll_position / document_height);
	        jQuery('.m-scooch').scrollLeft(object_position_left);
	    });
	},
	initRemoveClass: function() {
		jQuery('.state_select').removeClass("form-control");
		jQuery('#place_order').addClass("btn btn-large btn-block main-btn");
		jQuery('.button').each(function(){
			if(!jQuery(this).hasClass("btn btn-primary btn-large btn-block")) {
				jQuery(this).addClass("btn btn-primary btn-large btn-block");
			}
		});
	},
	onMove: function() {
		FSV.fadeInUp();
		FSV.slideInLeft();
		FSV.slideInRight();
	},
	isOnScreen: function(elem) {
		var item = jQuery(elem);
		var win = jQuery(window);
	    var viewport = {
	        top : win.scrollTop(),
	        left : win.scrollLeft()
	    };
	    viewport.right = viewport.left + win.width();
	    viewport.bottom = viewport.top + (win.height() - 200);
	 
	    var bounds = item.offset();
	    bounds.right = bounds.left + item.outerWidth();
	    bounds.bottom = bounds.top + item.outerHeight();
	 
	    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
	},
	fadeInUp: function() {
		var fadeWrap = jQuery('*[data-animation="FadeIn"]');
		if(fadeWrap.length > 0) {
			fadeWrap.each(function(){
				var text = jQuery(this);
				if(FSV.isOnScreen(text)) {
					text.addClass("faded");
				} else {
					jQuery(window).scroll(function(){
						if(FSV.isOnScreen(text)) {
							text.addClass("faded");
						} else {
							text.removeClass("faded");
						}
					});
				}
			});
		}
	},
	slideInLeft: function() {
		var wrap = jQuery('*[data-animation="slideInLeft"]');
		if(wrap.length > 0){
			wrap.each(function(){
				var section = jQuery(this);
				var parent = jQuery(this).parent();
				if(FSV.isOnScreen(parent)) {
					section.addClass("slide");
				} else {
					jQuery(window).scroll(function(){
						if(FSV.isOnScreen(parent)) {
							section.addClass("slide");
						} else {
							section.removeClass("slide");
						}
					});
				}
			});
		}
	},
	slideInRight: function() {
		var wrap = jQuery('*[data-animation="slideInRight"]');
		if(wrap.length > 0){
			wrap.each(function(){
				var section = jQuery(this);
				var parent = jQuery(this).parent();
				if(FSV.isOnScreen(parent)) {
					section.addClass("slide");
				} else {
					jQuery(window).scroll(function(){
						if(FSV.isOnScreen(parent)) {
							section.addClass("slide");
						} else {
							section.removeClass("slide");
						}
					});
				}
			});
		}
	},
	initRemoveHomeClasses: function() {
		jQuery('.btn-home, .HomeHeader, .down, .up').each(function(){
			jQuery(this).removeClass("active");
		});
		setTimeout(
			function() {
				FSV.initDelayClasses();
			}, 500
		);
	},
	initDelayClasses: function() {
		jQuery('.home-button').each(function(index) {
			jQuery(this).delay(300*index).queue(function(){
				jQuery(this).addClass("active");
			});
		});
		jQuery('.HomeHeader').each(function(index) {
			jQuery(this).delay(150*index).queue(function(){
				jQuery(this).addClass("active");
			});
			setTimeout(
				function() {
					jQuery('.HomeHeader').css( "z-index", 9999 );
				}, 500
			);
		});
		jQuery('.type-product').each(function(index) {
           jQuery(this).delay(30*index).queue(function(){
                jQuery(this).addClass("load");
            });
        });
	},
	initSwapImage: function() {
		jQuery('.woocommerce-product-gallery__image a').click(function(e) {
			e.preventDefault();
			var image = jQuery(this).attr("href");
			jQuery('.woocommerce-product-gallery__image .wp-post-image').attr("srcset", "");
			jQuery('.woocommerce-product-gallery__image .wp-post-image').attr("src", image);
		});
	},
	initScooch: function() {
		jQuery('.m-scooch').each(function(){
			jQuery(this).scooch();
		});
	},
	initScoochHover: function() {
		jQuery('.m-scooch').hover(function(){
			jQuery('.m-arrow').each(function(){
				jQuery(this).addClass("in");
			});
		}, function(){
			jQuery('.m-arrow').each(function(){
				jQuery(this).removeClass("in");
			});
		});
	},
	initNotify: function() {
		setTimeout(
			function() {
				jQuery('#notifyBar').slideDown("slow");
			}, 1500
		);
		jQuery('#notifyBar i').click(function(){
			jQuery('#notifyBar').slideUp("fast");
		});
	},
	initAddClasses: function() {
		// add the classes to all form elements
		jQuery('.form-row').each(function(){
			jQuery('.form-row input, .form-row select').addClass("form-control");
			jQuery('label').addClass("control-label");
		});
		setTimeout(
			function() {
				jQuery('.country_select').each(function() {
					jQuery(this).removeClass("form-control");
				});
			}, 200
		);
		// add class to textarea on checkout
		jQuery("#order_comments_field textarea").each(function(){
			jQuery(this).addClass("form-control");
		});
		// add class to qty input
		jQuery('.qty').addClass("form-control");
		// add class to .menu class
		jQuery('.menu').addClass("list-unstyled");
		// add class to parent
		jQuery('.dropdown').on("hover", function(){
			jQuery(this).prev().toggleClass("active");
		});
	},
	initValidateForms: function() {
		jQuery('#contact_frm').validate({
			rules: {
				name: {
					minlength: 2,
					required: true
				},
				emailaddress: {
					required: true,
					email: true
				},
				message: {
					required: true
				}
			},
			highlight: function(element) {
				jQuery(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element.addClass('valid').closest('.control-group').removeClass('error').addClass('success');
			}
		});
		jQuery('#vendors_frm').validate({
			rules: {
				name: {
					minlength: 2,
					required: true
				},
				emailaddress: {
					required: true,
					email: true
				},
				phonenumber: {
					required: true
				},
				storename: {
					required: true
				},
				storedescription: {
					required: true
				},
				paypalemail: {
					required: true,
					email: true
				}
			},
			highlight: function(element) {
				jQuery(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element.addClass('valid').closest('.control-group').removeClass('error').addClass('success');
			}
		});
	},
	initBlogScroll: function () {
        jQuery(window).scroll( function() {
            var totalHeight = (jQuery(window).scrollTop() + jQuery(window).height());
            if(!ajax.loading && totalHeight === jQuery(document).height() ) {
                ajax.loading = true;
                FSV.initBlogAjax();
            }
        });
    },
    initBlogAjax: function() {
    	var url = window.location.href,
	    parts = url.split("/"),
	    last_part = parts[parts.length-2];
        jQuery.ajax({
            url: ajax.ajaxurl,
            type: "post",
            data: {
            	action: 'ajaxBlog',
            	pageNumber: ajax.page,
            	cat: last_part
            },
            dataType: "html",
            beforeSend : function(){
                if(ajax.page !== 1){
                    jQuery("#products ul.products").append('<div id="temp_load"><i class="fa fa-spinner fa-spin"></i></div>');
                }
                ajax.loading = true;
            },
            success : function(data){
                if(jQuery(data).length && ajax.page > 1){
                    // fade response data in
	                jQuery("#temp_load").remove();
	                jQuery("#products ul.products").append(jQuery(data));
                } else {
                    // remove loader
                    jQuery("#temp_load").remove();
                }
            },
            complete : function() {
            	jQuery("#products ul.products li").addClass("load");
            	ajax.page++;
                ajax.loading = false;
            },
            error : function(jqXHR, textStatus, errorThrown) {
                jQuery("#temp_load").remove();
                console.log(errorThrown);
            }
        });
    }
};

jQuery(document).ready(function() {

	FSV.onReady();

	function SubmitForm() {
		var contactForm = jQuery('#contact_frm');
	    // Submit the form to the PHP script via Ajax
	    jQuery('<i class="icon-spinner"></i>').prependTo('.btn-submit');
	    jQuery.ajax({
	      url: contactForm.attr('action')+"?ajax=true",
	      type: contactForm.attr('method'),
	      data: contactForm.serialize(),
	      success: FormResponse
	    });
		// Prevent the default form submission occurring
		return false;
	}

	function FormResponse(response) {

		jQuery('.btn-submit i').remove();

		if (response === "success") {
			// Form submitted successfully:
			// 1. Display the success message
			// 2. Clear the form fields
			// 3. Fade the content back in
			jQuery('#successMessage').css( "display","block").fadeIn();
			jQuery('#name').val( "" );
			jQuery('#emailaddress').val( "" );
			jQuery('#message').val( "" );
			jQuery('.control-group').removeClass("success");
			jQuery('input').removeClass("valid");
		}

		if (response === "error"){
			// Form submission failed: Display the failure message,
			// then redisplay the form
			jQuery('#failureMessage').css( "display","block").fadeIn();
		}
	}

	jQuery('#contact_frm').submit( SubmitForm );

});