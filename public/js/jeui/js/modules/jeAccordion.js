/**
 * Created by SinArts on 2017/4/1.
 */
(function(root, factory) {
    //amd
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], factory);
    } else if (typeof exports === "object") {
        //umd
        module.exports = factory();
    } else {
        root.jeAccordion = factory(window.$ || $);
    }
})(this, function($) {
    var jeAccordion = function(elem, opts) {
        var config = {
            accIndex:1,                   //表示展开第几个，如果为0时全部展开
            titCell:"h3",
            conCell:"ul",
            currCell:"current",
            multiple:true,                //为true时展开当前，收起其他
            success : null                //加载成功后的回调函数
        };
        this.opts = $.extend(true,config, opts || {});
        this.elCell = elem;
        this.init();
    };
    $.fn.jeAccordion = function(options) {
        return this.each(function() {
            return new jeAccordion($(this), options || {});
        });
    };
    $.extend({
        jeAccordion:function(elem, options) {
            return $(elem).each(function() {
                return new jeAccordion($(this), options || {});
            });
        }
    });
    jeAccordion.prototype.init = function () {
        var that = this, opts = that.opts, idx = parseInt(opts.accIndex)-1,
            titCell = opts.titCell, conCell = opts.conCell, currCell = opts.currCell,
            titLi = that.elCell.find(titCell), 
            eqIndex = that.elCell.children().eq(idx),
            menuChild = that.elCell.find(conCell).children();
        //展开第几个
        if(idx >= 0){
            eqIndex.children(titCell).addClass(currCell);
            eqIndex.children(conCell).show();
        }else {
            that.elCell.children(titCell).addClass(currCell);
            that.elCell.children(conCell).show();
        }
        
        //绑定事件
        titLi.on("click",function () {
            var _this = $(this), next = _this.next();
            next.slideToggle();
            _this.parent().children(titCell).toggleClass(currCell);
            if (opts.multiple) {
                that.elCell.find(conCell).not(next).slideUp().parent().children(titCell).removeClass(currCell);
            };
        });
        //给菜单绑定事件
        menuChild.on("click",function(){
            menuChild.removeClass(currCell);
            $(this).addClass(currCell);
        });
        //加载成功后的回调
        if ($.isFunction(opts.success) || opts.success != ("" || null)) {
            opts.success && opts.success();
        }
    };
    return jeAccordion;
});