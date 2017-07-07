/**
 * Created by sinarts on 17/1/11.
 */
;(function(root, factory) {
    //amd
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') { //umd
        module.exports = factory();
    } else {
        root.jeCheck = factory(window.jQuery || $);
    }
})(this, function($) {
    $.fn.jeCheck = function(options){
        return this.each(function(){
            return new jeCheck($(this),options||{});
        });
    };
    $.extend({
        jeCheck:function(elem, options){
            return $(elem).each(function(){
                return new jeCheck($(this),options||{});
            });
        }
    });
    var config = {
        radioCls:"je-radio",        //radio最外层的样式
        checkCls:"je-check",        //checkbox最外层的样式
        current:'on',                 //被选中的样式
        disabled:"disabled",          //被禁用的样式
        currDisa:"checkDisa",         //被选中加禁用的样式
        typeName:"jename",            //设置文字属性
        switchText:["NO","OFF"],
        icons:['&#xe65c;','&#xe63c;','&#xe6a0;'], 
        itemfun:function(elem){},     //点击当前的回调，elem为当前点击的ID
        success : null                //加载成功后的回调函数
    },
    jeCheck = function (elem, opts){
        this.opts = $.extend(config, opts||{});
        this.elCell = elem;
        this.init();
    };
    var jefn = jeCheck.prototype;
    jefn.init = function () {
        var _this = this, opts = _this.opts,
            inputs = _this.elCell.find("input");
        $.each(inputs,function () {
            var that = $(this);
            if (typeof(that.attr('switch')) != "undefined"){
                _this.switchRadioCheck(that);
            }else {
                _this.radioCheck(that);
            }
        });
        //加载成功后的回调
        if ($.isFunction(opts.success) || opts.success != ("" || null)) {
            opts.success && opts.success();
        }
    };
    jefn.switchRadioCheck = function (that) {
        var _this = this, opts = _this.opts;
        if (that.attr('type') == 'checkbox' || that.attr('type') == 'radio'){
            var wrapTag = that.attr('type') == 'checkbox' ? '<ins class="' + opts.checkCls + '-switch"></ins>' : '<ins class="' + opts.radioCls + '-switch"></ins>';
            //创建SPAN并获取文字
            var spanCls = "<span>"+opts.switchText[1]+"</span><em></em>";
            that.wrap(wrapTag).after(spanCls);
            _this.isChecked(that);
        }
    }
    jefn.radioCheck = function (that) {
        var _this = this, opts = _this.opts;
        //判断是否为多选或单选
        if (that.attr('type') == 'checkbox' || that.attr('type') == 'radio'){
            //包裹多选或单选
            var wrapTag = that.attr('type') == 'checkbox' ? '<ins class="' + opts.checkCls + '"></ins>' : '<ins class="' + opts.radioCls + '"></ins>';
            //创建SPAN并获取文字
            var spanCls = "<em>" + (that.attr('type') == 'checkbox' ? opts.icons[0] : opts.icons[1]) + "</em><span class='" + (that.attr('type') == 'checkbox' ? opts.checkCls : opts.radioCls) + "-text'>" + (that.attr(opts.typeName) != undefined ? that.attr(opts.typeName) : '勾选') + "</span>";
            that.wrap(wrapTag).after(spanCls);
            _this.isChecked(that);
        }
    };
    jefn.isChecked = function (that) {
        var _this = this, opts = _this.opts, onCls = opts.current,
        //检查switch模式的选中状态
        checkSwitchBind = function (that,onCls) {
            if (typeof(that.attr('switch')) != "undefined") {
                if (that.is(':checked')) {
                    that.parent().addClass(onCls);
                    that.next().html(opts.switchText[0]);
                } else {
                    that.parent().removeClass(onCls);
                    that.next().html(opts.switchText[1]);
                }
            }else {
                _this.onSetStyle(that, onCls); 
            }
        };
        that.on('change', function () {
            var inpthis = $(this);
            if (inpthis.attr('type') == 'radio') {
                _this.elCell.find('input[name="' + inpthis.attr('name') + '"]').each(function () {
                    checkSwitchBind($(this), onCls);
                })
            } else if (inpthis.attr('type') == 'checkbox') {
                checkSwitchBind(inpthis, onCls);
            }
            //点击当前的回调
            if ($.isFunction(opts.itemfun) || opts.itemfun != ("" || null)) {
                opts.itemfun && opts.itemfun(inpthis);
            }
        });
        //判断是否为选中
        if (that.is(':checked')) {
            that.parent().addClass(opts.current);
            if (typeof(that.attr('switch')) != "undefined"){
                that.next().text(opts.switchText[0]);
            }else {
                if (that.attr('type') == 'radio') that.next().html(opts.icons[2]);
            }
        }
        //判断是否为禁用
        if (that.prop("disabled") == true) {
            that.parent().removeClass(opts.current).addClass(opts.disabled);
        }
        //判断是否为选中加禁用
        if (that.is(':checked') && that.prop("disabled") == true) {
            that.parent().addClass(opts.current).removeClass(opts.disabled).addClass(opts.currDisa);
        }
    };
    //设置点击后的样式
    jefn.onSetStyle = function (elem, cls) {
        var _this = this, opts = _this.opts;
        if (elem.is(':checked')) {
            elem.parent().addClass(cls);
            if (elem.attr('type') == 'radio') elem.next().html(opts.icons[2]);
        } else {
            elem.parent().removeClass(cls);
            if (elem.attr('type') == 'radio') elem.next().html(opts.icons[1]);
        }
        
    };
    return jeCheck;
});
