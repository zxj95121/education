$(function() {

    /**
     * 获取input里面的文本值
     */
    function getTextValue(element) {
        return element.val().trim();
    }

    /**
     * 像后台请求验证码
     */
    function requestForCode() {
        return '1234';
        // $.ajax({
        //     url:''
        // })
    }

    /**
     * 模态框显示相应信息
     */
    function modalShowTip(parttern, message, element) {
        var correct = parttern.test(getTextValue(element));
        if (correct) {
            console.log(123);
        } else {
            $('#exampleModal').modal('show');
            $('#toolTipInfo').html(message);
            setTimeout(function() {
                $('#exampleModal').modal('hide');
            }, 2000);
        }
    }

    /**正则判断函数**/
    function regexJudge(param) {
        //1.手机正则验证
        var phoneRegex = /^1[3|4|5|7|8][0-9]{9}$/;
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
        var firstPassword = $('#firstPassword');
        var confirmPassword = $('#confirmPassword');
        var firstPasswordValue = '';
        var confirmPasswordValue = '';
        //1.手机号码验证
        phoneNumber.blur(function() {
            if (getTextValue(phoneNumber).length > 0) { //输入了文本
                modalShowTip(/^1[3|4|5|7|8][0-9]{9}$/, '您输入的手机号码不正确', phoneNumber);
            }
        });
        //2.密码验证
        //2.1 firstPassword值格式校验
        firstPassword.change(function() {
            modalShowTip(/^[0-9a-zA-Z_]{6,18}$/, '您输入的密码格式不正确', firstPassword);
            firstPasswordValue = getTextValue(firstPassword);
            console.log('firstPasswordValue', firstPasswordValue);
        });

        //2.2 confirmPassword 和  firstPassword对比校验
        // confirmPassword.change(function() {
        //     confirmPasswordValue = getTextValue(confirmPassword);
        //     console.log('confirmPasswordValue', confirmPasswordValue);
        //     if (true) {
        //         message = '您两次输入的密码不一致';
        //     }
        //     modalShowTip(/^[0-9a-zA-Z_]{6,18}$/, message, firstPassword);
        // });

    }

    loginFormTooltip();



    $('.obtainCode').click(function() {

        //1.点击 获取验证码 按钮
        //1.1 向后台请求 验证码 
        $('.obtainCode').addClass('weui-btn_plain-disabled');
        var totalTime = 60;
        var callBackCode = requestForCode();
        console.log('callBackCode', callBackCode);
        $('#typeInCode').blur(function() {
            var typeInCode = getTextValue($('#typeInCode'));
            if (typeInCode == callBackCode) { //输入的验证码和后台返回的验证码一致

            } else {
                modalShowTip('验证码不正确');
            }
        });

        var timer = setInterval(function() {
            $('.obtainCode').html(totalTime + 's');
            totalTime--;
            if (totalTime < 0) {
                clearInterval(timer);
                $('.obtainCode').removeClass('weui-btn_plain-disabled');
                $('.obtainCode').html('获取验证码');
            }
        }, 1000);
        //1.2 校验后台验证码





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