/**
 * Created by sinarts on 17/1/19.
 */
(function(root, factory) {
    //amd
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], factory);
    } else if (typeof exports === "object") {
        //umd
        module.exports = factory();
    } else {
        root.jeTabs = factory(window.$ || $);
    }
})(this, function($) {
    var config = {
        headCls:".tabheader",
        contCls:".tabcontent",
        childCls:"tabitem",
        currCls:"on",                            //当前高亮的标识clss
        trigger:"click",                         //选项卡事件
        isClose:true,                            //是否开启关闭按钮
        tabIndex:1,                              //默认的当前位置索引。1是第一个；表示从第几个开始
        insAttr:["title","tab"],                 //插入对应的属性
        fragment:"",                             //插入内容片段 
        itemfun:function(elem, index, val) {},   //点击当前的回调，elem：当前Select的ID index：索引 val：选中的值
        success:null                             //加载成功后的回调
    }, jeTabs = function(elem, opts) {
        this.opts = $.extend(config, opts || {});
        this.elCell = elem;
        this.init();
    };
    var jefn = jeTabs.prototype, je = {emCls:"<em>&times;</em>"};
    var goTabMove = function (elem,idx,curr) {
        elem[0].removeClass(curr).eq(idx).addClass(curr);
        elem[1].removeClass(curr).eq(idx).addClass(curr);
    };
    $.fn.jeTabs = function(options) {
        return this.each(function() {
            return new jeTabs($(this), options || {});
        });
    };
    $.extend({
        jeTabs:function(elem, options) {
            return $(elem).each(function() {
                return new jeTabs($(this), options || {});
            });
        }
    });
    $.jeTabs.addTab = function (elem) {
        jefn.tabAppend(elem);
    };
    jefn.init = function () {
        var that = this, opts = that.opts,
            headCell = that.elCell.find(opts.headCls).children(),
            conCell = that.elCell.find(opts.contCls).children();
        je.that = that;
        //获取选项卡的各类属性值
        that.litag = headCell.prop("tagName") || "li";
        that.contag = conCell.prop("tagName") || "div";
        that.conChild = conCell.prop("className");
        //选项卡动作与面板
        that.onTabMove(opts.tabIndex - 1);
        that.onTabPane();
        //是否给选项卡标签插入关闭元素
        if(opts.isClose){
            $.each(headCell,function(i,el){
                $(this).append(je.emCls);
            });
            that.onClose("em");
        }
        //加载成功后的回调
        if ($.isFunction(opts.success) || opts.success != ("" || null)) {
            opts.success && opts.success();
        }
    };
    //选项卡动作关系
    jefn.onTabMove = function (idx) {
        var that = this, opts = that.opts, curr = opts.currCls;
        that.elCell.find(opts.headCls).children().eq(idx).addClass(curr).siblings().removeClass(curr);
        that.elCell.find(opts.contCls).children().eq(idx).addClass(curr).siblings().removeClass(curr);
    };
    //选项卡面板
    jefn.onTabPane = function () {
        var that = this, opts = that.opts;
        //给选项卡绑定事件
        that.elCell.find(opts.headCls).on(opts.trigger,that.litag, function() {
            that.idx = $(this).index();
            that.onTabMove(that.idx);
        });
    };
    //追加新的选项卡
    jefn.tabAppend = function (elem) {
        var that = je.that, opts = that.opts, 
            curr = opts.currCls, atr = opts.insAttr,
            headCell = that.elCell.find(opts.headCls),
            conCell = that.elCell.find(opts.contCls),
            //创建新元素
            lis = $("<"+that.litag+"/>",{"class":curr}),
            divs = $("<"+that.contag+"/>",{"class":that.conChild});
        //判断选项卡情况
        var headAttr = [],
            contain = function (arr,val) {
                for(var i=0; i<arr.length; i++){
                    if(arr[i] == val) return true
                }
                return false;
            };
        $.each(headCell.children("["+opts.insAttr[1]+"]"),function () {
            headAttr.push($(this).attr(opts.insAttr[1]));
        });
        var insAttrOne = elem.attr(opts.insAttr[1]);
        //如果有相同的选项卡就不再增加新选项卡，同时给相同的选项卡选中
        if( contain(headAttr , insAttrOne)) {
            //获取已经存在选项卡的索引
            var idx = headCell.children("["+opts.insAttr[1]+"="+ elem.attr(opts.insAttr[1])+"]").index();
            goTabMove([headCell.children(),conCell.children()],idx,curr);
        }else{
            //创建点击标签并插入
            headCell.children().removeClass(curr);
            //将获取到的内容插入到对应的标签
            var newem = opts.isClose ? $(je.emCls).attr("id","tabdel"+insAttrOne) : "";
            headCell.append(lis.attr(atr[1], elem.attr(atr[1])).text(elem.attr(atr[0])).append(newem).addClass(curr));
            //创建内容标签并插入
            conCell.children().removeClass(curr);
            if ($.isFunction(opts.fragment) || opts.fragment != ("" || null)) {
                var fragmentcenter = opts.fragment && opts.fragment(elem);
            }
            //插入新内容
            conCell.append(divs.attr("id","tabcon"+insAttrOne).html(fragmentcenter).addClass(curr)); 
        }
        //加载选项卡
        that.onTabPane();
        if(opts.isClose) that.onClose(insAttrOne);
    };
    //点击关闭按钮，进行对应关闭
    jefn.onClose = function (cell) {
        var that = this, opts = that.opts, curr = opts.currCls,
            headCell = that.elCell.find(opts.headCls).children(),
            contCls = that.elCell.find(opts.contCls).children();
        $("#tabdel"+cell).on(opts.trigger, function() {
            //获取当前选项卡的索引
            var idx = $(this).parent().index(),
                len = that.elCell.find(opts.headCls).children().length;
            //判断剩余的个数是否大于一
            if (len > 1) {  
                idx == 0 ? goTabMove([headCell,contCls],idx + 1,curr) : goTabMove([headCell,contCls],idx - 1,curr);
                //查找当前元素的父级节点并删除
                $(this).parent().remove();
                that.elCell.find(opts.contCls).children("#tabcon"+cell).remove();
            }
        })
    };
    return jeTabs;
});
