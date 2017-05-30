$(function() {

    /**正则判断函数**/
    function regexJudge(param) {
        //1.手机正则验证
        var phoneRegex = "^(\(\d{3,4}-)|\d{3.4}-)?\d{7,8}$";
        //2.密码正则验证（6到18位数字字母下划线）
        var passwordRegex = "^[a-zA-Z]\w{5,17}$";
        if (phoneRegex.match(param)) {
            return 'phoneSuccess';
        } else if (passwordRegex.match(param)) {
            return 'passwordSuccess';
        } else {
            return 'fail';
        }
    }

    /**
     * 获取input里面的文本值
     */
    function getTextValue(element) {
        return element.val().trim().toString();
    }

    /**获取能够登录成功的用户信息**/
    function collectUserInfo() {
        var userInfo = {};
        userInfo.username = getTextValue($('#phoneNumber'));
        userInfo.password = getTextValue($('#confirmPassword'));
        $.ajax({
            url: '',
            data: userInfo,
            success: function(param) {},
            error: function(param) {}
        });
    }

    /**
     * 用户填写登录表单相应提示
     */
    function loginFormTooltip() {
        var phoneNumber = $('#phoneNumber');
        //1.手机号码验证
        phoneNumber.blur(function() {
            var parttern = /^1[3|4|5|7|8][0-9]{9}$/;
            var correctPhoneNumber = parttern.test(getTextValue(phoneNumber));
            if (correctPhoneNumber) {
                console.log(123);

            } else {
                $('#exampleModal').modal('show');
                $('#toolTipInfo').html('请输入正确的手机号码1');
            }
        });
    }
    loginFormTooltip();



    $('.weui-label').click(function() {

        //1.点击 获取验证码 按钮
        //1.1 向后台请求 验证码 
        $('.weui-label').addClass('weui-btn_plain-disabled');
        var totalTime = 60;
        var typeInCode = $('#typeIncode').val().trim().toString();
        var callBackCode = requestForCode();
        if (typeInCode == callBackCode) { //输入的验证码和后台返回的验证码一致

        } else {

        }
        var timer = setInterval(function() {
            $('.weui-label').html(totalTime + 's');
            totalTime--;
            if (totalTime < 0) {
                clearInterval(timer);
                $('.weui-label').removeClass('weui-btn_plain-disabled');
                $('.weui-label').html('获取验证码');
            }
        }, 1000);
        //1.2 校验后台验证码

        function requestForCode() {
            var code = param;
            return code;
            // $.ajax({
            //     url:''
            // })
        }

    })



})

// $('#exampleModal').on('hide.bs.modal', function(event) {
//     var button = $(event.relatedTarget) // Button that triggered the modal
//     var recipient = button.data('whatever') // Extract info from data-* attributes
//         // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
//         // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
//     var modal = $(this)
//     modal.find('.modal-title').text('New message to ' + recipient)
//     modal.find('.modal-body input').val(recipient)
// });